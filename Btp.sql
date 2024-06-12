create database btp;

\c btp

create table client(
    id serial PRIMARY KEY,
    contact varchar(15) unique
);

create table maison(
    id serial PRIMARY KEY,
    nom varchar(50) not null,
    surface double precision not null,
    "description" varchar(250) not null,
    duree double precision not null
);
ALTER TABLE maison
ADD CONSTRAINT unique_nom_maison UNIQUE (nom);



create table finition_maison(
    id serial PRIMARY KEY,
    nom varchar(20) not null unique,
    pourcentage float not null
);


create table traveaux(
    id serial PRIMARY KEY,
    code varchar(20),
    nom varchar(50) not null,
    prix_unitaire double precision not null,
    unite varchar(10) not null
);
ALTER TABLE traveaux
ADD CONSTRAINT unique_nom_traveaux UNIQUE (code);


create or replace view v_traveaux as select id,code,nom,prix_unitaire,unite from traveaux;

create table traveaux_type_maison(
    id serial PRIMARY KEY,
    id_maison int,
    id_traveaux int,
    quantite float,
    -- duree float,
    FOREIGN KEY (id_maison) REFERENCES maison(id),
    FOREIGN KEY (id_traveaux) REFERENCES traveaux(id)
);


create or replace view v_traveaux_maison as 
    select tm.id,tm.id_maison,m.nom,m.description,tm.id_traveaux,t.code,m.duree duree,(t.prix_unitaire*tm.quantite) prix,t.prix_unitaire,tm.quantite,t.unite
        from traveaux_type_maison tm 
            join maison m on tm.id_maison = m.id
            join v_traveaux t on tm.id_traveaux = t.id; 

-----1
create or replace view v_maison as select id_maison id,nom,description,sum(prix) prix,duree from v_traveaux_maison group by id_maison,nom,description,duree;


create SEQUENCE REF_SEQ INCREMENT BY 1 START WITH 1;
create table traveaux_client(
    id serial PRIMARY KEY,
    ref_devis varchar(20) unique,
    id_client int not null,
    id_maison int not null,
    id_finition int,
    -- prixTotale float not null,
    date_devis date not null,
    debut date not null,
    lieu varchar(100) not null,
    FOREIGN KEY (id_client) REFERENCES client(id),
    FOREIGN KEY (id_finition) REFERENCES finition_maison(id),
    FOREIGN KEY (id_maison) REFERENCES maison(id) 
);
alter table traveaux_client alter column ref_devis set default 'D'|| lpad(nextval('REF_SEQ')::TEXT,3,'0') 
-- ALTER TABLE traveaux_client
-- ALTER COLUMN ref_devis DROP DEFAULT;


select sum(prixtotale) total_deves from traveaux_client;

create table devis_traveaux_maison(
    id serial PRIMARY KEY,
    id_traveaux int,
    ref_devis varchar(20),
    prix_unitaire double precision not null,
    quantite double precision not null,
    FOREIGN KEY (id_traveaux) REFERENCES traveaux(id),
    FOREIGN KEY (ref_devis) REFERENCES traveaux_client(ref_devis)
);

create or replace view v_devis_traveaux as select t.id,dm.ref_devis,dm.prix_unitaire,dm.quantite,t.code,t.nom from devis_traveaux_maison dm
    join traveaux t on dm.id_traveaux = t.id;


create table devis_finition(
    id serial PRIMARY key,
    ref_devis varchar(20),
    id_finition int,
    pourcentage float,
    FOREIGN KEY (id_finition) REFERENCES finition_maison(id),
    FOREIGN KEY (ref_devis) REFERENCES traveaux_client(ref_devis)
);
ALTER TABLE devis_finition
ADD CONSTRAINT unique_devis_finition UNIQUE (ref_devis);


create or replace view v_devis_finition as 
    select f.id,df.ref_devis,f.nom,df.pourcentage from devis_finition df
            join finition_maison f on df.id_finition = f.id;

create or replace view v_devis_traveaux_client as select d.id_client,d.id_maison,d.id_finition,d.ref_devis,sum((dm.quantite*dm.prix_unitaire)+((dm.quantite * dm.prix_unitaire*f.pourcentage)/100)) prixtotale,
    m.duree,d.debut,d.date_devis,d.debut+(m.duree||' days')::interval as detefin from devis_traveaux_maison dm
    join traveaux_client d on d.ref_devis = dm.ref_devis
    join v_devis_finition f on d.id_finition = f.id 
    join maison m on m.id= d.id_maison
    group by d.ref_devis,d.debut,d.date_devis,d.id_client,d.id_maison,d.id_finition,m.duree;

create or replace view v_devis_traveaux_detail as select t.id,t.ref_devis,tm.id_maison,tm.nom nom_maison,tm.description,t.code,t.nom,tm.duree,tm.prix,t.prix_unitaire,t.quantite,tm.unite from v_traveaux_maison tm join v_devis_traveaux t on tm.id_traveaux = t.id;


--test 
select * from 
    devis_traveaux_maison dm
    join traveaux_client d on d.ref_devis = dm.ref_devis
    join v_devis_finition f on d.id_finition = f.id
    join maison m on m.id= d.id_maison;


create table payment_client(
    id serial PRIMARY KEY,
    ref_paiement varchar(20) not null,
    ref_devis varchar(20) not null,
    montant double precision not null,
    "date" date not null,
    FOREIGN KEY (ref_devis) REFERENCES traveaux_client(ref_devis)
);

create or replace view v_somme_payment as select ref_devis,sum(montant) somme_payment from payment_client group by ref_devis;

create or replace view v_payment as select 
    tc.id_client,
    tc.ref_devis,
    tc.id_maison,
    tc.id_finition,
    tc.prixtotale,
    tc.date_devis,
    tc.debut,
    coalesce(p.somme_payment,0) as montant,
    (tc.prixtotale-coalesce(p.somme_payment,0)) as reste 
        from v_devis_traveaux_client tc 
        left join v_somme_payment p on tc.ref_devis = p.ref_devis;

create or replace view v_detail_paiment as select id_client,ref_devis,id_maison,id_finition,prixtotale,date_devis,debut,montant,reste,((montant * 100 )/prixtotale) pEffectue from v_payment;

WITH all_months as (
    select generate_series(date_trunc('year','2023-01-01'::date),date_trunc('year','2023-01-01'::date)+INTERVAL '1 year -1 day','1 month') as month
) 
select to_char(all_months.month,'YYYY-MM') as month,coalesce(sum(vt.prixtotale),0) as nb from all_months
    left join v_devis_traveaux_client vt on date_trunc('month',vt.date_devis) = all_months.month
    group by month
    order by month;

create table maison_traveau_import(
    type_maison varchar(100),
    "description" text,
    surface float,
    code_travaux varchar(20),
    type_travaux varchar(100),
    unite varchar(50),
    prix_unitaire float,
    quantite float,
    duree_travaux float
);

--maison
insert into maison(nom,description,surface,duree) 
    select type_maison,description,surface,duree_travaux from maison_traveau_import group by type_maison,description,surface,duree_travaux;

--traveau
insert into traveaux(code,nom,prix_unitaire,unite) 
    select code_travaux,type_travaux,prix_unitaire,unite from maison_traveau_import group by type_travaux,code_travaux,prix_unitaire,unite;

--traveux maison
insert into traveaux_type_maison(id_maison,id_traveaux,quantite) 
    select m.id,t.id,mi.quantite from maison_traveau_import mi join maison m on mi.type_maison = m.nom join traveaux t on mi.code_travaux = t.code group by m.id,t.id,mi.quantite;   


create table devis_import(
    client varchar(10) not null,	
    ref_devis varchar(20) not null,	
    type_maison varchar(200) not null,	
    finition varchar(100) not null,	
    taux_finition double precision,
    date_devis date not null,
    date_debut date not null,	
    lieu varchar(200) not null
);

--finition
insert into finition_maison (nom,pourcentage)
    select finition,taux_finition from devis_import group by finition,taux_finition; 

--client
insert into client(contact) select client from devis_import group by client;    

--devis
insert into traveaux_client(id_client,ref_devis,id_maison,id_finition,date_devis,debut,lieu) 
    select  distinct cli.id,di.ref_devis,m.id,f.id,di.date_devis,di.date_debut,di.lieu from devis_import di 
        join client cli on di.client = cli.contact
        join maison m on di.type_maison = m.nom
        join finition_maison f on di.finition = f.nom group by cli.id,di.ref_devis,m.id,f.id,di.date_devis,di.date_debut,di.lieu;

--devis_maison
insert into devis_traveaux_maison (id_traveaux,ref_devis,prix_unitaire,quantite) 
    select t.id,tc.ref_devis,t.prix_unitaire,mi.quantite from maison_traveau_import mi 
        join devis_import di on di.type_maison = mi.type_maison 
        join traveaux t on mi.code_travaux = t.code 
        join traveaux_client tc on di.ref_devis= tc.ref_devis group by t.id,tc.ref_devis,t.prix_unitaire,mi.quantite;

--devis_finition
insert into devis_finition(ref_devis,id_finition,pourcentage)
    select di.ref_devis,f.id,f.pourcentage from devis_import di
        join finition_maison f on di.finition = f.nom;

create table paiment_import(
    ref_devis varchar(20) not null,	
    ref_paiement varchar(20) not null,
    date_paiement date not null,
    montant double precision not null
);

insert into payment_client (ref_paiement,ref_devis,montant,date) select ref_paiement,ref_devis,montant,date_paiement from paiment_import;
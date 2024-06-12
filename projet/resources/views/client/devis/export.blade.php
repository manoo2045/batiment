<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">

    <style>
        * {
            /* Change your font family */
            font-family: sans-serif;
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #83868f;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            /*border-bottom: 2px solid #009879;*/
            border-bottom: 2px solid #83868f;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        td {
           text-align: right;
        }

    </style>
</head>

<body>
    <div class="row">
        <h4 class="card-title">Devis : {{ $devis->ref_devis }}  </h4>
        <b> Type de maison </b> : {{ $travaux[0]->nom_maison }}
        <br>
        <b> Date debut : {{ $devis->date_devis }}</b>
        <br>
        <b> Date fin : </b>{{ $devis->detefin }}

        <div class="">
            <table id="demo-foo-addrow" class="content-table col-md-12" >
                <thead>
                <tr>
                    <th class="footable-sortable">Code</th>
                    <th class="footable-sortable">Designation</th>
                    <th class="footable-sortable">Prix Unitaire (MGA)</th>
                    <th class="footable-sortable">Quantite</th>
                    <th class="footable-sortable">Prix (MGA)</th>
                    <th class="footable-sortable">Unite</th>
                </tr>
                </thead>
                <tbody>
                @foreach($travaux as $trav)
                    <tr class="footable-even" style="">
                        <td>
                            {{ $trav->code }}
                        </td>
                        <td>
                            {{ $trav->nom }}
                        </td>
                        <td>
                            {{ $trav->prix_unitaire }}
                        </td>
                        <td>
                            {{ $trav->quantite }}
                        </td>
                        <td>
                            {{ $trav->prix }}
                        </td>
                        <td>
                            {{ $trav->unite }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <b> Totale Travaux Infrastructure : </b>  {{ $devis->prixtotale }} Ar
    </div>
    <h2> Detail paiment </h2>
    <div class="">
        <table id="demo-foo-addrow" class="content-table col-md-12" >
            <thead>
            <tr>
                <th class="footable-sortable">Ref paiment</th>
                <th class="footable-sortable">Montant</th>
                <th class="footable-sortable">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($paiment as $pay)
                <tr class="footable-even" style="">
                    <td>
                        {{ $pay->ref_paiement }}
                    </td>
                    <td>
                        {{ $pay->montant }}
                    </td>
                    <td>
                        {{ $pay->date }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>

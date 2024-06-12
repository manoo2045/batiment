@extends('template.admin_home')

@section('title', '')

@section('content')
    <div class="col-md-5">
        <div class="card">
            @if(session('errtm'))
                @foreach(session('errtm') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    @foreach(session('message') as $message)
                        {{ $message }}
                    @endforeach
                </div>
            @endif

            @if(session('cath'))
                @foreach(session('cath') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="card-body">
                <div class="card-title" >
                    <h3> Importation donne </h3>
                </div>
                <form action="{{ url('/import/traveauxMaison') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label> Maison et travaux</label>
                        <input type="file" placeholder="Maison et travaux" class="form-control"
                               id="exampleInputPassword1"
                               name="traveaux_maison">
                        @error("traveaux_maison")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label> Devis </label>
                        <input type="file" placeholder="devis" class="form-control @error("devis") is-invalid @enderror" id="exampleInputPassword1" name="devis">
                        @error("devis")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            @if(session('err'))
                @foreach(session('err') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="card-body">
                <div class="card-title" >
                    <h3> Importation paiment </h3>
                </div>
                <form action="{{ url('/import/paiment') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" class="form-control @error("paiment") is-invalid @enderror" id="exampleInputPassword1" name="paiment">
                        @error("file")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Importer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

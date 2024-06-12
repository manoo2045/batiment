@extends('template.client_home')

@section('title', 'Demande devis')

@section('import-css')
    <link href="../../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/table.css') }}">
@endsection

@section('content')
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            @foreach(session('message') as $message)
                {{ $message }}
            @endforeach
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/client/devis/demande') }}" method="post" class="form">
                @csrf
                <div class="column">
                    <h3>Maison</h3>
                    <div class="row">
                        @foreach($maisons as $m)
                            <div class="col-md-3">
                                <div class="card border-info">
                                    <div class="card-header bg-info">
                                        <h4 class="m-b-0 text-white"> {{ $m->nom }} </h4></div>
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $m->prix }} Ar</h3>
                                        <br>
                                        <p class="card-text">{{ $m->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <input value="{{ $m->id }}" type="radio" id="check-male" name="maison" {{ old('genre') === 'male' ? 'checked' : '' }}>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        @error('maison')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Fintion</label>
                        <select name="finition" class="select2 form-control custom-select @error('categorie') is-invalid @enderror" style="width: 100%; height:36px;">
                            @foreach($finitions as $fin)
                                <option value="{{ $fin->id }}" >{{ $fin->nom }}</option>
                            @endforeach
                        </select>
                        @error("categorie")
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="disabledSelect" class="form-label">Lieu</label>
                        <input name="lieu" class="form-control custom-select @error('lieu') is-invalid @enderror" style="width: 100%; height:36px;" type="text">

                        @error("lieu")
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Date de traveaux</label>
                        <input class="form-control custom-select @error('date_devis') is-invalid @enderror" type="date" placeholder="Enter birth date" name="date_devis" value="{{ old('date_devis') }}"  />
                    </div>
                </div>
                <button class="btn btn-info" type="submit">Demande</button>
            </form>
        </div>
    </div>


@endsection


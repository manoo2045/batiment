@extends('template.admin_home')

@section('content')
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Modifier Traveaux</h5>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/travaux/doedite') }}" method="post" >
                        @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Code</label>
                                <input type="number" value="{{ $traveaux->code }}" name="code" class="form-control @error("code") is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error("code")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nom </label>
                                <input type="text" value="{{ $traveaux->nom }}" name="nom" class="form-control @error("nom") is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error("nom")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"> prix unitaire </label>
                                <input type="text" value="{{ $traveaux->prix_unitaire }}" name="pu" class="form-control @error("pu") is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error("pu")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" value="{{ $traveaux->id }}" name="id">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Effectue</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/Chart.js/dist/Chart.min.js"></script>

    </div>


@endsection

@extends('template.admin_home')

@section('content')
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Modifier traveaux</h5>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/traveaux/update') }}" method="post" >
                        @csrf
                            <input type="hidden" value="{{ $traveaux->id }}" name="id">
                            		<div class="mb-3">
			<label for="exampleInput_code" class="form-label">code</label>
			<input name="code" value="{{ $traveaux->code }}" type="text" class="form-control @error("code") is-invalid @enderror" id="exampleInput_code" aria-describedby="emailHelp">
			@error("code")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_nom" class="form-label">nom</label>
			<input name="nom" value="{{ $traveaux->nom }}" type="text" class="form-control @error("nom") is-invalid @enderror" id="exampleInput_nom" aria-describedby="emailHelp">
			@error("nom")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_prix_unitaire" class="form-label">prix_unitaire</label>
			<input name="prix_unitaire" value="{{ $traveaux->prix_unitaire }}" type="number" class="form-control @error("prix_unitaire") is-invalid @enderror" id="exampleInput_prix_unitaire" aria-describedby="emailHelp">
			@error("prix_unitaire")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_unite" class="form-label">unite</label>
			<input name="unite" value="{{ $traveaux->unite }}" type="text" class="form-control @error("unite") is-invalid @enderror" id="exampleInput_unite" aria-describedby="emailHelp">
			@error("unite")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Effectue</button>
                                <a href="{{ url('/traveaux') }}" type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/Chart.js/dist/Chart.min.js"></script>
    </div>
@endsection

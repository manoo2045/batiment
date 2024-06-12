@extends('template.admin_home')

@section('content')
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Modifier maison</h5>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/maison/update') }}" method="post" >
                        @csrf
                            <input type="hidden" value="{{ $maison->id }}" name="id">
                            		<div class="mb-3">
			<label for="exampleInput_nom" class="form-label">nom</label>
			<input name="nom" value="{{ $maison->nom }}" type="text" class="form-control @error("nom") is-invalid @enderror" id="exampleInput_nom" aria-describedby="emailHelp">
			@error("nom")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_surface" class="form-label">surface</label>
			<input name="surface" value="{{ $maison->surface }}" type="number" class="form-control @error("surface") is-invalid @enderror" id="exampleInput_surface" aria-describedby="emailHelp">
			@error("surface")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_description" class="form-label">description</label>
			<input name="description" value="{{ $maison->description }}" type="text" class="form-control @error("description") is-invalid @enderror" id="exampleInput_description" aria-describedby="emailHelp">
			@error("description")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_duree" class="form-label">duree</label>
			<input name="duree" value="{{ $maison->duree }}" type="number" class="form-control @error("duree") is-invalid @enderror" id="exampleInput_duree" aria-describedby="emailHelp">
			@error("duree")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Effectue</button>
                                <a href="{{ url('/maison') }}" type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/Chart.js/dist/Chart.min.js"></script>
    </div>
@endsection

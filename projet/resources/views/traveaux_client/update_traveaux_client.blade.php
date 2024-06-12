@extends('template.admin_home')

@section('content')
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Modifier traveaux_client</h5>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/traveaux_client/update') }}" method="post" >
                        @csrf
                            <input type="hidden" value="{{ $traveaux_client->id }}" name="id">
                            		<div class="mb-3">
			<label for="exampleInput_ref_devis" class="form-label">ref_devis</label>
			<input name="ref_devis" value="{{ $traveaux_client->ref_devis }}" type="text" class="form-control @error("ref_devis") is-invalid @enderror" id="exampleInput_ref_devis" aria-describedby="emailHelp">
			@error("ref_devis")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_date_devis" class="form-label">date_devis</label>
			<input name="date_devis" value="{{ $traveaux_client->date_devis }}" type="date" class="form-control @error("date_devis") is-invalid @enderror" id="exampleInput_date_devis" aria-describedby="emailHelp">
			@error("date_devis")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_debut" class="form-label">debut</label>
			<input name="debut" value="{{ $traveaux_client->debut }}" type="date" class="form-control @error("debut") is-invalid @enderror" id="exampleInput_debut" aria-describedby="emailHelp">
			@error("debut")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_fin" class="form-label">fin</label>
			<input name="fin" value="{{ $traveaux_client->fin }}" type="date" class="form-control @error("fin") is-invalid @enderror" id="exampleInput_fin" aria-describedby="emailHelp">
			@error("fin")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_lieu" class="form-label">lieu</label>
			<input name="lieu" value="{{ $traveaux_client->lieu }}" type="text" class="form-control @error("lieu") is-invalid @enderror" id="exampleInput_lieu" aria-describedby="emailHelp">
			@error("lieu")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for=\"exampleInput_id_client class="form-label">contact</label>
			<select name="id_client" class="select2 form-control custom-select @error('id_client') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_debut" aria-describedby="traveaux_clientlHelp">
			@foreach($ids as $id)
				 <option value="{{ $contact->id }}" @if($id_client->id === $traveaux_client->contact) selected @endif >{{ $id->nom }}</option> 
			@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label for=\"exampleInput_id_maison class="form-label">nom</label>
			<select name="id_maison" class="select2 form-control custom-select @error('id_maison') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_fin" aria-describedby="traveaux_clientlHelp">
			@foreach($ids as $id)
				 <option value="{{ $nom->id }}" @if($id_maison->id === $traveaux_client->nom) selected @endif >{{ $id->nom }}</option> 
			@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label for=\"exampleInput_id_finition class="form-label">nom</label>
			<select name="id_finition" class="select2 form-control custom-select @error('id_finition') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_lieu" aria-describedby="traveaux_clientlHelp">
			@foreach($ids as $id)
				 <option value="{{ $nom->id }}" @if($id_finition->id === $traveaux_client->nom) selected @endif >{{ $id->nom }}</option> 
			@endforeach
			</select>
		</div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Effectue</button>
                                <a href="{{ url('/traveaux_client') }}" type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/Chart.js/dist/Chart.min.js"></script>
    </div>
@endsection

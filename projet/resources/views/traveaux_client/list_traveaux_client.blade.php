@extends('template.admin_home')

@section('import-css')
    <link href=""{{ asset('assets/libs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
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
    <div class="row">
        <div id="exampleModal" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> Ajouter Traveaux_client </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{ url('traveaux_client/insert') }}" method="post">
                        <div class="modal-body">
                                @csrf
                            		<div class="mb-3">
			<label for="exampleInput_ref_devis" class="form-label">ref_devis</label>
			<input name="ref_devis" value="{{ old('ref_devis') }}" type="text" class="form-control @error("ref_devis") is-invalid @enderror" id="exampleInput_ref_devis" aria-describedby="#CLASS_NAME#lHelp">
			@error("ref_devis")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_date_devis" class="form-label">date_devis</label>
			<input name="date_devis" value="{{ old('date_devis') }}" type="date" class="form-control @error("date_devis") is-invalid @enderror" id="exampleInput_date_devis" aria-describedby="#CLASS_NAME#lHelp">
			@error("date_devis")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_debut" class="form-label">debut</label>
			<input name="debut" value="{{ old('debut') }}" type="date" class="form-control @error("debut") is-invalid @enderror" id="exampleInput_debut" aria-describedby="#CLASS_NAME#lHelp">
			@error("debut")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_fin" class="form-label">fin</label>
			<input name="fin" value="{{ old('fin') }}" type="date" class="form-control @error("fin") is-invalid @enderror" id="exampleInput_fin" aria-describedby="#CLASS_NAME#lHelp">
			@error("fin")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_lieu" class="form-label">lieu</label>
			<input name="lieu" value="{{ old('lieu') }}" type="text" class="form-control @error("lieu") is-invalid @enderror" id="exampleInput_lieu" aria-describedby="#CLASS_NAME#lHelp">
			@error("lieu")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for=\"exampleInput_id_client\" class=\"form-label\">"+attributs[i].getNom()+"</label>
			<select name="id_client" class="select2 form-control custom-select @error('id_client') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_"debut"" aria-describedby="#CLASS_NAME#lHelp">
			@foreach($id_clients as $id_client)
				 <option value="{{ $id_client->id }}" >{{ $id_client->nom }}</option> 
			@endforeach
			</select>
		</ion-item>
		<div class="mb-3">
			<label for=\"exampleInput_id_maison\" class=\"form-label\">"+attributs[i].getNom()+"</label>
			<select name="id_maison" class="select2 form-control custom-select @error('id_maison') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_"fin"" aria-describedby="#CLASS_NAME#lHelp">
			@foreach($id_maisons as $id_maison)
				 <option value="{{ $id_maison->id }}" >{{ $id_maison->nom }}</option> 
			@endforeach
			</select>
		</ion-item>
		<div class="mb-3">
			<label for=\"exampleInput_id_finition\" class=\"form-label\">"+attributs[i].getNom()+"</label>
			<select name="id_finition" class="select2 form-control custom-select @error('id_finition') is-invalid @enderror" style="width: 100%; height:36px;" id="exampleInput_"lieu"" aria-describedby="#CLASS_NAME#lHelp">
			@foreach($id_finitions as $id_finition)
				 <option value="{{ $id_finition->id }}" >{{ $id_finition->nom }}</option> 
			@endforeach
			</select>
		</ion-item>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info waves-effect">Ajouter</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="col-md-10">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste  traveaux_clients </h4>
                        <div class="">
                            <table id="demo-foo-addrow" class="content-table col-md-12" >
                                <thead>
                                    <tr>
									<th class="footable-sortable"> ref_devis <th>
									<th class="footable-sortable"> date_devis <th>
									<th class="footable-sortable"> debut <th>
									<th class="footable-sortable"> fin <th>
									<th class="footable-sortable"> lieu <th>
									<th class="footable-sortable" > id_client <th>
									<th class="footable-sortable" > id_maison <th>
									<th class="footable-sortable" > id_finition <th>

                                    <th class="footable-sortable">  <th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($traveaux_clients as $traveaux_client)
                                    <tr class="footable-even" style="">
                                        
									<td class="footable-sortable"> {{ $traveaux_client->ref_devis }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->date_devis }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->debut }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->fin }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->lieu }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->id_client }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->id_maison }} <td>
									<td class="footable-sortable"> {{ $traveaux_client->id_finition }} <td>

                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{ url('traveaux_client/edit/'.$traveaux_client->id) }}" type="button" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="@getbootstrap"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Overflowing text to show scroll behavior</h4>
                                                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ url('traveaux_client/delete/'.$traveaux_client->id) }}" type="button" class="btn btn-danger">Oui</a>
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7">

                                    </td>
                                </tr>
                                </tfoot>
                            </table>
{{--                            <div class="">--}}
{{--                                <nav aria-label="Page navigation example">--}}
{{--                                    {{ $traveaux_clients->links('pagination::bootstrap-5') }}--}}
{{--                                </nav>--}}
{{--                            </div>--}}

                            <div class="ml-2">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-info mb-4" onclick="openModal()">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script>
        function openModal() {
            $('#exampleModal').modal('show');
        }
    </script>

    @if(session('errors'))
        <script>
            $(document).ready(function () {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
@endsection

@section('import-js')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/forms/select2/select2.init.js') }}"></script>
@endsection

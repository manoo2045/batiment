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
                        <h4 class="modal-title" id="myModalLabel"> Ajouter Maison </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form action="{{ url('maison/insert') }}" method="post">
                        <div class="modal-body">
                                @csrf
                                <div class="mb-3">
        <label for="exampleInput_nom" class="form-label">nom</label>
        <input name="nom" value="{{ old('nom') }}" type="text" class="form-control @error("nom") is-invalid @enderror" id="exampleInput_nom" aria-describedby="#CLASS_NAME#lHelp">
        @error("nom")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_surface" class="form-label">surface</label>
			<input name="surface" value="{{ old('surface') }}" type="number" class="form-control @error("surface") is-invalid @enderror" id="exampleInput_surface" aria-describedby="#CLASS_NAME#lHelp">
			@error("surface")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_description" class="form-label">description</label>
			<input name="description" value="{{ old('description') }}" type="text" class="form-control @error("description") is-invalid @enderror" id="exampleInput_description" aria-describedby="#CLASS_NAME#lHelp">
			@error("description")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="exampleInput_duree" class="form-label">duree</label>
			<input name="duree" value="{{ old('duree') }}" type="number" class="form-control @error("duree") is-invalid @enderror" id="exampleInput_duree" aria-describedby="#CLASS_NAME#lHelp">
			@error("duree")
				<div class="invalid-feedback">
					{{ $message }}
				</div>
			@enderror
		</div>


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
                        <h4 class="card-title">Liste  maisons </h4>
                        <div class="">
                            <table id="demo-foo-addrow" class="content-table col-md-12" >
                                <thead>
                                    <tr>
									<th class="footable-sortable"> nom <th>
									<th class="footable-sortable"> surface <th>
									<th class="footable-sortable"> description <th>
                                        <th class="footable-sortable"> duree <th>
                                        <th class="footable-sortable">  <th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($maisons as $maison)
                                    <tr class="footable-even" style="">

									<td class="footable-sortable"> {{ $maison->nom }} <td>
									<td class="footable-sortable"> {{ $maison->surface }} <td>
									<td class="footable-sortable"> {{ $maison->description }} <td>
									<td class="footable-sortable"> {{ $maison->duree }} <td>

                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{ url('maison/edit/'.$maison->id) }}" type="button" class="btn btn-info"><i class="fa fa-edit"></i></a>
{{--                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="@getbootstrap"><i class="fa fa-trash"></i></button>--}}
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
                                                    <a href="{{ url('maison/delete/'.$maison->id) }}" type="button" class="btn btn-danger">Oui</a>
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
{{--                                    {{ $maisons->links('pagination::bootstrap-5') }}--}}
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
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
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
    <script src="../../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../../dist/js/pages/forms/select2/select2.init.js"></script>
@endsection

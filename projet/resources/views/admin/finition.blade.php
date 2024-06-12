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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste des devis en cours</h4>
                    <div class="">
                        <table id="demo-foo-addrow" class="content-table col-md-12" >
                            <thead>
                            <tr>
                                <th class="footable-sortable">Nom</th>
                                <th class="footable-sortable">Pourcentage</th>
                                <th class="footable-sortable">Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($finition as $f)
                                <tr class="footable-even" style="">
                                    <td>
                                        {{ $f->nom }}
                                    </td>
                                    <td>
                                        {{ $f->pourcentage }}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-info mb-4" onclick="openModal()"><i class="fa fa-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <div id="exampleModal" class="modal fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Modifier Pourcentage</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <form action="{{ route('finition.edit') }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $f->id }}">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Pourcentage</label>
                                                        <input type="text" value="{{ $f->pourcentage }}" name="pourcentage" class="form-control @error("pourcentage") is-invalid @enderror" >
                                                        @error('pourcentage')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info waves-effect">Save</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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

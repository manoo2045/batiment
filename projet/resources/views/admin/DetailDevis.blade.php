@extends('template.admin_home')

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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail</h4>
                    <div class="">
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

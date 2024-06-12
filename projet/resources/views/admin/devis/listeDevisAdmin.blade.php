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
                    <h4 class="card-title">Liste des devis en cours</h4>
                    <div class="">
                        <table id="demo-foo-addrow" class="content-table col-md-12" >
                            <thead>
                            <tr>
                                <th class="footable-sortable">Maison</th>
                                <th class="footable-sortable">Finition</th>
                                <th class="footable-sortable">Debut</th>
                                <th class="footable-sortable">Reste</th>
                                <th class="footable-sortable">paiement effectué</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devis as $dev)
                                <tr class="footable-even" style="">
                                    <td>
                                        {{ $dev->id_maison }}
                                    </td>
                                    <td>
                                        {{ $dev->id_finition }}
                                    </td>
                                    <td> {{ $dev->debut }} </td>
                                    <td> {{ $dev->reste }} Ar </td>
                                    <td> {{ $dev->peffectue }} % </td>
                                    <td> <a href="{{ url('/devis/detail/'.$dev->ref_devis) }}" class="btn btn-info" > Detail </a> </td>
                                </tr>
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

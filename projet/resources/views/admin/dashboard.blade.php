@extends('template.admin_home')

@section('title', 'DashBoard')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div>
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <i class="mdi mdi-currency-eur font-20 text-muted"></i>
                                    <p class="font-16 m-b-5">Paiment Effectue</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="font-light text-right">{{ $totalePaiment }} Ar</h1>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-12">--}}
{{--                            <div class="progress">--}}
{{--                                <div class="progress-bar bg-purple" role="progressbar" style="width: 65%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <i class="mdi mdi-currency-eur font-20 text-muted"></i>
                                    <p class="font-16 m-b-5">Totale devis</p>
                                </div>
                                <div class="ml-auto">
                                    <h1 class="font-light text-right">{{ $totalDevis }} Ar</h1>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="col-12">--}}
                        {{--                            <div class="progress">--}}
                        {{--                                <div class="progress-bar bg-purple" role="progressbar" style="width: 65%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div id="histogramme">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <select name="anne" id="sortingField" class="form-control">
                @foreach($annees as $anne)
                    <option value="{{ $anne->year }}"> {{ $anne->year }} </option>
                @endforeach
            </select>
        </div>
    </div>


    <script src="{{ asset('assets/js/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Placez votre code à l'intérieur de cet écouteur d'événement
            $(document).ready(function () {
                var chart;

                var options = {
                    series: [{
                        data: @json($donnees)
                    }],
                    chart: {
                        type: 'bar',
                        height: 200
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: ['jav', 'fev', 'mar', 'avril', 'mai', 'juin', 'jul', 'aut', 'sept', 'oct','nov','dec',]
                    }
                };

                chart = new ApexCharts(document.querySelector("#histogramme"), options);

                chart.render();

                $('#sortingField').change(function () {
                    var selectValue = $(this).val();
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    $.ajax({
                        type: 'POST',
                        url: '/admin/histogramme',
                        data: {
                            _token: csrfToken, // Envoyer le jeton CSRF
                            anne: selectValue
                        },
                        success: function (response) {
                            console.log(response.donne);
                            chart.updateSeries([{data: response.donne}]);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
        });

    </script>

@endsection

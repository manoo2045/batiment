@extends('template.client_home')


@section('content')
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Creer un seance</h5>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/client/devis/payment') }}" method="post" >
                        <div class="modal-body">

                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Montant</label>
                                <input type="number" value="{{ old('montant') }}" name="montant" class="form-control @error("montant") is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error("montant")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Date</label>
                                <input type="date" value="{{ old('date') }}" name="date" class="form-control @error("date") is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error("date")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" value="{{ $ref }}" name="devis">

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
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{

                        label: '# of Votes',
                        data: [{{200}}, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>


@endsection

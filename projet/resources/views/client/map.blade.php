@extends('template.client_home')

@section('title', 'Map')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/leaflet/leaflet.css') }}" />

    <script src="{{ asset('assets/leaflet/leaflet.js') }}"></script>

    <style>
        #map {
            height: 400PX;
        }
    </style>
    <div id="map"></div>

    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        var marker = L.marker([51.5, -0.09]).addTo(map);
    </script>
@endsection


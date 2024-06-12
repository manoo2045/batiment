@extends('template.admin_home')

@section('title', 'Accueil')

@section('content')
    <a class="btn btn-danger" href="{{ url('admin/clearBd') }}"> Reinitialiser base </a>
@endsection


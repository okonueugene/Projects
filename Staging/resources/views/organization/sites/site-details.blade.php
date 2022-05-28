@extends('layouts.organization')

@section('title')
    {{ $site->name }}
@endsection

@section('header')
    <style>
        .display-none{
            display: none;
        }
    </style>
@section('content')
    <livewire:sites.overview :site='$site'>
@endsection

@section('scripts')

    <script type="text/javascript">
        $("#showClient").click(function(){
            $("#client").toggleClass('display-none');
        });
    </script>

<script src="{{ asset('theme/assets/js/site-map.js?ver=2.9.0') }}"></script>
    
@endsection
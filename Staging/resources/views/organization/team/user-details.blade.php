@extends('layouts.organization')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
<div class="nk-content ">
    <livewire:user-details :user="$user">
</div>
@endsection

@section('scripts')

    
@endsection
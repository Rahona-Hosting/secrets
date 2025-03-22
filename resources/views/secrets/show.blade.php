@extends('layouts.secret')

@section('title', __('secrets.show.title'))
@section('subtitle', __('secrets.show.subtitle'))

@section('icon')
    <i class="fas fa-lock text-blue-400 text-3xl"></i>
@endsection

@section('content')

    <livewire:secret-viewer :secret="$secret" :isE2EE="$isE2EE"/>

@endsection

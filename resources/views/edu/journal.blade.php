@extends('common/html')

@push('html-head-bottom')
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
    </script>

@endpush

@section('html-body')
<h1>Журнал</h1>

@php
    $currentSection = "";
@endphp

@foreach ($items as $item)
@if ($item->journalable->title != $currentSection)
@php
    $title = $item->journalable->title;
    $user = $item->user;
    $currentSection = $title;
@endphp
<h2>{{ $currentSection }}</h2>

@endif

    <p><a href="/user/{{ $user->id }}">{{ $user->name }}</a></p>
@endforeach

@endsection

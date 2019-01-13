@extends('layouts.app')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="/watchlist">Watchlist</a>
        </li>
        <li class="breadcrumb-item active">Item</li>
    </ol>

    {{ $watchlistItem->detail->pair->name }}

@endsection
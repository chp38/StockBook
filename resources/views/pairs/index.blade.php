@extends('layouts.app')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Currency Pairs</li>
    </ol>

    <div class="card-deck">
        @foreach($currencyPairs as $pair)
            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header">
                    <a href="/currency/pairs/{{$pair->id}}">{{ $pair->name }}</a>
                </div>
                <div class="card-body text-info">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection
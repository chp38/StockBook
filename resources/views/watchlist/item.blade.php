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

  <div class="card mb-3">
    <div class="card-header">
      <h3> {{ $watchlistItem->detail->pair->name }} </h3></div>
    <div class="card-body" style="background: #333">
      <div id="chartdiv" currency-pair="{{ $watchlistItem->detail->pair->id }}">
        <div id="loading">
          <img style="width: 100%; height:100%;" src="/images/loading.gif" title="this slowpoke moves" />
        </div>
      </div>
    </div>
  </div>

  <p>
    <?php dump($watchlistItem); ?>
      <?php dump($watchlistItem->detail); ?>
    watch date - and how many days
    pip difference from creadted - now (will need to get current rate)
    high stop
    low stop

  </p>

@endsection
@extends('layouts.app')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-4 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-basket"></i>
                    </div>
                    <div class="mr-5">Active Trades</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-life-ring"></i>
                    </div>
                    <div class="mr-5">Watch List</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="watchlist">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-list"></i>
                    </div>
                    <div class="mr-5">Recent Trades</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Area Chart Example-->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Currency Chart</div>
        <div class="card-body" style="background: #333">
          <select id="home-chart-select" name="dataTable_length" style="width: 10%;" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
            @foreach($pairs as $pair)
              <option value="{{ $pair->id }}"> {{ $pair->name }} </option>
            @endforeach
          </select>
          @if($mainPair != null)
            <div id="chartdiv" currency-pair="{{ $mainPair->id }}">
              <div id="loading">
                <img style="width: 100%; height:100%;" src="images/loading.svg" title="this slowpoke moves" />
              </div>
            </div>
          @else
            <div id="chartdiv">
              No Pairs Found!
            </div>
          @endif
          @if($mainPair != null)
            <div class="dash-actions">
              <form method="POST">
                <input id="pair-id" type="hidden" name="pair-id" value="{{ $mainPair->id }}">
                <button name="watchlist" id="home-add-watchlist" class="btn btn-primary">Add Watchlist</button>
                <button name="trades" id="home-add-trades" class="btn btn-success">Add Trades</button>
              </form>
            </div>
          @endif
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection
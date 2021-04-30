@extends('layouts.app')

@section('content')

    <h1 class="mt-4">Gold EA Tokens</h1>    
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Manage Tokens</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
                Add Token
        </div>
        <div class="card-body">
            <form method="POST" action="/manage/tokens">
                @csrf
                <div class="form-group">
                    <label class="small mb-1" for="order_id">Order ID</label>
                    <input class="form-control py-4" id="order_id" name="order_id" type="text" placeholder="Order ID"/>
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="token">Token</label>
                    <input class="form-control py-4" id="token" name="token" type="text" placeholder="Token"/>
                </div>

                <input type="submit" class="btn btn-primary"/>
            </form>
        </div>
    </div>

    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Token</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Token</th>
                                                <th>Remove</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($tokens as $token)
                                                <tr>
                                                    <th>{{ $token->order_id }}</th>
                                                    <th>{{ $token->token }}</th>
                                                    <th>
                                                        <form action="/manage/tokens/{{ $token->id }}" method="POST">
                                                        @csrf
                                                        <button type="submit" name="order_id" value="{{ $token->id }}" class="btn btn-danger">Remove</button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

@endsection
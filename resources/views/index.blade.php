@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    <!-- {{ __('You are logged in!') }} -->
                    <a href="{{route('clients')}}" type="button" class="btn btn-primary btn-lg btn-block">Clientes</a>
                    <a href="{{route('products')}}" type="button" class="btn btn-secondary btn-lg btn-block">Produtos</a>
                    <a href="{{route('requests')}}" type="button" class="btn btn-success btn-lg btn-block">Pedidos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
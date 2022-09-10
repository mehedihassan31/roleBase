@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (Auth::user()->role()->first()->name=='admin')

                    <h1>Admin</h1>
                    your role is a admin you can create a product..
                    @else
                    <h1>User</h1>
                    your role is not a admin you can not create a product..
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

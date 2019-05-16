@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Orders</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Details</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->customer->phone}}</td>
                                    <td>{{$order->shipped?'Shipped':'Pending' }}</td>
                                    <td>{{$order->total}}</td>
                                    <td>
                                        <a href="/orders/{{$order->id}}" class="btn btn-info">Details</a>
                                    </td>
                                    <td>
                                        @if(!$order->shipped)
                                            @can('delete', $order)
                                            <form action="/orders/{{$order->id}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">Remove</button>
                                            </form>
                                            @endcan
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

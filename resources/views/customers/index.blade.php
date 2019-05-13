@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Customers</div>

                    <div class="card-body">
                        <table class="table">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Name</th>
                                   <th>Phone</th>
                                   <th>Address</th>
                               </tr>
                           </thead>
                            <tbody>
                              @foreach($customers as $customer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->address}}</td>
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

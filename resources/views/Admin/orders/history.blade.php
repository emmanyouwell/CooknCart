@extends('layouts.app')
@section('content')
@section('title')
Orders
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Order History
                        
                    </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Tracking Number</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td>@if($item->status == '0')
                                            <span class="text-danger">Pending</span> 
                                            @elseif($item->status == '1')
                                            <span class="text-warning">Processing</span> 
                                            @elseif($item->status == '2')
                                            <span class="text-success">Completed</span> 
                                            @else
                                            <span class="text-danger">Cancelled</span> 
                                            @endif</td>
                                        <td>
                                            <a href="{{ url('Admin/view-order/'.$item->id) }}" class="btn btn-primary">View</a>
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

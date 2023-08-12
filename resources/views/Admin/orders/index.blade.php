@extends('layouts.app')
@section('title')
Orders
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-header bg-dark">
                        <h4 class="text-white">New Orders
                    </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="orderTable">
                            <thead>
                                <tr class="text-center">
                                    <th>Order Date</th>
                                    <th>Tracking Number</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item )
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>
                                        @if($item->status == '0')
                                        Pending
                                        @elseif($item->status == '1')
                                        Processing
                                        @elseif($item->status == '2')
                                        Completed
                                        @else
                                        Cancelled
                                        @endif
                                        
                                    <td>
                                        <a href="{{ url('Admin/view-order/'.$item->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

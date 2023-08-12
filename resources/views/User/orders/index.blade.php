@extends('layouts.app')

@section('css')
<style>
</style>
@endsection
@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">My Orders</h4>
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
                                    <tr class="text-center">
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td>
                                            @if ($item->status == '0')
                                                <span class="text-danger">Pending</span>
                                            @elseif ($item->status == '1')
                                                <span class="text-warning">Processing</span>
                                            @elseif ($item->status == '2')
                                                <span class="text-success">Completed</span>
                                                @elseif($item->status == '3')
                                                <span class="text-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('user/view-order/' . $item->id) }}" class="btn btn-success"><i
                                                    class="fa fa-eye"></i> View</a>
                                            @if ($item->status == '0')
                                                <a href="{{ url('user/cancel-order/' . $item->id) }}" class="btn btn-danger"><i
                                                        class="fa fa-times"></i> Cancel</a>
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

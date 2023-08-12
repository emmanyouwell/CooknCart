<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: {{$track}}
                </small>
            </h1>
    
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
            </div>
        </div>
    
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <i class="fa-solid fa-utensils fa-2x text-success-m2 mr-1"></i>
                                <span class="text-default-d3">CooknCart.com</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->
    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{$customer}}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    {{$address}} {{$city}}
                                </div>
                                <div class="my-1">
                                    {{$pincode}}
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$phone}}</b></div>
                            </div>
                        </div>
                        <!-- /.col -->
    
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> {{$track}}</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{date('d-m-Y', strtotime($date))}}</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> {{$status}} </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
    
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Description</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2">Amount</div>
                        </div>
                        
                        <div class="text-95 text-secondary-d3">

                            @for($i=0; $i<$items->count();$i++)
                            @if($i%2 == 0)
                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <div class="d-none d-sm-block col-1">{{$i+1}}</div>
                                <div class="col-9 col-sm-5">{{$items[$i]->name}}</div>
                                <div class="d-none d-sm-block col-2">{{$items[$i]->quantity}}</div>
                                <div class="d-none d-sm-block col-2 text-95">{{$items[$i]->price}}</div>
                                <div class="col-2 text-secondary-d2">{{$items[$i]->quantity * $items[$i]->price}}</div>
                            </div>
                            @else
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">{{$i+1}}</div>
                                <div class="col-9 col-sm-5">{{$items[$i]->name}}</div>
                                <div class="d-none d-sm-block col-2">{{$items[$i]->quantity}}</div>
                                <div class="d-none d-sm-block col-2 text-95">{{$items[$i]->price}}</div>
                                <div class="col-2 text-secondary-d2">{{$items[$i]->quantity * $items[$i]->price}}</div>
                            </div>
                            @endif
                            @endfor
                            
    
                            
                        </div>

                    {{-- <div class="temp">

                        
                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">1</div>
                                <div class="col-9 col-sm-5">Domain registration</div>
                                <div class="d-none d-sm-block col-2">2</div>
                                <div class="d-none d-sm-block col-2 text-95">$10</div>
                                <div class="col-2 text-secondary-d2">$20</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <div class="d-none d-sm-block col-1">2</div>
                                <div class="col-9 col-sm-5">Web hosting</div>
                                <div class="d-none d-sm-block col-2">1</div>
                                <div class="d-none d-sm-block col-2 text-95">$15</div>
                                <div class="col-2 text-secondary-d2">$15</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">3</div>
                                <div class="col-9 col-sm-5">Software development</div>
                                <div class="d-none d-sm-block col-2">--</div>
                                <div class="d-none d-sm-block col-2 text-95">$1,000</div>
                                <div class="col-2 text-secondary-d2">$1,000</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <div class="d-none d-sm-block col-1">4</div>
                                <div class="col-9 col-sm-5">Consulting</div>
                                <div class="d-none d-sm-block col-2">1 Year</div>
                                <div class="d-none d-sm-block col-2 text-95">$500</div>
                                <div class="col-2 text-secondary-d2">$500</div>
                            </div>
                        </div>
                    </div> --}}
                        <div class="row border-b-2 brc-default-l2"></div>
    
                        <!-- or use a table instead -->
                        <!--
                <div class="table-responsive">
                    <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                        <thead class="bg-none bgc-default-tp1">
                            <tr class="text-white">
                                <th class="opacity-2">#</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th width="140">Amount</th>
                            </tr>
                        </thead>
    
                        <tbody class="text-95 text-secondary-d3">
                            <tr></tr>
                            <tr>
                                <td>1</td>
                                <td>Domain registration</td>
                                <td>2</td>
                                <td class="text-95">$10</td>
                                <td class="text-secondary-d2">$20</td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
                -->
    
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Extra note such as company or payment information...
                            </div>
    
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        SubTotal
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1">₱{{$total}}</span>
                                    </div>
                                </div>
    
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Shipping
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">₱0</span>
                                    </div>
                                </div>
    
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Total Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">₱{{$total}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <hr />
    
                        <div>
                            <span class="text-secondary-d1 text-105">Thank you for your business</span>
                            <a href="{{route('checkout')}}" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
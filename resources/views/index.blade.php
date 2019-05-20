@extends('layout.app')

@section('content')

<div class="content-wrapper">
        <div class="content-header row mb-1">
        </div>
        <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
<div class="row">
  <div class="col-xl-6 col-12">
    <div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Emails</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="reload"><i class="fa fa-envelope"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body pt-0">
          <p>Open rate <span class="float-right text-bold-600">89%</span></p>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <p class="pt-1">Sent <span class="float-right"><span class="text-bold-600">310</span>/500</span>
          </p>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-1">
            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Top Products</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a href="{{route('product.index')}}">Show all</a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body p-0">
          <div class="table-responsive">
            @if(count($top_product) > 0)
              @foreach($top_product as $product)
              <table class="table mb-0">
                <tbody>
                  <tr>
                    <th scope="row" class="border-top-0">{{$product->product_name}}</th>
                    <td class="border-top-0">{{$product->product_price}}</td>
                  </tr>
                </tbody>
              @endforeach
            @else
              <h4 class="ml-2">No Product Available</h4>
            @endif
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</div>
  </div>
  <div class="col-xl-6 col-12">
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h6 class="text-muted">Accepted Orders For This Month</h6>
                  <h3>{{$accepted_orders}}</h3>
                </div>
                <div class="align-self-center">
                  <i class="icon-trophy success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h6 class="text-muted">New Orders</h6>
                  <h3>{{$new_orders}}</h3>
                </div>
                <div class="align-self-center">
                  <i class="icon-call-in danger font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h6 class="text-muted">Categories</h6>
                  <h3>{{$category_count}}</h3>
                </div>
                <div class="align-self-center">
                  <i class="icon-trophy success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h6 class="text-muted">Products</h6>
                  <h3>{{$product_count}}</h3>
                </div>
                <div class="align-self-center">
                  <i class="icon-call-in danger font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Revenue, Hit Rate & Deals -->

<!-- Total earning & Recent Sales  -->
<div class="row">

  <div id="recent-sales" class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Recent Sales</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="{{route('view_orders')}}" >View all</a></li>
          </ul>
        </div>
      </div>
      <div class="card-content mt-1">
        <div class="table-responsive">
          <table id="recent-orders" class="table table-hover table-xl mb-0">
            <thead>
              <tr>
                <th class="border-top-0">Customer</th>
                <th class="border-top-0">Amount</th>
                <th class="border-top-0">Location</th>
              </tr>
            </thead>
            <tbody>
              @if(count($orders) > 0)
                @foreach($orders as $order)
                <tr>
                  <td class="text-truncate">{{$order->customer_name}}</td>
                  <td class="text-truncate">{{$order->amount}}</td>
                  <td class="text-truncate">[{$order->location}]</td>
                </tr>
                @endforeach
              @else
                  <div class="alert alert-warning" role="alert">
                    <strong>Sorry!</strong> No Orders Available :(
                  </div>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
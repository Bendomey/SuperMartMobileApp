@extends('layout.app')

@section('title','View Orders')

@section('content')

<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">View Orders</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Orders</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        @if(Session::has('success'))
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Congratulations!</strong> {{Session::get('success')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		@endif

		@if(Session::has('error'))
	        <div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Sorry!</strong> {{Session::get('error')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		@endif

		<div class="card" >
			<div class="card-header">
			    <h4 class="card-title">Categories</h4>
			    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
			</div>
			<div class="card-body">
				<div class="table-responsiveness">
					<table class="table">
					    <thead>
					        <tr>
					            <th>Customer</th>
					            <th>Price</th>
					            <th>Location</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
							@if(count($orders) > 0)
								@foreach($orders as $order)
					        <tr>
					            <th scope="row">{{$order->customer_name}}</th>
					            <td>{{$order->price}}</td>
					            <td>{{$order->location}}</td>
					            <td>
					            	<div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" data-order="{{$order->id}}" class="btn btn-info acceptOrderBtn"><i class="fa fa-pencil-alt mr-1"></i>Accept</button>
                                        <button class="btn btn-danger rejectOrderBtn" data-orderid="{{$order->id}}"><i class="fa fa-times mr-1"></i>Reject</button>
                                    </div>
					            </td>
					        </tr>
					        	@endforeach
					        @else
					        	 <div class="alert alert-warning" role="alert">
                                        <strong>Sorry!</strong> No Orders Available :(
                                    </div>
					        @endif
					    </tbody>
					</table>
					<div>
						{{$orders->links()}}
					</div>
				</div>
			</div>
		</div>

</div>

<div class="modal fade" id="acceptOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sell Product(s)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
		<h3>Are you sure you want to accept this order?</h3>
		<div class="modal-footer">
			<button class="btn btn-secondary" style="color: #fff" data-dismiss="modal">Close</button>
			<a id="acceptOrderButton" class="btn btn-danger">Yes</a>
		</div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="rejectOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Reject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
		<h3>Are you sure you want to reject this order?</h3>
		<div class="modal-footer">
			<button class="btn btn-secondary" style="color: #fff" data-dismiss="modal">Close</button>
			<a id="rejectOrderButton" class="btn btn-danger">Yes</a>
		</div>
    </div>
  </div>
</div>
</div>

@stop

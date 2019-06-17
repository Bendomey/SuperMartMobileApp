@extends('layout.app')
@section('title','Stores')
@section('content')


<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">View Stores</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Stores</li>
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
			    <h4 class="card-title">Stores</h4>
			    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
			</div>
			<div class="card-body">
				<div class="table-responsiveness">
					<table class="table">
					    <thead>
					        <tr>
					            <th>Name</th>
					            <th>Email</th>
					            <th>Contact</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
							@if(count($stores) > 0)
								@foreach($stores as $store)
					        <tr>
					            <th scope="row">{{$store->name}}</th>
					            <td>{{$store->email}}</td>
					            <td>{{$store->contact}}</td>
					            <td>
					            	<div class="btn-group" role="group" aria-label="Basic example">
					            		@if($store->feature == '0')
                                        <button class="btn btn-success featureStoreBtn" data-id="{{$store->id}}"><i class="fa fa-check mr-1"></i>Feature</button>
                                        <button class="btn btn-success unfeatureStoreBtn" data-id="{{$store->id}}" hidden><i class="fa fa-times mr-1"></i>unFeature</button>
                                        @else
                                        <button class="btn btn-success featureStoreBtn" data-id="{{$store->id}}" hidden><i class="fa fa-check mr-1"></i>Feature</button>
                                        <button class="btn btn-info unfeatureStoreBtn" data-id="{{$store->id}}"><i class="fa fa-times mr-1"></i>UnFeature</button>
                  						@endif                      
                                        <button class="btn btn-danger" id="removeStore" data-id="{{$store->id}}"><i class="fa fa-times mr-1"></i>Remove</button>
                                    </div>
					            </td>
					        </tr>
					        	@endforeach
					        @else
					        	 <div class="alert alert-warning" role="alert">
                                        <strong>Sorry!</strong> No Shops Registered :(
                                    </div>
					        @endif
					    </tbody>
					</table>
					<div>
						{{$stores->links()}}
					</div>
				</div>
			</div>
		</div>

</div>

<div class="modal fade" id="confirmDeleteStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
		<h3>Are you sure you want to delete this store?</h3>
		<h5>All products under this store would also be deleted</h5>
		<div class="modal-footer">
			<button class="btn btn-secondary" style="color: #fff" data-dismiss="modal">Close</button>
			<a id="ConfirmDeleteStoreButton" class="btn btn-danger">Yes</a>
		</div>
    </div>
  </div>
</div>
</div>

@stop
@extends('layout.app')
@section('title','Products')
@section('content')

<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">View Products</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Products</li>
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
			    <h4 class="card-title">Products</h4>
			    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
			    <div class="heading-elements">
			        <ul class="list-inline mb-0">
			            <li><a class="btn btn-danger" href="{{route('product.create')}}"><i class="fa fa-plus mr-1"></i>Add</a></li>
			        </ul>
			    </div>
			</div>
			<div class="card-body">
				<div class="table-responsiveness">
					<table class="table">
					    <thead>
					        <tr>
					            <th>Name</th>
					            <th>Category</th>
					            <th>Price</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
							@if(count($products) > 0)
								@foreach($products as $product)
					        <tr>
					            <th scope="row">{{$product->product_name}}</th>
					            <td>{{$product->category_name}}</td>
					            <td>{{$product->product_price}}</td>
					            <td>
					            	<div class="btn-group" role="group" aria-label="Basic example">
					            		@if($product->featured == '0')
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success featureButton">Feature</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-info unFeatureButton" hidden>unFeature</button>
					            		@else
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success featureButton" hidden>Feature</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-info unFeatureButton">unFeature</button>
					            		@endif
					            		
					            		@if($product->promote == '0')
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success promoteButton">Promote</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success unPromoteButton" hidden></i>unPromote</button>
					            		@else
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success promoteButton" hidden>Promote</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success unPromoteButton">unPromote</button>
					            		@endif
					            		
					            		@if($product->recommended == '0')
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success recommendButton">Recommend</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success unRecommendButton" hidden>unRecommend</button>
					            		@else
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success recommendButton" hidden>Recommend</button>
					            			<button type="button" data-product="{{$product->id}}" class="btn btn-success unRecommendButton">unRecommend</button>
					            		@endif
					            		
                                        <a type="button" href='{{url("product/$product->id/edit")}}' class="btn btn-info"><i class="fa fa-pencil-alt mr-1"></i>Edit</a>
                                        <button class="btn btn-danger deletePoductButton" data-product="{{$product->id}}"><i class="fa fa-times mr-1"></i>Delete</button>
                                    </div>
					            </td>
					        </tr>
					        	@endforeach
					        @else
					        	 <div class="alert alert-warning" role="alert">
                                        <strong>Sorry!</strong> No Categories Available :(
                                    </div>
					        @endif
					    </tbody>
					</table>
					<div>
						{{$products->links()}}
					</div>
				</div>
			</div>
		</div>
</div>

<div class="modal fade" id="confirmDeleteForProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
		<h3>Are you sure you want to delete this Product?</h3>
		<div class="modal-footer">
			<button class="btn btn-secondary" style="color: #fff" data-dismiss="modal">Close</button>
			<a id="ConfirmDeleteButtonForProduct" class="btn btn-danger">Yes</a>
		</div>
    </div>
  </div>
</div>
</div>


@stop
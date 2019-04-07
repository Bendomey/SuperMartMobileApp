@extends('layout.app')

@section('title','Add Product')

@section('content')

<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Add Products</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a>
                  </li>
                  <li class="breadcrumb-item active">Add Products</li>
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

		<div class="card">
			<div class="card-content collapse show">
				<div class="card-body">
					<form class="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="form-body">
							<h4 class="form-section"><i class="fa fa-plus"></i> Add Product</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="product name">Category</label>
										<select class="form-control" name="category_name" required>
											<option value="default">Please Choose</option>
											@if(count($categories) > 0)
												@foreach($categories as $cat)
													<option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="product name">Product Name</label>
										<input type="text" class="form-control" placeholder="Product Name" name="product_name" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="product price">Product Price</label>
										<input type="text" class="form-control" placeholder="Product Price" name="product_price" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="product expiry date">Product Expiry Date</label>
										<input type="date" class="form-control" placeholder="Product Expiry Date" name="product_expiry_date" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Select Product Image</label>
								<label id="file" class="file center-block">
									<input type="file" id="file" name="product_img" required>
									<span class="file-custom"></span>
								</label>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="product description">Product Description</label>
										<textarea class="form-control" name="product_description" cols="20" rows="10" placeholder="Product Description" required></textarea>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button type="button" class="btn btn-warning mr-1">
									<i class="fa fa-times"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-save"></i> Save
								</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>



</div>


@stop
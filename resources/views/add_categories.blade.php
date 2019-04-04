@extends('layout.app')

@section('title','Add Categories')

@section('content')

<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Add Categories</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  <li class="breadcrumb-item"><a href="{{route('view_categories')}}">Categories</a>
                  </li>
                  <li class="breadcrumb-item active">Add Categories</li>
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
					<form class="form" method="POST" action="{{route('add_category_phase')}}" enctype="multipart/form-data">
						@csrf
						<div class="form-body">
							<h4 class="form-section"><i class="fa fa-plus"></i> Add Category</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="projectinput1">Category Name</label>
										<input type="text" class="form-control" placeholder="Category Name" name="category_name" required autofocus>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
								<label>Select File</label>
								<label id="file" class="file center-block">
									<input type="file" id="file" name="category_img" required>
									<span class="file-custom"></span>
								</label>
							</div>
						<div class="form-actions">
							<button type="button" class="btn btn-warning mr-1">
								<i class="fa fa-times"></i> Cancel
							</button>
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-save"></i> Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>



</div>

@stop
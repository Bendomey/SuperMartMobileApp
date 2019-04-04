@extends('layout.app')
@section('title','Categories')
@section('content')


<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">View Categories</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Categories</li>
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
			    <div class="heading-elements">
			        <ul class="list-inline mb-0">
			            <li><a class="btn btn-danger" href="{{route('add_categories')}}"><i class="fa fa-plus mr-1"></i>Add</a></li>
			        </ul>
			    </div>
			</div>
			<div class="card-body">
				<div class="table-responsiveness">
					<table class="table">
					    <thead>
					        <tr>
					            <th>ID</th>
					            <th>Name</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
							@if(count($categories) > 0)
								@foreach($categories as $cat)
					        <tr>
					            <th scope="row">{{$cat->id}}</th>
					            <td>{{$cat->category_name}}</td>
					            <td>
					            	<div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" data-categories="{{$cat}}" class="btn btn-info updateCatButton"><i class="fa fa-pencil-alt mr-1"></i>Edit</button>
                                        <button class="btn btn-danger deleteCatButton" data-category="{{$cat->category_name}}"><i class="fa fa-times mr-1"></i>Delete</button>
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
						{{$categories->links()}}
					</div>
				</div>
			</div>
		</div>

</div>

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
		<h3>Are you sure you want to delete this category?</h3>
		<div class="modal-footer">
			<button class="btn btn-secondary" style="color: #fff" data-dismiss="modal">Close</button>
			<a id="ConfirmDeleteButton" class="btn btn-danger">Yes</a>
		</div>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	</div>
    <div class="modal-body">
		<form class="form" method="POST" action="{{route('update_category')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-body">
				<h4 class="form-section"><i class="fa fa-pencil-alt"></i> Edit Category</h4>
				<input type="hidden" class="categoryID" name="id">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="category name">Category Name</label>
							<input type="text" class="form-control inputCategoryName" name="category_name" required>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
					<label>Select File</label>
					<label id="file" class="file center-block">
						<input type="file" id="file" name="category_img">
						<span class="file-custom"></span>
					</label>
				</div>
			<div class="form-actions">
				<button type="button" class="btn btn-warning mr-1">
					<i class="fa fa-times"></i> Cancel
				</button>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-save"></i> Update
				</button>
			</div>
		</form>
    </div>
  </div>
</div>
</div>
@stop
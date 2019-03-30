@extends('layout.app')
@section('title', 'Profile')
@section('content')

<div class="content-wrapper">
	<div class="content-header row mb-1">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Profile</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Profile</li>
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
	<section id="user-profile-cards-with-cover-image" class="row mt-2">
    <div class="col-xl-3 col-md-6 col-12">
        <div class="card box-shadow-1">
            <div class="text-center">
                <div class="card-body">
                    <img src="../../../app-assets/images/portrait/medium/avatar-m-4.png" class="rounded-circle  height-150" alt="Card image">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{Auth::user()->name}}</h4>
                    <h6 class="card-subtitle text-muted">{{Auth::user()->position}}</h6>
                    <button type="button" class="btn btn-warning mt-1" data-toggle="modal" data-target="#uploadProfileImage">
	                    Change Profile Image
	                </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-6 col-12">
    	<div class="card">
	            <div class="card-header">
	            <div class="card-content collpase show">
	                <div class="card-body">
	                    <form class="form form-horizontal form-bordered" action="{{route(
	                    'update_profile_phase_1')}}" method="POST">
	                    	@csrf
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-user"></i> Personal Info</h4>
			                    <div class="form-group row mx-auto">
			                    	<input type="hidden" name="id" value="{{Auth::user()->id}}">

	                            	<label class="col-md-3 label-control" for="full name">Full Name</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="namePersonal" class="form-control personalInfo" placeholder="Full Name" name="name" value="{{Auth::user()->name}}" readonly required>
		                            </div>
		                        </div>
		                        <div class="form-group row mx-auto">
	                            	<label class="col-md-3 label-control" for="position">Position</label>
									<div class="col-md-9">
	                            		<input type="text" id="positionPersonal" class="form-control personalInfo" placeholder="Position" name="position" value="{{Auth::user()->position}}" readonly required>
	                            	</div>
		                        </div>

		                        <div class="form-group row mx-auto">
		                            <label class="col-md-3 label-control" for="email">E-mail</label>
		                            <div class="col-md-9">
		                            	<input type="text" id="emailPersonal" class="form-control personalInfo" placeholder="E-mail" name="email" value="{{Auth::user()->email}}" readonly required>
		                            </div>
		                        </div>

		                        <div class="form-group row mx-auto last">
		                            <label class="col-md-3 label-control" for="contact">Contact Number</label>
		                            <div class="col-md-9">
		                            	<input type="tel" id="contactPersonal" class="form-control personalInfo" placeholder="Phone" name="contact" value="{{Auth::user()->contact}}" readonly required>
		                            </div>
		                        </div>
							</div>
	                        <div class="form-actions">
	                        	<button class="btn btn-danger d-none saveForPersonalInfo"
	                            data-toggle="modal" data-target="#passwordConfirmation">
			                        <i class="fa fa-check-square"></i> Save
			                    </button>
	                        </div>
	                    </form>
	                    <button  class="btn btn-info editForPersonalInfo">
	                        <i class="fa fa-pencil-alt"></i> Edit
	                    </button>
	                    
	                </div>
	            </div>
	        </div>
    </div>
    <div class="card">
	            <div class="card-header">
	            <div class="card-content collpase show">
	                <div class="card-body">
	                    <form class="form form-horizontal form-bordered" action="{{route('updatePassword')}}" method="post">
	                    	@csrf
	                    	<div class="form-body">
	                    		<h4 class="form-section"><i class="fa fa-lock"></i> Security Settings</h4>
			                    <div class="form-group row mx-auto">
			                    	<input type="hidden" name="id" value="{{Auth::user()->id}}">
	                            	<label class="col-md-3 label-control" for="oldPassword">Old Password</label>
		                            <div class="col-md-9">
		                            	<input type="password" id="oldPassword" class="form-control" placeholder="Old Password" name="old_password">
		                            </div>
		                        </div>
		                        <div class="form-group row mx-auto">
	                            	<label class="col-md-3 label-control" for="newPassword">New Password</label>
		                            <div class="col-md-9">
		                            	<input type="password" id="newPassword" class="form-control" placeholder="New Password" name="new_password">
		                            </div>
		                        </div>
		                        <div class="form-group row mx-auto">
	                            	<label class="col-md-3 label-control" for="confirmPassword">Confirm Password</label>
		                            <div class="col-md-9">
		                            	<input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" name="confirm_password">
		                            </div>
		                        </div>
							</div>

	                        <div class="form-actions">
	                            <button type="submit" class="btn btn-danger">
	                                Change
	                            </button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
    </div>
</section>

</div>


<div class="modal fade" id="uploadProfileImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="post">
      		@csrf
	      	<div style="display: flex; flex-direction: row; margin-bottom: 2vh; ">
	      		
	        <img src="{{asset('app-assets/images/portrait/medium/avatar-m-4.png')}}" height="100" width="150" class="rounded-circle  height-150 profileImg" alt="Card image">
		    <div style="margin-left:2vw;">
		        <h2>File Upload</h2>
		        <div class="custom-file">
			    	<input type="file" class="custom-file-input" id="profileImage" name="profileImage" onchange="previewImage(event)" required>
			    	<label class="custom-file-label" for="validatedCustomFile">Choose Image...</label>
				</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	     </form>
    </div>
  </div>
</div>



@stop
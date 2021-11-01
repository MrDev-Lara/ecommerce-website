@extends('frontend.main_master')
@section('main_content')

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<img width=100px; id="image" height=100px; src="{{ (!empty($adminData->profile_photo_path))? url('backend/upload/admin/'.$adminData->profile_photo_path):url('backend/upload/admin_profile.png') }}">

				<ul class="list-group list-group-flush">
					<a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
					<a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
					<a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
					<a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
				</ul>
			</div>
			<div class="col-md-2">
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<h3 class="text-center">Update Your Profile</h3>
				</div>
				<div class="card-body">
	<form action="{{ route('user.profile.store') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		@csrf
			<div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
            <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control unicase-form-control text-input">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control unicase-form-control text-input" id="email" >

             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
            <input type="number" class="form-control unicase-form-control text-input" value="{{ $user->phone }}" id="phone" name="phone">

             @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">User Image<span>*</span></label>
           	<input type="file" name="profile_photo_path" class="form-control"/>

           	@error('profile_photo_path')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
           
        </div>
         <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update Profile</button>
		</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
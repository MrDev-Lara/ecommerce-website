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
					<h3 class="text-center">Change Your Password</h3>
				</div>
				<div class="card-body">
	<form action="{{ route('update.password') }}" method="post" accept-charset="utf-8">
		@csrf
			<div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Old Password <span>*</span></label>
            <input type="password" name="old_password" id="old_password" class="form-control unicase-form-control text-input">

            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="info-title" for="exampleInputEmail2">New Password<span>*</span></label>
            <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" >

             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Confirm Password<span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="password_confirmation" name="password_confirmation">

             @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
         <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Change Password</button>
		</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
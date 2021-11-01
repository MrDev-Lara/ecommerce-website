@extends('frontend.main_master')
@section('main_content')

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<img width=100px; id="image" height=100px; src="{{ (!empty($adminData->profile_photo_path))? url('backend/upload/admin/'.$adminData->profile_photo_path):url('backend/upload/admin_profile.png') }}">

				<ul class="list-group list-group-flush">
					<a href="" class="btn btn-primary btn-sm btn-block">Home</a>
					<a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
					<a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
					<a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
				</ul>
			</div>
			<div class="col-md-2">
				
			</div>
			<div class="col-md-6">
				<div class="card">
					<h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ Auth::user()->name }}</strong> Welcome to Amar Shop</h3>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
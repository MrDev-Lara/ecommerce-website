@extends('admin.admin_master')
@section('admin_content')

<section class="content">
	<div class="row">
		<div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Edit Admin Profile</h4>
			  <h6 class="box-subtitle">Update Your Profile</h6>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					  <div class="row">
						<div class="col-12">						
							<div class="form-group">
								<h5>Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $adminData->name }}"> <div class="help-block"></div></div>
							</div>
							<div class="form-group">
								<h5>Email Address <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{ $adminData->email }}"> <div class="help-block"></div></div>
							</div>
							
							<div class="form-group">
								<h5>Profile Photo</h5>
								<div class="controls">
									<input type="file" onchange="readURL(this);" name="profile_photo_path" class="form-control"> <div class="help-block"></div></div>
							</div>

							 <img width=100px; id="image" height=100px; src="{{ (!empty($adminData->profile_photo_path))? url('backend/upload/admin/'.$adminData->profile_photo_path):url('backend/upload/admin_profile.png') }}">

						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Update Profile</button>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
	</div>
</section>

<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(100)
                  .height(100);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection
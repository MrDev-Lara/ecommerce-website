@extends('admin.admin_master')
@section('admin_content')

<section class="content">
	<div class="row">
		<div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Admin Password</h4>
			  <h6 class="box-subtitle">Update Your Password</h6>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form action="{{ route('update.admin.password') }}" method="post">
					@csrf
					  <div class="row">
						<div class="col-12">						
							<div class="form-group">
								<h5>Old Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="old_password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
							<div class="form-group">
								<h5>New Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>
							<div class="form-group">
								<h5>Confirm Password <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="password" name="password_confirmation" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
							</div>

						<div class="text-xs-right">
							<button type="submit" class="btn btn-rounded btn-info">Update Password</button>
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


@endsection
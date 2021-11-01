@extends('admin.admin_master')
@section('admin_content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('category/update/'.$category->id) }}" method="post">
						@csrf
						
						<div class="form-group">
							<h5>Category Name English<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="category_name_en" value="{{ $category->category_name_en }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
								@error('category_name_en')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<h5>Category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="category_name_hin" value="{{ $category->category_name_hin }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									@error('category_name_hin')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								
								<div class="form-group">
									<h5>Category Icon<span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="category_icon" value="{{ $category->category_icon }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
										@error('category_icon')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
									<div class="text-xs-right">
										<input type="submit" value="Update Category" class="btn btn-primary"/>
									</div>
								</form>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
						
					</div>
				</div>
			</div>
			@endsection
@extends('admin.admin_master')
@section('admin_content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Sub-Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('subcategory/update/'.$subcategory->id) }}" method="post">
						@csrf
						
						<div class="form-group">
							  <label>Select Category</label>
							  <select class="form-control" name="category_id">
							  		<option disabled="" value="">Select one</option>
							  	@foreach($cats as $cat)
									<option value="{{ $cat->id }}" {{ $subcategory->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->category_name_en }}</option>
								@endforeach
							  </select>
						</div>

						<div class="form-group">
							<h5>Sub-Category Name English<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="subcategory_name_en" value="{{ $subcategory->subcategory_name_en }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
								@error('subcategory_name_en')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<h5>Sub-Category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="subcategory_name_hin" value="{{ $subcategory->subcategory_name_hin }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
									@error('subcategory_name_hin')
									<span class="text-danger">{{ $message }}</span>
									@enderror
								</div>
								
							
									<div class="text-xs-right">
										<input type="submit" value="Update SubCategory" class="btn btn-primary"/>
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
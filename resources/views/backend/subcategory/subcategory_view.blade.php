@extends('admin.admin_master')
@section('admin_content')

<div class="container">
	<div class="row">
		
	
<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub-Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial No</th>
								<th>Category Name</th>
								<th>Sub-Category Name English</th>
								<th>Sub-Category Name Hindi</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@foreach($subcategories as $subcategory)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $subcategory->category->category_name_en }}</td>
									<td>{{ $subcategory->subcategory_name_en }}</td>
									<td>{{ $subcategory->subcategory_name_hin }}</td>
									<td><span><a href="{{ URL::to('subcategory/edit/'.$subcategory->id) }}" class="btn btn-info btn-sm">EDIT</a><a href="{{ URL::to('subcategory/delete/'.$subcategory->id) }}" id="delete" class="btn btn-danger btn-sm">DELETE</a></span></td>
								</tr>
							@endforeach
						</tbody>
						
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			          
	</div>

	<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Sub-Category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ route('subcategory.store') }}" method="post">
					@csrf
						<div class="form-group">
							  <label>Select Category</label>
							  <select class="form-control" name="category_id">
							  		<option disabled="" selected="" value="">Select one</option>
							  	@foreach($cats as $cat)
									<option value="{{ $cat->id }}">{{ $cat->category_name_en }}</option>
								@endforeach
							  </select>
						</div>
					  						
							<div class="form-group">
								<h5>Sub-Category Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="subcategory_name_en" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('subcategory_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Sub-Category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="subcategory_name_hin" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('subcategory_name_hin')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
					

						<div class="text-xs-right">
							<input type="submit" value="Add SubCategory" class="btn btn-primary"/>
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
@extends('admin.admin_master')
@section('admin_content')

<div class="container">
	<div class="row">
		
	
<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Category List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial No</th>
								<th>Category Name English</th>
								<th>Category Name Hindi</th>
								<th>Category Icon</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@foreach($categories as $category)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $category->category_name_en }}</td>
									<td>{{ $category->category_name_hin }}</td>
									<td><span><i class="{{ $category->category_icon }}"></i></span></td>
									<td><span><a href="{{ URL::to('category/edit/'.$category->id) }}" class="btn btn-info btn-sm">EDIT</a><a href="{{ URL::to('category/delete/'.$category->id) }}" id="delete" class="btn btn-danger btn-sm">DELETE</a></span></td>
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
				  <h3 class="box-title">Add Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ route('category.store') }}" method="post">
					@csrf
					  						
							<div class="form-group">
								<h5>Category Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="category_name_en" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('category_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="category_name_hin" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('category_name_hin')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							
							<div class="form-group">
								<h5>Category Icon<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="category_icon" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('category_icon')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>

						<div class="text-xs-right">
							<input type="submit" value="Add Category" class="btn btn-primary"/>
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
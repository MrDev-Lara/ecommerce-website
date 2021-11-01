@extends('admin.admin_master')
@section('admin_content')

<div class="container">
	<div class="row">
		
	
<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Brand List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial No</th>
								<th>Brand Name English</th>
								<th>Brand Name Hindi</th>
								<th>Brand Image</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@foreach($brands as $brand)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $brand->brand_name_en }}</td>
									<td>{{ $brand->brand_name_hin }}</td>
									<td><img src="{{ asset($brand->brand_image) }}" height="70px" width="50px"/></td>
									<td><span><a href="{{ URL::to('brand/edit/'.$brand->id) }}" class="btn btn-info btn-sm">EDIT</a><a href="{{ URL::to('brand/delete/'.$brand->id) }}" id="delete" class="btn btn-danger btn-sm">DELETE</a></span></td>
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
					<form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					  						
							<div class="form-group">
								<h5>Brand Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="brand_name_en" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('brand_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Brand Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="brand_name_hin" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('brand_name_hin')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							
							<div class="form-group">
								<h5>Brand Image</h5>
								<div class="controls">
									<input type="file"  name="brand_image" class="form-control"> 
									@error('brand_image')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
						        </div>
							</div>

						<div class="text-xs-right">
							<input type="submit" value="Add Brand" class="btn btn-primary"/>
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
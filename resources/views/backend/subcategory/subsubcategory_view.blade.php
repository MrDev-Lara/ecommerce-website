@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
	<div class="row">
		
	
<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sub Sub-Category List</h3>
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
								<th>Sub sub-category Name English</th>
								<th>Sub sub-category Name Hindi</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 1;
							@endphp
							@foreach($subsubcategories as $subsubcategory)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $subsubcategory->category->category_name_en }}</td>
									<td>{{ $subsubcategory->subcategory->subcategory_name_en }}</td>
									<td>{{ $subsubcategory->subsubcategory_name_en }}</td>
									<td>{{ $subsubcategory->subsubcategory_name_hin }}</td>
									<td><span><a href="{{ URL::to('subcategory/sub/edit/'.$subsubcategory->id) }}" class="btn btn-info btn-sm">EDIT</a><a href="{{ URL::to('subcategory/sub/delete/'.$subsubcategory->id) }}" id="delete" class="btn btn-danger btn-sm">DELETE</a></span></td>
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
				  <h3 class="box-title">Add Sub sub-category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ route('subsubcategory.store') }}" method="post">
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
							  <label>Select Sub-Category</label>
							  <select class="form-control" name="subcategory_id">
							  		<option disabled="" selected="" value="">Select Sub-category</option>
							  	
							  </select>
						</div>

							<div class="form-group">
								<h5>Sub sub-category Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="subsubcategory_name_en" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('subcategory_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Sub sub-category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="subsubcategory_name_hin" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

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

<script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>
@endsection
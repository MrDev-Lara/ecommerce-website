@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container">
	<div class="row">
		
	

	<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Sub sub-category</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('subcategory/sub/update/'.$subsubcats->id) }}" method="post">
					@csrf
						<div class="form-group">
							  <label>Select Category</label>
							  <select class="form-control" name="category_id">
							  		<option disabled="" selected="" value="">Select one</option>
							  	@foreach($cats as $cat)
									<option value="{{ $cat->id }}" {{ $subsubcats->category_id == $cat->id ?'selected' : '' }}>{{ $cat->category_name_en }}</option>
								@endforeach
							  </select>
						</div>
					  	

					  	<div class="form-group">
							  <label>Select Sub-Category</label>
							  <select class="form-control" name="subcategory_id">
							  		<option disabled="" selected="" value="">Select Sub-category</option>
							  	@foreach($subcats as $subcat)
									<option value="{{ $subcat->id }}" {{ $subsubcats->subcategory_id == $subcat->id ?'selected' : '' }}>{{ $subcat->subcategory_name_en }}</option>
								@endforeach
							  </select>
						</div>

							<div class="form-group">
								<h5>Sub sub-category Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $subsubcats->subsubcategory_name_en }}" name="subsubcategory_name_en" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('subcategory_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Sub sub-category Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" value="{{ $subsubcats->subsubcategory_name_hin }}" name="subsubcategory_name_hin" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

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
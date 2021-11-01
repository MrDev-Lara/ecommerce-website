@extends('admin.admin_master')
@section('admin_content')

<div class="container">
	<div class="row">

	<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('brand/update/'.$brand->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					  						
							<div class="form-group">
								<h5>Brand Name English<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="brand_name_en" class="form-control" value="{{ $brand->brand_name_en }}" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('brand_name_en')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							<div class="form-group">
								<h5>Brand Name Hindi<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="brand_name_hin" value="{{ $brand->brand_name_hin }}" class="form-control" data-validation-required-message="This field is required"> <div class="help-block"></div></div>

									@error('brand_name_hin')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
							</div>
							
							<div class="form-group">
								<h5>Brand Image</h5>
								<div class="controls">
									<img id="image" src="{{ asset($brand->brand_image) }}" width="100px" height="100px"/>
									<input type="file"  name="brand_image" class="form-control" onchange="readURL(this);"> 
									@error('brand_image')
						                <span class="text-danger">{{ $message }}</span>
						            @enderror
						        </div>
							</div>

						<div class="text-xs-right">
							<input type="submit" value="Update Brand" class="btn btn-primary"/>
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
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection
@extends('admin.admin_master')
@section('admin_content')


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Product List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Serial No </th>
								<th>Image </th>
								<th>Product Name En</th>
								<th>Product Price </th>
								<th>Quantity </th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
							@php
							$i = 1;
							@endphp
	 @foreach($products as $product)
	 <tr>
	 	<td>{{ $i++}}  </td>
		<td> <img src="{{ asset($product->product_thambnail) }}" style="width: 60px; height: 50px;">  </td>
		<td>{{ $product->product_name_en }}</td>
		 <td>{{ $product->selling_price }}</td>
		 <td>{{ $product->product_qty }}</td>


		  <td>
		  	@if($product->status == 1)
		  		<span class="badge badge-pill badge-success"> Active </span>
		  	@else
		  		<span class="badge badge-pill badge-danger"> Inactive </span>
		  	@endif
		  </td>



		<td>
 <a href="{{ URL::to('product/edit/'.$product->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
 <a href="{{ URL::to('product/delete/'.$product->id) }}" class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
 	<a href="{{ URL::to('product/status/'.$product->id) }}" class="btn btn-success" title="Delete Data">
 	<i class="fa fa-eye"></i></a>
		</td>

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
			<!-- /.col -->





		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




@endsection 
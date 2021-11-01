@extends('frontend.main_master')
@section('main_content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Reset Password -->            
<div class="col-md-12 col-sm-6 sign-in">
    <h4 class="">Reset Password</h4>
    <p class="">Reset Your Account Password</p>

@if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

     <form method="POST" action="{{ route('password.email') }}">
            @csrf
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Email Address<span>*</span></label>
            <input type="email" name="email" :value="old('email')" required class="form-control unicase-form-control text-input" id="email" >


   @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
    </form>     

</div>
<!-- Sign-in -->
        </div><!-- /.row -->
        </div><!-- / Reset Password-->
        </div>
    </div>

@endsection
@extends('csadmin.layouts.login')
@section('content')
@php
$settingData = App\Models\CsThemeAdmin::first();
@endphp
<form class="w-100">
<div class="row">
<div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
<div class="text-center mb-5">
<a class="navbar-brand me-0" href="{{env('ADMIN_URL')}}">
<img class="brand-img d-inline-block" src="@if(isset($settingData->logo) && $settingData->logo!=''){{env('SETTING_IMAGE')}}{{$settingData->logo}}@else{{''}}@endif" alt="brand" style="width:150px;">
</a>
</div>
<div class="card card-flush">
<div class="card-body text-center">
<h4>Reset your Password</h4>
<p class="mb-4">Enter your registered email address.</p>
<div class="row gx-3">
<div class="form-group col-lg-12">
<div class="form-label-group">
<label for="userName">Email Adresss</label>
</div>
<input class="form-control" placeholder="" value="" type="email">
</div>
</div>
<a href="#" class="btn btn-primary btn-uppercase btn-block btn-lg">Send</a>

</div>
</div>
</div>
</div>
</form>
@endsection
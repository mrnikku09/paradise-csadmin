@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
<div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Site Setting</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                    <li class="breadcrumb-item active">Site Setting</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@include('csadmin.elements.message')
                       

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{route('csadmin.settings.sitesettingsprocess')}}" enctype="multipart/form-data">
            @csrf
            <div class="card bg-secondary rounded h-100 p-4">
                <div class="card-header">
					<div class="row align-items-center gy-3">
						<div class="col-sm">
							<h5 class="card-title my-1">Site Setting</h5>
						</div> 
					</div>
				</div>  
                <div class="card-body justify-content-sm-center">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Site Title: <span style="color: red;">*</span></label>
                                <input
                                    type="text"
                                    class="form-control @error('site_title') is-invalid @enderror"
                                    placeholder="Site Title"
                                    value="@if(isset($settingData->site_title)){{$settingData->site_title}}@else{{''}}@endif"
                                    name="site_title"
                                />
                                @error('site_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{'Site title is required'}}</strong>
                                </span>
                                @enderror 
                            </div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Administration Email Address: <span style="color: red;">*</span></label>
                                <input
                                    type="email"
                                    class="form-control @error('administration_email') is-invalid @enderror"
                                    placeholder="Administration Email Address"
                                    name="administration_email"
                                    value="@if(isset($settingData->administration_email)){{$settingData->administration_email}}@else{{old('administration_email')}}@endif"
                                />
                                @error('administration_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{'Administration Email Address is required'}}</strong>
                                </span>
                                @enderror 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Support Email Address: </label>
                                <input type="email" class="form-control" placeholder="Support Email Address" name="admin_support_email" value="@if(isset($settingData->admin_support_email)){{$settingData->admin_support_email}}@endif" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Support Mobile Number: </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Support Mobile Number"
                                    name="admin_support_mobile"
                                    value="@if(isset($settingData->admin_support_mobile)){{$settingData->admin_support_mobile}}@endif"
                                />
                            </div>
                        </div>
						
						
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Address:</label>
                                <input type="text" class="form-control" value="@if(isset($settingData->address)){{$settingData->address}}@else{{''}}@endif" name="address" />
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <hr />
                            <h6 class="mb-0"><strong>Logo & Favicon</strong></h6>
                            <hr />
                        </div>
                        <div class="col-lg-4 mb-3">
							<div class="fileimg">
								<img class="fileimg-preview logoimage mb-3" src="@if(isset($settingData->logo) && $settingData->logo!=''){{env('SETTING_IMAGE')}}{{$settingData->logo}}@else{{env('NO_IMAGE')}}@endif"/>
								<div style="width: 100%;">
									<label class="form-label">Site Logo:</label>
									<div class="input-group">
										<input
											   type="file"
											   class="form-control bg-dark @error('logo') is-invalid @enderror"
											   id="logoFile"
											   name="logo"
											   accept="image/png, image/gif, image/jpeg"
											   onchange="return logoValidation('logoFile')"
											   id="logofile"
											   />
									</div>
									<small class="text-muted">Accepted: gif, png, jpg. Max file size 2Mb</small>
									@error('logo')
									<div class="valid-feedback invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
                        </div>
						<div class="col-lg-4 mb-3">
                            <div class="d-flex">
                                <div class="fileimg">
                                    <img
                                        class="fileimg-preview whitelogo"
                                        name="favicon"
                                        src="@if(isset($settingData->white_logo) && $settingData->white_logo!=''){{env('SETTING_IMAGE')}}{{$settingData->white_logo}}@else{{env('NO_IMAGE')}}@endif"
                                    />
                                    <div style="width: 100%;">
                                        <label class="form-label">White Logo:</label>
                                        <div class="input-group">
                                            <input
                                                type="file"
                                                class="form-control bg-dark @error('white_logo') is-invalid @enderror"
                                                id="whiteLogo"
                                                name="white_logo"
                                                accept="image/png, image/gif, image/jpeg, image/webp,"
                                                onchange="return whiteLogoValidation('whiteLogo')"
                                            />
                                        </div>
                                        <small class="text-muted">Accepted: gif, png, jpg. Max file size 2Mb</small>
                                        @error('white_logo')
                                        <div class="valid-feedback invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-4 mb-3">
							<div class="fileimg">
								<img
									 class="fileimg-preview favicon mb-3"
									 name="favicon"
									 src="@if(isset($settingData->favicon) && $settingData->favicon!=''){{env('SETTING_IMAGE')}}{{$settingData->favicon}}@else{{env('NO_IMAGE')}}@endif"
									 />
								<div style="width: 100%;">
									<label class="form-label">Favicon Site Icon:</label>
									<div class="input-group">
										<input
											   type="file"
											   class="form-control bg-dark @error('favicon') is-invalid @enderror"
											   id="faviconFile"
											   name="favicon"
											   accept="image/png, image/gif, image/jpeg, image/webp,"
											   onchange="return faviconValidation('faviconFile')"
											   />
									</div>
									<small class="text-muted">Accepted: gif, png, jpg. Max file size 2Mb</small>
									@error('favicon')
									<div class="valid-feedback invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</div>
<script type="text/javascript">
var allowedMimes = ["png", "jpg", "jpeg", "gif", "webp"]; //allowed image mime types
var maxMb = 2; //maximum allowed size (MB) of image

function logoValidation(logoFile) {
var fileInput = document.getElementById(logoFile);

var mime = fileInput.value.split(".").pop();
var fsize = fileInput.files[0].size;
var file = fsize / 1024;
var mb = file / 1024; // convert kb to mb
if (mb > maxMb) {
    alert("Image size must be less than 2mb");
} else if (!allowedMimes.includes(mime)) {
    // if allowedMimes array does not have the extension
    alert("Only png, jpg, jpeg alowed");
} else {
    let reader = new FileReader();
    reader.onload = function (event) {
        $(".logoimage").attr("src", event.target.result);
    };
    reader.readAsDataURL(fileInput.files[0]);
}
}
function faviconValidation(faviconFile) {
var fileInput = document.getElementById(faviconFile);
var mime = fileInput.value.split(".").pop();
var fsize = fileInput.files[0].size;
var file = fsize / 1024;
var mb = file / 1024; // convert kb to mb
if (mb > maxMb) {
    alert("Image size must be less than 2mb");
} else if (!allowedMimes.includes(mime)) {
    // if allowedMimes array does not have the extension
    alert("Only png, jpg, jpeg alowed");
} else {
    let reader = new FileReader();
    reader.onload = function (event) {
        $(".favicon").attr("src", event.target.result);
    };
    reader.readAsDataURL(fileInput.files[0]);
}
}
</script>
@endsection




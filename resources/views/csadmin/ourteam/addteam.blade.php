@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-sm-0">Manage Add Team</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Team</a></li>
                                <li class="breadcrumb-item active">Manage Add Team</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <form method="POST" action="{{ route('csadmin.ourteam.teamProcess') }}" enctype="multipart/form-data"
                id=formsubmit>
                @csrf
                <input type="hidden" name="team_id"
                    value="{{isset($teamIdData->team_id) && $teamIdData->team_id != '' ? $teamIdData->team_id:0}}">
                <div class="card bg-secondary rounded p-2">
                    <div class="card-header">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title my-1">Add Team</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body justify-content-sm-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Team Name: <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control required @error('team_name') is-invalid @enderror"
                                            placeholder="Team Name" id="team_name_id"
                                            value="{{isset($teamIdData->team_name) && $teamIdData->team_name != '' ? $teamIdData->team_name:''}}"
                                            name="team_name" />
                                        @error('team_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Team Name is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Team Designation: <span style="color: red;">*</span></label>
                                        <div class="input-group mb-3">
                                            
                                            <input type="text" class="form-control required @error('team_designation') is-invalid @enderror" id="team_designation_id"
                                                name="team_designation" placeholder="Team Designation" value="@if(isset($teamIdData->team_designation)){{$teamIdData->team_designation}}@else{{''}}@endif">
                                                @error('team_designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ 'Team Designation  is required' }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>

                    </div>
                    <div class="card-body justify-content-sm-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="fileimg d-flex">
                                        <img class="fileimg-preview logoimage mediaImage mt-2"style="@error('team_image') {{'border:solid red 1px'}} @enderror"
                                            src="@if(isset($teamIdData->team_image) && $teamIdData->team_image != ''){{env('OURTEAM_IMAGE')}}{{$teamIdData->team_image}}@else{{env('NO_IMAGE')}} @endif"
                                            style="width:80px;height:80px;margin-right: 10px;border-radius: 5px;">
                                        <div style="width:100%">
                                            <label class="form-label">Team Image:<span
                                                    style="color:red">*</span></label>
                                            <div class="input-group">
                                                <input type="file" class="form-control " id="imageFile"
                                                    name="team_image" accept="image/png, image/gif, image/jpeg"
                                                    onchange="return imageValidation('imageFile')">

                                            </div>
                                            <small class="text-muted" style="font-size:11px;">Accepted: gif, png, jpg.
                                                Max file size 2Mb</small>
                                               
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer  d-flex justify-content-between">
                        <button type="submit" id='button' class="btn btn-success">@if (isset($teamIdData->team_id) &&
                            $teamIdData->team_id != '')
                            {{ 'Update' }}@else{{ 'Save' }} @endif</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
    <script>
        var allowedMimes = ["png", "jpg", "jpeg", "gif"]; //allowed image mime types
        var maxMb = 2; //maximum allowed size (MB) of image

        function imageValidation(imageFile) {
            var fileInput = document.getElementById(imageFile);

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
                    $(".mediaImage").attr("src", event.target.result);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
    @endsection
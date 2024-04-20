@extends('csadmin.layouts.master')



@section('content')

<div class="page-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="mb-sm-0">Add Slider And Banner</h5>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript:void(0);">Slider And Banner</a></li>

                                <li class="breadcrumb-item active">Add Slider And Banner</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        @include('csadmin.elements.message')

        <div class="row">

            <form method="POST" action="{{ route('csadmin.appearence.sliderProcess') }}" enctype="multipart/form-data"

                id="formsubmit">

                @csrf

                <input type="hidden" name="slider_id"

                    value="{{isset($sliderIdData->slider_id)&& $sliderIdData->slider_id != '' ?$sliderIdData->slider_id:0}}">

                <div class="row g-2">

                    <div class="col-lg-8">

                        <div class="card bg-secondary rounded p-2 mb-2">

                            <div class="card-header">

                                <div class="row align-items-center gy-3">

                                    <div class="col-sm">

                                        <h5 class="card-title my-1">Add Slider And Banner</h5>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body justify-content-sm-center">

                                <div class="row">

                                    <div class="col-lg-6">

                                        <div class="mb-3">

                                            <label class="form-label">Slider Name : <span

                                                    style="color: red;">*</span></label>

                                            <input type="text"

                                                class="form-control required @error('slider_name') is-invalid @enderror"

                                                placeholder="Slider Title" id="slider_name_id" name="slider_name"

                                                value="{{ isset($sliderIdData->slider_name) && $sliderIdData->slider_name != '' ? $sliderIdData->slider_name : '' }}" />



                                            @error('slider_name')

                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ 'Slider title is required' }}</strong>

                                            </span>

                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-lg-6">

                                        <div class="mb-3">

                                            <label class="form-label">Slider Position : <span

                                                    style="color: red;">*</span></label>

                                            <select name="slider_position" class="form-select required">

                                                <option value="">Select Position</option>

                                                <option value="1" @if (isset($sliderIdData->slider_position) &&

                                                    $sliderIdData->slider_position == 1) {{ 'selected' }}@else{{ '' }}

                                                    @endif >Top (Web)</option>

                                                <option value="2" @if (isset($sliderIdData->slider_position) &&

                                                    $sliderIdData->slider_position == 2) {{ 'selected' }}@else{{ '' }}

                                                    @endif >Top (Mobile)</option>

                                            </select>

                                        </div>

                                    </div>



                                    <div class="col-lg-12">

                                        <div class="mb-3">

                                            <label class="form-label">Slider Description : </label>

                                            <input type="text" class="form-control" placeholder="Slider Description"

                                                id="slider_desc_id" name="slider_desc"

                                                value="{{ isset($sliderIdData->slider_desc) && $sliderIdData->slider_desc != '' ? $sliderIdData->slider_desc : '' }}" />





                                        </div>

                                    </div>

                                    



                                </div>

                            </div>

                            <div class="card-footer justify-content-sm-center bordered">

                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="mb-3">

                                            <button type="button" id="button" onclick="return validcheck();"

                                                class="btn btn-success">

                                                @if(isset($sliderIdData->slider_id)&& $sliderIdData->slider_id !=

                                                ''){{'Update'}}@else{{'Save'}}@endif

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>





                    </div>

                    <div class="col-lg-4">



                        <div class="card bg-secondary rounded p-2 mb-2">

                            <div class="card-header">

                                <div class="row align-items-center gy-3">

                                    <div class="col-sm">

                                        <h5 class="card-title my-1">Slider Image</h5>

                                    </div>

                                </div>

                            </div>

                            <div class="card-body justify-content-sm-center bordered">

                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="mb-3">

                                            <div class="">

                                                <img class="fileimg-preview logoimage sliderImage mt-2 required @error('slider_image') is-invalid @enderror"

                                                    src="@if(isset($sliderIdData->slider_image)&& $sliderIdData->slider_image != ''){{env('SLIDER_IMAGE')}}{{$sliderIdData->slider_image}}@else{{env('NO_IMAGE')}} @endif"

                                                    style="height: 225px; width: 100%; object-fit: contain; border: 1px solid rgba(72, 94, 144, 0.16); cursor:pointer;"

                                                    onclick="triggerInputClick()">

                                                <div style="width:100%" class="text-center">

                                                    <div class="input-group mb-2 d-none">

                                                        <input type="file" class="form-control " id="imageFile"

                                                            name="slider_image"

                                                            accept="image/png, image/gif, image/jpeg"

                                                            onchange="return imageValidation('imageFile')">



                                                    </div>

                                                    <small class="text-muted " style="font-size:11px;">Accepted: gif,

                                                        png, jpg. Max file size 2Mb</small>



                                                </div>

                                                @error('slider_image')

                                                <span class="invalid-feedback text-center" role="alert">

                                                    <strong>{{ 'Slider Image is required' }}</strong>

                                                </span>

                                                @enderror

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<script>

    var allowedMimes = ["png", "jpg", "jpeg", "gif",'webp']; //allowed image mime types

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

                $(".sliderImage").attr("src", event.target.result);

            };

            reader.readAsDataURL(fileInput.files[0]);

        }

    }



    function triggerInputClick() {

        // Trigger click event of the hidden input field

        document.getElementById('imageFile').click();

    }



    function validcheck() {

        var counter = 0;

        var myElements = document.getElementsByClassName("required");

        for (var i = 0; i < myElements.length; i++) {

            if (myElements[i].value == '') {

                myElements[i].style.border = '1px solid red';

                counter++;

            } else {

                myElements[i].style.border = '';

            }

        }

        if (counter == 0) {

            $('#formsubmit').submit();

        }

    }

</script>









@endsection
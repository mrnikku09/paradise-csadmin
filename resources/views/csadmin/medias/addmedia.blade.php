@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-sm-0">Manage Add Media</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Media</a></li>
                                <li class="breadcrumb-item active">Manage Add Media</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <form method="POST" action="{{ route('csadmin.mediaProcess') }}" enctype="multipart/form-data"
                id=formsubmit>
                @csrf
                <input type="hidden" name="media_id"
                    value="{{isset($mediaIdData->media_id) && $mediaIdData->media_id != '' ? $mediaIdData->media_id:0}}">
                <div class="card bg-secondary rounded p-2">
                    <div class="card-header">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title my-1">Add Media</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body justify-content-sm-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <div class="fileimg d-flex">
                                        <img class="fileimg-preview logoimage mediaImage mt-2" src="@if(isset($mediaIdData->media) && $mediaIdData->media != ''){{env('MEDIA_IMAGE')}}{{$mediaIdData->media}} @else {{env('NO_IMAGE')}} @endif" style="width:80px;height:80px;margin-right: 10px;border-radius: 5px;">
                                        <div style="width:100%">
                                            <label class="form-label">Media Image:<span
                                                    style="color:red">*</span></label>
                                            <div class="input-group">
                                                <input type="file" class="form-control " id="imageFile" name="media"
                                                    accept="image/png, image/gif, image/jpeg"
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
                        <button type="submit" id='button' class="btn btn-success">@if (isset($mediaIdData->media_id) && $mediaIdData->media_id != '')
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
@extends('csadmin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-sm-0">Add Pages</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Add Pages</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('csadmin.elements.message')
            <div class="row">
                <form method="POST" action="{{ route('csadmin.page.addpageprocess') }}"enctype="multipart/form-data" id=formsubmit>
                    @csrf
                    <input type="hidden" name="page_id" value="{{isset($pageData->page_id) && $pageData->page_id != '' ? $pageData->page_id:0}}">
                    <div class="card bg-secondary rounded p-2">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title my-1">Add Page</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body justify-content-sm-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Name: <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control required @error('page_name') is-invalid @enderror"
                                            placeholder="Site Title" id="page_name_id" onkeyup="pagename(this.value)"
                                            value="{{isset($pageData->page_name) && $pageData->page_name != '' ? $pageData->page_name:''}}"
                                            name="page_name" />
                                        @error('page_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Site title is required' }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Url: <span style="color: red;">*</span></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text page_urls"
                                                id="basic-addon3">{{ url('/') }}</span>
                                            <input type="text" class="form-control required @error('page_url') is-invalid @enderror" id="page_url_id"
                                                aria-describedby="basic-addon3" name="page_url" value="@if(isset($pageData->page_url)){{$pageData->page_url}}@else{{''}}@endif">
                                                @error('page_url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ 'Page Url Address is required' }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Page Content</label>
                                        <textarea type="email" class="form-control ckeditor bg-dark" placeholder="Page Content" name="page_content"
                                            value="">
                                                        @if (isset($pageData->page_content))
{{ $pageData->page_content }}
@endif
                                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">    
                                        <div class="fileimg d-flex">    
                                            <img class="fileimg-preview logoimage mediaImage mt-2" src="@if(isset($pageData->page_header_image) && $pageData->page_header_image != ''){{env('PAGE_IMAGE')}}{{$pageData->page_header_image}} @else {{env('NO_IMAGE')}} @endif" style="width:80px;height:80px;margin-right: 10px;border-radius: 5px;">    
                                            <div style="width:100%">    
                                                <label class="form-label">Page Header Image:<span    
                                                        style="color:red">*</span></label>    
                                                <div class="input-group">    
                                                    <input type="file" class="form-control " id="imageFile" name="page_header_image"    
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

                    </div>
                    <div class="card bg-secondary rounded p-2">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title my-1">SEO - Meta Tags</h5>
                                    <p>Define page meta title, meta keywords and meta description to list your page in
                                        search engines

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body justify-content-sm-center">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Page Meta Title: <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control required @error('page_meta_title') is-invalid @enderror" placeholder="Page Meta Title"
                                        id="page_meta_title_id" name="page_meta_title"
                                        value="@if(isset($pageData->page_meta_title)){{$pageData->page_meta_title}}@endif" />
                                        @error('page_meta_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ 'Page Url Address is required' }}</strong>
                                                    </span>
                                                @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Page Meta Keyword: </label>
                                    <input type="text" class="form-control" placeholder="Page Meta Keyword"
                                        name="page_meta_keyword" id="page_meta_keyword_id"
                                        value="@if(isset($pageData->page_meta_keyword)){{ $pageData->page_meta_keyword}}@endif" />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Page Meta Description:</label>
                                    <input type="text" class="form-control" placeholder="Page Meta Desc"
                                        value="@if (isset($pageData->page_meta_keyword)) {{ $pageData->page_meta_keyword }}@else{{ '' }} @endif"
                                        name="page_meta_keyword" id="page_meta_keyword_id" />
                                </div>
                            </div>
                        </div>

                        <div class="card-footer  d-flex justify-content-between">
                            <button type="button" id='button' class="btn btn-success" onclick="return checkvalidation($(this));">@if (isset($pageData->page_id) && $pageData->page_id != '')
                                {{ 'Update' }}@else{{ 'Save' }}
                            @endif</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            console.log('res')
            $("#page_name_id").change(function(e) {
                $.get('{{ route('csadmin.checkslug') }}', {
                        'title': $(this).val()
                    },
                    function(data) {
                       $('#page_meta_title_id').val(data.metatitle);
                       $('#page_url_id').val(data.slug);
                    }
                );
            })

            function checkvalidation(value)
            {
                var elementsselect=document.querySelectorAll('.required');
                var counter = 0;
                for(let i=0; i<elementsselect.length;i++)
                {
                    if(elementsselect[i].value== "" )
                    {
                        elementsselect[i].style.border='1px solid red';
                        counter++;
                    }
                    else{
                        elementsselect[i].style.border='';

                    }
                }
                if(counter == 0)
                {
                    $('#formsubmit').submit();
                }
            }
        </script>
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

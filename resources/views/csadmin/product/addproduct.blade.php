@extends('csadmin.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-sm-0">Add Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <form method="POST" action="{{ route('csadmin.product.addproductprocess') }}" enctype="multipart/form-data" id="formsubmit">
                @csrf
                <input type="hidden" name="product_id" value="{{ isset($productIdData->product_id) && $productIdData->product_id != '' ? $productIdData->product_id : 0 }}">
                <div class="row g-2">
                    <div class="col-lg-8">
                        <div class="card bg-secondary rounded p-2 mb-2">
                            <div class="card-header">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title my-1">Add Product</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Name: <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control required @error('product_name') is-invalid @enderror" placeholder="Product Title" id="product_name_id" onkeyup="productname(this.value)" value="{{ isset($productIdData->product_name) && $productIdData->product_name != '' ? $productIdData->product_name : '' }}" name="product_name" />
                                            @error('product_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Product title is required' }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product SKU <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control required @error('product_sku') is-invalid @enderror" placeholder="Product SKU" id="product_sku_id" value="{{ isset($productIdData->product_sku) && $productIdData->product_sku != '' ? $productIdData->product_sku : '' }}" name="product_sku" />
                                            @error('product_sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ 'Product SKU is required' }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Content</label>
                                            <textarea type="text" class="form-control ckeditor bg-dark" placeholder="Product Content" name="product_description" value="">
@if (isset($productIdData->product_description))
{{ $productIdData->product_description }}
@endif
</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-secondary rounded p-2 mb-2">
                            <div class="card-header">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title my-1">Product Details</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Product MRP: <span style="color: red;">*</span></label>
                                            <input type="number" min=0 class="form-control required @error('product_price') is-invalid @enderror" placeholder="0" id="product_price_id" onchange="calcprice(this.value)" value="{{ isset($productIdData->product_price) && $productIdData->product_price != '' ? $productIdData->product_price : '' }}" name="product_price" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Product Price <span style="color: red;">*</span></label>
                                            <input type="number" min=0 class="form-control required @error('product_selling_price') is-invalid @enderror" placeholder="0" onchange="calcprice(this.value)" id="product_selling_price_id" value="{{ isset($productIdData->product_selling_price) && $productIdData->product_selling_price != '' ? $productIdData->product_selling_price : '' }}" name="product_selling_price" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Product Discount <span style="color: red;">*</span></label>
                                            <input type="number" min=0 class="form-control required  @error('product_discount') is-invalid @enderror" readonly placeholder="0" id="product_discount_id" value="{{ isset($productIdData->product_discount) && $productIdData->product_discount != '' ? $productIdData->product_discount : '' }}" name="product_discount" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Product Quantity <span style="color: red;">*</span></label>
                                            <input type="number" min=0 class="form-control required  @error('product_moq') is-invalid @enderror" placeholder="0" id="product_moq_id" value="{{ isset($productIdData->product_moq) && $productIdData->product_moq != '' ? $productIdData->product_moq : '' }}" name="product_moq" />
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
                                        <p class="text-muted">Define page meta title, meta keywords and meta description to list your page in search engines</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Product Meta Title: <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control required @error('product_meta_title') is-invalid @enderror" placeholder="Product Meta Title" id="product_meta_title_id" name="product_meta_title" value="@if (isset($productIdData->product_meta_title)) {{ $productIdData->product_meta_title }} @endif" />
                                        @error('product_meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Page Url Address is required' }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Product Meta Keyword: </label>
                                        <input type="text" class="form-control" placeholder="Product Meta Keyword" name="product_meta_keyword" id="product_meta_keyword_id" value="@if (isset($productIdData->product_meta_keyword)) {{ $productIdData->product_meta_keyword }} @endif" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Product Meta Description:</label>
                                        <input type="text" class="form-control" placeholder="Page Meta Desc" value="@if (isset($productIdData->product_meta_desc)) {{ $productIdData->product_meta_desc }}@else{{ '' }} @endif" name="product_meta_desc" id="product_meta_desc_id" placeholder="Product Meta Description"/>
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
                                        <h5 class="card-title my-1">Publish</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center bordered">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <button type="button" id="button" class="btn btn-success" onclick="return checkvalidation($(this));">
                                                @if (isset($productIdData->product_id) && $productIdData->product_id != '') {{ 'Update' }} @else {{ 'Publish' }} @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-secondary rounded p-2 mb-2">
						<div class="card-header">
							<h5>Category</h5> </div>
						<div class="card-body justify-content-sm-center bordered">
                        <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                                <p style="line-height: 20px;"><small class="text-muted">Select category in which you want to display this blog. You can also select multiple categories for this blog.</small></p>
                                                <div style="height: 250px; overflow-x: hidden; border: 1px solid #5d5959; padding: 10px; background: #414141;"> 
                                                @if(count($categoryData)>0)
                                                @php
                                                $strCategory = array();
                                                if(isset($productIdData->product_category_id))
                                                {
                                                    $strCategory = explode(',',$productIdData->product_category_id);
                                                }
                                                $counter=1
                                                @endphp
                                            @foreach($categoryData as $data)
                                            @php $count=$counter++; @endphp
                                            <div class="form-check form-check-inline" style="width: 100%; margin-bottom: 10px;margin-left:0px; cursor:pointer;">
                                            <input class="form-check-input categorychcked" @if(in_array($data->cat_id,$strCategory)) {{'checked="checked"'}} @endif style="cursor:pointer;" type="checkbox" id="inlineCheckbox{{$count}}" value="{{$data->cat_id}}" name="category_id[]">
                                            <label class="form-check-label" style="cursor:pointer;" for="inlineCheckbox{{$count}}">{{$data->cat_name}}</label>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                               <a href="{{route('csadmin.product.category')}}"> <span><i class="ri-add-line me-2"></i></span> Add Category</a>
                            </div>
                            </div>
						</div>
						<!-- <div class="card-footer"> <a href="https://bybv.in/csadmin/category" target="_blank">+ Add New Category</a> </div> -->
					</div>
                        <div class="card bg-secondary rounded p-2 mb-2">
                            <div class="card-header">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title my-1">Product Image</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center bordered">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <div class="">
                                                <img class="fileimg-preview logoimage mediaImage mt-2" src="@if (isset($productIdData->product_image) && $productIdData->product_image != '') {{ env('PRODUCT_IMAGE') }}{{ $productIdData->product_image }} @else {{ env('NO_IMAGE') }} @endif" style="height: 225px; width: 100%; object-fit: contain; border: 1px solid rgba(72, 94, 144, 0.16); cursor:pointer;" onclick="triggerInputClick()">
                                                <div style="width:100%" class="text-center">
                                                    <div class="input-group mb-2 d-none">
                                                        <input type="file" class="form-control " id="imageFile" name="product_image" accept="image/png, image/gif, image/jpeg" onchange="return imageValidation('imageFile')">
                                                    </div>
                                                    <small class="text-muted " style="font-size:11px;">Accepted: gif, png, jpg. Max file size 2Mb</small>
                                                </div>
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
            reader.onload = function(event) {
                $(".mediaImage").attr("src", event.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    function triggerInputClick() {
        // Trigger click event of the hidden input field
        document.getElementById('imageFile').click();
    }
</script>

<script type="text/javascript">
    $("#product_name_id").change(function(e) {
        $.get('{{ route('csadmin.product.checkslug') }}', {
                'title': $(this).val()
            },
            function(data) {
                $('#product_meta_title_id').val(data.metatitle);
            }
        );
    })

    
</script>

<!-- Product Price -->
<script>
    function calcprice(e) {
        var productMrp = parseFloat($('#product_price_id').val());
        var productSelling = parseFloat($('#product_selling_price_id').val());
        var productDiscount = parseFloat($('#product_discount_id').val());
        console.log(productMrp);
        console.log(productSelling);
        console.log(productDiscount);
        if (productSelling === "" ||productSelling == 0) {
            $('#product_discount_id').val('');
            $('#product_selling_price_id').val('');
        } else if (productSelling > productMrp) {
            alert('MRP Must greater than Selling Price')
            $('#product_discount_id').val('');
            $('#product_selling_price_id').val('');
        } else {
            $('#product_discount_id').val(productMrp - productSelling);
            $('#product_selling_price_id').val(productSelling);
        }
    }
</script>
<script>
    function checkvalidation(value) {
        var elementsselect = document.querySelectorAll('.required');
        var counter = 0;
        for (let i = 0; i < elementsselect.length; i++) {
            if (elementsselect[i].value == "") {
                elementsselect[i].style.border = '1px solid red';
                counter++;
            } else {
                elementsselect[i].style.border = '';
            }
        }
        if (counter == 0) {
            $('#formsubmit').submit();
        }
    }
</script>
@endsection

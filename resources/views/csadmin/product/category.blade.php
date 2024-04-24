@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-sm-0">Manage Category</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                <li class="breadcrumb-item active">Manage Category</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <div class="col-lg-4">
                <form method="POST" action="{{ route('csadmin.category.addcategoryprocess') }}" enctype="multipart/form-data"
                    id=formsubmit>
                    @csrf
                    <input type="hidden" name="cat_id"
                        value="{{isset($categoryIdData->cat_id) && $categoryIdData->cat_id != '' ? $categoryIdData->cat_id:0}}">
                    <div class="card bg-secondary rounded p-3">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title my-1">Add Category</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body justify-content-sm-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name: <span style="color: red;">*</span></label>
                                        <input type="text"
                                            class="form-control required @error('cat_name') is-invalid @enderror"
                                            placeholder="Menu Name" onkeyup="pagename(this.value)" id='cat_name_id'
                                            value="{{isset($categoryIdData->cat_name) && $categoryIdData->cat_name != '' ? $categoryIdData->cat_name:''}}"
                                            name="cat_name" />
                                        @error('cat_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Category Name is required and Unique' }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Category Slug: <span style="color: red;">*</span></label>
                                        <input type="text"
                                            class="form-control required @error('cat_slug') is-invalid @enderror" placeholder="slug"
                                            id="cat_slug_id"
                                            value="{{isset($categoryIdData->cat_slug) && $categoryIdData->cat_slug != '' ? $categoryIdData->cat_slug:''}}"
                                            name="cat_slug" />
                                        @error('cat_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Category Slug is required' }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  d-flex justify-content-between">
                            <button type="submit" id='button' class="btn btn-success"
                                onclick="return checkvalidation($(this));">@if (isset($categoryIdData->cat_id) &&
                                $categoryIdData->cat_id != '')
                                {{ 'Update' }}@else{{ 'Save' }}@endif</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-lg-8">
                <div class="card bg-secondary rounded p-2">
                    <div class="card-header">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title my-1">Category</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body justify-content-sm-center">
                        <div class="row align-items-center gy-3">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">S.no.</th>
                                            <th>Category Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($categoryData) > 0)
                                        @php
                                        $counter = 1;
                                        @endphp
                                        @foreach ($categoryData as $value)
                                        <tr>
                                            <th>{{ $counter++ }}</th>
                                            <td>{{$value->cat_name}}</td>

                                            @if($value->cat_status==1)
                                            <td class="text-center"><a
                                                    href="{{route('csadmin.category.categorystatus',$value->cat_id)}}"><span
                                                        class="badge bg-success-subtle text-uppercase">Active</span></a>
                                            </td>
                                            @elseif($value->cat_status==0)
                                            <td class="text-center"><a
                                                    href="{{route('csadmin.category.categorystatus',$value->cat_id)}}"><span
                                                        class="badge bg-danger-subtle text-uppercase">Inactive</span></a>
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{route('csadmin.product.category',$value->cat_id)}}"
                                                    class="btn btn-info btn-sm btnaction"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="{{route('csadmin.category.deletecategory',$value->cat_id)}}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger  btn-sm btnaction"><i
                                                        class="fas fa-trash "></i></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">No Data Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer listing justify-content-sm-center">
                        <p>Sowing 1 of 1</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            function createSlug(str) {
                return str
                    .toLowerCase() // Convert string to lowercase
                    .replace(/[^\w\s-]/g, '') // Remove non-word characters
                    .trim() // Trim leading/trailing whitespace
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/--+/g, '-'); // Replace multiple - with single -
            }

            $('#cat_name_id').change( function (e) {
                const title = $(this).val();
                const slug = createSlug(title);
                $('#cat_slug_id').val(slug);
            });
        });
    </script>


    @endsection
@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-sm-0">Manage Menu</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item active">Manage Menu</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <div class="col-lg-4">
                <form method="POST" action="{{ route('csadmin.appearence.menuprocess') }}" enctype="multipart/form-data"
                    id=formsubmit>
                    @csrf
                    <input type="hidden" name="menu_id"
                        value="{{isset($menuIdData->menu_id) && $menuIdData->menu_id != '' ? $menuIdData->menu_id:0}}">
                    <div class="card bg-secondary rounded p-3">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title my-1">Add Menu</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body justify-content-sm-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Menu Name: <span style="color: red;">*</span></label>
                                        <input type="text"
                                            class="form-control required @error('menu_name') is-invalid @enderror"
                                            placeholder="Menu Name" onkeyup="pagename(this.value)" id='menu_name_id'
                                            value="{{isset($menuIdData->menu_name) && $menuIdData->menu_name != '' ? $menuIdData->menu_name:''}}"
                                            name="menu_name" />
                                        @error('menu_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Site title is required' }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Menu Slug: <span style="color: red;">*</span></label>
                                        <input type="text"
                                            class="form-control required @error('menu_slug') is-invalid @enderror" placeholder="slug"
                                            id="menu_slug_id"
                                            value="{{isset($menuIdData->menu_slug) && $menuIdData->menu_slug != '' ? $menuIdData->menu_slug:''}}"
                                            name="menu_slug" />
                                        @error('menu_slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'Site title is required' }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  d-flex justify-content-between">
                            <button type="submit" id='button' class="btn btn-success"
                                onclick="return checkvalidation($(this));">@if (isset($menuIdData->menu_id) &&
                                $menuIdData->menu_id != '')
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
                                <h5 class="card-title my-1">Menu</h5>
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
                                            <th>Menu Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($menudata) > 0)
                                        @php
                                        $counter = 1;
                                        @endphp
                                        @foreach ($menudata as $value)
                                        <tr>
                                            <th>{{ $counter++ }}</th>
                                            <td>{{$value->menu_name}}</td>

                                            @if($value->menu_status==1)
                                            <td class="text-center"><a
                                                    href="{{route('csadmin.appearence.menustatus',$value->menu_id)}}"><span
                                                        class="badge bg-success-subtle text-uppercase">Active</span></a>
                                            </td>
                                            @elseif($value->menu_status==0)
                                            <td class="text-center"><a
                                                    href="{{route('csadmin.appearence.menustatus',$value->menu_id)}}"><span
                                                        class="badge bg-danger-subtle text-uppercase">Inactive</span></a>
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{route('csadmin.appearence.menu',$value->menu_id)}}"
                                                    class="btn btn-info btn-sm btnaction"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a href="{{route('csadmin.appearence.deletemenu',$value->menu_id)}}"
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

            $('#menu_name_id').change( function (e) {
                const title = $(this).val();
                const slug = createSlug(title);
                $('#menu_slug_id').val(slug);
            });
        });
    </script>


    @endsection
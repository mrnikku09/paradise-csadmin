@extends('csadmin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-sm-0">Manage Pages</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Manage Pages</li>
                                </ol>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('csadmin.page.addpage') }}" class="btn btn-primary"><i
                                    class="ri-add-line me-2"></i>Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            @include('csadmin.elements.message')
            <div class="row">
                <div class="col-12">
                    <div class="card bg-secondary rounded h-100 p-4">
                        <div class="card-header">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title my-1">Pages</h5>
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
                                                <th>Page Name</th>
                                                <th>Page Url</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($pageData) > 0)
                                                @php
                                                    $counter = 1;
                                                @endphp
                                                @foreach ($pageData as $value)
                                                    <tr>
                                                        <th>{{ $counter++ }}</th>
                                                        <td>{{$value->page_name}}</td>

                                                        <td><a href="{{env('WEBSITE_URL')}}{{$value->page_url}}">{{env('WEBSITE_URL')}}{{$value->page_url}}</a></td>
                                                        @if($value->page_status==1)
                                                        <td class="text-center"><a href="{{route('csadmin.page.pagestatus',$value->page_id)}}"><span class="badge bg-success-subtle text-uppercase">Active</span></a>
                                                        </td>
                                                        @elseif($value->page_status==0)
                                                        <td class="text-center"><a href="{{route('csadmin.page.pagestatus',$value->page_id)}}"><span class="badge bg-danger-subtle text-uppercase">Inactive</span></a></td>
                                                        @endif
                                                        <td class="text-center">
                                                            <a href="{{route('csadmin.page.addpage',$value->page_id)}}" class="btn btn-info btn-sm btnaction"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <a href="{{route('csadmin.page.deletepage',$value->page_id)}}"
                                                                onclick="return confirm('Are you sure you want to delete?')"
                                                                class="btn btn-danger  btn-sm btnaction"><i
                                                                    class="fas fa-trash "></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                            @else
                                                <tr>No Data Found</tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

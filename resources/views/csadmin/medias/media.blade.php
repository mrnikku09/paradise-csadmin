@extends('csadmin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-sm-0">Manage Media</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Media</a></li>
                                    <li class="breadcrumb-item active">Manage Media</li>
                                </ol>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('csadmin.addmedia') }}" class="btn btn-primary"><i
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
                                    <h5 class="card-title my-1">Media</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body justify-content-sm-center">
                            <div class="row align-items-center gy-3">
                                <div class="col-lg-12">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:60px">S.no.</th>
                                                <th>Media Image</th>
                                                <th>Media Url</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($mediaIdData) > 0)
                                                @php
                                                    $counter = 1;
                                                @endphp
                                                @foreach ($mediaIdData as $value)
                                                    <tr>
                                                        <th>{{ $counter++ }}</th>
                                                        <td>
                                                            <img style="object-fit:cover;width:50px ;height:50px" src="@if(isset($value->media) && $value->media != ''){{env('MEDIA_IMAGE')}}{{$value->media}} @else {{env('NO_IMAGE')}} @endif" alt="">
                                                        </td>

                                                        <td><a href="{{env('WEBSITE_URL')}}{{$value->media}}">{{env('WEBSITE_URL')}}{{$value->media}}</a></td>
                                                        
                                                        <td class="text-center">
                                                            <a href="{{route('csadmin.addmedia',$value->media_id)}}" class="btn btn-info btn-sm btnaction"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <a href="{{route('csadmin.deletemedia',$value->media_id)}}"
                                                                onclick="return confirm('Are you sure you want to delete?')"
                                                                class="btn btn-danger  btn-sm btnaction"><i
                                                                    class="fas fa-trash "></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                @endforeach
                                            @else
                                                <tr><td class="text-center" colspan="4"> No Data Found</td></tr>
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

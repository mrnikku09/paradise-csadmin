@extends('csadmin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-sm-0">Manage Our Team</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Our Team</a></li>
                                    <li class="breadcrumb-item active">Manage Our Team</li>
                                </ol>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('csadmin.ourteam.addteam') }}" class="btn btn-primary"><i
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
                                    <h5 class="card-title my-1">Our Team</h5>
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
                                                <th>Team Image</th>
                                                <th>Team Name</th>
                                                <th>Team Designation</th>
                                                <th style="text-align:center">Featured</th>
                                                <th style="text-align:center">Status</th>

                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($teamIdData) > 0)
                                                @php
                                                    $counter = 1;
                                                @endphp
                                                @foreach ($teamIdData as $value)
                                                    <tr>
                                                        <th>{{ $counter++ }}</th>
                                                        <td>
                                                            <img style="object-fit:cover;width:50px ;height:50px" src="@if(isset($value->team_image) && $value->team_image != ''){{env('OURTEAM_IMAGE')}}{{$value->team_image}} @else {{env('NO_IMAGE')}} @endif" alt="">
                                                        </td>

                                                        <td >{{$value->team_name}}</td>
                                                        <td >{{$value->team_designation}}</td>
                                                        <td style="text-align: center;">
                                                                    @if (isset($value->team_featured) && $value->team_featured == 1)
                                                                    <a href="{{ route('csadmin.ourteam.teamfeatured', $value->team_id) }}">
                                                                    <i class="fas fa-star"></i>
                                                                    </a>
                                                                    @else
                                                                    <a href="{{ route('csadmin.ourteam.teamfeatured', $value->team_id) }}">
                                                                    <i class="far fa-star"></i>
                                                                    </a>
                                                                    @endif
                                                                </td>
                                                                @if($value->team_status==1)
                                                        <td class="text-center"><a href="{{route('csadmin.ourteam.statusteam',$value->team_id)}}"><span class="badge bg-success-subtle text-uppercase">Active</span></a>
                                                        </td>
                                                        @elseif($value->team_status==0)
                                                        <td class="text-center"><a href="{{route('csadmin.ourteam.statusteam',$value->team_id)}}"><span class="badge bg-danger-subtle text-uppercase">Inactive</span></a></td>
                                                        @endif
                                                        <td class="text-center">
                                                            <a href="{{route('csadmin.ourteam.addteam',$value->team_id)}}" class="btn btn-info btn-sm btnaction"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <a href="{{route('csadmin.ourteam.deleteteam',$value->team_id)}}"
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

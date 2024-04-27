@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-sm-0">Manage NewsLetter</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">NewsLetter</a></li>
                                <li class="breadcrumb-item active">Manage NewsLetter</li>
                            </ol>
                        </div>
                    </div>
                    <div>
                        
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
                                <h5 class="card-title my-1">NewsLetter</h5>
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
                                            <th> Email</th>
                                            <th class="text-center"> Created At</th>

                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($newsLetterData) > 0)
                                        @php
                                        $counter = 1;
                                        @endphp
                                        @foreach ($newsLetterData as $value)
                                        <tr>
                                            <th>{{ $counter++ }}</th>
                                            

                                            <td>{{$value->newsletter_email}}</td>
                                            <td style="text-align: center;">{{date('d-m-Y',strtotime($value->created_at))}}<br><span style="font-size:11px">{{date("h:i:s A",strtotime($value->created_at))}}</span></td>

                                            <td class="text-center">
                                                
                                                <a href="{{route('csadmin.newsletter.newsletterdelete',$value->newsletter_id)}}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger  btn-sm btnaction"><i
                                                        class="fas fa-trash "></i></a>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="4"> No Data Found</td>
                                        </tr>
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
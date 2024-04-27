@extends('csadmin.layouts.master')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-lg-12">
                <h5>Good Morning {{$settingData->admin_name}}</h5>
                <p>Here's what's happening with your store today.
                </p>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection

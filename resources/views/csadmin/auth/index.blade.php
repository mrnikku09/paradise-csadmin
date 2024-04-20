@extends('csadmin.layouts.login')
@section('content')
    @php
        $settingData = App\Models\CsThemeAdmin::first();
    @endphp

    
    @include('csadmin.elements.message')
    <form class="needs-validation" novalidate action="{{ route('adminlogincheck') }}" method="post" id="loginformSubmit">
        @csrf
    <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <img class="rounded-circle" src="{{env('SETTING_IMAGE')}}{{$settingData->logo }}" alt=""
                            style="width: 75px; height: 75px;">
                            <h3>Paradise</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email"  name="admin_email" class="form-control required @error('admin_email') is-invalid @enderror" id="useremail" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                            @error('admin_email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                        </div>
                        <div class="form-floating mb-3 ">
                            <input type="password" class="form-control pe-5 password required @error('admin_password') is-invalid @enderror" name="admin_password" id="password-input" placeholder="Password">
                            <label for="floatingPassword">Password</label>

                            @error('admin_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--<div class="form-check mb-3" >-->
                        <!--      <input style="cursor:pointer;" class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="passwordshow($(this))">-->
                        <!--      <label style="cursor:pointer;" class="form-check-label" for="flexCheckDefault" >-->
                        <!--        Show Password-->
                        <!--      </label>-->
                        <!--    </div>-->
                        
                        <button type="submit" class="btn btn-success py-3 w-100 mb-4" onclick="return submitLoginForm();">Sign In</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    
    <script type="text/javascript">
        function passwordshow(event) {
            var password = document.getElementsByClassName("password");
            
                        console.log(password);

        }
    
        function submitLoginForm() {
            var counter = 0;
            var myElements = document.getElementsByClassName("required");
            for (var i = 0; i < myElements.length; i++) {
                if (myElements[i].value == '') {
                    myElements[i].style.border = '1px solid red';
                    counter++;
                    return false;
                } else {
                    myElements[i].style.border = '';
                }
            }
            if (counter == 0) {
                console.log('res');
                $('#loginformSubmit').submit();
            }
        }
    </script>
@endsection

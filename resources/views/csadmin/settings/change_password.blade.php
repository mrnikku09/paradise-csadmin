@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
               <h4 class="mb-sm-0">Change Password</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                     <li class="breadcrumb-item active">Change Password</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      @include('csadmin.elements.message')
      <div class="row">
         <div class="col-12">
            <form method="post" action="{{route('csadmin.setting.changepasswordprocess')}}">
               @csrf
               <div class="card">
                  <div class="card-header">
                     <div class="row align-items-center gy-3">
                        <div class="col-sm">
                           <h5 class="card-title mb-0">Change Password</h5>
                        </div> 
                     </div>
                  </div>  
                  <div class="card-body">
                     <div class="row gx-3">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label>Password: <span style="color:red;">*</span></label>
                              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="***********" autocomplete="current-password">
                              @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label>Confirm Password: <span style="color:red;">*</span></label>
                              <input type="password" class="form-control @error('password') is-invalid @enderror" name="confirm_password" placeholder="***********" autocomplete="current-password">
                              @error('confirm_password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary me-2">Save & Continue</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
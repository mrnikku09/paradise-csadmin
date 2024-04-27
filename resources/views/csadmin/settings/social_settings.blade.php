@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">                    
					<div>
                        <h4 class="mb-1">Manage Social Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                <li class="breadcrumb-item active">Manage Social Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <div class="col-12">
				<div class="card bg-dark">
					<div class="card-header">
						<div class="row align-items-center gy-3">
							<div class="col-sm">
								<h5 class="card-title my-1">Social Setting</h5>
							</div> 
						</div>
					</div>  
					<form method="post" action="{{route('csadmin.settings.socialsettingprocess')}}">
						@csrf
						<div class="card-body justify-content-sm-center">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Facebook Url:</label>
										<input type="text" class="form-control" name="facebook_url" value="{{$settingData->facebook_url}}">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Instagram Url:</label>
										<input type="text" class="form-control" name="instagram_url" value="{{$settingData->instagram_url}}">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Twitter Url:</label>
										<input type="text" class="form-control" name="twitter_url" value="{{$settingData->twitter_url}}">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Youtube Url:</label>
										<input type="text" class="form-control" name="youtube_url" value="{{$settingData->youtube_url}}">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">LinkedIn Url:</label>
										<input type="text" class="form-control" name="linkedin_url" value="{{$settingData->linkedin_url}}">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer bg-dark d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
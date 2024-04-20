@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex justify-content-between align-items-center">
<div>
<h4 class="mb-sm-0">Add Footer</h4>
<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="javascript: void(0);">Footer</a></li>
<li class="breadcrumb-item active">Add Footer</li>
</ol>
</div>
</div>
</div>
</div>
</div>
@include('csadmin.elements.message')
<div class="row">
<form method="POST" action="{{ route('csadmin.appearance.footerProcess') }}" enctype="multipart/form-data"
id=formsubmit>
@csrf
<input type="hidden" name="footer_id"
value="{{isset($footerIdData->footer_id) && $footerIdData->footer_id != '' ? $footerIdData->footer_id:0}}">
<div class="card bg-secondary rounded p-2">
<div class="card-header">
<div class="row align-items-center gy-3">
<div class="col-sm">
<h5 class="card-title my-1">Add Footer</h5>
</div>
</div>
</div>
<div class="card-body justify-content-sm-center">
<div class="row">
<div class="col-lg-12">
<div class="mb-3">
<label class="form-label">Footer 1</label>
<textarea type="email" class="form-control ckeditor bg-dark"
placeholder="Footer 1" name="footer_desc1" value="">
@if (isset($footerIdData->footer_desc1))
{{ $footerIdData->footer_desc1 }}
@endif
</textarea>
</div>
</div>
</div>
</div>

<div class="card-body justify-content-sm-center">
<div class="row">
<div class="col-lg-12">
<div class="mb-3">
<label class="form-label">Footer 2</label>
<textarea type="email" class="form-control ckeditor bg-dark"
placeholder="Footer 1" name="footer_desc2" value="">
@if (isset($footerIdData->footer_desc2))
{{ $footerIdData->footer_desc2 }}
@endif
</textarea>
</div>
</div>
</div>
</div>

<div class="card-body justify-content-sm-center">
<div class="row">
<div class="col-lg-12">
<div class="mb-3">
<label class="form-label">Footer 3</label>
<textarea type="email" class="form-control ckeditor bg-dark"
placeholder="Footer 1" name="footer_desc3" value="">
@if (isset($footerIdData->footer_desc3))
{{ $footerIdData->footer_desc3 }}
@endif
</textarea>
</div>
</div>
</div>
</div>

<div class="card-body justify-content-sm-center">
<div class="row">
<div class="col-lg-12">
<div class="mb-3">
<label class="form-label">Footer 4</label>
<textarea type="email" class="form-control ckeditor bg-dark"
placeholder="Footer 1" name="footer_desc4" value="">
@if (isset($footerIdData->footer_desc4))
{{ $footerIdData->footer_desc4 }}
@endif
</textarea>
</div>
</div>

</div>
</div>

<div class="card-footer  d-flex justify-content-between">
<button type="submit" id='button' class="btn btn-success">@if (isset($footerIdData->footer_id) && $footerIdData->footer_id != '')
{{ 'Update' }}@else{{ 'Save' }}
@endif</button>
</div>
</div>


</form>
</div>
</div>


@endsection
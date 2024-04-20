@extends('csadmin.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-sm-0">Add FAQ</h5>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">FAQ</a></li>
                                <li class="breadcrumb-item active">Add FAQ</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('csadmin.elements.message')
        <div class="row">
            <form method="POST" action="{{ route('csadmin.faq.faqProcess') }}" enctype="multipart/form-data"
                id="formsubmit">
                @csrf
                <input type="hidden" name="faq_id"
                    value="{{isset($faqIdData->faq_id)&& $faqIdData->faq_id != '' ?$faqIdData->faq_id:0}}">
                <div class="row g-2">
                    <div class="col-lg-12">
                        <div class="card bg-secondary rounded p-2 mb-2">
                            <div class="card-header">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <h5 class="card-title my-1">Add FAQ</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body justify-content-sm-center">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Faq Name : <span
                                                    style="color: red;">*</span></label>
                                            <input type="text" class="form-control @error('faq_title') is-invalid @enderror" placeholder="Faq Title"
                                                id="faq_title_id" name="faq_title"
                                                value="{{ isset($faqIdData->faq_title) && $faqIdData->faq_title != '' ? $faqIdData->faq_title : '' }}" />
                                                @error('faq_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Faq Description : </label>
                                            <textarea type="text" class="form-control ckeditor @error('faq_description') is-invalid @enderror"
                                                placeholder="Faq Description" id="faq_description_id"
                                                name="faq_description"
                                                value="">{{ isset($faqIdData->faq_description) && $faqIdData->faq_description != '' ? $faqIdData->faq_description : '' }}</textarea>
                                                @error('faq_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-sm-center bordered">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <button type="submit" id="button" class="btn btn-success">
                                                @if(isset($faqIdData->faq_id)&& $faqIdData->faq_id !=
                                                ''){{'Update'}}@else{{'Save'}}@endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
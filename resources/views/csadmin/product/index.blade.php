@extends('csadmin.layouts.master')
@section('content')
<div class="page-content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
               <div>
                  <h5 class="mb-sm-0">Manage Product</h5>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                     </ol>
                  </div>
               </div>
               <div>
                  <a href="{{ route('csadmin.product.addproduct') }}" class="btn btn-primary"><i
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
                        <h5 class="card-title my-1">Product</h5>
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
                                 <th style="width:170px">Product Image</th>
                                 <th>Product Name</th>
                                 <th style="text-align:center">Featured</th>
                                 <th class="text-center">Status</th>
                                 <th class="text-center">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if (count($productData) > 0)
                              @php
                              $counter = 1;
                              @endphp
                              @foreach ($productData as $value)
                              <tr>
                                 <td>{{$counter++}}</td>

                                 <td><img style="object-fit:cover;width:50px ;height:50px"
                                       src="@if(isset($value->product_image) && $value->product_image != ''){{env('PRODUCT_IMAGE')}}{{$value->product_image}} @else {{env('NO_IMAGE')}} @endif"
                                       alt=""></td>
                                 <td>{{$value->product_name}}</td>
                                 <td style="text-align: center;">
                                    @if (isset($value->product_featured) && $value->product_featured == 1)
                                    <a href="{{ route('csadmin.product.checkfeatured', $value->product_id) }}">
                                       <i class="fas fa-star"></i>
                                    </a>
                                    @else
                                    <a href="{{ route('csadmin.product.checkfeatured', $value->product_id) }}">
                                       <i class="far fa-star"></i>
                                    </a>
                                    @endif
                                 </td>
                                 @if($value->product_status==1)
                                 <td class="text-center"><a
                                       href="{{route('csadmin.product.productstatus',$value->product_id)}}"><span
                                          class="badge bg-success-subtle text-uppercase">Active</span></a>
                                 </td>
                                 @elseif($value->product_status==0)
                                 <td class="text-center"><a
                                       href="{{route('csadmin.product.productstatus',$value->product_id)}}"><span
                                          class="badge bg-danger-subtle text-uppercase">Inactive</span></a>
                                 </td>
                                 @endif
                                 <td class="text-center">
                                    <a href="{{route('csadmin.product.addproduct',$value->product_id)}}"
                                       class="btn btn-info btn-sm btnaction"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{route('csadmin.product.deleteproduct',$value->product_id)}}"
                                       onclick="return confirm('Are you sure you want to delete?')"
                                       class="btn btn-danger  btn-sm btnaction"><i class="fas fa-trash "></i></a>
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td colspan="8" class="text-center"> No Data Found</td>
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
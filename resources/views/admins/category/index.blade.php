@extends('admins._layouts.master')
@section('title','Devmaster Laravel Project Tutorial')

@section('body-content')
<!--begin::App Content Header-->
<div class="app-content-header"> 
    <!--begin::Container-->
    <div class="container-fluid"> 
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Danh sách loại sản phẩm</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Category
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> 
<!--end::App Content Header--> 
<!--begin::App Content-->
<div class="app-content"> 
    <!--begin::Container-->
    <div class="container-fluid"> 
        <div class="card">
            <div class="card-header">
                <a href="{{route('category.create')}}" class="btn btn-primary my-0">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="container-fluid"> 
                    @include('admins.category.list')
                </div> 
            </div>
        </div>
    </div> <!--end::Container-->    
</div><!--end::App Content-->  
@endsection

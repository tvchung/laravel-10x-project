@extends('admins._layouts.master')
@section('title','Devmaster Laravel Project Tutorial')

@section('body-content')
    <!--begin::App Content Header-->
    <div class="container-fluid py-2"> <!--begin::Row-->
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Danh sách quản trị viên</h3>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Admins
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
        <div class="row">
            @include('admins.admins.main')    
        </div>
    </div> <!--end::Container-->
    <!--end::App Content Header--> 
@endsection

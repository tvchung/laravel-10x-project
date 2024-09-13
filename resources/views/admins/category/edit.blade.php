@extends('admins._layouts.master')
@section('title', 'Thêm mới danh mục loại sản phẩm')

@section('body-content')
<!--begin::App Content Header-->
<div class="app-content-header"> 
    <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"></h3>
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
    <div class="container-fluid">
        <!--begin::Form-->
        <form action="{{route('category.editSubmit',[$id])}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$id}}">
            @csrf
            <div class="card card-outline">
                <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="mb-0">Sửa thông danh mục loại sản phẩm - Mã: <strong class="text-danger">{{$id}}</strong></h4>
                    </div>
                </div> 
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="NAME" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NAME" name="NAME" 
                                        value="{{$data->NAME}}"
                                        onkeyup="fn_ChangeTitleToSlug(this.value)" >
                                    @error('NAME')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="SLUG" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="SLUG" name="SLUG" 
                                        value="{{$data->SLUG}}"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ICON" class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="ICON" name="fileICON">
                                    @error('ICON')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <img src="{{$data->ICON}}" alt="{{$data->NAME}}" style="width:3.5rem">
                                    <input type="hidden" name="ICON" value="{{$data->ICON}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="IDPARENT" class="col-sm-2 col-form-label">IDPARENT</label>
                                <div class="col-sm-10">
                                    <select name="IDPARENT" id="IDPARENT"  class="form-select" value={{$data->IDPARENT}}>
                                        <option value="null">---Choose---</option>
                                    </select>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Active</legend>
                                <div class="col-sm-10">
                                    @if ($data->ISACTIVE==1)
                                        <div class="form-check"> 
                                            <input class="form-check-input" type="radio" name="ISACTIVE" 
                                                id="gridISACTIVE1" value="1" checked> 
                                            <label class="form-check-label" for="gridISACTIVE1">
                                                Active
                                            </label> 
                                        </div>
                                        <div class="form-check"> 
                                            <input class="form-check-input" type="radio" name="ISACTIVE" 
                                                    id="gridISACTIVE2" value="0"> 
                                            <label class="form-check-label" for="gridISACTIVE2">
                                            Hide
                                            </label> 
                                        </div>
                                    @else
                                        <div class="form-check"> 
                                            <input class="form-check-input" type="radio" name="ISACTIVE" 
                                                id="gridISACTIVE1" value="1" > 
                                            <label class="form-check-label" for="gridISACTIVE1">
                                                Active
                                            </label> 
                                        </div>
                                        <div class="form-check"> 
                                            <input class="form-check-input" type="radio" name="ISACTIVE" 
                                                    id="gridISACTIVE2" value="0" checked> 
                                            <label class="form-check-label" for="gridISACTIVE2">
                                            Hide
                                            </label> 
                                        </div>
                                    @endif
                                    
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="META_TITLE" class="col-sm-2 col-form-label">META TITLE</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="META_TITLE" 
                                        value="{{$data->META_TITLE}}"
                                        name="META_TITLE">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="META_KEYWORD" class="col-sm-2 col-form-label">META KEYWORD</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="META_KEYWORD" 
                                        value="{{$data->META_KEYWORD}}"
                                        name="META_KEYWORD">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="META_DESCRIPTION" class="col-sm-2 col-form-label">META DESCRIPTION</label>
                                <div class="col-sm-10">
                                    <textarea name="META_DESCRIPTION" id="META_DESCRIPTION"  rows="3" class="form-control">{{$data->META_DESCRIPTION}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--end::Body--> 
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ghi lại</button>
                    <a href="{{route('category.index')}}" class="btn btn-secondary" type="button">Bỏ qua</a>
                </div>
                <!--end::Footer-->
            </div>
            <!--end::card-->
        </form> 
        <!--end::Form-->
    </div>
</div> 
<!--end::App Content-->
    <script>
        const fn_ChangeTitleToSlug = (title)=>{
            let slug = fn_TitleToSlug(title);
            $('#SLUG').val(slug);
        }
        // fn_ChangeTitleToSlug("Chuyển tiếng Việt thành slug không dấu");
    </script>
@endsection

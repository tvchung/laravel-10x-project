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
                <h3 class="mb-0">Nhóm tin tức</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('newsgroup.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        News Group
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
                <a href="#" class="btn btn-primary my-0" 
                        data-bs-toggle="modal"
                        data-bs-target="#newsgroupModal">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="container-fluid"> 
                    @include('admins.newsgroup.list')
                </div> 
            </div>
        </div>
    </div> <!--end::Container-->    
</div><!--end::App Content-->  


<!-- Modal: Add/Edit -->
<div class="modal fade" id="newsgroupModal" 
        data-bs-backdrop="static"
        data-bs-keyboard="false" 
        tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="frmAddOrEdit" method="post" enctype="multipart/form-data" action="{{route('newsgroup.createSubmit')}}">
            @csrf
            <input type="hidden" name="id" value="0">
            <div class="modal-header">
            <h5 class="modal-title" id="newsgroupModalLabel">Thêm mới nhóm tin tức</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">Name</span>
                    <input type="text" class="form-control" id="NAME" name="NAME" 
                                aria-label="NAME" aria-describedby="NAME"
                                    onkeyup="fn_ChangeTitleToSlug(this.value)">
                    <span class="text-danger">(*)</span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Slug</span>
                    <input type="text" class="form-control" id="SLUG" name="SLUG" 
                                aria-label="SLUG" aria-describedby="SLUG" readonly/>
                            <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Icon</span>
                    <input type="file" class="form-control" id="fileICON" name="fileICON" 
                                aria-label="fileICON" aria-describedby="fileICON"/>
                            <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">IdParent</span>
                    <select class="form-control" id="IDPARENT" name="IDPARENT" 
                        aria-label="IDPARENT" aria-describedby="IDPARENT">
                        <option value="null">---Choose---</option>
                    </select>
                            <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" >Meta title</span>
                    <input type="text" class="form-control" id="META_TITLE" name="META_TITLE" 
                                aria-label="META_TITLE" aria-describedby="META_TITLE"/>
                            <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" >Meta <br/>keyword</span>
                    <textarea name="META_KEYWORD" id="META_KEYWORD"  rows="2" class="form-control"></textarea>
                        <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" >Meta <br/>Description</span>
                    <textarea name="META_DESCRIPTION" id="META_DESCRIPTION"  rows="3" class="form-control"></textarea>
                        <span class="text-danger"></span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Active</span>
                    <div class="d-flex align-items-center mx-3 ">
                        <div class="form-check mx-1"> 
                            <input class="form-check-input" type="radio" name="ISACTIVE" id="rdISACTIVE1" value="1" > 
                            <label class="form-check-label" for="rdISACTIVE1">
                                Active
                            </label> 
                        </div>
                        <div class="form-check mx-1"> 
                            <input class="form-check-input" type="radio" name="ISACTIVE" id="rdISACTIVE2" value="0"> 
                            <label class="form-check-label" for="rdISACTIVE2">
                                Hide
                            </label> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" id="btnSumit">Ghi lại</button>
            </div>
            <div hidden>
                <input type="hidden" name="updated_at"  id="updated_at" value="">
                <input type="hidden" name="UPDATED_BY"   id="UPDATED_BY" value="">
                <input type="hidden" name="ICON"  id="ICON">
            </div>
        </form>
      </div>
    </div>
  </div>

  
@endsection

@section('Scripts')
    <script>
        const fn_ChangeTitleToSlug = (title)=>{
            let slug = fn_TitleToSlug(title);
            $('#SLUG').val(slug);
        }
        // Submit
        $("#btnSumit").click(function(e){
            e.preventDefault();
            var form_data = new FormData($('#frmAddOrEdit')[0]); // this method will send the file request and the post data 
            form_data.append("_token","{{csrf_token()}}") //for csrf token

            $.ajax({
                data: form_data,
                url: "{{ route('newsgroup.createSubmit') }}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log("data",data);
                    fillAddToList(data);
                    $("button[type='submit']").attr('data-bs-dismiss','modal');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#btnSumit').html('Error');
                }
            });
        });
        const fillAddToList = (data)=>{
            let row = `
                    <tr class="align-middle">
                        <td   class="text-center">${data.id}</td>
                        <td   class="text-center">${data.id}</td>
                        <td>${data.NAME}</td>
                        <td>${data.SLUG}</td>
                        <td>
                            <img src="${data.ICON}" alt="${data.NAME}" style="width:3rem" class="rounded-circle"> 
                        </td>
                        <td>${data.UPDATED_BY} : {{Auth::guard('admin')->user()->name}}</td>
                        <td>${data.updated_at}</td>
                        <td class="text-center">
                            ${data.ISACTIVE=='1'?'<span class="badge rounded-pill bg-success">Hiện</span>':'<span class="badge rounded-pill bg-warning text-dark">Ẩn</span>'}
                        </td>
                        <td class="action">
                           <div class="d-flex justify-content-between align-items-center mx-3">   
                                <a href="javascript:void(0)" title="Xem chi tiết">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="javascript:void(0)" title="Sửa thông tin"  onclick="fn_Edit(${data.id})" >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="javascript:void(0)" title="Xóa danh mục">
                                    <i class="fa-sharp fa-regular fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            $('#tblNewsGroup tbody ').append(row);
        }
    </script>
    <script>
        function fn_Edit(id){
            $.get('news-group/edit/'+id,function(data){
                console.log(data);
                
                $('#id').val(data.id);
                $('#NAME').val(data.NAME);
                $('#SLUG').val(data.SLUG);
                $('#IDPARENT').val(data.IDPARENT);
                $('#META_TITLE').val(data.META_TITLE);
                $('#META_KEYWORD').val(data.META_KEYWORD);
                $('#META_DESCRIPTION').val(data.META_DESCRIPTION);
                $('#ICON').val(data.ICON);
                $('#updated_at').val(data.updated_at);
                $('#UPDATED_BY').val(data.UPDATED_BY);
                $('#ISACTIVE').val(data.ISACTIVE);
                if(data.ISACTIVE == "1"){
                    $('#rdISACTIVE1').prop('checked',true);
                    $('#rdISACTIVE2').prop('checked',false);
                }else{
                    $('#rdISACTIVE1').prop('checked',false);
                    $('#rdISACTIVE2').prop('checked',true);
                }
                $('#newsgroupModal').modal('toggle');
            })
        }
    </script>
@endsection 
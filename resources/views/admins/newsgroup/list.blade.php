<div class="row">
    <div class="col-md-12 ">
        <table class="table table-bordered" id="tblNewsGroup">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Mã nhóm</th>
                    <th>Tên nhóm</th>
                    <th>Slug</th>
                    <th>Hình ảnh</th>
                    <th>Người cập nhật</th>
                    <th>Ngày cập nhật</th>
                    <th style="width: 100px">Trạng thái</th>
                    <th style="width: 120px" class="text-center">
                        <i class="far fa-list-alt"></i>
                        Chức năng
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                   $num=0;  
                @endphp
                @foreach ($datas as $item)
                    @php
                        $num++;
                    @endphp
                    <tr class="align-middle">
                        <td style="width:3rem" class="text-center">{{$num}}</td>
                        <td style="width:3rem" class="text-center">{{$item->id}}</td>
                        <td>{{$item->NAME}}</td>
                        <td>{{$item->SLUG}}</td>
                        <td>
                            <img src="{{$item->ICON}}" alt="{{$item->NAME}}" style="width:3rem"> 
                        </td>
                        <td>{{$item->UPDATED_BY}}:{{$item->name}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            {{$item->ISACTIVE==1?'Hiện':'Ẩn'}}
                        </td>
                        <td class="action">
                            <div class="d-flex justify-content-between align-items-center mx-3">   
                                <a href="{{route('newsgroup.detail',[$item->id])}}" title="Xem chi tiết">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{route('newsgroup.edit',[$item->id])}}" title="Sửa thông tin">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="{{route('newsgroup.detail',[$item->id])}}" title="Xóa danh mục">
                                    <i class="fa-sharp fa-regular fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div> <!--end::Row-->


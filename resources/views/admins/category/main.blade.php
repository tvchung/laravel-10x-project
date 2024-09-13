<div class="row">
    <div class="col-md-12 ">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Icon</th>
                    <th>Content</th>
                    <th>Update By</th>
                    <th>Update at</th>
                    <th style="width: 40px">Status</th>
                    <th style="width: 100px" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                   $num=0;  
                @endphp
                @foreach ($data as $item)
                    @php
                        $num++;
                    @endphp
                    <tr class="align-middle">
                        <td style="width:3rem" class="text-center">{{$num}}</td>
                        <td>{{$item->NAME}}</td>
                        <td>{{$item->SLUG}}</td>
                        <td><img src="{{$item->ICON}}" alt="{{$item->NAME}}" style="width:3rem"> </td>
                        <td>{{$item->UPDATED_BY}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>{{$item->ISACTIVE}}</td>
                        <td>{{''}}</td>
                        <td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div> <!--end::Row-->

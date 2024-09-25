<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Newsgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsGroupController extends Controller
{
    public function index()
    {
        $datas = Newsgroup::all();
        $list=DB::table('newsgroup')
                    ->join('admins', 'admins.id', '=', 'newsgroup.updated_by')
                    ->select('newsgroup.*', 'admins.name')
                    ->get();
        // echo "<pre>";
        // print_r($list);
        // die;
        return view('admins.newsgroup.index',['datas'=>$list]);
    }
    //detail
    public function detail($id)
    {
        // $data = newsgroup::where('id',$id);
        $data = Newsgroup::find($id);
        $list=DB::table('newsgroup')->where('id',$id)
                    ->join('admins', 'admins.id', '=', 'newsgroup.updated_by')
                    ->select('newsgroup.*', 'admins.name')
                    ->get();
        // return view('admins.newsgroup.detail',['data'=>$list,'id'=>$id]);
        return response()->json($list);
    }
    // Get: create
    public function create()
    {

        return view('admins.newsgroup.create');
    }
    // Post: createSubmit
    public function createSubmit(Request $request)
    {
        // validation form
        // $validations = $request->validate([
        //     'NAME'=>'required|unique:newsgroup',
        //     'SLUG'=>'required|unique:newsgroup',
        //     'ICON'=>'required'
        //     ]
        //     ,[
        //         'NAME.required'=>'Tên loại danh mục không để trống',
        //         'NAME.unique'=>'Tên loại danh mục không trùng nhau',
        //         'SLUG.required'=>'SLUG không được để trống',
        //         'SLUG.unique'=>'SLUGkhông trùng nhau',
        //         'ICON.required'=>'Chọn ảnh đại diện loại danh mục tin tức'
        //     ]
        // );
        // $validator = Validator::make($request->all(), [
        //     'NAME'=>'required|unique:newsgroup',
        //     'SLUG'=>'required|unique:newsgroup',
        //     'ICON'=>'required'
        // ],
        // [
        //     'NAME.required'=>'Tên loại danh mục không để trống',
        //     'NAME.unique'=>'Tên loại danh mục không trùng nhau',
        //     'SLUG.required'=>'SLUG không được để trống',
        //     'SLUG.unique'=>'SLUGkhông trùng nhau',
        //     'ICON.required'=>'Chọn ảnh đại diện loại danh mục tin tức'
        // ]);
        // if($validator->fails()){
        //     return response()->json($validator);
        // }
        // Upload file
        $image_path = 'images\\newsgroup\\';
        $imageFileName="";
        $icon="";
        if($request->hasFile('fileICON')){
            $image_tmp = $request->file('fileICON');
            if($image_tmp->isValid()){
                // get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Tạo tên file image
                $image_id_image = rand(11111,99999);
                $imageFileName = $request->NAME .'-' . $image_id_image .'.' .$extension; // tên file sẽ lưu trên server
                $image_tmp->move($image_path,$imageFileName);
                $icon='/images/newsgroup/'.$imageFileName;
            }else if(!empty($request->fileICON)){
                $imageFileName = $request->fileICON;
                $icon='/images/newsgroup/'.$imageFileName;
            }else{
                $imageFileName = "";
            }
        }
        if(!empty($request->ICON)){
            $icon = $request->ICON;
        }
        // tạo đối tượng thêm mới
        $newsgroup = new Newsgroup;
        $newsgroup->NAME = $request->NAME;
        $newsgroup->ICON = $icon;
        $newsgroup->NOTES = $request->NOTES;
        $newsgroup->SLUG = $request->SLUG;
        $newsgroup->META_TITLE = $request->META_TITLE;
        $newsgroup->META_KEYWORD = $request->META_KEYWORD;
        $newsgroup->META_DESCRIPTION = $request->META_DESCRIPTION;
        $newsgroup->ISDELETE = 0;

        $newsgroup->ISACTIVE = $request->ISACTIVE;
        $newsgroup->created_at=date('Y-m-d H:i:s');
        $newsgroup->updated_at=date('Y-m-d H:i:s');
        $newsgroup->CREATED_BY=Auth::guard('admin')->user()->id;
        $newsgroup->UPDATED_BY=Auth::guard('admin')->user()->id;

        // ghi vào db
        $newsgroup->save();

        // return redirect('/admins/news-group');
        return response()->json($request->all());
    }

    //GET: edit
    public function edit($id)
    {
        $data = Newsgroup::find($id);
        return response()->json($data);
        // return view('admins.newsgroup.edit',['data'=>$data,'id'=>$id]);
    }
    //POST:editSubmit
    public function editSubmit(Request $request)
    {
        // Upload file
        $image_path = 'images\\newsgroup\\';
        $imageFileName="";
        $icon=$request->ICON;
        if($request->hasFile('fileICON')){
            $image_tmp = $request->file('fileICON');
            if($image_tmp->isValid()){
                // get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Tạo tên file image
                $image_id_image = rand(11111,99999);
                $imageFileName = $request->NAME .'-' . $image_id_image .'.' .$extension; // tên file sẽ lưu trên server
                $image_tmp->move($image_path,$imageFileName);
                $icon='/images/newsgroup/'.$imageFileName;
            }else if(!empty($request->ICON)){
                $imageFileName = $request->ICON;
                $icon='/images/newsgroup/'.$imageFileName;
            }else{
                $imageFileName = "";
            }
        }
        // Cập nhật thông tin
        $newsgroup = Newsgroup::find($request->id);
        $newsgroup->NAME = $request->NAME;
        $newsgroup->ICON = $icon;
        $newsgroup->NOTES = $request->NOTES;
        $newsgroup->SLUG = $request->SLUG;
        $newsgroup->META_TITLE = $request->META_TITLE;
        $newsgroup->META_KEYWORD = $request->META_KEYWORD;
        $newsgroup->META_DESCRIPTION = $request->META_DESCRIPTION;
        $newsgroup->ISACTIVE = $request->ISACTIVE;
        // Các trường mặc ẩn, mặc định
        $newsgroup->updated_at=date('Y-m-d H:i:s');
        $newsgroup->UPDATED_BY=Auth::guard('admin')->user()->id;
        // ghi vào db
        $newsgroup->save();

        return redirect('/admins/newsgroup');
        // return view('admins.newsgroup.edit',['id'=>$request->id]);
    }
}

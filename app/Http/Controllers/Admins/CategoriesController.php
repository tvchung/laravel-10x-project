<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $datas = Category::all();
        $list=DB::table('category')
                    ->join('admins', 'admins.id', '=', 'category.updated_by')
                    ->select('category.*', 'admins.name')
                    ->get();
        // echo "<pre>";
        // print_r($list);
        // die;
        return view('admins.category.index',['datas'=>$list]);
    }
    //detail
    public function detail($id)
    {
        // $data = Category::where('id',$id);
        $data = Category::find($id);
        return view('admins.category.detail',['data'=>$data,'id'=>$id]);
    }
    // Get: create
    public function create()
    {
        return view('admins.category.create');
    }
    // Post: createSubmit
    public function createSubmit(Request $request)
    {
        // validation form
        $validations = $request->validate([
            'NAME'=>'required|unique:category',
            'SLUG'=>'required|unique:category',
            'ICON'=>'required'
            ]
            ,[
                'NAME.required'=>'Tên loại danh mục không để trống',
                'NAME.unique'=>'Tên loại danh mục không trùng nhau',
                'SLUG.required'=>'SLUG không được để trống',
                'SLUG.unique'=>'SLUGkhông trùng nhau',
                'ICON.required'=>'Chọn ảnh đại diện loại danh mục'
            ]
        );
        // Upload file
        $image_path = 'images\\categories\\';
        $imageFileName="";
        $icon="";
        if($request->hasFile('ICON')){
            $image_tmp = $request->file('ICON');
            if($image_tmp->isValid()){
                // get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Tạo tên file image
                $image_id_image = rand(11111,99999);
                $imageFileName = $request->NAME .'-' . $image_id_image .'.' .$extension; // tên file sẽ lưu trên server
                $image_tmp->move($image_path,$imageFileName);
                $icon='/images/categories/'.$imageFileName;
            }else if(!empty($request->ICON)){
                $imageFileName = $request->ICON;
                $icon='/images/categories/'.$imageFileName;
            }else{
                $imageFileName = "";
            }
        }
        // if($request->isMethod('post')){
        //     $data = $request->all();
        //     echo "<pre>"; print_r($data);die;
        // }

        // tạo đối tượng thêm mới
        $category = new Category;
        $category->NAME = $request->NAME;
        $category->ICON = $icon;
        $category->NOTES = $request->NOTES;
        $category->SLUG = $request->SLUG;
        $category->META_TITLE = $request->META_TITLE;
        $category->META_KEYWORD = $request->META_KEYWORD;
        $category->META_DESCRIPTION = $request->META_DESCRIPTION;
        $category->ISDELETE = 0;

        $category->ISACTIVE = $request->ISACTIVE;
        $category->created_at=date('Y-m-d H:i:s');
        $category->updated_at=date('Y-m-d H:i:s');
        $category->CREATED_BY=Auth::guard('admin')->user()->id;
        $category->UPDATED_BY=Auth::guard('admin')->user()->id;

        // ghi vào db
        $category->save();

        return redirect('/admins/category');
    }

    //GET: edit
    public function edit($id)
    {
        $data = Category::find($id);
        return view('admins.category.edit',['data'=>$data,'id'=>$id]);
    }
    //POST:editSubmit
    public function editSubmit(Request $request)
    {
        // Upload file
        $image_path = 'images\\categories\\';
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
                $icon='/images/categories/'.$imageFileName;
            }else if(!empty($request->ICON)){
                $imageFileName = $request->ICON;
                $icon='/images/categories/'.$imageFileName;
            }else{
                $imageFileName = "";
            }
        }
        // if($request->isMethod('post')){
        //     $data = $request->all();
        //     echo "<pre>"; print_r($data);die;
        // }

        // Cập nhật thông tin
        $category = Category::find($request->id);
        $category->NAME = $request->NAME;
        $category->ICON = $icon;
        $category->NOTES = $request->NOTES;
        $category->SLUG = $request->SLUG;
        $category->META_TITLE = $request->META_TITLE;
        $category->META_KEYWORD = $request->META_KEYWORD;
        $category->META_DESCRIPTION = $request->META_DESCRIPTION;
        $category->ISACTIVE = $request->ISACTIVE;
        // Các trường mặc ẩn, mặc định
        $category->updated_at=date('Y-m-d H:i:s');
        $category->UPDATED_BY=Auth::guard('admin')->user()->id;
        // ghi vào db
        $category->save();

        return redirect('/admins/category');
        // return view('admins.category.edit',['id'=>$request->id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class CategoryController extends Controller
{
  /**
   * undocumented function
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  /**
   * undocumented function
   *
   * @return void
   */
  public function index()
  {
    $data['categories'] = Category::paginate(20);
    return view('admin.category.index',$data);
  }
      
      /**
       *      * Show the profile for the given category.
       '       *           *
       *                * @param  int  $id
       *                     * @return Response
       *                          */
  public function show($id)
  {
    $data['category'] = Category::find($id);
    //Lay gia tri menu don cap
    $data['categories'] = Category::where([
      ['parent', '=', 0],
      ['id', '<>', 1]
    ])->get();
    if ($data['category'] !== null) {
      return view('admin.category.show',$data);
    }
    return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục này');
  }
  /**
   * create category function
   *
   * @return void
   */
  public function create()
  {
    $data['categories'] = Category::where([
      [ 'parent', '=', 0],
      [ 'id', '<>', 1]
    ])->get();
    return view('admin.category.create', $data);
  }

  /**
   * store category function
   *
   * @return void
   */
  public function store(Request $request)
  {
    $valid = Validator::make($request->all(),
      [
        'name' => 'required|unique:categories,name',
        'parent' => "required",
      ], 
      [
        'name.required' => 'Vui lòng nhập vào tên chuyên mục',
        'name.unique' => 'Chuyên mục đã tồn tại',
        'parent.required' => 'Vui lòng chọn chuyên mục cha',
        'parent.exists' => 'ID chuyên mục cha không hợp lệ'
      ]);
    $valid->sometimes('parent', 'exists:categories,id', function($input){
      return $input->parent !== '0';
    });
    if ($valid->fails()) {
      return redirect()->back()->withErrors($valid)->withInput();
    }else{
      $order = 0;
      if ($request->input('order')) {
        $order = $request->input('order');
      }
      $category = Category::create([
        'name' => $request->input('name'),
        'slug' => str_slug($request->input('name')),
        'parent' => $request->input('parent'),
        'order' => $order
      ]);
      return redirect()->route('admin.category')->with('message', "Tạo chuyên mục $category->name thành công");
    }
    return 'store';
  }

  /**
   * Edit Category Infomation 
   *
   * @return void
   */
  public function update(Request $request,$id)
  {
    $valid = Validator::make($request->all(),
      [
        'name' => 'required|unique:categories,name,'.$id,
        'parent' => "required",
      ], 
      [
        'name.required' => 'Vui lòng nhập vào tên chuyên mục',
        'name.unique' => 'Chuyên mục đã tồn tại',
        'parent.required' => 'Vui lòng chọn chuyên mục cha',
        'parent.exists' => 'ID chuyên mục cha không hợp lệ'
      ]);
    $valid->sometimes('parent', 'exists:categories,id', function($input){
      return $input->parent !== '0';
    });
    if ($valid->fails()) {
      return redirect()->back()->withErrors($valid)->withInput();
    }else{
      $category = Category::find($id);
      if ($category !== null) {
        $order = 0;
        if ($request->input('order')) {
          $order = $request->input('order');
        }
        $category->name = $request->input('name');
        $category->parent = $request->input('parent');
        $category->order = $order;
        $category->slug = str_slug($request->input('name'));
        $category->save();
        return redirect()->route('admin.category')->with('message', "Cập nhật  chuyên mục $category->name thành công");  
      }
    }
    return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục này');
  }
  
  /**
   * Delete Category Information
   *
   * @return void
   */
 
  public function delete($id)
  {
    $category = Category::find($id);
    if ($category !== null) {
      $category->delete();
      return redirect()->route('admin.category')->with('message', "Xóa chuyên mục $category->name thành công");
    }
    return redirect()->route('admin.category.index')->with('error', "Không tìm thấy chuyên mục này");
  }
    
  
}

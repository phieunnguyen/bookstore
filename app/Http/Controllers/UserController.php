<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class UserController extends Controller
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
    $data['users'] = User::paginate(20);
    return view('admin.user.index',$data);
  }
      
      /**
       *      * Show the profile for the given user.
       '       *           *
       *                * @param  int  $id
       *                     * @return Response
       *                          */
  public function show($id)
  {
    $data['user'] = User::find($id);
    if ($data['user'] !== null) {
      return view('admin.user.show',$data);
    }
    return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
  }
  /**
   * create user function
   *
   * @return void
   */
  public function create()
  {
    return view('admin.user.create');
  }

  /**
   * store user function
   *
   * @return void
   */
  public function store(Request $request)
  {
    $valid = Validator::make($request->all(),
      [
        'name' => 'required',
        'email' => "required|email|unique:users,email",
        'password' => 'required|confirmed',
      ], 
      [
        'name.required' => 'Vui lòng nhập vào họ tên',
        'email.required' => 'Vui lòng nhập vào email',
        'email.email' => 'Vui lòng nhập đúng định dạng email',
        'email.unique' => 'Email đã tồn tại',
        'password.required' => 'Vui lòng nhập vào mật khẩu',
        'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp'
      ]);
    if ($valid->fails()) {
      return redirect()->back()->withErrors($valid)->withInput();
    }else{
      $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
      ]);
      return redirect()->route('admin.user')->with('message', "Tạo người dùng $user->name thành công");
    }
    return 'store';
  }

  /**
   * Edit User Infomation 
   *
   * @return void
   */
  public function update(Request $request,$id)
  {
    $valid = Validator::make($request->all(),
      [
        'name' => 'required',
        'email' => "required|email|unique:users,email,".$id,
        'password' => 'confirmed',
      ], 
      [
        'name.required' => 'Vui lòng nhập vào họ tên',
        'email.required' => 'Vui lòng nhập vào email',
        'email.email' => 'Vui lòng nhập đúng định dạng email',
        'email.unique' => 'Email đã tồn tại',
        'password.required' => 'Vui lòng nhập vào mật khẩu',
        'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp'
      ]);
    if ($valid->fails()) {
      return redirect()->back()->withErrors($valid)->withInput();
    }else{
      $user = User::find($id);
      if ($user !== null) {
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      if ($request->input('password')) {
        $user->password = bcrypt($request->input('password'));
      }
      $user->save();
      return redirect()->route('admin.user')->with('message', "Cập nhật  người dùng $user->name thành công");  
      }
    }
    return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng này');
  }
  
  /**
   * Delete User Information
   *
   * @return void
   */
 
  public function delete($id)
  {
    $user = User::find($id);
    if ($user !== null) {
      $user->delete();
      return redirect()->route('admin.user')->with('message', "Xóa người dùng $user->name thành công");
    }
    return redirect()->route('admin.user.index')->with('error', "Không tìm thấy người dùng này");
  }
    
  
}

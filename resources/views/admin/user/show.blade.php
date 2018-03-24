@extends('admin.master')
@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="panel">
    <div class="panel-heading">Cập Nhật Người Dùng</div>
    <div class='panel-body'>
      <form action="{{route('admin.user.update',['id'=>$user->id])}}" method='POST'>
      {{csrf_field()}}
      {{method_field('PUT')}}
  <div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
    <label for="InputName">Họ tên</label>
    <input type="text" class="form-control" id="InputName"  name="name" value="{{$user->name}}" placeholder="Nhập vào email">
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('name')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('email') ? 'has-error' : '' }}">
    <label for="InputEmail">Email</label>
    <input type="email" class="form-control" id="InputEmail1"  name="email" value="{{$user->email}}" placeholder="Nhập vào email">
    <small id="emailHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('email')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('password') ? 'has-error' : '' }} ">
    <label for="password">Mật khẩu</label>
    <input type="password" class="form-control" id="Password" name="password" placeholder="Nhập vào Password">
    <small id="passwordHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('password')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('password_comfirmation') ? 'has-error' : '' }}">
    <label for="password_confirmation">Xác nhận mật khẩu</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận password">
    <small id="confirm-passwordHelpBlock" class="form-text text-muted">
      {{$errors->first('password_comfirmation')}}
    </small>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
    </div>

    </div>
  </div>
</div>
@endsection 

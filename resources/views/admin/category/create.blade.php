@extends('admin.master')
@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="panel">
    <div class="panel-heading">Tạo Sản Phẩm</div>
    <div class='panel-body'>
      <form action="{{route('admin.category.store')}}" method="post">
      {{csrf_field()}}
  <div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
    <label for="InputName">Tên sản phẩm</label>
    <input type="text" class="form-control" id="InputName"  name="name" value="{{old('name')}}" placeholder="Nhập vào chuyên mục ">
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('name')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('order') ? 'has-error' : '' }}">
    <label for="InputName">Thứ tự ưu tiên</label>
    <input type="text" class="form-control" id="InputName"  name="order" value="{{old('order')}}" placeholder="Nhập vào thứ tự ưu tiên ">
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('order')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('parent') ? 'has-error' : '' }}">
    <label for="InputName">Chuyên mục cha</label>
    <select name="parent" id="parent"  class="form-control">
      <option value="0">Không</option>
      @if (count($categories) > 0)
        @foreach ($categories as $category)
          <option value="{{$category->id}}" {{old('parent') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @endforeach
      @endif
    </select>
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('parent')}}
    </small>
  </div>
  <button type="submit" class="btn btn-primary">Tạo</button>
</form>
    </div>

    </div>
  </div>
</div>
@endsection 

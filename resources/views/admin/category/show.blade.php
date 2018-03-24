@extends('admin.master')
@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="panel">
    <div class="panel-heading">Cập nhật Chuyên Mục</div>
    <div class='panel-body'>
      <form action="{{route('admin.category.update', ['id' => $category->id])}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
  <div class="form-group {{$errors->has('name') ? 'has-error' : '' }}">
    <label for="InputName">Tên chuyên mục</label>
    <input type="text" class="form-control" id="InputName"  name="name" value="{{$category->name}}" placeholder="Nhập vào chuyên mục ">
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('name')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('order') ? 'has-error' : '' }}">
    <label for="InputName">Thứ tự ưu tiên</label>
    <input type="text" class="form-control" id="InputName"  name="order" value="{{$category->order}}" placeholder="Nhập vào thứ tự ưu tiên ">
    <small id="nameHelpBlock" class="form-text text-muted text-danger">
      {{$errors->first('order')}}
    </small>
  </div>
  <div class="form-group {{$errors->has('parent') ? 'has-error' : '' }}">
    <label for="InputName">Chuyên mục cha</label>
    <select name="parent" id="parent"  class="form-control">
      <option value="0">Không</option>
      @if (count($categories) > 0)
        @foreach ($categories as $sCategory)
          <option value="{{$sCategory->id}}" {{$sCategory->parent == $sCategory->id ? 'selected' : ''}}>{{$sCategory->name}}</option>
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

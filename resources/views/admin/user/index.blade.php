@extends('admin.master')
@section('content')
<div class="container">
  <div class="col-md-12">
  @if(session('message'))
    <div class = "alert alert-success">{{session('message')}}</div>
  @endif
  @if(session('error'))
    <div class = "alert alert-danger">{{session('error')}}</div>
  @endif
    <div>
      <a href="{{route('admin.user.create')}}" class='btn btn-primary'>Tạo Người Dùng</a>
    </div>
    <br>
    <div class="panel">
    <div class="panel-heading">Danh Sách Người Dùng</div>
    <div class='panel-body'>
      <div class="table-reponsive">
      <table class='table table-hover'>
        <thead class='thead-dark'>
          <tr>
            <th scope='row'>#</th>
            <th scope='row'>Name</th>
            <th scope='row'>Email</th>
            <th scope='row' >Created at</th>
            <th scope='row'>Update at</th>
            <th scope='row'>Options</th>
          </tr>
        </thead>

        <tbody>
          @forelse($users as $user)
            <tr>
              <td scope='row'>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
              <td><a href="{{route('admin.user.show', ['id'=>$user->id])}}" class='btn btn-primary'>Edit</a>
              <a href="{{route('admin.user.delete', ['id'=>$user->id])}}" 
                class='btn btn-danger'
                onclick="event.preventDefault();
                         window.confirm('Bạn có chắc chắn muốn xóa  người dùng {{$user->name}} không?') ? 
                         document.getElementById('delete-user-{{$user->id}}').submit() : 0;">Delete</a>
              <form action="{{route('admin.user.delete',['id'=>$user->id])}}" method='POST' id='delete-user-{{$user->id}}'>
                {{csrf_field()}}
                {{method_field('DELETE')}}
              </form>
            </tr>
          @empty
            <tr>
              <td colspan="5">No Data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>

      <div class="text-center">{{$users->links()}}
      </div>
    </div>
  </div>
</div>
@endsection 

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
      <a href="{{route('admin.product.create')}}" class='btn btn-primary'>Tạo Sản Phẩm</a>
    </div>
    <br>
    <div class="panel">
    <div class="panel-heading">Danh Sách Sản Phẩm</div>
    <div class='panel-body'>
      <div class="table-reposive">      
        <table class='table table-hover'>
        <thead class='thead-dark'>
          <tr>
            <th scope='row'>#</th>
            <th scope='row'>Tên</th>
            <th scope='row'>Mã</th>
            <th scope='row'>Giá bán</th>
            <th scope='row'>Số lượng</th>
            <th scope='row' >Hình ảnh</th>
            <th scope='row' >Người đăng</th>
            <th scope='row'>Ngày cập nhật</th>
            <th scope='row'>Chức năng</th>
          </tr>
        </thead>

        <tbody>
          @forelse($products as $product)
            <tr>
              <td scope='row'>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->code}}</td>
              <td>{{$product->sale_price}}</td>
              <td>{{$product->quantity}}</td>
              <td>
                @if(!empty($product->image) && file_exists(public_path(get_thumbnail("uploads/$product->image"))))
                    <img src="{{ asset(get_thumbnail("uploads/$product->image"))}}" alt="Image" class="img-responsive img-thumbnail">
                @else
                    <img src="{{ asset("images/no_image.jpg")}}" alt="No Image" class="img-responsive img-thumbnail">
                  @endif
              </td>
              <td>{{$product->user->name}}</td>
              <td>{{$product->updated_at}}</td>
              <td><a href="{{route('admin.product.show', ['id'=>$product->id])}}" class='btn btn-primary'>Edit</a>
              <a href="{{route('admin.product.delete', ['id'=>$product->id])}}" 
                class='btn btn-danger'
                onclick="event.preventDefault();
                window.confirm('Bạn có chắc chắn muốn xóa chuyên mục {{$product->name}} không?') ?
                document.getElementById('delete-product-{{$product->id}}').submit() : 0;">Delete</a>
              <form action="{{route('admin.product.delete',['id'=>$product->id])}}" method='POST' id='delete-product-{{$product->id}}'>
                {{csrf_field()}}
                {{method_field('DELETE')}}
              </form>
            </tr>
          @empty
            <tr>
              <td colspan="8">Không có dữ liệu</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    </div>

      <div class="text-center">{{$products->links()}}
      </div>
    </div>
  </div>
</div>
@endsection 

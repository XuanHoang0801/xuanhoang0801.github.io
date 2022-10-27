@extends('layouts.app')
@section('title','Quản lý danh mục')
@section('content')
<div class="container">
    <h1>Quản lý danh mục</h1>

    <div class="form-group">
        <a href="/admin/danh-muc/create" class="btn btn-primary">Thêm mới</a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thể loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=1 ?>
            @foreach ($categories as $cat)
                
            <tr>
                <td scope="row">{{$stt++}}</td>
                <td>{{$cat->name}}</td>
                <td class="d-flex">
                    <a href="admin/danh-muc/{{$cat->id}}" class="btn btn-success" style="margin: 0 5px"><i class="fas fa-pen"></i></a>
                    
                    <form action="admin/danh-muc/{{$cat->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa danh mục này không?')"><i class="fas fa-trash"></i></button>
                    </form>
                    

                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>

<script>
    
</script>
@endsection

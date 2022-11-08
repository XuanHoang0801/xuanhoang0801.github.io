@extends('home')
@section('title','Đổi mật khẩu')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                <h3 class="card-header text-center h3 ">Đổi mật khẩu </h3>
                @if (session('loi'))
                    <div class="alert alert-danger mt-3">{{session('loi')}}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mt-3 mx-3">{{session('success')}}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="/doi-mat-khau">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Mật khẩu hiện tại:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control  password @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                <div class="notify-pass"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu mới:</label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control newpass @error('newpassword') is-invalid @enderror" name="newpassword" required autocomplete="current-password">
                                <div class=" notify"></div>
                                @error('newpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Nhập lại mật khẩu mới:</label>

                            <div class="col-md-6">
                                <input id="repassword" type="password" class="form-control repass @error('repassword') is-invalid @enderror" name="repassword" required autocomplete="current-password">
                                <div class=" notify-re"></div>

                                @error('repassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success change" style="display:none">
                                   Đổi mật khẩu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
 <script>
   $(document).ready(function(){
    $('.password').change(function(){
        var pass = $(this).val();
        $.post("ajax/check-pass",
            {
                _token: '{{ csrf_token() }}',
                pass:pass,  
            },
            function(data){
                $('.notify-pass').html(data['success']);
                $('.change').css("display",'none');   
            }); 
    });
    $('.newpass').change(function(){
        var newpass = $(this).val();
        if(newpass.length < 6){
            $('.notify').html('<span class="text-danger">Mật khẩu quá ngắn!</span');
        }
        else{
            $('.notify').html('<span class="text-success">Mật khẩu hợp lệ!</span');
            $('.change').css("display",'none');
        }
    });
    $('.repass').change(function(){
        var repass = $(this).val();
        var newpass = $('.newpass').val();
        if(repass != newpass){
            $('.notify-re').html('<span class="text-danger">Mật khẩu không trùng khớp!</span');
            $('.change').css("display",'none');
        }
        else{
            $('.notify-re').html('<span class="text-success">Mật khẩu hợp lệ!</span');
            $('.change').css("display",'block');
        }
    });
    });
</script>   
@endsection
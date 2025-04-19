@extends('frontend.home.main')
@section('content')
    <div class="container o-hidden">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg mt-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img class="w-100" src="backend/img/auth/auth.jpg" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5 mt-5">
                                    <div class="text-center">
                                        <h2>Quên mật khẩu</h2>
                                    </div>
                                    <form class="user mt-4" method="POST"
                                        action="{{ route('auth.password.forgot.form') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập địa chỉ email..." value="{{ old('email') }}"
                                                name="email">
                                            @if ($errors->has('email'))
                                                <span class="message-error">*{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Gửi mã xác thực
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center d-flex justify-content-between">
                                        <a class="small" href="{{ route('auth.register') }}">Đăng ký tài
                                            khoản!</a>
                                        <a class="small" href="{{ route('auth.admin') }}">
                                            Đăng nhập!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

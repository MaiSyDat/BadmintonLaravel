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
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2>Đăng nhập</h2>
                                    </div>
                                    <form class="user mt-4" method="POST" action="{{ route('auth.login') }}">
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
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" name="password">
                                            @if ($errors->has('password'))
                                                <span class="message-error">*{{ $errors->first('password') }}</span>
                                            @endif

                                        </div>
                                        <div class="form-group d-flex justify-content-between">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Nhớ tôi</label>
                                            </div>
                                            <div class="text-center">
                                                <a class="small" href="{{ route('auth.password.forgot.form') }}">Quên mật
                                                    khẩu?</a>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Đăng nhập
                                        </button>
                                        <hr>
                                        <a href="index.html" class="btn btn-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('auth.register') }}">Đăng ký tài
                                            khoản!</a>
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

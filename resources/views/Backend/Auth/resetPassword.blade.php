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
                                        <h2>Mật khẩu mới</h2>
                                    </div>
                                    <form class="user mt-4" method="POST" action="{{ route('auth.password.reset') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="email" value="{{ $email }}">

                                        <div class="form-group row">
                                            <div class="col-sm-12 mb-3">
                                                <input type="password" class="form-control form-control-user"
                                                    placeholder="Nhập mật khẩu mới" name="password" required>
                                                @if ($errors->has('password'))
                                                    <span class="message-error">*{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control form-control-user"
                                                    placeholder="Nhập lại mật khẩu" name="password_confirmation" required>
                                                @if ($errors->has('password_confirmation'))
                                                    <span
                                                        class="message-error">*{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Xác nhận
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('Frontend.Profile.index')
@section('profile_content')
    <div>
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-person-circle me-2"></i> Đổi mật khẩu
                </h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('auth.password.change') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>
                <div class="mt-4 text-center">
                    <button class="btn btn-outline-primary mt-3" type="submit">
                        <i class="bi bi-save me-2"></i> Lưu thông tin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

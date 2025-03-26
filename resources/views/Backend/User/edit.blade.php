@extends('backend.dashboard.home.main')

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-4">Sửa Người Dùng</h2>
        <form action="{{ route('user.update', $user->id) }}" method="POST" id="updateUserForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="userId" value="{{ $user->id }}">

            <div class="form-group">
                <div class="position-relative d-inline-block">
                    <img id="imgPreview" src="{{ asset($user->img ?? 'backend/img/user/default-avatar.png') }}"
                        alt="Ảnh đại diện" class="rounded-circle border shadow"
                        style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;">
                    <input type="file" class="d-none" name="img" id="imgInput" accept="image/*">
                    <button type="button" class="btn btn-primary mt-2"
                        onclick="document.getElementById('imgInput').click();">
                        Thêm ảnh
                    </button>
                </div>
            </div>

            <script>
                document.getElementById('imgInput').addEventListener('change', function(event) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imgPreview').src = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                });
            </script>

            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Họ tên" name="name" required
                        value="{{ $user->name }}">
                </div>
                <div class="col-sm-6">
                    <input type="email" class="form-control" placeholder="Địa chỉ email" name="email" required
                        value="{{ $user->email }}">
                    @error('email')
                        <div class="message-error">*{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="confirm_password">
                    @error('confirm_password')
                        <div class="message-error">*{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Giới tính</label>
                    <select class="form-control" name="gender">
                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nam</option>
                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}">
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                    value="{{ $user->phone }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                    value="{{ $user->address }}">
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Quyền</label>
                    <select class="form-control" name="role">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>User</option>
                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status">
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Không hoạt động</option>
                    </select>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-end m-4">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary ml-3">Quay lại</a>
            </div>
        </form>
    </div>
@endsection

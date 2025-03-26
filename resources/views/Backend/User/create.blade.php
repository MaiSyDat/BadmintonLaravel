@extends('backend.dashboard.home.main')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm người dùng</h5>
            </div>
            <div class="card-body">
                <form id="addUserForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <div class="position-relative d-inline-block">
                            <!-- Hiển thị ảnh mặc định hoặc ảnh đã lưu -->
                            <img id="imgPreview"
                                src="{{ isset($user) && $user->img ? asset($user->img) : asset('backend/img/user/default-avatar.png') }}"
                                alt="Ảnh đại diện" class="rounded-circle border shadow"
                                style="width: 120px; height: 120px; object-fit: cover; cursor: pointer;">

                            <!-- Input file (ẩn đi) -->
                            <input type="file" class="d-none" name="img" id="imgInput" accept="image/*">

                            <!-- Nút thêm ảnh -->
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="document.getElementById('imgInput').click();">
                                Thêm ảnh
                            </button>
                        </div>
                    </div>

                    <script>
                        document.getElementById('imgInput').addEventListener('change', function(event) {
                            let file = event.target.files[0]; // Lấy file người dùng chọn
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('imgPreview').src = e.target.result; // Hiển thị ảnh ngay lập tức
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" placeholder="Họ tên" name="name" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="Địa chỉ email" name="email" required>
                            @error('email')
                                <div class="message-error">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password"
                                required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"
                                name="confirm_password" required>
                            @error('confirm_password')
                                <div class="message-error">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Giới tính</label>
                            <select class="form-control" name="gender">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Quyền</label>
                            <select class="form-control" name="role">
                                <option value="1">User</option>
                                <option value="0">Admin</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end m-4">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary ml-3">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

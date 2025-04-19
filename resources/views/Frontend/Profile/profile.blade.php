@extends('Frontend.Profile.index')
@section('profile_content')
    <div>
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    <i class="bi bi-person-circle me-2"></i> Cài đặt thông tin cá nhân
                </h4>
            </div>

            <form action="{{ route('profile.profile.update') }}" method="POST" id="profile-form">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Họ tên</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Giới tính</label>
                        <select name="gender" class="form-control" disabled>
                            <option value="1" {{ Auth::user()->gender == 1 ? 'selected' : '' }}>Nam</option>
                            <option value="2" {{ Auth::user()->gender == 2 ? 'selected' : '' }}>Nữ</option>
                            <option value="3" {{ Auth::user()->gender == 3 ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                            disabled>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}"
                            disabled>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}"
                            disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ngày sinh</label>
                        <input type="date" name="birthday" class="form-control" value="{{ Auth::user()->birthday }}"
                            disabled>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <button type="button" class="btn btn-outline-secondary" id="edit-btn">
                        <i class="bi bi-pencil-square me-2"></i> Sửa thông tin
                    </button>

                    <button class="btn btn-outline-primary mt-3 d-none" type="submit" id="save-btn">
                        <i class="bi bi-save me-2"></i> Lưu thông tin
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editBtn = document.getElementById('edit-btn');
            const saveBtn = document.getElementById('save-btn');
            const inputs = document.querySelectorAll('#profile-form input');

            editBtn.addEventListener('click', function() {
                inputs.forEach(input => {
                    input.removeAttribute('disabled');
                });
                document.querySelectorAll('#profile-form select').forEach(select => {
                    select.removeAttribute('disabled');
                });
                saveBtn.classList.remove('d-none');
                editBtn.classList.add('d-none');
            });
        });
    </script>
@endsection

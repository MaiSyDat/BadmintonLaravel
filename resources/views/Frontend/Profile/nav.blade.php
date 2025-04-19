<div class="col-md-3 border-end">
    <div class="avatar d-flex flex-column align-items-center text-center p-3 py-4">
        <img class="rounded-circle mb-3 shadow-sm" src="{{ asset(Auth::user()->img) }}" width="100" height="100"
            id="avatarPreview">
        <h5 class="fw-bold mb-0">{{ Auth::user()->name }}</h5>
        <small class="text-muted">{{ Auth::user()->email }}</small>

        <form action="{{ route('profile.profile.update.avatar') }}" method="POST" enctype="multipart/form-data"
            class="mt-3 w-100">
            @csrf
            <div class="mb-2">
                <input type="file" name="img" class="form-control form-control-sm"
                    onchange="previewAvatar(event)" required>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary w-100">Cập nhật ảnh đại diện</button>
        </form>
    </div>

    <div class="mt-4 d-flex flex-column">
        <a href="{{ route('profile.index') }}"
            class="btn btn-outline-primary mb-2 d-flex align-items-center justify-content-start">
            <i class="bi bi-person-circle me-2 fs-5"></i> Thông tin cá nhân
        </a>
        <a href="{{ route('profile.orders') }}"
            class="btn btn-outline-success mb-2 d-flex align-items-center justify-content-start">
            <i class="bi bi-receipt-cutoff me-2 fs-5"></i> Đơn hàng của bạn
        </a>
        <a href="{{ route('auth.password.change.form') }}"
            class="btn btn-outline-danger mb-2 d-flex align-items-center justify-content-start">
            <i class="bi bi-eye me-2 fs-5"></i> Đổi mật khẩu
        </a>
    </div>
</div>

<script>
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('avatarPreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@extends('backend.dashboard.home.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm sản phẩm</h5>
            </div>
            <div class="card-body">
                <form id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <div class="position-relative d-inline-block">
                            <img id="imgPreview" src="{{ asset('backend/img/product/default-product.png') }}"
                                alt="Ảnh sản phẩm" class="rounded border shadow"
                                style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;">
                            <input type="file" class="d-none" name="img" id="imgInput" accept="image/*">
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="document.getElementById('imgInput').click();">Thêm ảnh</button>
                        </div>
                    </div>
                    <script>
                        document.getElementById('imgInput').addEventListener('change', function(event) {
                            let file = event.target.files[0];
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('imgPreview').src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input type="number" class="form-control" name="price" placeholder="Nhập giá sản phẩm" required>
                    </div>
                    <div class="form-group">
                        <label>Giảm giá (%)</label>
                        <input type="number" class="form-control" name="sale" placeholder="Nhập phần trăm giảm giá">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" id="new-content" name="description" rows="3" placeholder="Mô tả sản phẩm"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea class="form-control" id="new-content" name="content" rows="5"
                            placeholder="Nhập nội dung chi tiết sản phẩm"></textarea>

                    </div>
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="categories_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="status">
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center justify-content-end m-4">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary ml-3">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('backend.dashboard.home.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Sửa sản phẩm</h5>
            </div>
            <div class="card-body">
                <form id="editProductForm" action="{{ route('products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Laravel yêu cầu @method('PUT') để cập nhật --}}

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <div class="position-relative d-inline-block">
                            <img id="imgPreview" src="{{ asset($product->img) }}" alt="Ảnh sản phẩm"
                                class="rounded border shadow"
                                style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;">
                            <input type="file" class="d-none" name="img" id="imgInput" accept="image/*">
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="document.getElementById('imgInput').click();">Chọn ảnh</button>
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
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input type="number" class="form-control" name="price" value="{{ $product->price }}" required>
                    </div>

                    <div class="form-group">
                        <label>Giảm giá (%)</label>
                        <input type="number" class="form-control" name="sale" value="{{ $product->sale }}">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea id="new-content" class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea id="new-content" class="form-control" name="content" rows="5">{{ $product->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="categories_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->categories_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Còn hàng</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Hết hàng</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center justify-content-end m-4">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary ml-3">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

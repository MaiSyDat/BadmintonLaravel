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
                    @method('PUT')

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <div class="position-relative d-inline-block">
                            <!-- Ảnh đại diện -->
                            <img id="mainImgPreview"
                                src="{{ asset($product->img ?? 'backend/img/product/default-product.png') }}"
                                alt="Ảnh sản phẩm" class="rounded border shadow"
                                style="width: 150px; height: 150px; object-fit: cover;">

                            <input type="file" class="d-none" name="img" id="mainImgInput" accept="image/*">
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="document.getElementById('mainImgInput').click();">
                                Thêm ảnh đại diện
                            </button>
                        </div>
                    </div>

                    <!-- Khu vực hiển thị ảnh chi tiết -->
                    <div class="form-group mt-3">
                        <label>Ảnh chi tiết</label>
                        <div id="previewContainer" class="d-flex flex-wrap">
                            @foreach ($productImages as $image)
                                <div class="position-relative m-2 image-container" style="width: 100px; height: 100px;"
                                    data-id="{{ $image->id }}">
                                    <img src="{{ asset($image->path) }}" class="rounded border shadow"
                                        style="width: 100%; height: 100%; object-fit: cover;">

                                    <i class="position-absolute text-danger bi bi-x-circle rounded-circle delete-image"
                                        style="font-size: 20px; text-align: center; cursor: pointer; top: -5px; right: 0;">
                                    </i>
                                </div>
                            @endforeach

                            <!-- Nút thêm ảnh -->
                            <div class="add-image-btn d-flex align-items-center justify-content-center border rounded shadow"
                                style="width: 100px; height: 100px; cursor: pointer; font-size: 30px; background: #f8f9fa;"
                                onclick="document.getElementById('detailImgInput').click();">
                                +
                            </div>
                        </div>

                        <input type="hidden" name="deleted_images" id="deletedImages">
                        <input type="file" class="d-none" name="detail_imgs[]" id="detailImgInput" accept="image/*"
                            multiple>
                    </div>

                    <script>
                        document.getElementById('mainImgInput').addEventListener('change', function(event) {
                            let file = event.target.files[0];
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('mainImgPreview').src = e.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        document.getElementById('detailImgInput').addEventListener('change', function(event) {
                            let files = event.target.files;
                            let previewContainer = document.getElementById('previewContainer');

                            for (let i = 0; i < files.length; i++) {
                                let fileReader = new FileReader();
                                fileReader.onload = function(e) {
                                    let div = document.createElement('div');
                                    div.className = 'position-relative m-2';
                                    div.style = 'width: 100px; height: 100px;';

                                    let imgElement = document.createElement('img');
                                    imgElement.src = e.target.result;
                                    imgElement.className = 'rounded border shadow';
                                    imgElement.style = 'width: 100%; height: 100%; object-fit: cover;';

                                    let closeBtn = document.createElement('i');
                                    closeBtn.className = 'position-absolute text-danger bi bi-x-circle';
                                    closeBtn.style =
                                        'font-size: 20px; text-align: center; cursor: pointer; top: -5px; right: 0;';
                                    closeBtn.onclick = function() {
                                        div.remove();
                                    };

                                    div.appendChild(imgElement);
                                    div.appendChild(closeBtn);
                                    previewContainer.insertBefore(div, previewContainer.lastElementChild);
                                };
                                fileReader.readAsDataURL(files[i]);
                            }
                        });

                        function deleteImage(imageId, element) {
                            fetch('/admin/products/delete-image/' + imageId, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            }).then(response => response.json()).then(data => {
                                if (data.success) {
                                    element.closest('div').remove();
                                }
                            });
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            let deletedImages = [];

                            document.querySelectorAll('.delete-image').forEach(button => {
                                button.addEventListener('click', function() {
                                    let imageContainer = this.closest('.image-container');
                                    let imageId = imageContainer.getAttribute('data-id');

                                    if (imageId) {
                                        deletedImages.push(imageId);
                                        document.getElementById('deletedImages').value = deletedImages.join(',');
                                    }

                                    imageContainer.remove();
                                });
                            });
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
                        <textarea class="form-control new-content" name="description" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Nội dung chi tiết</label>
                        <textarea class="form-control new-content" name="content" rows="5">{{ $product->content }}</textarea>
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

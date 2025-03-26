@extends('backend.dashboard.home.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm danh mục</h5>
            </div>
            <div class="card-body">
                <form id="addUserForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row align-items-center">
                        <label class="col-sm-2 col-form-label">Tên danh mục</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name"
                                required>
                        </div>
                        <label class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="d-flex align-items-center justify-content-end m-4">
                <button type="submit" class="btn btn-primary">Thêm</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-3">Quay lại</a>
            </div>
            </form>
        </div>
    </div>
@endsection

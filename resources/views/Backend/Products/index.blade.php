@extends('backend.dashboard.home.main')
@section('content')
    {{-- product --}}
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ config('apps.product.title') }}</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ config('apps.product.tableHeading') }}
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row align-items-center">
                            <!-- Dropdown chọn số lượng hiển thị -->
                            <div class="col-sm-12 col-md-4">
                                <div class="dataTables_length" id="dataTable_length">
                                    <label>Show
                                        <select name="dataTable_length" aria-controls="dataTable"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        entries
                                    </label>
                                </div>
                            </div>

                            <!-- Ô tìm kiếm + nút tìm kiếm -->
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter" class="dataTables_filter d-flex">
                                    <label class="w-100">
                                        Search:
                                        <input type="search" class="form-control form-control-sm d-inline-block w-75"
                                            placeholder="Nhập từ khóa..." aria-controls="dataTable">
                                        <button class="btn btn-primary"><i class="fas fa-fw fa-search"></i></button>
                                    </label>
                                </div>
                            </div>

                            <!-- Nút Thêm người dùng -->
                            <div class="col-sm-12 col-md-2 text-right">
                                <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm danh mục</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">Ảnh sản phẩm</th>
                                            <th rowspan="1" colspan="1">Tên sản phẩm</th>
                                            <th rowspan="1" colspan="1">Giá</th>
                                            <th rowspan="1" colspan="1">Trạng thái</th>
                                            <th rowspan="1" colspan="1">Danh mục</th>
                                            <th rowspan="1" colspan="1">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Ảnh sản phẩm</th>
                                            <th rowspan="1" colspan="1">Tên sản phẩm</th>
                                            <th rowspan="1" colspan="1">Giá</th>
                                            <th rowspan="1" colspan="1">Trạng thái</th>
                                            <th rowspan="1" colspan="1">Danh mục</th>
                                            <th rowspan="1" colspan="1">Chức năng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="odd">
                                                <td class="sorting_1">
                                                    <img src="{{ asset($product->img) }}" alt="Ảnh sản phẩm"
                                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->getFormattedPrice() }}</td>
                                                <td>
                                                    <span class="badge border {{ $product->status_badge_class }}">
                                                        {{ $product->status_name }}
                                                    </span>
                                                </td>
                                                <td>{{ $product->category->name ?? 'Không có danh mục' }}</td>
                                                <td style="display: flex; align-items: center; gap: 5px;">
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-primary">Sửa</a>
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- {{ $category->links('pagination::bootstrap-4') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

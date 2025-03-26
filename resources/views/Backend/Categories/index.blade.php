@extends('backend.dashboard.home.main')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ config('apps.categories.title') }}</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ config('apps.categories.tableHeading') }}
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
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">ID danh mục</th>
                                            <th rowspan="1" colspan="1">Tên danh mục</th>
                                            <th rowspan="1" colspan="1">Trạng thái</th>
                                            <th rowspan="1" colspan="1">Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">ID danh mục</th>
                                            <th rowspan="1" colspan="1">Tên danh mục</th>
                                            <th rowspan="1" colspan="1">Trạng thái</th>
                                            <th rowspan="1" colspan="1">Chức năng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="odd">
                                                <td class="sorting_1">{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <span class="badge border {{ $category->status_badge_class }}">
                                                        {{ $category->status_name }}
                                                    </span>
                                                </td>

                                                <td style="display: flex; align-items: center; gap: 5px;">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-primary">Sửa</a>

                                                    <form action="{{ route('categories.destroy', $category->id) }}"
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

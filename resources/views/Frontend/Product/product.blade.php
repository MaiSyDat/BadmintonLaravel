@extends('frontend.home.main')
@section('content')
    <!-- Bread-crumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-4">
        <div class="row">
            <!-- Cột bên trái: Bộ lọc -->
            <div class="col-md-3">
                <div class="filter-box">
                    <div class="filter-title">Danh mục</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $category)
                            <li class="list-group-item bg-transparent border-0">
                                <input type="checkbox"> {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-box">
                    <div class="filter-title">Khoảng giá</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent border-0">
                            <input type="checkbox" /> Giá dưới 500.000đ
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                            <input type="checkbox" /> 500.000đ - 1 triệu
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                            <input type="checkbox" /> 1 - 2 triệu
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                            <input type="checkbox" /> 2 - 3 triệu
                        </li>
                        <li class="list-group-item bg-transparent border-0">
                            <input type="checkbox" /> Giá trên 3 triệu
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Cột bên phải: Danh sách sản phẩm -->
            <div class="col-md-9">
                <!-- Thanh sắp xếp -->
                <div class="sort-box">
                    <select class="form-select w-25">
                        <option selected>Sắp xếp</option>
                        <option value="asc">Giá thấp đến cao</option>
                        <option value="desc">Giá cao đến thấp</option>
                    </select>
                </div>

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <a href="{{ route('product.show', $product->id) }}">
                                <div class="product-item bg-white m-2">
                                    <div class="product-image">
                                        <img class="img-fluid" src="{{ asset($product->img) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="product-name">
                                        <p class="truncate-2-lines">{{ $product->name }}</p>
                                    </div>
                                    <div class="product-price">
                                        <p class="price text-danger">
                                            {{ number_format($product->getDiscountedPrice()) }}đ
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

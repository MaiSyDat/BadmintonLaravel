@extends('frontend.home.main')
@section('content')
    <div class="container my-2">
        <nav class="mb-3">
            <a href="{{ route('home.index') }}">Trang chủ</a> > <span class="text-danger">Giỏ hàng</span>
        </nav>
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">
                <h4 class="mb-4 fw-bold text-uppercase text-danger text-center">Giỏ hàng của bạn</h4>

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center border">
                        <thead class="table-light">
                            <tr class="fw-semibold">
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->items as $item)
                                <tr class="align-middle text-center">
                                    <td>
                                        <img src="{{ asset($item->img) }}" class="img-thumbnail rounded"
                                            style="width: 80px; height: 80px;">
                                    </td>
                                    <td class="text-start align-middle">
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-danger fw-semibold align-middle">
                                        {{ number_format($item->price) }}đ
                                    </td>
                                    <td class="align-middle">
                                        <div
                                            class="quantity-wrapper d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('update.cart', ['id' => $item->id, 'quantity' => $item->quantity - 1]) }}"
                                                class="btn btn-outline-secondary btn-sm"
                                                onclick="return {{ $item->quantity <= 1 ? 'false' : 'true' }}">-</a>

                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="form-control text-center" style="width: 50px;"
                                                readonly>

                                            <a href="{{ route('update.cart', ['id' => $item->id, 'quantity' => $item->quantity + 1]) }}"
                                                class="btn btn-outline-secondary btn-sm">+</a>
                                        </div>
                                    </td>
                                    <td class="text-danger fw-bold align-middle">
                                        {{ number_format($item->quantity * $item->price) }}đ
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm không?') "
                                            href="{{ route('delete.cart', $item->id) }}" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr class="align-middle">
                                <td colspan="4" class="text-end fw-bold">Tổng số lượng:</td>
                                <td class="fw-bold fs-8 total-quantity">{{ number_format($cart->totalQuantity) }} sản phẩm
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-danger fw-bold fs-5 total-price">{{ number_format($cart->totalPrice) }}đ
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('checkout.index') }}"
                        class="btn btn-danger px-5 py-2 fw-bold shadow-sm rounded-pill">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
@endsection

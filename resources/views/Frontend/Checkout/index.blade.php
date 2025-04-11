@extends('Frontend.home.main')

@section('content')
    <div class="container">
        <div class="brand mb-4">Dsmah<span>Sports</span></div>
        <div class="row">

            <!-- Thông tin nhận hàng -->
            <div class="col-md-4">
                <h5><strong>Thông tin nhận hàng</strong></h5>
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Họ và tên người nhận hàng">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Địa chỉ">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Ghi chú đơn hàng (tùy chọn)"></textarea>
                    </div>
                </form>
            </div>

            <!-- Thanh toán -->
            <div class="col-md-4">
                <h5><strong>Thanh toán</strong></h5>
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" checked>
                        <label class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment">
                        <label class="form-check-label">Thanh toán qua ngân hàng</label>
                    </div>
                </div>

                <div class="payment-methods">
                    <button class="btn btn-danger">THANH TOÁN THẺ <br>(Visa, MasterCard, JCB)</button>
                    <button class="btn btn-primary">TRẢ GÓP QUA THẺ <br>Visa, Master, JCB</button>
                    <button class="btn btn-warning">MUA TRẢ CHẬM <br>HOME PayLater - Muađi</button>
                </div>

                <div class="bg-light p-3 mt-3 rounded">
                    <h6 class="mb-2 text-primary">ƯU ĐÃI KHI THANH TOÁN <strong>HOME PayLater</strong></h6>
                    <small class="text-muted">(Sử dụng khi xác nhận khoản vay trên trang của tổ chức tài chính)</small>
                    <ul class="mt-2">
                        <li>Giảm 5% cho đơn hàng từ 55K, tối đa 300K, 1 lần/tháng. Áp dụng cho tất cả khách hàng.</li>
                        <li>Giảm 20% cho đơn hàng từ 55K, tối đa 50K, chỉ áp dụng cho khách hàng mới. <span
                                class="hot-badge">SIÊU HOT</span></li>
                    </ul>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="col-md-4 order-summary">
                <h5><strong>Đơn hàng ({{ $cart->totalQuantity }} sản phẩm)</strong></h5>
                <div style="max-height: 400px; overflow-y: auto;">
                    <ul class="list-group mb-3">
                        @foreach ($cart->items as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <img src="{{ asset($item->img) }}" class="img-thumbnail rounded"
                                    style="width: 80px; height: 80px; margin-right: 10px">{{ $item->name }}
                                <span>{{ number_format($item->price) }}đ x({{ $item->quantity }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <strong>Tổng cộng:</strong>
                    <strong class="text-danger">{{ number_format($cart->totalPrice) }}đ</strong>
                </div>
                <div class="d-flex gap-2 justify-content-between">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary"><i class="bi bi-pencil"></i>Sửa
                        giỏ hàng</a>
                    <form class="" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger text-white">ĐẶT HÀNG</button>
                    </form>

                </div>
                <div class="mt-3 text-muted small">
                    <p>– Giá trên chưa bao gồm phí vận chuyển.</p>
                    <p>– Xử lý đơn hàng: Từ 8h-17h T2–T7. Đơn hàng sau thời gian này sẽ được xử lý vào ngày làm việc tiếp
                        theo.</p>
                </div>
            </div>

        </div>
    </div>
@endsection

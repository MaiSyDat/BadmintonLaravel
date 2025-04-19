@extends('Frontend.Home.main')

@section('content')
    <div class="container py-5">
        <h4 class="mb-4">
            <i class="bi bi-file-earmark-text"></i> Đặt hàng thành công!
        </h4>

        <!-- Thông tin đơn hàng -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2">
                <i class="bi bi-receipt-cutoff"></i> Thông tin đơn hàng
            </h5>
            <div class="row">
                <div class="col-md-8">
                    <p><i class="bi bi-upc-scan"></i> <strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                    <p><i class="bi bi-calendar3"></i> <strong>Ngày đặt:</strong>
                        {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><i class="bi bi-chat-text"></i> <strong>Ghi chú:</strong> {{ $order->note ?? 'Không có' }}</p>
                </div>
                <div class="col-md-4">
                    <p><i class="bi bi-bag-check"></i> <strong>Tổng số lượng:</strong> {{ $order->total_quantity }}</p>
                    <p><i class="bi bi-cash-stack"></i> <strong>Tổng tiền:</strong>
                        <span class="text-danger fw-bold">
                            {{ number_format($order->total_price, 0, ',', '.') }} ₫
                        </span>
                    </p>
                    <p>
                        <i class="bi bi-credit-card"></i> <strong>Thanh toán:</strong>
                        <span class="badge bg-{{ $order->status_payment ? 'success' : 'warning' }}">
                            <i class="bi bi-{{ $order->status_payment ? 'check-circle' : 'exclamation-circle' }}"></i>
                            {{ $order->status_payment ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </p>
                    <p>
                        <i class="bi bi-truck"></i> <strong>Vận chuyển:</strong>
                        <span class="badge bg-{{ $order->status_transport ? 'info' : 'secondary' }}">
                            <i class="bi bi-{{ $order->status_transport ? 'truck' : 'clock' }}"></i>
                            {{ $order->status_transport ? 'Đang giao' : 'Chờ xử lý' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="mb-4">
            <h5 class="border-bottom pb-2">
                <i class="bi bi-box-seam"></i> Sản phẩm đã đặt
            </h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-box"></i> Tên sản phẩm</th>
                            <th><i class="bi bi-123"></i> Số lượng</th>
                            <th><i class="bi bi-cash-coin"></i> Giá</th>
                            <th><i class="bi bi-percent"></i> Giảm giá</th>
                            <th><i class="bi bi-wallet2"></i> Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                            <tr>
                                <td class="text-start">{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->product->price, 0, ',', '.') }} ₫</td>
                                <td>{{ $detail->product->sale }}%</td>
                                <td class="text-danger fw-bold">
                                    {{ number_format($detail->total_price, 0, ',', '.') }} ₫
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="text-danger fw-bold">
                                {{ number_format($order->total_price, 0, ',', '.') }} ₫
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Tiếp tục mua hàng
            </a>
        </div>
    </div>
@endsection

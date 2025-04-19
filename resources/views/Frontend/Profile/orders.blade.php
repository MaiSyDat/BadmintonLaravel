@extends('Frontend.Profile.index')
@section('profile_content')
    <div class="container mt-5 mb-5">
        <h4 class="mb-4"><i class="bi bi-list-ul"></i> Danh sách đơn hàng của bạn</h4>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-hash"></i> Mã đơn</th>
                        <th><i class="bi bi-calendar-check"></i> Ngày đặt</th>
                        <th><i class="bi bi-plus-square"></i> Số lượng</th>
                        <th><i class="bi bi-currency-dollar"></i> Tổng tiền</th>
                        <th><i class="bi bi-credit-card-2-front"></i> Thanh toán</th>
                        <th><i class="bi bi-eye"></i> Xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $order->total_quantity }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} ₫</td>
                            <td>
                                <span class="badge bg-{{ $order->status_payment ? 'success' : 'warning' }}">
                                    {{ $order->status_payment ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('profile.orderDetail', $order->id) }}"
                                    class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('backend.dashboard.home.main')
@section('content')
    <div class="container">
        <h2 class="mb-4">📦 Quản lý đơn hàng</h2>

        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Số SP</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Giao hàng</th>
                    <th>Thời gian</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            <strong>{{ $order->user->name }}</strong><br>
                            <i class="bi bi-telephone-fill"></i> {{ $order->user->phone }}
                        </td>
                        <td class="text-center">{{ $order->total_quantity }}</td>
                        <td>{{ number_format($order->total_price) }} <sup>đ</sup></td>
                        <td>
                            @if ($order->status_payment == 1)
                                <span class="badge badge-success"><i class="bi bi-check-circle"></i> Đã thanh toán</span>
                            @else
                                <span class="badge badge-warning text-white"><i class="bi bi-clock"></i> Chưa thanh
                                    toán</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->status_transport == 0)
                                <span class="badge badge-secondary"><i class="bi bi-truck"></i> Chờ giao</span>
                            @elseif($order->status_transport == 1)
                                <span class="badge badge-primary"><i class="bi bi-truck-front"></i> Đã giao</span>
                            @else
                                <span class="badge badge-danger"><i class="bi bi-x-circle"></i> Huỷ</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('ordersManager.show', $order->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Xem
                            </a>
                            <a href="#" onclick="return confirm('Bạn chắc muốn xoá đơn này?')"
                                class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Xoá
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
@endsection

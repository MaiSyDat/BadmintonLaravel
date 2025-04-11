@extends('frontend.home.main')
@section('content')
    @include('Frontend.Layout.banner')
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="service-box">
                    <i class="bi bi-truck"></i>
                    <div>
                        <h5>Vận chuyển <b>TOÀN QUỐC</b></h5>
                        <p>Thanh toán khi nhận hàng</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box">
                    <i class="bi bi-patch-check"></i>
                    <div>
                        <h5>Bảo đảm chất lượng</h5>
                        <p>Sản phẩm bảo đảm chất lượng.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box">
                    <i class="bi bi-credit-card"></i>
                    <div>
                        <h5>Tiến hành <b>THANH TOÁN</b></h5>
                        <p>Với nhiều <b>PHƯƠNG THỨC</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-box">
                    <i class="bi bi-arrow-repeat"></i>
                    <div>
                        <h5>Đổi sản phẩm mới</h5>
                        <p>nếu sản phẩm lỗi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <h2 class="text-center text-dark">🔥 FLASH <span class="text-danger">SALE</span> GIÁ SỐC 🔥</h2>
        <div class="scroll-indicator"></div>
        <div class="text-center mt-4">
            <h4>Ưu đãi kết thúc sau:</h4>
            <div class="countdown" id="countdown">
                <span id="hours">07</span> Giờ : <span id="minutes">50</span> Phút : <span id="seconds">15</span>
                Giây
            </div>
        </div>
        <div class="flash-sale p-4 mt-3">
            <div class="row">
                @foreach ($discountedProducts as $product)
                    <div class="col-md-3">
                        <a href="{{ route('product.show', $product->id) }}">
                            <div class="product-item bg-white m-2">
                                <div class="product-discount">
                                    <span class="discount">-{{ round($product->sale) }}%</span>
                                </div>
                                <div class="product-image">
                                    <img class="img-fluid" src="{{ asset($product->img) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="product-name">
                                    <p class="truncate-2-lines">{{ $product->name }}</p>
                                </div>
                                <div class="product-price">
                                    <p class="price text-danger">
                                        {{ number_format($product->getDiscountedPrice()) }}đ
                                        <del class="text-muted">{{ number_format($product->price, 0, ',', '.') }} VNĐ</del>
                                    </p>
                                </div>
                                <div class="product-purchase">
                                    <p class="purchase"><i class="bi bi-cart"></i> {{ $product->total_pay }} lượt mua</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Sản phẩm nooit bật --}}
    <div class="container py-4">
        <h2 class="text-center mb-4">SẢN PHẨM NỔI BẬT</h2>
        <div class="scroll-indicator"></div>
        <div class="row">
            @foreach ($featuredProducts as $product)
                <div class="col-md-3">
                    <a href="{{ route('product.show', $product->id) }}">
                        <div class="product-item bg-white m-2">
                            <div class="product-discount">
                                <span class="discount">-{{ round($product->sale) }}%</span>
                            </div>
                            <div class="product-image">
                                <img class="img-fluid" src="{{ asset($product->img) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="product-name">
                                <p class="truncate-2-lines">{{ $product->name }}</p>
                            </div>
                            <div class="product-price">
                                <p class="price text-danger">
                                    {{ number_format($product->getDiscountedPrice()) }}đ
                                    <del class="text-muted">{{ number_format($product->price, 0, ',', '.') }} VNĐ</del>
                                </p>
                            </div>
                            <div class="product-purchase">
                                <p class="purchase"><i class="bi bi-cart"></i> {{ $product->total_pay }} lượt mua</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Về chúng tôi --}}

    <div class="container py-4">
        <div class="about-section light-background">
            <h2>CÂU CHUYỆN VỀ CHÚNG TÔI</h2>
            <div class="scroll-indicator"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <i class="bi bi-award"></i>
                        <p>THƯƠNG HIỆU UY TÍN <br> ĐỨNG ĐẦU VIỆT NAM</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <i class="bi bi-graph-up"></i>
                        <p>7 NĂM PHÁT TRIỂN <br> BỀN VỮNG</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <i class="bi bi-lightbulb"></i>
                        <p>CƠ HỘI THĂNG TIẾN <br> PHÁT TRIỂN BẢN THÂN</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <i class="bi bi-star-fill"></i>
                        <p>SẢN PHẨM CAO CẤP <br> ĐẠT CHUẨN GMP</p>
                    </div>
                </div>
            </div>
            <div class="about-content mt-4">
                <p>
                    Thương hiệu LP Natural Beauty hiện đang là thương hiệu đi đầu trong lĩnh vực chăm sóc da và làm đẹp tại
                    Việt
                    Nam.
                    Với sự tư vấn từ các chuyên gia hàng đầu thế giới, chúng tôi cam kết mang lại sản phẩm chất lượng, đáp
                    ứng
                    tiêu chuẩn GMP.
                </p>
                <p>
                    LP NATURAL BEAUTY VIỆT NAM không ngừng sáng tạo và phát triển, giúp khách hàng trải nghiệm dịch vụ tốt
                    nhất.
                </p>
            </div>
            <button class="btn btn-custom">TÌM HIỂU THÊM</button>
        </div>
    </div>


    <div class="container news-section my-4">
        <h2>Tin tức mới</h2>
        <div class="scroll-indicator"></div>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="news-card mb-2">
                    <img src="backend/img/products/1742891135_1000z.game_.2-1-scaled.jpg" alt="News">
                    <div class="content">
                        <h5>Các Thuật Ngữ Trong Pickleball Mà Người Chơi Cần Phải Biết</h5>
                        <span class="date">26-03-2025 17:29</span>
                        <p>Để chơi tốt bộ môn Pickleball, ngoài việc thường xuyên luyện tập nâng cao kỹ thuật, việc hiểu rõ
                            các...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-card mb-2">
                    <img src="backend/img/products/1742891135_1000z.game_.2-1-scaled.jpg" alt="News">
                    <div class="content">
                        <h5>Review Sân Cầu Lông HAAN BADMINTON CLUB Uy Tín</h5>
                        <span class="date">26-03-2025 09:24</span>
                        <p>Sân cầu lông HAAN BADMINTON CLUB với không gian rộng rãi, cơ sở vật chất sạch đẹp, được biết đến
                            là...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-card mb-2">
                    <img src="backend/img/products/1742891135_1000z.game_.2-1-scaled.jpg" alt="News">
                    <div class="content">
                        <h5>Tổng Hợp Danh Sách Các Sân Cầu Lông Bình Tân Uy Tín, Chất Lượng</h5>
                        <span class="date">26-03-2025 09:23</span>
                        <p>Cầu lông là môn thể thao tuyệt vời và bạn là người cực kỳ đam mê bộ môn này với địa điểm làm việc
                            cù...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-card mb-2">
                    <img src="backend/img/products/1742891135_1000z.game_.2-1-scaled.jpg" alt="News">
                    <div class="content">
                        <h5>Tưng Bừng Khai Trương Cửa Hàng Thể Thao VNB Tân Uyên</h5>
                        <span class="date">18-03-2025 17:12</span>
                        <p>Nhằm mang đến những sản phẩm và dịch vụ chất lượng nhất cho cộng đồng người yêu thể thao tại TP.
                            Tân...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

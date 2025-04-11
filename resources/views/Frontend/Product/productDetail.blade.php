 @extends('frontend.home.main')
 @section('content')
     <!-- Bread-crumb -->
     <div class="container mt-4">
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                 <li class="breadcrumb-item" aria-current="page">Sản phẩm</li>
                 <li class="breadcrumb-item active" aria-current="page">chi tiết sản phẩm</li>
             </ol>
         </nav>
     </div>
     <div class="container my-4">
         <div class="row">
             <!-- Hình ảnh -->
             <div class="col-md-5">
                 <div class="main-image_product position-relative">
                     <img src="{{ asset($product->img) }}" class="img-fluid border" id="main-image">
                     <div class="discount-badge">-{{ $product->sale }}%</div>
                 </div>
                 <div class="d-flex mt-2 gap-2">
                     <div class="product-thumb">
                         <img src="{{ asset($product->img) }}"
                             onclick="document.getElementById('main-image').src=this.src;">
                     </div>
                     @foreach ($img_product as $image_detail)
                         <div class="product-thumb">
                             <img src="{{ asset($image_detail->path) }}"
                                 onclick="document.getElementById('main-image').src=this.src;">
                         </div>
                     @endforeach
                 </div>
             </div>

             <!-- Chi tiết sản phẩm -->
             <div class="col-md-7">
                 <h3 class="product-title">{{ $product->name }}</h3>
                 <p class="text-warning mb-1"><span class="text-muted">Lượt mua: {{ $product->total_pay }}</span></p>
                 <p class="product-price">
                     {{ number_format($product->getDiscountedPrice()) }}đ
                     <span class="old-price">{{ number_format($product->price) }}đ</span>
                 </p>

                 <form action="{{ route('add.cart', $product->id) }}" method="GET" class="">
                     <div class="quantity-wrapper d-flex align-items-center gap-2 my-3">
                         <button class="btn btn-outline-secondary btn-sm" type="button"
                             onclick="decreaseQuantity()">-</button>
                         <input type="number" id="quantityInput" name="quantity" value="1" min="1"
                             class="form-control text-center" style="width: 50px;">
                         <button class="btn btn-outline-secondary btn-sm" type="button"
                             onclick="increaseQuantity()">+</button>
                     </div>
                     <div class="d-flex gap-2 mb-3">
                         <button type="submit" class="btn btn-outline-secondary">Thêm vào giỏ</button>
                         <button class="btn btn-danger text-white" type="button">Mua ngay</button>
                     </div>
                 </form>




                 <div class="offer-box mb-3">
                     <h6>🎁Ưu đãi:</h6>
                     <ul class="list-unstyled">
                         <li>✅Tặng 2 Quấn cán vợt Cầu Lông</li>
                         <li>✅Tặng bao nhung/bảo vệ</li>
                         <li>✅Thanh toán sau khi kiểm tra và nhận hàng (Giao khung vợt)</li>
                         <li>✅Bảo hành chính hãng theo nhà sản xuất (Trừ hàng nội địa, xách
                             tay)</li>
                     </ul>
                 </div>

                 <div class="border rounded p-2">
                     <h6>🎁Ưu đãi thêm khi mua sản phẩm tại DSMASH Premium</h6>
                     <ul class="mb-0 list-unstyled">
                         <li>✅Sơn logo mặt vợt miễn phí</li>
                         <li>✅Thay gen vợt miễn phí trọn đời</li>
                         <li>✅Miễn phí căng cước + tặng phụ kiện</li>
                         <li>✅Freeship đơn > 1 triệu</li>
                         <li>✅Bảo hành 1 đổi 1 trong 90 ngày</li>
                     </ul>
                 </div>
             </div>
         </div>

         <!-- Tabs mô tả sản phẩm -->
         <div class="mt-5">
             <ul class="nav nav-tabs" id="productTab" role="tablist">
                 <li class="nav-item">
                     <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                         type="button" role="tab">Mô tả sản phẩm</button>
                 </li>
                 <li class="nav-item">
                     <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button"
                         role="tab">Video review</button>
                 </li>
                 <li class="nav-item">
                     <button class="nav-link" id="tech-tab" data-bs-toggle="tab" data-bs-target="#tech" type="button"
                         role="tab">Thông số kỹ thuật</button>
                 </li>
                 <li class="nav-item">
                     <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button"
                         role="tab">Đánh giá 5★</button>
                 </li>
             </ul>
             <div class="tab-content border border-top-0 p-3" id="productTabContent">
                 <div class="tab-pane fade show active" id="desc" role="tabpanel">
                     <p>{!! $product->content !!}</p>
                 </div>
                 <div class="tab-pane fade" id="video" role="tabpanel">
                     <p>Đang được cập nhật.</p>
                 </div>
                 <div class="tab-pane fade" id="tech" role="tabpanel">
                     <p>Thông số kỹ thuật: Đang được cập nhật.</p>
                 </div>
                 <div class="tab-pane fade" id="review" role="tabpanel">
                     <p>Đang được cập nhật.</p>
                 </div>
             </div>
         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endsection

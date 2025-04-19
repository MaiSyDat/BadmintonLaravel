<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\orders_detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $config = $this->config();
        $soSanPham = Product::count();
        $luotMua = orders_detail::sum('quantity');
        $soNguoiDung = User::count();
        $doanhThu = Orders::where('status_payment', 'completed')->sum('total_price');

        return view('backend.dashboard.index', compact('config', 'soSanPham', 'luotMua', 'soNguoiDung', 'doanhThu'));
    }

    private function config()
    {
        return [
            'js' => [
                "backend/vendor/jquery/jquery.min.js",
                "backend/vendor/bootstrap/js/bootstrap.bundle.min.js",
                "backend/vendor/jquery-easing/jquery.easing.min.js",
                "backend/js/sb-admin-2.min.js",
                "backend/vendor/chart.js/Chart.min.js",
                "backend/js/demo/chart-area-demo.js",
                "backend/js/demo/chart-pie-demo.js",
            ]
        ];
    }
}

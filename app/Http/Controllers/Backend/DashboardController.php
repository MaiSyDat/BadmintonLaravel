<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $config = $this->config();

        return view('backend.dashboard.index', compact('config'));
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

<?php

namespace Phambinh\Cms\Core\Http\Controllers;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
    /**
     * Biến lưu chuyển dữ liệu
     * @var array
     */
    protected $data = [];

    public function __construct()
    {
        \Metatag::set('title', setting('company-name'));
        \Metatag::set('_base_url', url('/'));

        // Gọi action khởi chạy app
        do_action('app.init');

        // Gọi action đóng app
        do_action('app.destroy');
    }
}

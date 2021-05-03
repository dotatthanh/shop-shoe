<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DashboardController extends AppController
{
    public function index() {
        return view('admin::dashboard.index');
    }
}

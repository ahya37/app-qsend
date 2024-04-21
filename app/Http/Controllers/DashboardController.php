<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Qr code'
        ];
        return view('whatsapp.qrcode-create', $data);
    }
}

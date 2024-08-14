<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Route;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['rute'] = Route::with('transportation')->get();
        $data['content'] = ['slider','list'];
        return view('home.user.template', $data);
    }
}

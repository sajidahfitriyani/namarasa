<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['table', 'orders'])->get();
        return view('admin.index', compact('reservations'));
    }
}

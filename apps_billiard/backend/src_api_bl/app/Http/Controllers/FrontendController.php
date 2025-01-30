<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Layanan;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $abouts = About::all();
        $layanans = Layanan::all();
        $pertandingans = Pertandingan::with(['clientA', 'clientB'])->get();
        return view('frontend.index', compact('abouts', 'layanans', 'pertandingans'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tintuc() {
        return view('pages.tintuc');
    }

    public function gioithieu() {
        return view('pages.gioithieu');
    }

    public function lienhe() {
        return view('pages.lienhe');
    }
}
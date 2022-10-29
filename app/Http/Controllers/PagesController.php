<?php

namespace App\Http\Controllers;

use App\Models\CompanyA;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $lists = CompanyA::first();

        return view('index', compact('lists'));
    }
}

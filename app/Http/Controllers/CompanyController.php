<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company.home'); // will look in resources/views/company/home.blade.php
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{

    public function unavailable()
    {
        return view('dashboard.services.unavailable');
    }

}

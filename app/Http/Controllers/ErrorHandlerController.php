<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorHandlerController extends Controller
{
    public function e_404(){
        return redirect()->route('e404');
    }
}

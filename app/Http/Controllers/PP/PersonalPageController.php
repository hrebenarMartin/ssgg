<?php

namespace App\Http\Controllers\PP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonalPageController extends Controller
{
    public function hrebenar(){
        return view('pp.hrebenar');
    }
}

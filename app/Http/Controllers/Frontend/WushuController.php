<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WushuController extends Controller
{
    //
    function test(){
        $data=[1,2,3];
        return Inertia::render('frontend/wushu/Cart',[
            'response'=>$data,
        ]);
    }
}

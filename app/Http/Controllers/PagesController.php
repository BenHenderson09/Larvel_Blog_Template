<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /*  --- Returning views with data: ---
        return view('pages.mypage', compact('myvar', 'mysecondvar'));
        return view('pages.mypage') -> with('myvar', $myvar); 

        --- Arrays: ---
        $myArr = [ "first" => 1, "second" => 2 ];
        return view('pages.mypage') -> with($myArr); // Accessed like: `echo $first;` (1)
    */

    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function guidelines(){
        return view('pages.guidelines');
    }
}

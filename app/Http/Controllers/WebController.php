<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    
    public function suma($num1,$num2){
     
      return view('suma',compact('num1','num2'));
 
    }

}

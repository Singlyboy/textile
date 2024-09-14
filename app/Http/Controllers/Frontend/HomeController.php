<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
      
        return view("frontend.home");    
    }

    public function new(){
        $allParts = Part::all();
        return view("frontend.newparts",compact('allParts'));  
    }
    public function partsUnderCategory($id)
    {
      
        $parts=Part::where('category_id',$id)->get();

       return view('frontend.pages.parts-under-category',compact('parts'));

    }
}

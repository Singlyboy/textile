<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function allParts()
    {
        $parts=Part::all();
        return response()->json($parts);
    }
}

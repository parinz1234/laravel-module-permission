<?php

namespace App\Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function test ()
    {
        // dd('Test Controller!');
        return view('blog::test');
    }
}

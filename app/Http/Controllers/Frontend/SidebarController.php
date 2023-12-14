<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Genre;

class SidebarController extends Controller
{
    public function showSidebar()
    {

        return view('frontend.layout.right_siderbar', compact('genres','posts'));
    }
}

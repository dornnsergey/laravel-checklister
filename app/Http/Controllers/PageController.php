<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function welcome()
    {
        $page = Page::findOrFail(1);

        return view('pages.welcome', compact('page'));
    }

    public function consultation()
    {
        $page = Page::findOrFail(2);

        return view('pages.consultation', compact('page'));
    }
}

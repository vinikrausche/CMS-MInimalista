<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function fall($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if ($page) {
            switch ($slug) {
                case 'contato':
                    return view('site.contato', ['page' => $page]);
                    break;
                case 'sobre-mim':
                    return view('site.page', ['page' => $page]);
                    break;
            }
        } else {
            abort(404);
        }
    }
}

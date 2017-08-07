<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RssController extends Controller
{
    public function index()
    {
        ini_set('allow_url_fopen', 1);
        ini_set('allow_url_include', 1);

        $rss = simplexml_load_file("https://news.google.com/news/section?cf=all&hl=pt-BR&pz=1&ned=pt-BR_br&topic=n&output=rss");

        $limit = 10;
        $count = 0;

        return view('rss', compact('rss', 'limit', 'count'));
    }
}

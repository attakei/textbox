<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ArticleTag;


class TagController extends Controller
{
    /**
     * 表示可能な記事リストを表示する。
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $tags = ArticleTag::calcSummaryLeast()->get();

        // Render articles
        return view('tag.list', [
            'tags' => $tags,
        ]);
    }

}

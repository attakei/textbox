<?php
/**
 * ログイン後のダッシュボードなど、特定の何かを扱わないページなどのコントローラはここに記述
 *
 */
namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\Article;
use App\ArticleTag;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ダッシュボード
     * - ログイン処理後に遷移するページ
     * - 次の条件の記事のタイトルが表示される
     *     - 最近更新された記事
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $latestArticles = Article::latestInternal()->limit(5)->get();
        $tagSummary = ArticleTag::calcSummaryLeast()->limit(10)->get();

        return view('home.dashboard', [
            'tagSummary' => $tagSummary,
            'latestArticles' => $latestArticles,
        ]);
    }


    /**
     * マイページ
     * - 下書き含むリスト
     * @return \Illuminate\Http\Response
     */
    public function mypage()
    {
        $authoredArticles = Article::latestAuthor(Auth::user())->get();

        return view('home.mypage', [
            'authoredArticles' => $authoredArticles,
        ]);
    }
}

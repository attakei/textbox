<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class ArticleTag extends Model
{
    protected $primaryKey = ['article_id', 'sort_num'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'sort_num', 'body',
    ];

    public function article()
    {
        return $this->belongsTo(\App\Article::class);
    }

    /**
     * タグの使用数を集計する
     * - 下書きのものは公開対象外にする
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public static function calcSummaryLeast()
    {
        // TODO: Eloquentの記法で書けない？
        return DB::table('article_tags')
            ->join('articles', 'article_tags.article_id', '=', 'articles.id')
            ->select(
                'article_tags.body as body'
                , DB::raw('COUNT(*) as count')
                , DB::raw('MAX(articles.updated_at) as least_updated')
                )
            ->where('articles.status', '!=', 'draft')
            ->groupBy('article_tags.body')
            ->orderBy('least_updated', 'desc');
    }
}

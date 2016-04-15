<?php

use Illuminate\Support\Facades\DB;
use \App\User;
use \App\Article;
use \App\ArticleTag;


class ArticleTagTest extends \TestCase
{
    protected function injectTestData()
    {
        DB::transaction(function ()
        {
            User::create(['name'=>'test_user_1', 'email' => 'user1@example.com', 'password' => '']);
            $article = Article::create(
                ['title' => 'test title1', 'body' => 'test', 'status' => 'internal', 'author_id' => 1,]
            );
            $article->save();
            for ($num = 1 ; $num <= 5; $num++) {
                $article->tags()->create(['sort_num' => $num, 'body' => 'tag'.$num]);
            }
        });
    }


    /**
     * testing Article::updateTags
     *
     * @return void
     */
    public function testUpdateTags()
    {
        $this->injectTestData();
        $article = Article::find(1);
        $article->updateTags(['xxx']);
        $article = Article::find(1);
        $this->assertEquals(count($article->tags), 1);
    }

    /**
     * testing Article::updateTags
     *
     * @return void
     */
    public function testTagsForForm()
    {
        $this->injectTestData();
        $article = Article::find(1);
        $article->updateTags([]);
        $article->save();
        $this->assertEquals($article->tagsForInput(), '');
        $article->updateTags(['foo']);
        $article->save();
        $article = Article::find(1);
        $this->assertEquals($article->tagsForInput(), 'foo');
        $article->updateTags(['foo', 'bar']);
        $article = Article::find(1);
        $this->assertEquals($article->tagsForInput(), 'foo,bar');
    }

    public function testCalcCurrentSummary()
    {
        $this->injectTestData();
        // 追加登録
        DB::transaction(function ()
        {
            $article = Article::create(
                ['title' => 'test title2', 'body' => 'test2', 'status' => 'draft', 'author_id' => 1,]
            );
            $article->save();
            for ($num = 1 ; $num <= 5; $num++) {
                $article->tags()->create(['sort_num' => $num, 'body' => 'tag'.$num]);
            }
            sleep(1);
            $article = Article::create(
                ['title' => 'test title3', 'body' => 'test3', 'status' => 'internal', 'author_id' => 1,]
            );
            $article->save();
            $article->tags()->create(['sort_num' => 1, 'body' => 'tag5']);
        });
        $summary = ArticleTag::calcSummaryLeast()->first();
        $this->assertEquals($summary->body, 'tag5');
        // draftのものはタグとして数えない
        $this->assertEquals($summary->count, 2);
    }
}

@extends('layouts.2paned')

@section('content.main')
<h2>最近の記事</h2>

@foreach($latestArticles as $article)
    <div class="well well-sm">
        <h3><a href="{{ route('get_article_single', $article->id) }}">{{ $article->title }}</a></h3>
        <div class="row">
            <div class="col-xs-6">
            @foreach($article->tags as $tag)
            <a href="{{ route('list_by_tag', ['tagBody' => $tag->body ])}}"><span class="label label-info">{{ $tag->body }}</span></a>
            @endforeach
            </div>
            <div class="col-xs-6">
            <p class="text-right">
                by {{ $article->author->name }}
                at {{ $article->updated_at}}
            </p>
            </div>
        </div>
    </div>
@endforeach
<p style="text-align: right;"><a href="{{ route('get_article_list') }}">...もっと見る</a></p>
@endsection

@section('content.sub')
@include('snippets.tags_least', ['latestTags' => $tagSummary])
@endsection

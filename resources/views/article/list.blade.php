@extends('layouts.2paned')

@section('content.title')
<h1>@yield('title', '最近の記事') ({{ $articles->currentPage() }}/{{$articles->lastPage()}})</h1>
@endsection

@section('content.main')
@foreach($articles as $article)
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
<nav>
    <ul class="pagination pagination-sm">
        @if($articles->currentPage() == 1)
            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        @else
            <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        @endif
        @for($page = 1; $page <= $articles->lastPage(); $page++)
            @if($page == $articles->currentPage())
                <li class="active"><a href="#">{{$page}} <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ $articles->url($page) }}">{{$page}}</a></li>
            @endif
        @endfor
        @if($articles->currentPage() == $articles->lastPage())
            <li class="disabled"><a href="#" aria-label="Following"><span aria-hidden="true">&raquo;</span></a></li>
        @else
            <li><a href="#" aria-label="Following"><span aria-hidden="true">&raquo;</span></a></li>
        @endif
    </ul>
</nav>
@endsection

@section('content.sub')
@include('snippets.tags_least', ['latestTags' => $tagSummary])
@endsection

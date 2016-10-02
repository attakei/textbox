@extends('layouts.2paned')

@section('content.title')
<h1>
    {{ $article->title }}
</h1>
<hr>
<p>
    @foreach($article->tags as $tag)
    <a href="{{ route('list_by_tag', ['tagBody' => $tag->body ])}}">
        <span class="label label-info">{{ $tag->body }}</span>
    </a>
    @endforeach
    <br>
    {{ $article->author->name }} が
    {{ $article->created_at}} に作成
    @if($article->created_at != $article->updated_at)
    {{ $article->updated_at}} に更新
    @endif
</p>
@if($article->author->id == Auth::user()->id)
<form action="{{ '/articles/' . $article->id . '/_edit' }}">
    <button type="submit" class="btn btn-default pull-right">編集する</button>
</form>
@endif
<hr>
{{-- フラッシュメッセージの表示 --}}
@if (Session::has('flash_message'))
<div class="alert alert-success">{{ Session::get('flash_message') }}</div>
@endif
@endsection

@section('content.main')
<div class="page-content">
{!! $contentDom->saveHTML() !!}
</div>

<hr><hr>

{{--
<div class="page-comment">
    @foreach($article->comments as $comment)
    <div class="well well-sm" id="{{ 'comment'.$comment->id }}">
        <p><strong>{{$comment->body}}</strong></p>
        <p class="text-right">by {{$comment->user->name}}</p>
    </div>
    @endforeach
    <h3>コメントする</h3>
    <form action="{{ '/articles/' . $article->id . '/comments/_new' }}" method="POST">
        {!! csrf_field() !!}

        <div class="form-group">
            <input class="form-control" type="text" name="articleComment" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">コメント</button>
        </div>

    </form>
</div>
--}}
@endsection

@section('content.sub')
<h3>見出し</h3>
<div>
    {!! $headlineDom->saveHTML() !!}
</div>
@endsection

@section('page_js')
<script>
var articleJson = JSON.parse({!! json_encode($article) !!});
</script>
@endsection

@section('page_css')
<style>
.page-content img {
    position: relative;;
    width: 100%;

}
.code-frame {
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    margin: 1em 0;
    background-color: #f7f7f7;
    line-height: 0;
    overflow: hidden
}

.code-frame pre {
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border: 0;
    margin: 0;
    padding: 8px 15px;
    line-height: 18px;
    background-color: #f7f7f7;
    font-family: Consolas, "Liberation Mono", Menlo, Courier, monospace;
    overflow-x: scroll;
    word-wrap: normal;
    white-space: pre
}

.code-lang {
    color: #555;
    display: inline-block;
    padding: 3px 6px;
    margin: 0;
    line-height: 1;
    background-color: rgba(0, 0, 0, 0.07);
    font-size: 12px;
    font-weight: 400
}
</style>
@endsection

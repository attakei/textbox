@extends('layouts.2paned')

@section('content.title')
<h1>@yield('title', 'タグ一覧')</h1>
@endsection

@section('content.main')
@foreach($tags as $tag)
    <div class="well well-sm">
        <h3><a href="{{ route('list_by_tag', $tag->body) }}">{{ $tag->body }}</a></h3>
        <p>{{ $tag->count }}件の記事に登録されています</p>
    </div>
@endforeach
@endsection

@section('content.sub')
@endsection

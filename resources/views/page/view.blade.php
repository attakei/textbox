@extends('layouts.2paned')

@section('content.title')
<h1>
    {{ $page->title }}
</h1>
<hr>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @yield('content.title')
    </div>

    <view-markdown></view-markdown>
@endsection

@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/riot/2.5.0/riot+compiler.min.js"></script>
<script src="/js/article.js"></script>
<script type="riot/tag" src="/tag/view-markdown.tag"></script>

<script>
var pageJson = {!! json_encode($page) !!};
riot.mount('view-markdown', pageJson);
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

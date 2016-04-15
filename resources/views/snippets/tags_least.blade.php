<h3>タグ</h3>
<ul>
    @foreach($latestTags as $tag)
    <li><a href="{{ route('list_by_tag', $tag->body) }}">{{ $tag->body }} [{{ $tag->count }}]</a></li>
    @endforeach
</ul>
<p style="text-align: right;"><a href="{{ route('get_tags_list') }}">...もっと見る</a></p>

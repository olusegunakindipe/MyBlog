<div class="tags-wrap" style="margin-left:300px">
    @foreach($tags as $tag)
        <a href="{{route('single.tag',$tag->id)}}" class="w-tags-item ">{{$tag->tag}}</a>
    @endforeach
</div>
//Praktikum presentasi 5 
<div>
    <p>Haiii</p>
    @foreach ($posts as $post)
        <h2>{{ $post-> title }}</h2>
        @if ($post->content)
        <span>{{$post->content }}</span>
        @else 
        <span>Haiii</span>
        @endif
    @endforeach

    @php
        echo "hello";
    @endphp

    @datetime($post->created_at)
</div>

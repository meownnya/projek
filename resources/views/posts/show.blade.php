<h1>{{ $post->title }}</h1>
<p>{{ $post->description }}</p>
@if ($post->music)
    <audio controls>
    <source src="/music/{{ $post->music }}/" type="audio/mpeg"></source>
    </audio>
@endif

@foreach ($post->photos as $photo)
    <img src="/photos/{{ $photo->photo_path }}"  class="border p-2 m-3" style="width: 200px;" alt="{{ $post->title }}">
@endforeach
<p>{{ \Carbon\Carbon::parse($post->from_date)->isoFormat('DD MMMM Y')}}</p>

<a href="{{ route('posts.edit', $post->id) }}">Edit</a>
<a href="{{ route('posts.index') }}">Back</a>

<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

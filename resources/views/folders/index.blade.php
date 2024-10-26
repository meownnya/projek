@extends('layouts.navbar')

@section('content')

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($folders->count() > 0)
        @foreach ($folders as $folder)
            <div>
        
                <div>{{ $folder->posts->count() }}</div>

             
                @if ($folder->posts->count() > 0 && $folder->posts->first()->photos->count() > 0)
                    <div>

                        <a href="{{ route('folders.show', $folder->id) }}">
                            <img src="{{ asset('/storage/uploads/photos/' . $folder->posts->first()->photos->first()->photo_path) }}" 
                                 alt="Folder Photo">
                        </a>
                    </div>
                @else
                    <p>No photo available.</p>
                @endif

                <div>{{ $folder->title }}</div>

                <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Folder</button>
                </form>
            </div>
        @endforeach
    @else
        <p>No folders available.</p>
    @endif

@endsection

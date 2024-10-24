@extends('layouts.navbar')

@section('content')

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Loop untuk menampilkan folder -->
    @if ($folders->count() > 0)
        @foreach ($folders as $folder)
            <div>
                <!-- Tampilkan jumlah postingan di pojok kanan atas menimpa foto -->
                <div>{{ $folder->posts->count() }}</div>

                <!-- Tampilkan foto pertama dari posting dalam folder -->
                @if ($folder->posts->count() > 0 && $folder->posts->first()->photos->count() > 0)
                    <div>
                        <!-- Saat foto dipencet, masuk ke folder detail (folders.show) -->
                        <a href="{{ route('folders.show', $folder->id) }}">
                            <img src="{{ asset('/storage/uploads/photos/' . $folder->posts->first()->photos->first()->photo_path) }}" 
                                 alt="Folder Photo">
                        </a>
                    </div>
                @else
                    <p>No photo available.</p>
                @endif

                <!-- Judul folder -->
                <div>{{ $folder->title }}</div>
            </div>
        @endforeach
    @else
        <p>No folders available.</p>
    @endif
@endsection

@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <style>
        .folder-card {
            position: relative;
            width: 220px;
            margin: 20px;
            display: inline-block;
            text-align: center;
        }
        .post-count {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #f00;
            color: #fff;
            padding: 5px;
            border-radius: 50%;
            z-index: 10;
            font-size: 14px;
        }
        .folder-photo img {
            width: 200px;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        .folder-title {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>



    <!-- Loop untuk menampilkan folder -->
    @if ($folders->count() > 0)
        @foreach ($folders as $folder)
            <div class="folder-card">
                <!-- Tampilkan jumlah postingan di pojok kanan atas menimpa foto -->
                <div class="post-count">{{ $folder->posts->count() }}</div>

                <!-- Tampilkan foto pertama dari posting dalam folder -->
                @if ($folder->posts->count() > 0 && $folder->posts->first()->photos->count() > 0)
                    <div class="folder-photo">
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
                <div class="folder-title">{{ $folder->title }}</div>
            </div>
        @endforeach
    @else
        <p>No folders available.</p>
    @endif
@endsection

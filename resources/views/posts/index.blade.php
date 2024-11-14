@extends('lay.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Link ke Google Fonts dan Bootstrap Icons -->
<link href="https://fonts.googleapis.com/css2?family=Gamja+Flower&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

<!-- Tambahkan CSS di sini -->
<style>
    /* Menggunakan font 'Gamja Flower' untuk seluruh halaman */
    body {
        font-family: 'Gamja Flower', cursive;
    }

    .posts-container {
        padding-top: 78px; 
        column-count: 4;
        column-gap: 1rem;
        max-width: 100%;
        margin: auto;
    }

    .post-item {
        display: inline-block;
        width: 100%;
        margin-bottom: 1px;
        overflow: hidden;
        border-radius: 8px;
        background: none;
        position: relative;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    }

    .post-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 8px;
        transition: transform 0.2s ease, filter 0.2s ease;
    }

    /* Animasi hover untuk elemen post-item */
    .post-item:hover {
        transform: scale(1.05); /* Efek zoom sedikit */
        background-color: #f7f7f7; /* Menambahkan background yang lebih terang */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
    }

    .post-item:hover .post-image {
        transform: scale(1.03); /* Memperbesar gambar sedikit */
        filter: brightness(0.95); /* Mengurangi kecerahan sedikit */
    }

    .post-title, .post-folder {
        padding: 0.1rem 0;
        margin: 0;
        text-align: left;
        transition: color 0.3s ease; /* Efek perubahan warna pada teks */
    }

    .post-title {
        font-size: 1.2rem; /* Membuat judul sedikit lebih besar */
        font-weight: bold;
        color: #333;
    }

    .post-folder {
        font-size: 1em; /* Membuat folder sedikit lebih besar */
        color: #777;
        margin-top: -0.2rem; /* Menambahkan margin negatif agar folder lebih dekat dengan title */
    }

    /* Efek perubahan warna pada teks judul dan folder saat hover */
    .post-item:hover .post-title {
        color: #007bff; /* Mengubah warna judul saat hover */
    }

    .post-item:hover .post-folder {
        color: #555; /* Mengubah warna folder saat hover */
    }

    /* Pusatkan pesan 'No posts found' */
    .no-posts {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 60vh;
        font-size: 1.5rem;
        color: #777;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .posts-container {
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .posts-container {
            column-count: 1;
        }
    }
</style>

<div class="posts-container">
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="post-item">
                <a href="{{ route('posts.show', $post->id) }}">
                    <img src="{{ asset('storage/uploads/photos/' . ($post->photos->first()->photo_path ?? 'default.jpg')) }}" 
                         alt="{{ $post->title }}" class="post-image">
                </a>
                <h2 class="post-title">{{ $post->title }}</h2>
                <p class="post-folder">
                    <i class="bi bi-folder-fill"></i> <!-- Ikon folder dari Bootstrap Icons -->
                    {{ $post->folders->isNotEmpty() ? $post->folders->first()->title : 'None' }}
                </p>
            </div>
        @endforeach
    @else
        <div class="no-posts">No posts found.</div>
    @endif
</div>

@endsection

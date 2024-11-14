<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- Google Font: Gamja Flower -->
<link href="https://fonts.googleapis.com/css2?family=Gamja+Flower&display=swap" rel="stylesheet">

<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-header text-center">
            <a href="{{ route('posts.index') }}">
                <img src="{{ asset('/images/lohm.png') }}" alt="Logo" class="logo">
            </a>
        </div>

        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}" class="form-control search-input">
            <button type="submit" class="btn btn-search"><i class="bi bi-search"></i></button>
        </form>

        <!-- Navigation Links -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('posts.index') }}" class="nav-link {{ request()->is('posts') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Memories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('folders.index') }}" class="nav-link {{ request()->is('folders') ? 'active' : '' }}">
                    <i class="bi bi-folder-fill"></i> Folders
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" id="create-toggle" onclick="toggleDropdown('create-dropdown')">
                    <i class="bi bi-plus-square"></i> Create
                </a>
                <ul class="dropdown-menu" id="create-dropdown">
                    <li><a href="{{ route('posts.create') }}" class="dropdown-item">
                        <i class="bi bi-chevron-compact-right"></i>Memories</a></li>
                    <li><a href="{{ route('folders.create') }}" class="dropdown-item">
                        <i class="bi bi-chevron-compact-right"></i>Folders</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" id="account-toggle" onclick="toggleDropdown('account-dropdown')">
                    <i class="bi bi-person-circle"></i> Account
                </a>
                <ul class="dropdown-menu" id="account-dropdown">
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                            <i class="bi bi-box-arrow-left me-2"></i>Logout
                        </a>
                    </li>
                    <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
          
                <div class="cat-container">
                    <video src="{{ asset('/images/cae.mp4') }}" class="black-cat" autoplay loop muted>
                       
                    </video>
                </div>
                

            </li>
        </ul>
    </nav>

    <!-- Navbar -->
    <div class="navbar navbar-custom">
        <button class="hamburger-btn" onclick="toggleSidebar()">
            <i class="bi bi-list"></i> <!-- Hamburger Icon -->
        </button>
        {{ Auth::user()->name }} Memories
        <img src="{{ asset('/images/hml.png') }}" class="hml-logo">
    </div>

    <!-- Main content area -->
    <div id="content" class="content">
        <!-- Main content here -->
    </div>
</div>

<style>
    /* Sidebar Styling */
    body {
        font-family: 'Gamja Flower', cursive;
        margin: 0;
        padding: 0;
        display: flex;
        background-color: #f2f4f5;
    }

    .sidebar {
        min-width: 260px;
        max-width: 260px;
        height: 100vh;
        background-color: #ffffff;
        border-right: 1px solid #ddd;
        padding-top: 10px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        font-family: 'Gamja Flower', cursive;
        font-size: 1.3rem;
        color: #333;
        transition: transform 0.3s ease;
    }

    .cat-container {
    position: absolute;
    top: 90px; /* Adjust vertical position */
    left: 70px;   /* Keep it near the left edge of the sidebar */
    transform: translateX(-40px); /* Shift it slightly to the left */
    z-index: 500; /* Ensure it's above other elements */
}

.black-cat {
    width: 200px; /* Increased size */
    height: auto;
    animation: jump 1s ease-in-out infinite alternate;
}

@keyframes jump {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
}

    .sidebar-header {
        padding: 10px 15px;
    }

    .logo {
        width: 120px;
        height: auto;
    }

    .search-form {
        display: flex;
        align-items: center;
        padding: 10px 15px;
    }

    .search-input {
        border: 2px solid #ccc;
        border-radius: 30px;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
        flex-grow: 1;
        transition: all 0.3s ease;
        color: #333;
    }

    .search-input::placeholder {
        color: #aaa;
        font-style: italic;
    }

    .search-input:focus {
        border-color: #ccc;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-search {
        background-color: transparent;
        color: #333;
        border: none;
        padding: 0 10px;
        font-size: 18px;
        cursor: pointer;
    }

    .btn-search:hover {
        color: #007acc;
    }

    .nav-link {
        color: #333;
        font-weight: 600;
        padding: 10px 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-link:hover, .nav-link.active {
        background-color: #f0f0f0;
        color: #007acc;
    }

    /* Dropdown Menu Styling */
    .dropdown-menu {
        font-size: 1.3rem;
        position: relative;
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 0;
        min-width: 100%;
        border-radius: 5px;
        max-height: 0;
        opacity: 0;
        transform: translateY(-10px);
        transition: max-height 0.5s ease-out, opacity 0.3s ease-out, transform 0.3s ease-out;
    }

    .dropdown-menu.show {
        max-height: 200px;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-item {
        color: #333;
    }

    .dropdown-item:hover {
        background-color: #f2f4f5;
        color: #007acc;
    }

    /* Navbar Styling */
    .navbar-custom {
        font-family: 'Gamja Flower', cursive;
        font-size: 1.5rem;
        background-color: #ffffff;
        color: #333;
        padding: 10px;
        text-align: center;
        position: fixed;
        top: 0;
        left: 260px; /* Align with sidebar */
        z-index: 1000;
        width: calc(100% - 260px); /* Adjust to sidebar width */
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between; /* Align content and logo to both ends */
        align-items: center;
    }

    .hml-logo {
        width: 40px; /* Perkecil ukuran gambar */
        height: auto;
        position: absolute;
        top: 10px; /* Posisi vertikal dari atas */
        right: 10px; /* Posisi horizontal dari kanan */
    }

    /* Hamburger Button */
    .hamburger-btn {
        display: none;
        font-size: 30px;
        background: none;
        border: none;
        cursor: pointer;
        color: #333;
        margin-left: 15px;
    }

    /* Content */
    .content {
        margin-top: 60px; /* Offset for navbar */
        margin-left: 230px; /* Align with sidebar */
        padding: 20px;
        width: calc(100% - 260px); /* Avoid sidebar overlap */
        background-color: #f2f4f5;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: static;
            display: none; /* Sidebar defaultnya disembunyikan di mobile */
        }

        .sidebar.active {
            display: block; /* Sidebar muncul ketika diaktifkan */
        }

        .navbar-custom {
            width: 100%;
            left: 0;
        }

        .hml-logo {
            width: 30px; /* Ukuran lebih kecil pada layar kecil */
        }

        .content {
            margin-left: 0;
            width: 100%;
        }

        /* Menampilkan tombol hamburger di layar kecil */
        .hamburger-btn {
            display: block;
        }
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }

    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const allDropdowns = document.querySelectorAll('.dropdown-menu');
        
        allDropdowns.forEach(menu => {
            if (menu !== dropdown) {
                menu.classList.remove('show');
            }
        });

        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
</script>

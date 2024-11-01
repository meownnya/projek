<div class="app">
    <ol>
        <li>
            <a href="{{ route('posts.index') }}">
                <img src="{{ asset('/images/LogoMemories.png') }}">
            </a>
        </li>
        <li>
            <form action="{{ route('search') }}" method="GET">
                <i class="bi bi-search icon"></i>
                <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
                <button type="submit">Search</button>
            </form>
        </li>
        <li>
            <a href="{{ route('posts.index') }}" class="{{ request()->is('posts') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span>Memories</span>
            </a>
        </li>
        <li>
            <a href="{{ route('folders.index') }}" class="{{ request()->is('folders') ? 'active' : '' }}">
                <i class="bi bi-folder-fill"></i>
                <span>Folders</span>
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="{{ request()->is('create') ? 'active' : '' }}">
                <i class="bi bi-plus-square"></i>
                <span>Create</span>
            </a>
            <ul>
                <li><a href="{{ route('posts.create') }}">Memories</a></li>
                <li><a href="{{ route('folders.create') }}">Folders</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="{{ request()->is('account') ? 'active' : '' }}"><img src="{{ asset('/images/Acc.png') }}"></a>
            <ul>
                <a class="dropdown-item" href="#" onclick="$('#form-logout').submit()">
                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> 
                    Logout
                </a>
    
                <form id="form-logout" action="{{route('logout')}}" method="POST">
                    
                    @csrf
                </form>
            </ul>
        </li>
    </ol>
    
</div>

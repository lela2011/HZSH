<header class="Header" style="--header-height: 185px;">
    <div class="Header--top">
        <div class="Header--logo">
            <a class="Logo" href="{{ route('node.index') }}">
                <img src="{{asset('images/uzh_logo.svg')}}" alt="" width="208" height="92">
            </a>
        </div>
        <h2 class="Header--department">
            <a class="Header--department--link" href="{{ route('node.index') }}">
                Department of Political Science
            </a>
        </h2>
        @auth
            <form method="POST" action=" {{ route('logout') }} " style="margin-left: auto;">
                @csrf
                <button type="submit">
                    <span class="material-icons logout-icon">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        @endauth
    </div>
</header>

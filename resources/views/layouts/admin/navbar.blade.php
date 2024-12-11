<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="navbar-text mr-3">
                Welcome, {{ Auth::user()->name }}
            </span>
        </li>

        <li class="nav-item dropdown">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link text-danger" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>            
        </li>              
    </ul>
</nav>

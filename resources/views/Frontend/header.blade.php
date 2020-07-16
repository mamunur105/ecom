    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white absolute-top">
            <div class="container">

         
                <div class="collapse navbar-collapse order-3 order-md-2" id="navbar-left">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="home-twocolumn.html#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="#">One column</a>
                                <a class="dropdown-item" href="home-twocolumn.html">Two column</a>
                                <a class="dropdown-item" href="home-threecolumn.html">Three column</a>
                                <a class="dropdown-item" href="home-fourcolumn.html">Four column</a>
                                <a class="dropdown-item" href="home-featured.html">Featured posts</a>
                                <a class="dropdown-item" href="home-fullwidth.html">Full width</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="home-twocolumn.html#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown02">
                                <a class="dropdown-item" href="post-image.html">Image</a>
                                <a class="dropdown-item" href="post-video.html">Video</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="home-twocolumn.html#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Components</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown03">
                                <a class="dropdown-item" href="doc-alerts.html">Alerts</a>
                                <a class="dropdown-item" href="doc-buttons.html">Buttons</a>
                                <a class="dropdown-item" href="doc-cards.html">Cards</a>
                                <a class="dropdown-item" href="doc-forms.html">Forms</a>
                                <a class="dropdown-item" href="doc-icons.html">Icons</a>
                                <a class="dropdown-item" href="doc-pagination.html">Pagination</a>
                                <a class="dropdown-item" href="doc-tables.html">Tables</a>
                                <a class="dropdown-item" href="doc-typography.html">Typography</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <a class="navbar-brand mx-auto order-1 order-md-3" href="{{ route('homepage') }}">Milø</a>

                <div class="collapse navbar-collapse order-4 order-md-4" id="navbar-right">
                    <ul class="navbar-nav ml-auto">
                         @auth()
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}" title="{{optional(auth()->user())->name}}">Profile </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endauth
                        @guest()
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('loginForm') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('registrationForm') }}">Register</a>
                            </li>
                        @endguest

                    </ul>
                   
                </div>
            </div>
        </nav>
    </header>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="/">
            <strong class="blue-text">Adopet</strong>
        </a>
        @section('navlinks')
        <!-- <li class="nav-item active">
			<a class="nav-link waves-effect" href="/">Home
				<span class="sr-only">(current)</span>
			</a>
		</li> -->

        @auth
        <li class="nav-item">
            <a class="nav-link waves-effect" href="/pet">Pet List</a>
        </li>

        <li class="nav-item">
            <a class="nav-link waves-effect" href="/pet/create">Pet Create</a>
        </li>
        <li class="nav-item">
            <a class="nav-link waves-effect" href="{{ route('viewfblog') }}">Facebook Data</a>
        </li>
        @endauth

        @endsection



        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                @yield('navlinks')
            </ul>


          
			<!-- Right -->
			<ul class="navbar-nav nav-flex-icons">

				@auth

					<!-- Split button -->
					<div class="btn-group">
					  <a href="/profile" type="button" class="btn btn-info">{{ Auth::user()->first_name }}</a>
					  <button type="button" class="btn btn-info dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true"
					    aria-expanded="false">
					    <span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <div class="dropdown-menu">
					    <a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="/pet">Pet List</a>
							<a class="dropdown-item" href="/pet/create">Pet Create</a>


                        <div class="dropdown-divider"></div>

                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>

                    </div>
                </div>

                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link border border-light rounded waves-effect">
                        <i class="fa fa-user "></i>Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link border border-light rounded waves-effect">
                        <i class="fa fa-user "></i>Register
                    </a>
                </li>
                @endauth
            </ul>

        </div>

    </div>
</nav>
<!-- Navbar -->

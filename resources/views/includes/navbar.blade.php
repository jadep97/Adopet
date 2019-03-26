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
		<!-- <li class="nav-item">
			<a href=" {{ route('pet.create') }}" class="nav-link waves-effect">Adoption</a>
		</li>
		<li class="nav-item ">
			<a href="/adoption" class="nav-link waves-effect">aaa</a>
		</li>
		<li class="nav-item">
			<a class="nav-link waves-effect" href="/">About Adopet</a>
		</li> -->
	@endsection



		<!-- Collapse -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
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
				<!-- <li class="nav-item">
					<a class="nav-link waves-effect">
						<span class="badge red z-depth-1 mr-1"> 1 </span>
						<i class="fa fa-shopping-cart"></i>
						<span class="clearfix d-none d-sm-inline-block"> Cart </span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link waves-effect" target="_blank">
						<i class="fa fa-facebook"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link waves-effect" target="_blank">
						<i class="fa fa-twitter"></i>
					</a>
				</li> -->
				@auth

					<!-- Split button -->
					<div class="btn-group">
					  <button href="/profile" type="button" class="btn btn-info">{{ Auth::user()->first_name }}</button>
					  <button type="button" class="btn btn-info dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true"
					    aria-expanded="false">
					    <span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <div class="dropdown-menu">
					    <a class="dropdown-item" href="{{ route('recommend') }}">Recommend</a>
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

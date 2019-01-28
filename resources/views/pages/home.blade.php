@extends('layouts.app')

@section('title', 'Welcome')

@section('navlinks')
	<!-- <li class="nav-item active">
		<a class="nav-link waves-effect" href="/">Home
			<span class="sr-only">(current)</span>
		</a>
	</li> -->
	<li class="nav-item">
		<a class="nav-link waves-effect" href="/pet">Pet List</a>
	</li>

	<li class="nav-item">
		<a class="nav-link waves-effect" href="/pet/create">Pet Create</a>
	</li>
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

@section('content')
	<!-- <div>
		include('includes.carousel')
	</div> -->
	<!--Main layout-->
	<main>
		<div class="container">

			<!--Navbar-->
			<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5" v-if="false">

				<!-- Navbar brand -->
				<span class="navbar-brand">Categories:</span>

				<!-- Collapse button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Collapsible content -->
				<div class="collapse navbar-collapse" id="basicExampleNav">

					<!-- Links -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">All
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Shirts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Sport wears</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Outwears</a>
						</li>

					</ul>
					<!-- Links -->

					<form class="form-inline">
						<div class="md-form my-0">
							<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
						</div>
					</form>
				</div>
				<!-- Collapsible content -->

			</nav>
			<!--/.Navbar-->

			<!--Section: Products v.3-->
			<section class="text-center mb-4">
				<!--Grid row-->
				<div class="row wow fadeIn" >
					<!--Grid column-->
					<div class="col-lg-3 col-md-6 mb-4" v-for="pet in pets">
						<!--Card-->
						<div class="card">

							<!--Card image-->
							<div class="view overlay">
								<img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12.jpg" class="card-img-top" alt="">
								<a>
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<!--Card image-->

							<!--Card content-->
							<div class="card-body text-center">
								<!--Category & Title-->
								<a href="" class="grey-text">
									<h5>@{{ pet.breed }}</h5>
								</a>
								<h5>
									<strong>
										<a href="" class="dark-grey-text">@{{ pet.petName }}
											<!-- <span class="badge badge-pill danger-color">NEW</span> -->
										</a>
									</strong>
								</h5>

								<h4 class="font-weight-bold blue-text">
									<strong>@{{ pet.petBirth }}</strong>
								</h4>

							</div>
							<!--Card content-->

						</div>
						<!--Card-->
						<pre>@{{ pet }}</pre>
					</div>
					<!--Grid column-->
				</div>
				<!--Grid row-->
			</section>
			<!--Section: Products v.3-->

			<!--Pagination-->
			<nav class="d-flex justify-content-center wow fadeIn" v-if="false">
				<ul class="pagination pg-blue">

					<!--Arrow left-->
					<li class="page-item disabled">
						<a class="page-link" href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>

					<li class="page-item active">
						<a class="page-link" href="#">1
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">2</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">3</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">4</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="#">5</a>
					</li>

					<li class="page-item">
						<a class="page-link" href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</nav>
			<!--Pagination-->

		</div>
	</main>
	<!--Main layout-->
@endsection

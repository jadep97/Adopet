@extends('layouts.app')

@section('title', 'Petlist')

@section('navlinks')
	<!-- <li class="nav-item ">
		<a class="nav-link waves-effect" href="/">Home
			<span class="sr-only">(current)</span>
		</a>
	</li> -->
	<li class="nav-item active">
		<a class="nav-link waves-effect" href="/pet">Pet List</a>
	</li>
	<li class="nav-item">
		<a class="nav-link waves-effect" href="/pet/create">Pet Create</a>
	</li>
@endsection

@section('content')

<div class="container petlist-page">
	
		@foreach ($pets as $pet)
		<section class="text-center mb-4">
			<!--Grid row-->
			<div class="row wow fadeIn" >
				<!--Grid column-->
					<div class="col-lg-3 col-md-6 mb-4" v-for="pet in pets" @click="showModal(pet)">
					<!--Card-->
					<div class="card" data-toggle="modal" data-target="#exampleModalLong">

						<div class="view overlay">
							<!--Card image-->
							<!-- <div class="view overlay">

							</div> -->
								<img :src="'/images/'+ JSON.parse(pet.petImg)[0]" class="card-img-top" alt="" height="175">
							<a>
								<div class="mask rgba-white-slight"></div>
							</a>
							<!--Card image-->

							<!--Card content-->
							<div class="card-body">
								<h4 class="font-weight-bold blue-text">
									<strong>@{{ pet.id }}</strong>
								</h4>
								<h4 class="font-weight-bold blue-text">
									<strong>@{{ pet.petName }}</strong>
								</h4>

								<h5>
									<strong>
										<a href="" class="dark-grey-text">@{{ pet.breed }}
											<!-- <span class="badge badge-pill danger-color">NEW</span> -->
										</a>
									</strong>
								</h5>

							</div>
							<!--Card content-->

						</div>

					</div>
					<!--Card-->
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

	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" v-if="petDetail">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">

						<h5 class="modal-title" id="exampleModalLongTitle">@{{ petDetail.id }}</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div> <!-- // modal-header -->

					<div class="modal-body">
							<img class="img-responsive"
									 v-if="petImages"
									 v-for="img in petImages"
									 :src="'/images/'+ img"
									 class="card-img-top"
									 height="175">
						<hr>

						<h5>
							<i>Name </i><strong>:</strong>
							<span>
								@{{ petDetail.petName }}
							</span>
						</h5>
						<h5>
							<i>Breed </i><strong>:</strong>
							<span>
								@{{ petDetail.breed }}
							</span>
						</h5>
						<h5>
							<i>Birth </i><strong>:</strong>
							<span>
								@{{ petDetail.petBirth }}
							</span>
						</h5>
						<h5>
							<i>Owner </i><strong>:</strong>
							<span>
								@{{ petDetail.username }}
							</span>
						</h5>

					</div> <!-- // modal-body -->

					 <div class="modal-footer">
						 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						 <form method="get" class="form" :action="'/pet/getUserRequest/' + petDetail.id">
							 <button type="submit" class="btn btn-primary">Adopt</button>
						 </form>
					 </div> <!-- // modal-footer -->
				</div>
		</div> <!-- // modal-dialog -->
	</div>
		{{-- <td class="petName">
            <span>{{ $pet->petName }}</span>
        </td>

        <td class="breed">
            <span>{{ $pet->breed }}</span>
		</td>
		<td class="breed">
            <span>{{ $pet->petImg }}</span>
        </td> --}}
		
		@endforeach
        

	  

	<!-- <prompt text="Confirm pet?"></prompt> -->
</div>



@endsection

@extends('pages.profile')

@section('title', 'Chat')

@section('content')
	<!-- <div>
		include('includes.carousel')
	</div> -->
	<!--Main layout-->
	<main>

		<div class="container">

	<br>

			<!--Section: Products v.3-->
			<section class="text-center mb-4">





				<!--Grid row-->
				<div class="row wow">
					<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

						<span class="navbar-brand">You are now in chat</span>
					</nav>
				</div>

				<div class="row wow fadeIn" >

						@foreach ($chats as $chat)

					<div class="chatbox">

									<div class="pet-info">

										<img class="img-responsive"
												 v-if="petImages"
												 v-for="img in petImages"
												 :src="'/images/'+ img"
												 class="card-img-top"
												 height="175">
									<hr>

														<h5>
															<strong>Name:</strong>
															<span>
																{{ $chat->pet_id }}
															</span>
														</h5>
														<h5>
															<strong>Breed:</strong>
															<span>
																
															</span>
														</h5>
														<h5>
															<strong>Birth:</strong>
															<span>

															</span>
														</h5>
														<h5>
															<strong>Owner:</strong>
															<span>
																{{ $chat->petOwner }}
															</span>
														</h5>
														<h5>
															<strong>Address:</strong>
															<span>

															</span>
														</h5>
														<h5>
															<strong>Description:</strong>
															<span>

															</span>
														</h5>

														<h5>
															<strong>Likes:</strong>
															<span>

															</span>
														</h5>
@endforeach
							</div>

							<div class="pet-comments">
								<div class="pet-comments-inner">
									<h5>
										<h6 v-for="message in messages">
											<span class="font-weight-bold blue-text">
												@{{ message.username }}
											</span> :
											<span class="com-comments">
												@{{ message.petComment }}
											</span>
											<span class="date-comments">
												@{{ message.created_at | formatDate}}
											</span>

										</h6>
									</h5>
								</div>

								<!-- Comment section  modal-->
								<form method="get" class="form" :action="'/pet/messagePet/' + message.id">

										<div class="com-inpt">
											<input type="text" name="petComment" id="petComment" class="form-control" placeholder="Write Something" required rows="3"></textarea>
										</div>

										<div class="com-btn">
											<button type="submit" class="btn btn-primary">Send Message</button>
										</div>


								</form>
								<!-- Comment section -->
							</div> <!-- // pet-comments -->

					</div>

				<br>

				</div>
				<!--Grid row-->



			</section>
			<!--Section: Products v.3-->

		</div>

	</main>
	<!--Main layout-->
@endsection

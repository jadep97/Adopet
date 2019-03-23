@extends('layouts.app')
@extends('pages.home')

@section('title', 'Petlist')


@section('content')

<div class="container petlist-page">
	<prompt text="Post pet?"></prompt>
	<table class="table table-hover">
	  <thead>
	    <tr>
				<th scope="col">Pet Requests</th>
				<th scope="col">Pet Name</th>
				<th scope="col">Pet Owner</th>
				<th scope="col">Pet Birth</th>
				<th scope="col">Breed</th>
				<th scope="col">Address</th>
				<th scope="col">Pet Information</th>
				<th scope="col">Status</th>
	    </tr>
	  </thead>
	  <tbody>
			@foreach ($pets as $pet)
					<tr>
							<td class="request">
								<a @click="showModal(pet)">{{ $pet->petRequest }}</a>
							</td>
							<td class="name">
								<span>{{ $pet->petName }}</span>
							</td>
							<td class="owner">
								<span>{{ $pet->petOwner }}</span>
							</td>
							<td class="birth">
								<span>{{ $pet->petBirth }}</span>
							</td>
							<td class="breed">
								<span>{{ $pet->breed }}</span>
							</td>
							<td class="address">
								<span>{{ $pet->address }}</span>
							</td>
							<td class="info">
								<span>{{ $pet->petInfo }}</span>
							</td>

							<td class="is-posted">
								@if($pet->isPosted == 0)
									<button type="submit" class="btn btn-sm btn-primary" @click="postPet({{$pet->id}})">Post</button>
								@else
									<span>is posted</span>
								@endif
							</td>
					</tr>
			@endforeach
	  </tbody>
	</table>

	<!-- <prompt text="Confirm pet?"></prompt> -->
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" v-if="petDetail">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLongTitle">@{{ petDetail.petName }}</h5>

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


				 </div> <!-- // modal-footer -->
			</div>
	</div> <!-- // modal-dialog -->
</div>  <!-- // modal -->


@endsection

@extends('layouts.app')
@extends('pages.home')

@section('title', 'Petlist')

@section('content')

<div class="container petlist-page">
	<prompt text="Post pet?"></prompt>
	<table class="table table-hover">
	  <thead>
	    <tr>
				<!-- <th scope="col">Pet Requests</th> -->
				<th scope="col">Pet Name</th>
				<th scope="col">Pet Owner</th>
				<th scope="col">Pet Birth</th>
				<th scope="col">Breed</th>
				<th scope="col">Address</th>
				<th scope="col">Pet Description</th>
				<th scope="col">Status</th>
	    </tr>
	  </thead>
	  <tbody>
			@foreach ($pets as $pet)
					<tr>
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
							<td class="address">
								<span>{{ $pet->description }}</span>
							</td>

							<td class="is-posted">
								@if($pet->isPosted == 0)
									<!-- <button type="submit" class="btn btn-sm btn-primary" @click="postPet({{$pet->id}})">Post</button> -->
									<a class="btn btn-sm btn-primary" href="/pet/postPet/{{$pet->id}}">Post</a>
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



@endsection

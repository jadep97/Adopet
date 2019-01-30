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
	<prompt text="Post pet?"></prompt>
	<table class="table table-hover">
	  <thead>
	    <tr>
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


@endsection

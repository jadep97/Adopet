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
							<td>{{  $pet->petName }}</td>
							<td>{{  $pet->petOwner }}</td>
							<td>{{  $pet->petBirth }}</td>
							<td>{{  $pet->breed }}</td>
							<td>{{  $pet->address }}</td>
							<td>{{  $pet->petInfo }}</td>
							<td>
								<button type="submit" class="btn btn-sm btn-primary" @click="postPet({{$pet->id}})">Post</button>
							</td>
					</tr>
			@endforeach		
	  </tbody>
	</table>
</div>


@endsection

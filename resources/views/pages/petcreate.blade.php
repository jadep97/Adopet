@extends('layouts.app')

@section('title', 'Create a Pet')



@section('content')
	<div class="container" style="padding-top: 40px">
		<form method="post" class="form" action="{{route('pet.store')}}" enctype="multipart/form-data">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
					</ul>
				</div><br />
			@endif

				{{ csrf_field() }}
				<div class="form-group">
					<input
						type="file"
						name="petImg[]" id="petImg"
						class="form-control"
						accept="image/x-png,image/gif,image/jpeg"
						multiple
					>
				</div>
				<div class="form-group">
					<input type="text" name="petName" id="petName" class="form-control" placeholder="Pet Name">
				</div>
				<div class="form-group">
					<input type="text" name="petOwner" id="petOwner" class="form-control" placeholder="Pet Owner">
				</div>
				<div class="form-group">
					<input type="date" name="petBirth" id="petBirth" class="form-control" placeholder="Pet Birth">
				</div>
				<div class="form-group">
					<input type="text" name="breed" id="breed" class="form-control" placeholder="Breed">
				</div>
				<div class="form-group">
					<input type="text" name="address" id="address"  class="form-control" placeholder="Address">
				</div>
				<div class="form-group">
					<input type="text" name="petInfo" id="petInfo" class="form-control" placeholder="Pet Information">
				</div>


		

		<div class="form-group">

				<label>Eyes Color</label>
				<input type="text" name="petEyes" id="petEyes" class="form-control">
				
		</div>

		<div class="form-group">

				<label>Ears</label>
				<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petEars">
						<option value="rounded">Rounded</option>
						<option value="tipted">Tipted</option>
						<option value="down">Down</option>
					  </select>
		</div>
		
		<div class="form-group">

			<label>Hair</label>
			  <select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petHair">
				<option value="long">Long</option>
				<option value="curl">Curl</option>
				<option value="thick">Thick</option>
				<option value="fluffy">Fluffy</option>
			  </select>
		</div>

		<div class="form-group">

			<label>Tail</label>
			<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petTail">
				<option value="long">Long</option>
				<option value="short">Short</option>
			  </select>

		</div>

		<div class="form-group">

			<label>Color</label>
			<input type="text" name="petColor" id="petColor" class="form-control">

		</div>

		<div class="form-group">

			<label>Markings</label>
			<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petMarking" >
					<option value="dotted">Dotted</option>
					<option value="stripes">Stripes</option>
					<option value="wavy">Wavy</option>
			</select>

		</div>

		<div class="form-group">

			<label>Size</label>
			<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petSize">
					<option value="small">Small</option>
					<option value="medium">Medium</option>
					<option value="large">Large</option>
			</select>

		</div>		


				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>

	<!-- <div class="create-pet__form">
		<div class="container">
			<form class="form" method="post" action=" {{ route('pet.store') }} ">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
							</ul>
						</div><br />
					@endif
					{{ csrf_field() }}
					<div class="form-group">
						<label for="petName">Image</label>
						<input
							type="file"
							name="petName"
							id="imageInput"
							class="form-control"
							accept="image/x-png,image/gif,image/jpeg"
							placeholder="Pet Name"
							@change="readImg($event)"
						>
						<img id="imgSrc" width="100" height="100"/>
					</div>
					<div class="form-group">
						<label for="petName">Pet Name</label>
						<input type="text" name="petName" id="petName" class="form-control" placeholder="Pet Name">
					</div>
					<div class="form-group">
						<label for="petOwner">Pet Owner</label>
						<input type="text" name="petOwner" id="petOwner" class="form-control" placeholder="Pet Owner">
					</div>
					<div class="form-group">
						<label for="petBirth">Pet Birth</label>
						<input type="date" name="petBirth" id="petBirth" class="form-control" placeholder="Pet Birth">
					</div>
					<div class="form-group">
						<label for="breed">Breed</label>
						<input type="text" name="breed" id="breed" class="form-control" placeholder="Breed">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" name="address" id="address" class="form-control" placeholder="Address">
					</div>
					<div class="form-group">
						<label for="petInfo">Pet Information</label>
						<input type="text" name="petInfo" id="petInfo" class="form-control" placeholder="Pet Information">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div> -->


@endsection

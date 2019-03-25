@extends('layouts.app')

@section('title', 'Pet Finder')

@section('navlinks')
	<!-- <li class="nav-item ">
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
@endsection

@section('content')
	<div class="container" style="padding-top: 40px">
			
		<form method="get" class="form" action="/searchpets" enctype="multipart/form-data">
			{{-- @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
					</ul>
				</div><br />
			@endif --}}

				{{ csrf_field() }}
				
				<div class="form-group">

					<div class="form-group">

                        <label>Breed</label>
                        <select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petBreed" id="petBreed">
													
														<option value=""></option>			
													@foreach ($pets as $pet)
																<option value="{{ $pet->breed }}">{{ $pet->breed }}</option>
																@endforeach
																
                              </select>
                		</div>

					

				</div>

                <div class="form-group">

                        <label>Eyes Color</label>
						<input type="text" name="petEyes" id="petEyes" class="form-control">
						
                </div>

                <div class="form-group">

                        <label>Ears</label>
                        <select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petEars">
															
														<option value=""></option>	
													@foreach ($petDetail as $petDetails)
																<option value="{{ $petDetails->ears }}">{{ $petDetails->ears }}</option>		
																@endforeach
																
                              </select>
                </div>
                
                <div class="form-group">

					<label>Hair</label>
                	  <select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petHair">
												<option value=""></option>	
												@foreach ($petDetail as $petDetails)
															<option value="{{ $petDetails->hair }}">{{ $petDetails->hair }}</option>		
															@endforeach
					  </select>
				</div>

				<div class="form-group">

					<label>Tail</label>
					<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petTail">
												<option value=""></option>
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
					<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petMarking">
							<option value=""></option>
							<option value="dotted">Dotted</option>
							<option value="stripes">Stripes</option>
							<option value="wavy">Wavy</option>
					</select>

				</div>

				<div class="form-group">

					<label>Size</label>
					<select class="mdb-select md-form colorful-select dropdown-primary form-control" name="petSize">
							<option value=""></option>
							<option value="small">Small</option>
							<option value="medium">Medium</option>
							<option value="large">Large</option>
					</select>

				</div>		
                      
				<button type="submit" class="btn btn-primary">Find</button>
		</form>
    </div>
@endsection
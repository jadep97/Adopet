@extends('layouts.app')

@section('content')


<table class="table table-hover">
  <thead>
    <tr>
      <td scope="col">Pet Name</td>
      <td scope="col">Pet Owner</td>
      <td scope="col">Pet Birth</td>
      <td scope="col">Breed</td>
      <td scope="col">Address</td>
      <td scope="col">Pet Information</td>
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
						<td>{{  $pet->isPosted }}</td>
						<td>  <button type="submit" href="{{ URL::to('home/'   . $pet->id)  }}">Post</button></td>
        </tr>

    @endforeach
  </tbody>
</table>

@endsection

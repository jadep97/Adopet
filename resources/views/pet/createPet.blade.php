@extends('layouts.app');

@section('content')
 
    <form method="post" action=" {{ route('pet.store') }} ">
        @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <div class="form-group">
        {{ csrf_field() }}
        <input type="text" name="petName" id="petName" placeholder="Pet Name">
        <input type="text" name="petOwner" id="petOwner" placeholder="Pet Owner">
        <input type="text" name="petBirth" id="petBirth" placeholder="Pet Birth">
        <input type="text" name="breed" id="breed" placeholder="Breed">
        <input type="text" name="address" id="address" placeholder="Address">
        <input type="text" name="petInfo" id="petInfo" placeholder="Pet Information">
        <button type="submit">Submit</button>
    </div>
    </form>

@endsection
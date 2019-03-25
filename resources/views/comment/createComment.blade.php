@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make Comment</div>
                <div class="card-body">
                    <form method="post" action="{{ route('comment.store') }}">
                        
                            @csrf
                            
                        <div class="form-group">
                            <label class="label">Comment: </label>
                            <textarea name="comments" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">

                            <input type="hidden" name="petID">

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
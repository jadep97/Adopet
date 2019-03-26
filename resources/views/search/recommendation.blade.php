@extends('layouts.app')
@section('title','Recommended')
@section('content')

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Recommended Pet(s) For You</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($result as $key => $value)
        <img src="/images/{{ $result[$key]->petImg[0] }}" class="img-responsive" class="card-img-top" height="175">
        <hr>
        <h5>
            <i>Name </i><strong>:</strong>
            <span>
                {{ $result[$key]->petName }}
            </span>
        </h5>
        <h5>
            <i>Breed </i><strong>:</strong>
            <span>
                {{ $result[$key]->breed }}
            </span>
        </h5>
        <h5>
            <i>Birth </i><strong>:</strong>
            <span>
                {{ $result[$key]->petBirth }}
            </span>
        </h5>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">OK</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        $(window).on('load',function(){
            $('#modal').modal('show');
        });
    });
    
</script>

@endsection
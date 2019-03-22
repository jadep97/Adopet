@extends('layouts.app')

@section('content')


<div class="table-responsive">
<table class="table table-hover" border=1>
  <thead class="thead-dark">
    <tr>
      <th scope="col">User Posts</th>
      <th scope="col">User Likes</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $value)
        @if(count($data[0]['posts_logs'])>count($data[0]['likes_logs']))
            @for($i = 0; $i < count($data[0]['posts_logs']) ; $i++)
                @if(isset($value['posts_logs'][$i]) && isset($value['likes_logs'][$i]))
                <tr>
                    <td><pre>{{ $value['posts_logs'][$i] }}</pre></td>
                    <td><pre>{{ $value['likes_logs'][$i] }}</pre></td>
                </tr>
                @endif
            @endfor
        @else
            @for($i = 0; $i < count($data[0]['likes_logs']) ; $i++)
                @if(isset($value['posts_logs'][$i]) && isset($value['likes_logs'][$i]))
                <tr>
                    <td><pre>{{ $value['posts_logs'][$i] }}</pre></td>
                    <td><pre>{{ $value['likes_logs'][$i] }}</pre></td>
                </tr>
                @endif
            @endfor
        @endif
            
    @endforeach
  </tbody>
</table>
</div>

@endsection

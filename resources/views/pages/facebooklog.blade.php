@extends('layouts.app')

@section('title','Facebook')

@section('content')

<a href="{{ route('fblog') }}" class="btn btn-primary">Renew Data</a>
<a href="{{ route('recommend') }}" class="btn btn-primary">Recommend Me a Pet</a>
<div class="table-responsive">
<table class="table table-hover" border=1>
  <thead class="thead-dark">
    <tr>
      <th>User Posts</th>
      <th>User Likes</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $value)
        @if(count($data['posts_logs'])>count($data['likes_logs']))
            @for($i = 0; $i < count($data['posts_logs']) ; $i++)
                @if(isset($data['posts_logs'][$i]) && isset($data['likes_logs'][$i]))
                
                <tr>
                    <td>{{ $data['posts_logs'][$i] }}</td>
                    <td>{{ $data['likes_logs'][$i] }}</td>
                </tr>
                @else
                    @if(!isset($data['posts_logs'][$i]))
                    <tr>
                        <td></td>
                        <td>{{ $data['posts_logs'][$i] }}</td>
                    </tr>
                    @elseif(!isset($data['likes_logs'][$i]))
                    <tr>
                        <td>{{ $data['posts_logs'][$i] }}</td>
                        <td></td>
                    </tr>
                    @endif
                @endif
            @endfor
            
        @else
            @for($i = 0; $i < count($data['likes_logs']) ; $i++)
                @if(isset($data['posts_logs'][$i]) && isset($data['likes_logs'][$i]))
                
                <tr>
                    <td>{{ $data['posts_logs'][$i] }}</td>
                    <td>{{ $data['likes_logs'][$i] }}</td>
                </tr>
                @else
                    @if(!isset($data['posts_logs'][$i]))
                    <tr>
                        <td></td>
                        <td>{{ $data['posts_logs'][$i] }}</td>
                    </tr>
                    @elseif(!isset($data['likes_logs'][$i]))
                    <tr>
                        <td>{{ $data['posts_logs'][$i] }}</td>
                        <td></td>
                    </tr>
                    @endif
                @endif
            @endfor
        @endif
        @break
    @endforeach
  </tbody>
</table>
</div>

@endsection

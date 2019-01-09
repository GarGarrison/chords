@extends('app')

@section("title")
<title>{{ $song->artist }} - {{ $song->title }}</title>
@endsection

@section('content')
    <div class="block bottom song">
        <div class="bread">
          <a href='{{ "/artist/{$artist->url}" }}'><i class="material-icons left">undo</i>назад к «{{ $artist->name }}»</a>
        </div>
        <h1>{{ $song->artist_name }} - {{ $song->title }}</h1>
        <pre>
        {!! $song->text !!}
        </pre>
    </div>
@endsection
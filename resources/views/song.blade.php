@extends('app')

@section('meta')
<title>{{ $song->artist_name }} - {{ $song->song_name }} | аккорды для гитары, текст песни</title>
<meta name="Keywords" content="{{ $song->artist_name }},{{ $song->song_name }},аккорды для гитары, текст песни"/>
<meta name="Description" content="{{ $song->artist_name }} - {{ $song->song_name }} | аккорды для гитары, текст песни"/>
@endsection

@section('content')
    <div class="block bottom song">
        <div class="bread">
          <a href='{{ "/artist/{$artist->url}" }}'><i class="material-icons left">undo</i>назад к «{{ $artist->artist_name }}»</a>
        </div>
        <h1>{{ $song->artist_name }} - {{ $song->song_name }}</h1>
        <pre>
        {!! $song->chords_txt !!}
        </pre>
    </div>
@endsection
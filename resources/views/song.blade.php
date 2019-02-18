@extends('app')

@section('meta')
@if($song->seo_title)
  <title>{{ $song->seo_title }}</title>
@else
  <title>{{ $song->artist_name }} - {{ $song->song_name }} | аккорды для гитары, текст песни</title>
@endif
@if($song->seo_description)
  <meta name="Description" content="{{ $song->seo_description }}"/>
@else
  <meta name="Description" content="{{ $song->artist_name }} - {{ $song->song_name }} | аккорды для гитары, текст песни"/>
@endif
<meta name="Keywords" content="{{ $song->artist_name }},{{ $song->song_name }},аккорды для гитары, текст песни"/>
@endsection

@section('content')
    <div class="block bottom song">
        <div class="bread">
          <a href='{{ "/artist/{$artist->url}" }}'><i class="material-icons left">undo</i>назад к «{{ $artist->artist_name }}»</a>
        </div>
        <h1>{{ $song->artist_name }} - {{ $song->song_name }}</h1>
        @if($song->video)
        <iframe src="https://www.youtube.com/embed/{{ $song->video }}?rel=0?ecver=1" frameborder="0" allowfullscreen></iframe>
        @endif
        <pre>
        {!! $song->chords_txt !!}
        </pre>
    </div>
@endsection
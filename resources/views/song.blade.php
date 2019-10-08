@extends('app')

@section('meta')
@if($song->seo_title)
  <title>{{ $song->seo_title }}</title>
@else
  <title>{{ $song->song_name }} - {{ $song->artist_name }}: аккорды для гитары, текст песни</title>
@endif
@if($song->seo_description)
  <meta name="Description" content="{{ $song->seo_description }}"/>
@else
  <meta name="Description" content="Играйте песню {{ $song->song_name }} группы {{ $song->artist_name }} под правильные аккорды, которыми славится Check the Chords"/>
@endif
@if($song->seo_keywords)
  <meta name="Keywords" content="{{ $song->seo_keywords }}"/>
@else
  <meta name="Keywords" content="{{ $song->artist_name }},{{ $song->song_name }},аккорды для гитары, текст песни"/>
@endif
@endsection

@section('content')
    <div class="block bottom song">
        <div class="bread">
          <a href='{{ "/artist/{$artist->url}" }}'><i class="material-icons left">undo</i>назад к «{{ $artist->artist_name }}»</a>
        </div>
        <h1>{{ $song->artist_name }} - {{ $song->song_name }}</h1>
        @if($song->video)
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $song->video }}?rel=0?ecver=1" frameborder="0" allowfullscreen></iframe>
        @endif
        <pre>
        {!! $song->chords_txt !!}
        </pre>
    </div>
@endsection
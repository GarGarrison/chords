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
  <div class="col s12">
    <div class="block bottom song">
        <div class="bread">
          <a href='{{ "/artist/{$artist->url}" }}'><i class="material-icons left">undo</i>назад к «{{ $artist->artist_name }}»</a>
        </div>
        <h1>{{ $song->artist_name }} - {{ $song->song_name }}</h1>
        @if($song->video)
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $song->video }}?rel=0?ecver=1" frameborder="0" allowfullscreen></iframe>
        @endif

        @if($song->guitar_chords)
        <div class="chords_block">
          @foreach ( explode(";", $song->guitar_chords) as $chord)
            @if( file_exists("img/chords/guitar/{$chord}.gif") )
            <img src='{{ "/img/chords/guitar/{$chord}.gif" }}' />
            @endif
          @endforeach
        </div>
        @endif
        <pre>
        {!! $song->chords_txt !!}
        </pre>
        <div id="wpac-comment"></div>
        <script type="text/javascript">
        wpac_init = window.wpac_init || [];
        wpac_init.push({widget: 'Comment', id: 21090});
        (function() {
            if ('WIDGETPACK_LOADED' in window) return;
            WIDGETPACK_LOADED = true;
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = 'https://embed.widgetpack.com/widget.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
        })();
        </script>
        {{-- <a href="https://widgetpack.com" class="wpac-cr">Comments System WIDGET PACK</a> --}}
    </div>
  </div>
@endsection
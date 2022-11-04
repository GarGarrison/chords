@extends('app')

@section('meta')

@if($artist->seo_title)
  <title>{{ $artist->seo_title }}</title>
@else
  <title>{{ $artist->artist_name }} - аккорды для гитары, текст песен</title>
@endif
@if($artist->seo_description)
  <meta name="Description" content="{{ $artist->seo_description }}"/>
@else
  <meta name="Description" content="{{ $artist->artist_name }} - аккорды для гитары, текст песен"/>
@endif
@if($artist->seo_keywords)
  <meta name="Keywords" content="{{ $artist->seo_keywords }}"/>
@else
    <meta name="Keywords" content="{{ $artist->artist_name }}, аккорды для гитары, текст песен"/>
@endif
@endsection

@section('content')
    <div class="col s12">
        <div class="block bottom">
            <h1>{{ $artist->artist_name }}</h1>
            @if($artist->description)
                <p>{{ $artist->description }}</p>
            @endif
            @if(count($songs))
                <table>
                    <tr>
                        <th></th>
                        <th>Песня</th>
                        <th>Просмотров</th>
                    </tr>
                @foreach($songs as $song)
                    <tr>
                        <td></td><!-- ava -->
                        <td><a href='{{"/{$song->url}" }}'>{{ $song->song_name }}</a></td>
                        <td>{{ $song->view }}</td>
                    </tr>
                @endforeach
                </table>
                {{ $songs->links() }}
            @else
                <h5>У исполнителя пока нет песен</h5>
            @endif

        </div>
    </div>
@endsection

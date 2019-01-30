@extends('app')

@section('content')
    <div style="display: inline-block; width: 100%;">
        <div class="col s12 m4">
            <div class="block complex">
                <h5>Популярные исполнители</h5>
                @if(count($top_artists))
                    <table>
                        <tr>
                            <th>Исполнитель</th>
                            <th>Песен</th>
                        </tr>
                    @foreach($top_artists as $artist)
                        <tr>
                            <td><a href='{{"/artist/{$artist->url}" }}'>{{ $artist->artist_name }}</a></td>
                            <td>{{ $artist->songs_sum }}</td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    <span>Таких нет</span>
                @endif
            </div>
            <div class="block complex">
                <h5>Популярные песни</h5>
                @if(count($top_songs))
                    <table>
                        <tr>
                            <th>Песня</th>
                            <th>Просмотров</th>
                        </tr>
                    @foreach($top_songs as $song)
                        <tr>
                            <td><a href='{{"/{$song->url}" }}'>{{ $song->artist_name }} - {{ $song->song_name }}</a></td>
                            <td>{{ $song->view }}</td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    <span>Таких нет</span>
                @endif
            </div>
        </div>
        <div class="col s12 m8">
            <div class="block">
                <h5>Новинки</h5>
                @if(count($new_songs))
                    <table>
                        <tr>
                            <th>Исполнитель</th>
                            <th>Песня</th>
                        </tr>
                    @foreach($new_songs as $song)
                        <tr>
                            <td>{{ $song->artist_name }}</td>
                            <td><a href='{{ "/{$song->url}" }}'>{{ $song->song_name }}</a></td>
                        </tr>
                    @endforeach
                    </table>
                    {{ $new_songs->links() }}
                @else
                    <span>Таких нет</span>
                @endif
            </div>
        </div>
    </div>
@endsection
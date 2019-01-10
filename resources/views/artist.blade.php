@extends('app')

@section('meta')
<title>{{ $artist->name }} - аккорды для гитары, текст песен</title>
<meta name="Keywords" content="{{ $artist->name }}, аккорды для гитары, текст песен"/>
<meta name="Description" content="{{ $artist->name }} - аккорды для гитары, текст песен"/>
@endsection

@section('content')
    <div class="block bottom">
        <h1>{{ $artist->name }}</h1>
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
                    <td><a href='{{"/{$song->url}" }}'>{{ $song->title }}</a></td>
                    <td>{{ $song->view }}</td>
                </tr>
            @endforeach
            </table>
            {{ $songs->links() }}
        @else
            <h5>У исполнителя пока нет песен</h5>
        @endif

    </div>
@endsection
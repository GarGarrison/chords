@extends('app')

@section('content')
    <div class="block bottom">
        <h1>Исполнители на «{{ $letter }}»</h1>
        @if(count($artists))
            <table>
                <tr>
                    <th></th>
                    <th>Исполнитель</th>
                    <th>Песен</th>
                </tr>
            @foreach($artists as $artist)
                <tr>
                    <td></td><!-- ava -->
                    <td><a href='{{ "/artist/{$artist->url}" }}'>{{ $artist->name }}</a></td>
                    <td>{{ $artist->songs_sum }}</td>
                </tr>
            @endforeach
            </table>
            {{ $artists->links() }}
        @else
            <h5>Таких исполнителей пока нет</h5>
        @endif
    </div>
@endsection
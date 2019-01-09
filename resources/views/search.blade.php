@extends('app')

@section('content')
    <div class="block bottom">
        <h1>Результаты для «{{ $request }}»</h1>
        @if(count($results))
            <table>
                <tr>
                    <th></th>
                    <th>Песня</th>
                </tr>
            @foreach($results as $result)
                <tr>
                    <td></td><!-- ava -->
                    <td><a href='{{"/{$result->url}" }}'>{{ $result->artist_name }} - {{ $result->title }}</a></td>
                </tr>
            @endforeach
            </table>
            {{ $results->links() }}
        @else
            <h5>Ничего не найдено</h5>
        @endif
    </div>
@endsection
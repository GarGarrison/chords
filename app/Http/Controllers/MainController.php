<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Song;
use App\Artist;

// use Carbon\Carbon;

class MainController extends Controller
{
    public function index(Request $request) {
        return view('index');
    }

    public function search(Request $request) {
        $req = $request->input('search');
        $lower = strtolower($req);
        // $results = Song::whereRaw("LOWER(CONCAT(artist_name, ' ', title)) like '%{strtolower($req)}%'")->paginate(20);
        $results = Song::whereRaw("LOWER(CONCAT(artist_name, ' ', title)) like '%{$lower}%'")->paginate(20);
        return view('search', ["results"=>$results, "request"=>$req]);
    }

    public function song(Request $request, $url) {
        $song = Song::where('url', $url)->firstOrFail();
        $artist = Artist::find($song->artist_id);
        return view('song', ["artist"=>$artist, "song"=>$song]);
    }

    public function letter(Request $request, $letter) {
        // $artists = Artist::where('letter', $letter)->orderBY("name")->paginate(20);
        $artists = DB::table('artists')
            ->where('letter', $letter)
            ->leftJoin('songs', 'artists.id', '=', 'songs.artist_id')
            ->select('artists.*', DB::raw('count(artists.id) as songs_sum'))
            ->groupBy('artists.id')
            ->orderBY("name")
            ->paginate(50);
        return view('letter', ["artists"=>$artists, "letter"=>$letter]);
    }

    public function artist(Request $request, $url) {
        $artist = Artist::where('url', $url)->firstOrFail();
        $songs = Song::where('artist_id', $artist->id)->orderBY("title")->paginate(50);
        return view('artist', ["songs"=>$songs, "artist"=>$artist]);
    }
}
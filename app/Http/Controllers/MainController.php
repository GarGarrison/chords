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
        $top_artists = DB::table('artists')
                        ->leftJoin('songs', 'artists.id', '=', 'songs.artist_id')
                        ->select('artists.*', DB::raw('count(artists.id) as songs_sum'))
                        ->groupBy('artists.id')
                        ->orderBY("songs_sum", "desc")->take(7)->get();
        $top_songs = Song::orderBY("view","desc")->take(7)->get();
        $new_songs = Song::orderBY("created_at","desc")->simplePaginate(20);
        return view('index', ["top_artists"=>$top_artists, "top_songs"=>$top_songs, "new_songs"=>$new_songs]);
    }

    public function search(Request $request) {
        $req = $request->input('search');
        $lower = strtolower($req);
        $results = Song::whereRaw("LOWER(CONCAT(artist_name, ' ', song_name)) like '%{$lower}%'")->paginate(20);
        return view('search', ["results"=>$results, "request"=>$req]);
    }

    public function song(Request $request, $url) {
        $song = Song::where('url', $url)->firstOrFail();
        $artist = Artist::find($song->artist_id);
        $song->view += 1;
        $song->save();
        // $other_song = Song::where("artist_id", $artist->id)->inRandomOrder()->limit(5)->get();
        $other_song = Song::where("artist_id", $artist->id)->orderBY("view","desc")->limit(5)->get();
        return view('song', ["artist"=>$artist, "song"=>$song, "other_songs"=>$other_song]);
    }

    public function letter(Request $request, $letter) {
        $artists = DB::table('artists')
            ->where('letter', $letter)
            ->leftJoin('songs', 'artists.id', '=', 'songs.artist_id')
            ->select('artists.*', DB::raw('count(artists.id) as songs_sum'))
            ->groupBy('artists.id')
            ->orderBY("artist_name")
            ->paginate(50);
        return view('letter', ["artists"=>$artists, "letter"=>$letter]);
    }

    public function artist(Request $request, $url) {
        $artist = Artist::where('url', $url)->firstOrFail();
        $songs = Song::where('artist_id', $artist->id)->orderBY("song_name")->paginate(50);
        return view('artist', ["songs"=>$songs, "artist"=>$artist]);
    }
    // public function test(Request $request) {
    //     $songs = Song::where('chords_txt', 'like', '%<h2>%')->get();
    //     dd($songs);
    //     foreach ($songs as $song) {
    //         $chords = preg_replace('/<h2>.+?<\/h2>/', '', $song->chords_txt);
    //         $chords = preg_replace('/<ul>.+?<\/ul>/', '', $chords);
    //         $song->chords_txt = $chords;
    //         $song->save();
    //     }
    //     return "ok";
    // }
}
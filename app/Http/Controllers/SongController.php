<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
class SongController extends Controller
{
    public function showForm(){
        return view('song.songuploadform');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required:max:255',
            'artist' => 'required',
            'genre' => 'required',
            'lyric' =>'required'
        ]);

        $song = Song::create([
            'title' => $request->get('title'),
            'artist' => $request->get('artist'),
            'genre' => $request->get('genre'),
            'lyric' =>$request->get('lyric')
        ]);

        return back()->with('message', 'Your file is submitted Successfully');
    }

    public function upload(Request $request)
    {
        $uploadedFile = $request->file('song');
        $filename = time().$uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            'songs/'.$filename,
            $uploadedFile,
            $filename
        );

        $upload = new Upload;
        $upload->filename = $filename;

        //$upload->user()->associate(auth()->user());

        $upload->save();

        return response()->json([
            'id' => $upload->id
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * pass an array to the 'foo' view
     * as a second parameter.
    */
    public function index()
    {
        $movieList = [
            'Shawshank redemption',
            'Forrest Gump',
            'The Matrix',
            'Pirates of the Carribean',
            'Back to the future',
        ];

        $latestMovie = end($movieList);
        echo 'text';
        return view('welcome', compact('movieList', 'latestMovie'));
    }

    public function foo()
    {
    	//view('posts.index', compact('posts'));
        // return view('foo', [
        //     'key' => 'The big brown fox jumped over the lazy dog'
        // ]);
        return view('foo', [
        	'key' => 'The big brown fox jumped over the lazy dog'
        ]);
    }

    /**
     * Pass a key variable to the 'foo view
     * using the compact method as
     * the second parameter.
    */
    public function bar()
    {
        $key = 'If a would chuck can chuck wood,';

        return view('foo', compact('key'));
    }

    /**
     * Pass a key, value pair to the view
     * using the with method.
    */
    public function baz()
    {
        return view('foo')->with(
            'key',
            'How much woood would a woodchuck chuck.'
        );
    }
}

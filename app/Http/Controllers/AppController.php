<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Web64\LaravelNlp\Facades\NLP;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main');
    }

    public function getSpotlightData(Request $request)
    {
        $response = Http::post(env('SPOTLIGHT_URL', 'http://178.216.200.239:5000'), [
            'data' => $request->input('data', '')
        ]);

        return response()->json(collect($response->json())->unique('URI'));
    }

    public function test()
    {
        $test = "We know that there are no perfect products. Come to think about it, perfect in what way? Recognizing clients’ needs, fitting the market, sales, user experience, design, lack of software bugs? Or maybe a little bit of everything?
One thing we know for sure. There are applications on the market which are just great. They combine pragmatism, because they solve users’ problems and using such apps is pure pleasure.";
        $entities_spacy = NLP::spacy_entities( $test, 'en' );
        dd($entities_spacy);
    }
}

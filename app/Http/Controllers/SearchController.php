<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    //

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processSearch(Request $request){

        if ($request->isMethod('post')) {
           $searchResult = NULL;
           $rs = NULL;

           if(isset($request->searchKey) && $request->searchKey != NULL){

            $value = Cache::get($request->searchKey);

                if($value == NULL){

                    $searchResult = Http::get('https://api.github.com/users/'.$request->searchKey);
                    $rs = json_decode(json_encode($searchResult->object()), true);
                    Cache::put($request->searchKey, $rs);

                } else {
                    $rs = $value;
                }

           } else {

                $value = Cache::get('lists');

                if($value == NULL){

                    $searchResult = Http::get('https://api.github.com/users');
                    $rs = json_decode(json_encode($searchResult->object()), true);
                    Cache::put('lists', $rs);

                } else {
                    $rs = $value;
                }

           }

           return view('home', compact('rs'));
        }

    }




}

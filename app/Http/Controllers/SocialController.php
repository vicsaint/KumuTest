<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver('github')->redirect();
    }


    public function callback($provider)
    {
        $getInfo = Socialite::driver('github')->user();
        $user = $this->createUser($getInfo,'github');
        auth()->login($user);
        return redirect()->to('/home');

    }

    function createUser($getInfo,$provider){

        $user = User::where('github_id', $getInfo->id)->first();
        if (!$user) {
             $user = User::create([

                'name'     => $getInfo->nickname, //$getInfo->name,
                'email'    => $getInfo->email,
                'provider' => 'github',
                'github_id' => $getInfo->id,

            ]);

        }
        return $user;

    }

}

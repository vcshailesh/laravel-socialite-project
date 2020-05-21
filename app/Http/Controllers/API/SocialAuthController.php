<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialAuthController extends Controller
{
    /**
     * Create a new SocialAuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param $provider
     */
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        // this user we get back is not our user model, but a special user object that has all the information we need
        $providerUser = Socialite::driver($provider)->stateless()->user();

        // we have successfully authenticated via facebook at this point and can use the provider user to log us in.

        // for example we might do something like... Check if a user exists with the email and if so, log them in.
        $user = User::query()->firstOrNew(['email' => $providerUser->getEmail()]);

        // maybe we can set all the values on our user model if it is new... right now we only have name
        // but you could set other things like avatar or gender
        if (!$user->exists) {
            $user->name = $providerUser->getName();
            $user->save();
        }

        /**
         * At this point we done.  You can use whatever you are using for authentication here...
         * for example you might do something like this if you were using JWT
         */

        $token = JWTAuth::fromUser($user);

        return new JsonResponse([
            'token' => $token
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
//            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function me(){
        return response()->json($this->guard()->user());
    }
}

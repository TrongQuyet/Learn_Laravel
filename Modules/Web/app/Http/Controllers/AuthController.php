<?php

namespace Modules\Web\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        return response()->json(['message' => 'Register in successfully']);
    }

    protected function authenticated($password, $user)
    {
        Auth::logoutOtherDevices($password);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'message' => 'Logged in successfully']);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json(['message' => 'Invalid login details'], 401);
        }
        $user = Auth::getProvider()->retrieveByCredentials(['email' => $request->email, 'password' => $request->password]);
        Auth::login($user);
        info(Auth::token());
        return $this->authenticated($request->password, $user);
        // return response()->json(['message' => 'Logged in successfully']);
    }

    public function logout(Request $request)
    {
        $request->user()->update(['remember_token' => null]);
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function users(Request $request)
    {
        return Cache::remember('users', 60, function () {
            return User::all();
        });
    }

    public function user(Request $request)
    {
        return Cache::remember('user.'.$request->user()->id, 60, function () use ($request) {
            return $request->user();
        });
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $userEmail = User::where('email', $user->email)->first();
        if($userEmail){
            $userEmail->provider_id = $user->id;
            $userEmail->provider = $provider;
            $userEmail->save();
            return $userEmail;
        }
        return User::create([
            'name'     => $user->name ?? $user->email,
            'email'    => $user->email,
            'password' => Hash::make('123456'),
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/Dashboard');
    }
}

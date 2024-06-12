<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login() {
        return view('auth.login');
    }

    public function register(){
        return view('client.register');
    }

    public function loginClient(){
        return view('client.login');
    }

//login
//    public function doLoginClient(Request $request)
//    {
//        $validate = $request->validate([
//            'contact' => 'required|regex:#03[2843][0-9]{7}$#',
//        ]);
//
//        $credentials['email'] = 'default'.$request->contact.'@gmail.com';
//        $credentials['password'] = $validate['contact'];
//
//        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();
//            $user = Auth::user();
//            if ($user->isAdmin()) {
//                return redirect()->intended('/home');
//            } else {
//                return redirect()->intended('/client/home');
//            }
//        }
//
//        return back()->withErrors([
//            'email' => 'Verifier',
//            'password' => 'Verifier'
//        ])->onlyInput('email');
//    }

    public function doLoginClient(Request $request)
    {
        $validate = $request->validate([
            'contact' => 'required|regex:#03[2843][0-9]{7}$#',
        ]);

        $client = Client::where('contact',$validate['contact'])->first();
        if ($client) {
            Session::put('client',$client->id);
            return redirect()->intended('/client/home');
        } else {
            $user = new Client();
            $idCli = $user->insert($validate['contact']);
            Session::put('client',$idCli);
            return redirect()->intended('/client/home');
        }
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/client/home');
            }
        }

        return back()->withErrors([
            'email' => 'Verifier',
            'password' => 'Verifier'
        ])->onlyInput('email');
    }

    public function doRegister(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => ['required', 'string', 'email','unique:'.User::class],
            'contact' => 'required|numeric',
            'genre' => 'required|in:male,female',
            'date_naissance' => 'required|date',
            'adresse' => 'required',
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ],
        [
            'email.unique' => 'Email deja utilise',
        ]);

        $user = User::create([
            'pseudo' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false
        ]);

        DB::table('info_client')->insert(
            [
                'prenom' => $validatedData['prenom'],
                'contact' => $validatedData['contact'],
                'genre' => $validatedData['genre'],
                'date_naissance' =>  $validatedData['date_naissance'],
                'adresse' => $validatedData['adresse'],
                'id_login' => $user->id,
            ]
        );

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function insertAd()
    {
        $user = User::create([
            'pseudo' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'is_admin' => true
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function inscription()
    {
        $user = User::create([
            'pseudo' => 'user',
            'email' => 'default0348846103@gmail.com',
            'password' => Hash::make('0348846103'),
            'is_admin' => false
        ]);
    }

}

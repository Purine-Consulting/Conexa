<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Applicant;
use App\Mentee;
use App\Mentor;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'email'     => 'required|email|unique:user',
            'password'  => 'required|confirmed',
        ]);

        try {
            $user = new User;
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->enterprise = $request->input('enterprise');
            $user->gender = $request->input('gender');
            $user->birth_date = $request->input('birth_date');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->save();

            $applicant = new Applicant;
            $applicant->id = $user->id;
            $applicant->grade = $request->input('grade');
            $applicant->linkedIn = $request->input('linkedIn');
            $applicant->facebook = $request->input('facebook');
            $applicant->twitter = $request->input('twitter');
            $applicant->save();
            $applicant = Applicant::findOrFail($user->id);

            switch ($request->input('role')) {
                case 'mentor':
                    $mentor = new Mentor;
                    $mentor->id = $applicant->id;
                    $mentor->save();
                    $user->assignRole('mentor');
                    break;
                
                case 'mentee':
                    $mentee = new Mentee;
                    $mentee->id = $applicant->id;
                    $mentee->save();
                    $user->assignRole('mentee');
                    break;
                
                case 'admin':
                    $user->assignRole('admin');
                    break;

                default:
                    # code...
                    break;
            }

            return response()->json(['user' => $user, 'message' => 'Utilisateur créé avec succès'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Utilisateur non créé', 'erreur' => $e], 409);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Déconnecté avec succès!']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

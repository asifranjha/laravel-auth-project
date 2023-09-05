<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255|min:3',
            'email' => 'required|max:255|min:5|email|unique:users',
            'password' => 'required|max:25|min:4',
        ]);

        $hash = bcrypt($request->password);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $hash,
        ]);

        return back()->withErrors('success');

    }

    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|min:5|email',
            'password' => 'required|max:255',
        ]);

        $email = $request->email;
        $password = $request->password;

        $credentials = [
          'email' => $email,  
          'password' => $password,  
        ];
        
        if(Auth::attempt($credentials))
        {
            return to_route('profile.view');
        }

        // Invalid email password 
        return back()->withErrors('invalid_email_password');
    }

    public function profile_view()
    {

        $users = User::get();
        
        return view('profile', [
            'users' => $users
        ]);
    }

    public function logout()
    {
        //  Logout
        Auth::logout();

        // Redirect
        return to_route('login.view');
    }


    public function search_users(Request $request)
    {
        $keyword = $request->value;

        $users = User::where('first_name', 'LIKE' ,'%'.$keyword.'%')
            ->orWhere('last_name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
            ->get();

        return $users;

    }

}
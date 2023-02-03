<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function register()
    {
        return view('auth.register-patient');
    }

    protected function registerHospital()
    {
        return view('auth.register-hospital');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'mobile' => $request->get('mobile'),
            'password' => Hash::make($request->get('password')),
        ]);
        $patient = Patient::create([
            'name' => $request->get('name'),
            'identity_number' => $request->get('identity_number'),
            'user_id' => $user->id
        ]);
        $role = Role::where('title', 'patient')->first();
        $user->roles()->sync([$role->id]);
        session()->put('url.intended', "/admin/patients/$patient->id/edit");
        return redirect()->route('view.patient.login');
    }

    protected function createHospital(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $hospital = Hospital::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'admin_id' => $user->id,
        ]);
        $role = Role::where('title', 'hospital')->first();
        $user->roles()->sync([$role->id]);

        session()->put('url.intended', "/admin/hospitals/$hospital->id/edit");
        return redirect()->route('login');
    }
}

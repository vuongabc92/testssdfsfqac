<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Role;
use App\Models\UserProfile;
use Google_Service_Oauth2_Userinfoplus;
use Intervention\Image\Facades\Image as ImageIntervention;
use Laravel\Socialite\Facades\Socialite;
use Log;

class LoginController extends Controller {

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/settings';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm() {
        return view('frontend.auth.login');
    }

    public function redirectToFacebookProvider() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback(Request $request){

        if ($request->get('error')) {
            return redirect(route('front_login'))->withErrors([
                $this->username() => _t('auth.whoop'),
            ]);
        }

        $facebookUser = Socialite::driver('facebook')->fields(['name', 'email', 'first_name', 'last_name'])->user();
        $user         = $facebookUser->user;

        $this->socialiteLogin([
            'email'      => $facebookUser->getEmail(),
            'first_name' => isset($user['first_name']) ? $user['first_name'] : '',
            'last_name'  => isset($user['last_name'])  ? $user['last_name']  : '',
            //'avatar'     => $facebookUser->avatar_original,
            'provider'   => config('frontend.socialiteProvider.facebook')
        ]);

        return redirect(route('front_settings'));
    }

    public function redirectToGoogleProvider() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback(Request $request) {
        if ($request->get('error')) {
            return redirect(route('front_login'))->withErrors([
                $this->username() => _t('auth.whoop'),
            ]);
        }

        $googleUser = Socialite::driver('google')->user();
        $user       = $googleUser->user;

        $this->socialiteLogin([
            'email'      => $googleUser->getEmail(),
            'first_name' => isset($user['first_name']) ? $user['first_name'] : '',
            'last_name'  => isset($user['last_name'])  ? $user['last_name']  : '',
            //'avatar'     => $googleUser->avatar_original,
            'provider'   => config('frontend.socialiteProvider.facebook')
        ]);

        return redirect(route('front_settings'));
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $email = request()->get('email');
        if (empty($email)) {
            return 'email';
        }

        $loginType = filter_var(request()->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        //Change request login type value
        request()->merge([$loginType => $email]);

        return $loginType;
    }

    protected function socialiteLogin($data) {

        $email         = isset($data['email'])      ? $data['email']      : '';
        //$avatar        = isset($data['avatar'])     ? $data['avatar']     : '';
        $firstName     = isset($data['first_name']) ? $data['first_name'] : '';
        $lastName      = isset($data['last_name'])  ? $data['last_name']  : '';
        $loginProvider = isset($data['provider'])   ? $data['provider']   : null;
        $emailSplit    = explode('@', $email);

        $user         = User::where('email', $email)->first();
        if (is_null($user)) {

            $slug                 = $this->_randomSlug($emailSplit[0]);
            $roleMember           = Role::where('slug', 'member')->first();

            $user                 = new User();
            $user->email          = $email;
            $user->username       = $slug;
            $user->role_id        = ($roleMember) ? $roleMember->id : 2;
            $user->login_provider = $loginProvider;
            $user->save();

            $userProfile          = new UserProfile();
            $userProfile->user_id = $user->id;
            $userProfile->slug    = $slug;

            //Temporary removing save avatar because it takes so long
//            if ($avatar) {
//                $avatar                    = $this->socialiteSaveAvatar($avatar);
//                $userProfile->avatar_image = serialize($avatar);
//            }

            if ($firstName) {$userProfile->first_name = $firstName;}
            if ($lastName) {$userProfile->last_name = $lastName;}

            $userProfile->save();
        }

        auth()->loginUsingId($user->id);
    }

    /**
     * Save avatar from social
     *
     * @param $avatarUrl
     * @return array
     * @throws \Exception
     */
    protected function socialiteSaveAvatar($avatarUrl) {
        try {
            $storagePath             = config('frontend.avatarsFolder');
            $tmpPath                 = config('frontend.tmpFolder');
            $sizes                   = config('frontend.avatarSizes');
            $clientOriginalExtension = 'jpg';
            $names                   = [];

            unset($sizes['original']);
            $tmp_original = generate_filename($tmpPath, $clientOriginalExtension, ['prefix' => 'avatar_original']);
            file_put_contents($tmpPath . '/' . $tmp_original, file_get_contents($avatarUrl));

            foreach ($sizes as $size) {
                $name = generate_filename($storagePath, $clientOriginalExtension, [
                    'prefix' => 'avatar_',
                    'suffix' => "_{$size['w']}x{$size['h']}"
                ]);

                $image = ImageIntervention::make($tmpPath . '/' . $tmp_original)->orientate();
                $image->fit($size['w'], $size['h'], function ($constraint) {
                    $constraint->upsize();
                });

                $image->save($storagePath . '/' . $name);
                $names[$size['w']] = $name;
            }

            delete_file($tmpPath . "/" . $tmp_original);
            return $names;
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * Random slug
     *
     * @param $prefix string
     *
     * @return string
     */
    protected function _randomSlug($prefix) {
        $userProfile = User::where('username', $prefix)->first();
        if ($userProfile === null) {
            $routes     = Route::getRoutes();
            $checkRoute = false;
            foreach ($routes as $route) {
                $routeSplit = explode('/', $route->uri);
                if (isset($routeSplit[0]) && $prefix == $routeSplit[0]) {
                    $checkRoute = true;
                    break;
                }
            }

            if ( ! $checkRoute) {
                return $prefix;
            }
        }

        $slug        = $prefix . "_" . random_string(6, $available_sets = 'lud');
        $userProfile = User::where('username', $slug)->first();
        
        if ($userProfile === null) {
            return $slug;
        }

        return $this->_randomSlug($slug);
    }

    /**
     * Check does the user allow to login
     *
     * @param $email
     * @return bool|mixed
     */
    protected function allowLogin($email) {
        $user = User::where('email', $email)->first();
        
        if (is_null($user)) {
            return true;
        }
        
        return $user->activated;
    }

    /**
     *
     * * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request) {
        $this->validate($request,
            ['email' => 'required|activated', 'password' => 'required'],
            ['email.required' => _t('auth.email.required'), 'password.required' => _t('auth.pass.required')]
        );
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request) {
        return redirect(route('front_login'))
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => _t('auth.failed'),
            ]);
    }
}

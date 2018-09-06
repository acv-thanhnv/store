<?php

namespace App\Api\V1\Http\Controllers\Auth;

use App\Api\V1\Models\User;
use App\Api\V1\Http\Controllers\Controller;
use App\Core\Common\SDBStatusCode;
use App\Core\Common\ApiConst;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\ResponseHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'email';
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = array('email' => $request->input('email'), 'password' => $request->input('password'), 'is_active' => 1);
        return $credentials;
    }
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $email = $request->get($this->username());
        $client = User::where($this->username(), $email)->first();
        $response = new DataResultCollection();
        if ($this->attemptLogin($request)) {
            $user=Auth::user();
            $token =  $user->createToken('By Login from user:'.$user->getAuthIdentifier());
            $accessToken = $token->accessToken;
            $refreshToken = '';// $token->refresh_token;
            $response->status = SDBStatusCode::OK;
            $response->data = array(ApiConst::ApiAccessTokenParamName=>$accessToken,ApiConst::ApiRefreshTokenParamName=>$refreshToken);
            return ResponseHelper::JsonDataResult($response);
        }else{
            $this->incrementLoginAttempts($request);
            // Customization: If client status is inactive (0) return failed_status error.
            if (isset($client->is_active)&& $client->is_active === 0) {
                $response->status = SDBStatusCode::ApiError;
                $response->message= trans('auth.not_active');
            }else{
                $response->status = SDBStatusCode::ApiError;
                $response->message= trans('auth.can_not_login');
            }
        }

        return ResponseHelper::JsonDataResult($response);
    }

    /**
     * revoke current token
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        $result  =  new DataResultCollection();
        $result->status = SDBStatusCode::ApiAuthNotPass;
        if(Auth::check()){
            $result->status = SDBStatusCode::OK;
            $accessToken = Auth::user()->token();
            $accessToken->revoke();
        }
        return ResponseHelper::JsonDataResult($result);
    }
}

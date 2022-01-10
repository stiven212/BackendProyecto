<?php
namespace App\Http\Controllers;
use App\Http\Resources\OrderCollection;
use App\Models\Car;
use App\Models\OrderBuy;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use App\Http\Resources\User as UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
    private static $messages = [
        'email.unique' => 'Correo ya existente',

    ];
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $users = User::all();
        $user = null;
        foreach ($users as $u) {
            if ($request->email === $u->email) {
                $user = $u;
            }
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'credenciales invalidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        //$user = JWTAuth::user();
        return response()->json(new UserResource($user, $token))
            //return response()->json(compact('token', 'user'))
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl => time to live
                '/', // path
                null, // domain
                config('app.env') !== 'local', // Secure
                true, // httpOnly
                false, //
                config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );
    }
    public function register(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//        ], self::$messages);
//        if($validator->fails()){
//            return response()->json($validator->errors()->toJson(), 400);
//        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],self::$messages);


        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(new UserResource($user, $token), 201)
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'),
                '/',
                null,
                config('app.env') !== 'local',
                true,
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax'
            );

    }

    public function createCar(){

        $car = Car::create();
      //  $car->user_id = Auth::id();


        return response()->json($car,201);

    }

    public function createWish(){
        $wish = WishList::create();

        return response()->json($wish, 201);
    }

    public function showCar(){

        $id = Auth::id();

        $cars = Car::all();
        $car= Car::all()->where('user_id', $id);
//        foreach ($cars as $carr){
//            if($carr->user_id === $id){
//                $car = $carr;
//            }
//        }
        return response()->json($car,208);

    }



    public function showWish(){
        $id = Auth::id();

        $wish = WishList::all()->where('user_id',$id);

        return response()->json($wish, 208);
    }

    public function showOrders(){
        $id = Auth::id();

        $orders = OrderBuy::all();
        $order = [];

        foreach ($orders as $o){
            if($o->user_id === $id){
                $order[] =$o;
            }
        }

        return response()->json(new OrderCollection($order),200);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message'=>'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(new UserResource($user),200);
    }

    public function update(Request $request){

        $user = JWTAuth::parseToken()->authenticate();

//        $request.password_hash($request->getPassword(),121);
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'string|min:6|confirmed',
        ],self::$messages);
        $user->update(['name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),]);

//        $user->update($request->all());
        //            'password' => Hash::make($request->get('password')),

        return response()->json(new UserResource($user),200);

    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

//            Cookie::queue(Cookie::forget('token'));
//            $cookie = Cookie::forget('token');
//            $cookie->withSameSite('None');
            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200)
                ->withCookie('token', null,
                    config('jwt.ttl'),
                    '/',
                    null,
                    config('app.env') !== 'local',
                    true,
                    false,
                    config('app.env') !== 'local' ? 'None' : 'Lax'
                );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }

    public function forgot(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            $request->only('email')
        );

        return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email'=> __($status)]);
    }

    public function getToken($token){
        return view('auth.password.reset-password', ['token' => $token]);

    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        //json('Restablecimiento correcto de la contraseña') //
        return $status === Password::PASSWORD_RESET
            ? response()-> view('auth.password.successfully')//redirect()->route('welcome')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

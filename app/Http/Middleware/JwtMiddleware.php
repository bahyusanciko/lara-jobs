<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtMiddleware extends BaseMiddleware
    {

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                if ($user) {
                    $request->attributes->add(['user' =>  $user->toArray()]);
                }else{
                    $message = 'Authorization Token not found';
                    $data = [
                        "response" => [
                            "code" =>  400,
                            "message" => $message
                        ],
                        "code" => 200
                    ];
                    return response()->json($data['response'], $data['code']);
                }
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    $message = 'Token is Invalid';
                }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    $message = 'Token is Expired';
                }else{
                    $message = 'Authorization Token not found';
                }
                $data = [
                    "response" => [
                        "code" =>  400,
                        "message" => $message
                    ],
                    "code" => 200
                ];
                return response()->json($data['response'], $data['code']);
            }
            return $next($request);
        }
    }
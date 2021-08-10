<?php
/**
 * @Name: OptionsRequest.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\Frame\Laravel\Middleware;


class OptionsRequest{

    /**
     * @Desc 跨域请求处理
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @author hug-code
     */
    public function handle($request, \Closure $next){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: content-type,token');
        if($request->getMethod() === 'OPTIONS'){
            Response('', 204)->send();
            exit;
        }
        return $next($request);
    }

}

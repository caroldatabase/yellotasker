<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                if(str_contains($action['controller'],'@index')){
                    $step1 = str_replace('Modules\Admin\Http\Controllers','',$action['controller']);    
                    $step2 = str_replace("@index", '', $step1);
                    $step3 = str_replace("Controller", '', $step2);
                    
                    $notArr = ['Auth','Admin','Role'];
                    if(in_array(ltrim($step3,'"\"'), $notArr))
                    {
                        continue;
                    }else{
                        $controllers[] = ltrim($step3,'"\"');
                    }
                }
                
            }
        }

        try{
            $ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            
            if($ipInfo->status=="success"){ 
                 
                $timezone = $ipInfo->timezone; 
                
            }else{
                $timezone = date_default_timezone_get();

            }
        }catch(\Exception $e){
            $timezone = date_default_timezone_get();
        }
       // $timezone = 'Asia/Kolkata';
        config(['app.timezone' => $timezone]);

        date_default_timezone_set($timezone);
        
        View::share('controllers',$controllers);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

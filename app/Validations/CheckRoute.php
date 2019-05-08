<?php
namespace App\Validations;

use Validator;
use Illuminate\Support\Facades\Route;

class CheckRoute
{
    /**
     * Validation rule name
     *
     * @var string $rule
     */
    private $rule = 'check_route';

    /**
     * Validation rule message
     *
     * @var string $message
     */
    private $message = 'register.uname.uni';

    public function __construct()
    {
        Validator::extend($this->rule, function($attribute, $value){
            $routes = Route::getRoutes();

            foreach ($routes as $route) {
                $routeSplit = explode('/', $route->uri);
                if (isset($routeSplit[0]) && $value == $routeSplit[0]) {
                    return false;
                }
            }

            return true;
        });

        Validator::replacer($this->rule, function () {
            return _t($this->message);
        });
    }

}
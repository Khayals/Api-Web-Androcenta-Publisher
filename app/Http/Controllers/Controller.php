<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function response() {
        return new ResponseHelper();
    }    
}

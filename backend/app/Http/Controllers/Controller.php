<?php

namespace App\Http\Controllers;

use App\Traits\RequestValidate;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use RequestValidate;
}

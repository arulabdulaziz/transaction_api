<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public const SUCCESS_STATUS = 200;
    public const BAD_REQUEST_STATUS = 400;
    public const UNAUTHORIZE = 401;
    public const NOT_FOUND = 404;
    public const UPGRADE_REQUIRED = 426;
    public const USER_UNAUTHORIZE = 401001;
    public const CASHIER_UNAUTHORIZE = 401002;

    public const EMAIL_NOT_VERIFIED = 411001; //
    public const PHONE_NOT_VERIFIED = 412001; //
    public const USER_DOES_NOT_HAS_OUTLET = 420000; //

    public const EMAIL_HAS_VERIFIED = 411002; //
    public const PHONE_HAS_VERIFIED = 412002; //

    public const OUTLET_SUBSCRIPTION_EXPIRED = 421001; //

    public const USER_INACTIVE = 403001; //

    public const INCORRECT_DATA = 402001; //

    public const FATAL_INPUT_ERROR = 991001; //
    public const OBSOLETE_APP_VERSION = 100010; //

    //BUSINESS
    public const BUSINESS_EMAIL_NOT_VERIFIED = 511001; //
    public const BUSINESS_PHONE_NOT_VERIFIED = 512001; //
}

<?php

use Behamin\BResources\Helpers\ApiResponse\Api;

if (!function_exists('apiResponse')) {
    function apiResponse(): Api
    {
        return new Api();
    }
}

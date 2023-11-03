<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    const ERROR_MSG = 'Error! An error occurred. Please try again later';
}

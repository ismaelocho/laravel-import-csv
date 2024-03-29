<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {

    /* This method will call SendEmailJob Job*/

    dispatch(new SendEmailJob($request));

    }
}

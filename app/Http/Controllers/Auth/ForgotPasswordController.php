<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    
    use SendsPasswordResetEmails;
    
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(['status' => trans($response)], 200);
    }

    protected function sendResetlinkFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 422);
    }
}

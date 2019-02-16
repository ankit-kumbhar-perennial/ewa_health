<?php

namespace App\Services;

use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class RegistrationService
{

    protected $mailer, $notify;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendForgotPasswordOtp($otp, $mailTo)
    {
        try {
            $textMessage = str_replace('#OTP#', $otp, Config::get('constants.FORGOT_PASSWORD_OTP_TEXT'));
            $data = [
                'textMessage' => $textMessage
            ];
            $this->mailer->send("emails.otpVerification", $data, function (Message $m) use ($mailTo) {
                $m->to($mailTo)->subject("Forgot Password");
            });
            return true;
        } catch (\Exception $ex) {
            Log::info($ex->getMessage() . " = " . $ex->getLine());
        }
    }

}
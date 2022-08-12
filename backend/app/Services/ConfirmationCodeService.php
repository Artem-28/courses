<?php

namespace App\Services;

use App\Models\ConfirmationCode;
use Carbon\Carbon;

class ConfirmationCodeService
{
    private int $liveTimeCode;

    public function __construct()
    {
        $this->liveTimeCode = 360;
    }

    private function generateCode(int $codeLength): string
    {
        $random = array();

        for ($c = -1; $c < $codeLength - 1; $c++) {
            array_push($random, mt_rand(0, 9));
            shuffle($random);
        }

        return join('', $random);
    }

    private function saveEmailCode($email): string
    {
        $code = ['code' => $this->generateCode(6)];

        $confirmCode = ConfirmationCode::updateOrCreate([
            'email' => $email
        ], $code);

        return $confirmCode->code;
    }

    private function savePhoneCode($phone)
    {
        return null;
    }

    private function checkIsLiveCode(ConfirmationCode $confirmationCode): bool
    {
        $updatedDate = $confirmationCode->updated_at;
        $updatedTimestamp = Carbon::parse($updatedDate)->timestamp;
        $nowTimestamp = Carbon::now()->timestamp;

        return  $updatedTimestamp + $this->liveTimeCode > $nowTimestamp;
    }

    private function getEmailCode($email): ConfirmationCode
    {
        return ConfirmationCode::where('email', $email)->first();
    }

    private function checkEmailCode(string $email, string $confirmCode): array
    {
        $dataCode = $this->getEmailCode($email);
        $live = $this->checkIsLiveCode($dataCode);
        $matches =  $dataCode->code === $confirmCode;

        return array('live' => $live, 'matches' => $matches);
    }

    private function checkPhoneCode(int $phone, string $confirmCode): array
    {
        return array('live' => false, 'matches' => false);
    }

    public function createCode($type, $address)
    {
        switch ($type) {
            case ConfirmationCode::EMAIL_CODE:
                return $this->saveEmailCode($address);
            case ConfirmationCode::PHONE_CODE:
                return $this->savePhoneCode($address);
        }
    }

    public function checkCode(string $type, $address, string $confirmCode = '')
    {
        switch ($type) {
            case ConfirmationCode::EMAIL_CODE:
                return $this->checkEmailCode($address, $confirmCode);
            case ConfirmationCode::PHONE_CODE:
                return $this->checkPhoneCode($address, $confirmCode);
        }
    }
}

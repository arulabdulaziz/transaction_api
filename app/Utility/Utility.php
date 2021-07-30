<?php

namespace App\Utility;

use Illuminate\Hashing\Argon2IdHasher;
use Illuminate\Support\Facades\Hash;

class Utility
{

    public static function getErrorMessage()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute harus berupa angka.',
            'string' => ':attribute harus berupa text.',
            'min' => ':attribute minimal :min.',
            'max' => ':attribute maxilam :max.',
            'file' => ':attribute harus berupa file.',
            'email' => ':attribute harus email yang benar.',
            'mimes' => 'Jenis file yang Anda unggah salah.',
            'unique' => ':attribute sudah terdaftar'

        ];
    }
    public static function argonForMobile($text){
        return Hash::make($text,[
            'memory' => 32768,
            'time' => 3,
            'threads' => 1,
        ]);
    }
    public static function getNow()
    {
        return now()->format('Y-m-d H:i:s.u');
    }
    public static function validatePhoneNumber($phone)
    {
        if(strlen($phone)<7 || strlen($phone)>16)
            return false;

        if (strpos($phone, "0") === 0) {
            return substr_replace($phone,"62",0,1);
        }
        else if (strpos($phone, "62") === 0){
            return $phone;
        }
        else if(strpos($phone, "8") === 0){
            return substr_replace($phone,"62",0,0);
        }
        else{
            return false;
        }
    }
    public static function getCurrentRow($var)
    {
        $var->count++;
        return $var->getChunkOffset() + $var->count;
    }
}

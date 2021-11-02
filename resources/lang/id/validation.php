<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'email' => ':attribute tidak valid.',
    'numeric' => ':attribute harus nomor.',
    'password' => 'password salah.',
    'required' => ':attribute harus diisi.',
    'same' => ':attribute dan :other harus sama.',
    'max' => [
      'numeric' => ':attribute harus kurang dari :max.',
      'file' => ':attribute harus kurang dari :max kilobytes.',
      'string' => ':attribute harus kurang dari :max karakter.',
      'array' => ':attribute harus kurang dari :max items.',
    ],
    'min' => [
      'numeric' => ':attribute harus lebih dari :min.',
      'file' => ':attribute harus lebih dari :min kilobytes.',
      'string' => ':attribute harus lebih dari :min karakter.',
      'array' => ':attribute harus lebih dari :min item.',
    ],
    'unique' => ':attribute sudah ada.',

];

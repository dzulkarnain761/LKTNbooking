<?php

return [
    'custom' => [
        'name' => [
            'required' => 'Sila berikan nama anda.',
            'string' => 'Nilai yang dimasukkan perlu dalam bentuk teks.',
            'max' => [
                'string' => 'Panjang nama tidak boleh melebihi :max aksara.',
            ],
        ],
        'email' => [
            'nullable' => 'Alamat emel tidak boleh dibiarkan kosong.',
            'string' => 'Nilai yang dimasukkan perlu dalam bentuk teks.',
            'lowercase' => 'Alamat emel perlu dalam huruf kecil.',
            'email' => 'Sila berikan alamat emel yang sah.',
            'max' => [
                'string' => 'Panjang alamat emel tidak boleh melebihi :max aksara.',
            ],
            'unique' => 'Alamat emel ini telah digunakan.',
        ],
        'ic_number' => [
            'required' => 'Sila berikan nombor kad pengenalan.',
            'string' => 'Nilai yang dimasukkan perlu dalam bentuk teks.',
            'max' => [
                'string' => 'Panjang nombor kad pengenalan tidak boleh melebihi :max aksara.',
            ],
            'unique' => 'Nombor kad pengenalan ini telah digunakan.',
            'exists' => 'Nombor Kad Pengenalan Tak Dijumpai.',
        ],
        'phone_number' => [
            'required' => 'Sila berikan nombor telefon.',
            'string' => 'Nilai yang dimasukkan perlu dalam bentuk teks.',
            'max' => [
                'string' => 'Panjang nombor telefon tidak boleh melebihi :max aksara.',
            ],
        ],
        'username' => [
            'required' => 'Sila berikan nama pengguna.',
            'string' => 'Nilai yang dimasukkan perlu dalam bentuk teks.',
            'max' => [
                'string' => 'Panjang nama pengguna tidak boleh melebihi :max aksara.',
            ],
            'unique' => 'Nama pengguna ini telah digunakan.',
        ],
        'password' => [
            'required' => 'Sila berikan kata laluan.',
            'confirmed' => 'Pengesahan kata laluan tidak sepadan.',
            'password' => 'Kata laluan mestilah sekurang-kurangnya 8 aksara panjang dan mengandungi sekurang-kurangnya satu huruf besar, satu huruf kecil, dan satu nombor.',
        ],
    ],
];

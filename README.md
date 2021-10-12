# lib-courier

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-courier
```

## Penggunaan

Module ini menambahkan satu library dengan nama `LibCourier\Library\Courier` yang
bisa digunakan untuk bekerja dengan library courier:

```php
use LibCourier\Library\Courier;

$delivery_cost = Courier::cost([
    'origin' => [
        'id' => 1,
        'type' => 'city'
    ],
    'destination' => [
        'id' => 1,
        'type' => 'city'
    ],
    'weight' => 1000, // in gram
    'courier' => ['jne'], // courier code
    'length' => 100, // package length in cm
    'width' => 100, // package width in cm
    'height' => 100, // package height in cm
    'diameter' => 100, // package diameter in cm
]);

$tracking = Courier::track($courier, $courier_receipt);
```

## Implementasi Courier

Masing-masing courier handler harus mengimplementasikan interface `LibCourier\Iface\Handler`,
sehingga masing-masing handler harus memiliki method sebagai berikut:


### cost(array $data): ?array

Mengambil harga pengiriman berdasarkan data pengiriman. Fungsi ini harus mengembalikan
data null jika error atau array sebagai berikut jika berhasil:

```php
[
    [
        'courier' => [
            'name' => 'Jalur Nugraha Ekakurir (JNE)',
            'code' => 'jne'
        ],
        'packages' => [
            [
                'name' => 'OKE',
                'info' => 'Ongkos Kirim Ekonomis',
                'cost' => '26000',
                'etd'  => '6-7',
                'note' => '...'
            ],
            // ...
        ]
    ],
    // ...
]
```

### track(string $courier, string $courier_receipt): ?array

Mengambil tracking pengiriman. Fungsi ini harus mengembalikan data null jika
terjadi error, atau array sebagai berikut jika berhasil:

```php
[
    // 1 pending
    // 2 receiped from sender
    // 3 on the way
    // 4 delivered
    'status' => ::int,
    'tracks' => [
        [
            'desc' => 'Manifested',
            'date' => '2015-03-04 03:41:00',
            'place' => 'SOLO',
            'status' => 2,
            'info' => '...'
        ],
        // ...
        [
            'desc' => 'Received On Destination',
            'date' => '2015-03-05 08:57:00',
            'note' => 'PALEMBANG',
            'status' => 4,
            'info' => 'RISKA VIVI'
        ]
    ]
]
```

### lastError(): ?string

## Konfigurasi

Setelah selesai membuat library handler untuk kurir, pastikan mendaftarkan library
tersebut sebagai handler untuk suatu kurir sebagai berikut:

```php
<?php

return [
    'libCourier' => [
        'handlers' => [
            'courier-code' => 'Class\\Handler',
            'jne' => 'LibCourierRajaOngkir\\Library\\Handler'
        ]
    ]
];
```

<?php


namespace App\Services;


class OngkirService extends BaseService
{
    public function getProvincy() {
        return $this->get('province',[
            'headers' => [
                'key'           => env('API_KEY_RAJA_ONGKIR'),
                'Content-Type'  => 'application/json'
            ]
        ]);
    }

    public function getCity($id_provincy) {
        return $this->get('city?province='.$id_provincy,[
            'headers' => [
                'key'           => env('API_KEY_RAJA_ONGKIR'),
                'Content-Type'  => 'application/json'
            ]
        ]);
    }

    public function getOngkir($provincy,$kota,$weight) {
        return $this->post('cost',[
            'json'    => [
                'origin'        => '108',
                'destination'   => $kota,
                'weight'        => $weight,
                'courier'       => 'jne'
            ],
            'headers' => [
                'key'           => env('API_KEY_RAJA_ONGKIR'),
                'Content-Type'  => 'application/json'
            ]
        ]);
    }

}
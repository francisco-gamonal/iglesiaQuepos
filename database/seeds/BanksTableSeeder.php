<?php

use Illuminate\Database\Seeder;
use SistemasAmigables\Entities\Bank;

class BanksTableSeeder extends Seeder {

    public function run() {
        Bank::create([
            'id' => 1,
            'date' => '2015-01-05',
            'balance' => '55000',
            'record_id' => 1,
            'check_id' => NULL,
            'type'=>'entradas'
        ]);
        Bank::create([
            'id' => 2,
            'date' => '2015-01-05',
            'balance' => '50000',
            'record_id' => NULL,
            'check_id' => 1,
            'type'=>'salidas'
        ]);
    }

}

<?php

class Historial extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'sabado' => 'required',
        'numero' => 'required',
        'saldo' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = ['numero', 'sabado', 'saldo'];

    public function lastId() {
        $lastId = Historial::orderBy('id', 'desc')->first();
        if ($lastId == null) {
            return 0;
        }
        return $lastId->id;
    }

}

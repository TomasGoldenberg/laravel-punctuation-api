<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;
//extendemos de Pivot en ligar de Model
class Rating extends Pivot
{
    public $incrementing = true;

    protected $table = "ratings";
    
    public function rateable(){
        return $this->morphTo();
    }

    public function qualifier(){
        return $this->morphTo();
    }
}

<?php

namespace App\Utils;
use Illuminate\Database\Eloquent\Model;

trait CanBeRated{

    public function qualifiers(string $model = null){
        $modelClass = $model ? (new $model)->getMorphClass() : $this->getMorphClass();
    
        return $this->morphToMany($modelClass,
         'rateable', 
         'ratings', 
         'rateable_id', 
         'qualifier_id')
            ->withPivot('qualifier_type', 'score')
            ->wherePivot('qualifier_type', $modelClass)
            ->wherePivot('rateable_type', $this->getMorphClass());
    }

    public function averageRating(string $model = null){
//la calificacion relacionada con el model ->el promedio  de score ? si no tengo  nada deuvelvo 0
        return $this->qualifiers($model)->avg("score") ?: 0.0;
    }
}
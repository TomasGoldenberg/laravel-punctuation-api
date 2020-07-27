<?php

namespace App\Utils;
use Illuminate\Database\Eloquent\Model;

trait CanRate
{
    public function ratings($model = null){
        $modelClass = $model ? $model : $this->getMorphClass();

        $morphToMany = $this->morphToMany(
            $modelClass,
            "qualifier",
            "ratings",
            "qualifier_id", // la Key del CanRate
            "rateable_id"
        );

        $morphToMany
            ->as("rating")
            ->withTimestamps()
            ->withPivot("score", "rateable_type")
            ->wherePivot("rateable_type", $modelClass) //que rateable sea igual al rateable que idetificamos
            ->wherePivot("qualifier_type", $this->getMorphClass()); // que el qualifier sea la misma entidad que esta usando CanRate
   
        return $morphToMany;
        }

    public function rate(Model $model, float $score){


        if($this->hasRated($model)){
            return false;
        }


                                        //id del model
        $this->ratings($model)->attach($model->getKey(),[
            "score" => $score,
            "rateable_type" => get_class($model)
        ]);
        
        //this=qualifier(el que puede calificar),
        //$model = el modelo que recibimos para calificar
        //$score =  el puntaje
        event(new ModelRated($this, $model,$score));

        return true;
    }


    public function unrate(Model $model):bool
    {
        if(!$this->hasRated($model)){
            return false;
        }

        $this->ratings($model->getMorphClass())->detach($model->getKey());

        return true;
    }

    public function hasRated(Model $model){
          // verificar  si es null la relacion entre la entidad calificadora y la calificada 
        return ! is_null($this->ratings($model->getMorphClass())->find($model->getKey()));
    }
}
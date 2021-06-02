<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = ['id_review','review','users_id','id_movie_tv','category'];

}

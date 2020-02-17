<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planos extends Model
{
      public $timestamps = false ;
      protected $fillable = [
        'tema',
        'curso',
        'disciplina',
        'planDescription',
        'datas',
        'planoEnsino',
        'materialExtra',
        'nivelEnsino',
        'semestreAno',
        'validacao',
        'recusarPlano',
        'knowArea',
        'PlanAuth',
        'title',
        'typePlan',
        'namePlan',
        'nameMaterialExtra'
    ];
}

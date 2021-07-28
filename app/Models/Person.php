<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthdate',
        'cpf',
        'rg',
        'profile',
    ];

}

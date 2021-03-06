<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonApps extends Model
{

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'person_apps';

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
        'person_id',
        'apps_id',
    ];

    /**
     * Get the phone associated with the person.
     */
    public function person()
    {
        return $this->hasMany(Person::class, 'id', 'person_id');
    }

    /**
     * Get the phone associated with the apps.
     */
    public function apps()
    {
        return $this->hasMany(Apps::class, 'id', 'apps_id');
    }

}

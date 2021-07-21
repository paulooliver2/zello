<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PersonApps extends Model
{

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
        'name',
        'bundle_id',
    ];

    /**
     * Get the phone associated with the person.
     */
    public function person()
    {
        return $this->hasOne(Person::class);
    }

    /**
     * Get the phone associated with the apps.
     */
    public function apps()
    {
        return $this->hasOne(Apps::class);
    }


}

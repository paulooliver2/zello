<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apps';

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
     * Get the user that owns the apps.
     */
    public function personApps()
    {
        return $this->belongsTo(PersonApps::class);
    }


}

<?php

namespace Modules\Files\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class File extends  Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'size',
        'original_name',
        'uuid',
        'extension',
        'file_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'original_name',
        'size',
        'extension',
        'file_path',
        'fileable',
        'tutor'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    function fileable()
    {
        return $this->morphTo();
    }

    function tutor(){
        return $this->belongsTo(User::class, 'tutor_id');
    }


}

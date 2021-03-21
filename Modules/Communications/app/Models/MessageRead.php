<?php

namespace Modules\Communications\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

/**
 * Messages from tutors to students
 * Class StudentMessage
 * @package Modules\Communications\Models
 */
class MessageRead extends  Model
{

    protected $table = 'communications_message_students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'read_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
    ];

    function message()
    {
        return $this->belongsTo(MessageRead::class, 'message_id');
    }

    public function reicever()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }






}

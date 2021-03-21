<?php

namespace Modules\Communications\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Communications\Database\Factories\TutorMessageFactory;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

/**
 * Messages to tutors from students
 * Class TutorMessage
 * @package Modules\Communications\Models
 */
class TutorMessage extends  Model
{
    use HasFactory;

    protected $table = 'communications_tutor_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'read_at',
        'subject',
        'message',
        'sender',
        'reicever'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    function sender()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function reicever()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function responseTo(){
        return $this->belongsTo(StudentMessage::class, 'original_message_id');
    }

    public static function newFactory()
    {
        return TutorMessageFactory::new();
    }

}

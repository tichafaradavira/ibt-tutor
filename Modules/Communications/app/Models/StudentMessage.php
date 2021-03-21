<?php

namespace Modules\Communications\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Communications\Database\Factories\StudentMessageFactory;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

/**
 * Messages from tutors to students
 * Class StudentMessage
 * @package Modules\Communications\Models
 */
class StudentMessage extends  Model
{
    use HasFactory;

    protected $table = 'communications_student_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'message',
//        'message_sequence',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'subject',
//        'message_sequence',
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
        return $this->belongsTo(User::class, 'tutor_id');
    }


    public function reicevers()
    {
        return $this->belongsToMany(Student::class, 'communications_message_students', 'message_id', 'student_id');
    }


    public function reicever()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function responseTo(){
        return $this->belongsTo(TutorMessage::class, 'original_message_id');
    }


    function getReadAtAttribute(){
        if($this->reicever){
            return DB::table('communications_message_students')
                ->select('read_at')
                ->where('message_id', $this->id)
                ->where('student_id', $this->reicever->id)
                ->first()->read_at;
        }
        else{
            return null;
        }
    }

    public static  function newFactory()
    {
        return StudentMessageFactory::new();
    }


}

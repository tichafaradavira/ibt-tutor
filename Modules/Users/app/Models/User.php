<?php
namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
use Modules\Users\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use HasFactory;

    protected  $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin',
        'first_name' ,
        'last_name' ,
        'email',
        'dob',
        'country',
        'language',
        'phone_number',
        'user_type',
        'password',
        'recovery_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'is_admin',
        'first_name' ,
        'last_name' ,
        'email',
        'dob',
        'country',
        'language',
        'phone_number',
        'user_type',
        'students',
        'recovery_token',
        'student_ids',
        'suspended_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'suspended_at' => 'datetime',
        'dob' => 'date',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_tutor', 'user_id', 'student_id');
    }

    public function getStudentIdsAttribute()
    {
        $ids =  Arr::pluck($this->students, 'id');
        return $ids;
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}

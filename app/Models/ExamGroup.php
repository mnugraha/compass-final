<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroup extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'exam_session_id',
        'user_id',
    ];

    /**
     * exam
     *
     * @return void
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * exam_session
     *
     * @return void
     */
    public function exam_session()
    {
        return $this->belongsTo(ExamSession::class);
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
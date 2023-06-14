<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\ExamGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'exam_id',
        'title',
        'start_time',
        'end_time',
    ];

    /**
     * exam_groups
     *
     * @return void
     */
    public function exam_groups()
    {
        return $this->hasMany(ExamGroup::class);
    }

    /**
     * exam
     *
     * @return void
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
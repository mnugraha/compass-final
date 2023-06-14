<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Peran;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'level_id',
        'peran_id',
        'duration',
        'description',
        'random_question',
        'random_answer',
        'show_answer',
    ];

    /**
     * level
     *
     * @return void
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    /**
     * peran
     *
     * @return void
     */
    public function peran()
    {
        return $this->belongsTo(Peran::class, 'peran_id');
    }

    /**
     * questions
     *
     * @return void
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('id', 'DESC');
    }
}

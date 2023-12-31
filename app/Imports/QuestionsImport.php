<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    protected $examId;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    /**
     * __construct
     *
     * @param  mixed $examId
     * @return void
     */
    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Question([
            'exam_id' => (int) $this->examId,
            'question' => $row['question'],
            'option_1' => $row['option_1'],
            'option_2' => $row['option_2'],
            'option_3' => $row['option_3'],
            'option_4' => $row['option_4'],
            'option_5' => $row['option_5'],
            'answer' => $row['answer'],
        ]);
    }
}

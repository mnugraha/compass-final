<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GradesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * grades
     *
     * @var mixed
     */
    protected $grades;

    /**
     * __construct
     *
     * @param  mixed $grades
     * @return void
     */
    public function __construct($grades)
    {
        $this->grades = $grades;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->grades;
    }

    public function map($grades): array
    {
        return [
            $grades->exam->title,
            $grades->exam_session->title,
            $grades->user->id_user,
            $grades->user->name,
            $grades->grade,
            $grades->start_time,
            $grades->end_time,
            $grades->total_correct,
            $grades->total_incorrect,
        ];
    }

    public function headings(): array
    {
        return [
            'Ujian',
            'Sesi',
            'Id User',
            'Nama',
            'Nilai',
            'Mulai Mengerjakan',
            'Selesai Mengerjakan',
            'Jumlah Benar',
            'Jumlah Salah',
        ];
    }
}
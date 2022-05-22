<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class UsersExport implements FromArray,WithHeadings,ShouldAutoSize
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'insurance_plan',
            'date_received',
            'date_need_to_be_finished',
            'medicaid_id',
            'member_id',
            'first_name',
            'last_name',
            'sex',
            'date_of_birth',
            'primary_language',
            'cell_phone',
            'home_phone',
            'marital_status',
            'email',
            'address',
            'city',
            'state',
            'zip_code',
            'country',
            'assesment_type'

        ];
    }

}

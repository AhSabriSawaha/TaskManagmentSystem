<?php

namespace Modules\TaskManagmentSystem\app\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\TaskManagmentSystem\app\Models\Task;

class TaskExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::all();
    }
}

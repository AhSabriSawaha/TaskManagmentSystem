<?php

namespace Modules\TaskManagmentSystem\app\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\TaskManagmentSystem\app\Models\Project;

class ProjectExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Project::all();
    }
}

<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectExport implements FromCollection, WithHeadings, WithMapping
{
    protected $projects;

    /**
     * @param array $ids Array of project IDs to export
     */
    public function __construct(array $ids)
    {
        // Fetch only the projects with the given IDs and eager load occurrences
        $this->projects = Project::with('occurrences')
            ->whereIn('id', $ids)
            ->get();
    }

    public function collection()
    {
        return $this->projects;
    }

    public function map($project): array
    {
        return [
            $project->id,
            $project->title,
            $project->research_type,
            $project->department,
            $project->course,
            $project->advisor,
            $project->description,
            $project->creator,
            $project->occurrences->pluck('occurrence_id')->join(', '),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Research Type',
            'Department',
            'Course',
            'Advisor',
            'Description',
            'Creator',
            'Occurrence IDs',
        ];
    }
}

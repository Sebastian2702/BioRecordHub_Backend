<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sampleProjects = [
            [
                'title' => 'AI-Powered Tutor System',
                'research_type' => 'undergraduate_thesis',
                'department' => 'Computer Science',
                'course' => 'BSCS',
                'advisor' => 'Dr. John Doe',
                'description' => 'A machine learning model to assist students with real-time tutoring.',
                'creator' => 'Alice Smith',
            ],
            [
                'title' => 'Sustainable Packaging Materials',
                'research_type' => 'phd_dissertation',
                'department' => 'Environmental Science',
                'course' => 'BSES',
                'advisor' => 'Prof. Jane Roe',
                'description' => 'Study on biodegradable packaging and its environmental impacts.',
                'creator' => 'Bob Johnson',
            ],
            [
                'title' => 'Mobile Health Monitoring App',
                'research_type' => 'research_project',
                'department' => 'Information Technology',
                'course' => 'BSIT',
                'advisor' => 'Dr. Emily Davis',
                'description' => 'An app that tracks and sends health metrics to medical professionals.',
                'creator' => 'Carla Gomez',
            ],
        ];

        foreach ($sampleProjects as $project) {
            Project::create($project);
        }
    }
}

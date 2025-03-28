<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class StudyActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $activities = [
            ['name' => 'Getting Started', 'duration_minutes' => 3, 'is_complete' => false],
            ['name' => 'Intro to Your Course', 'duration_minutes' => 3, 'is_complete' => false],
            ['name' => 'Module 1: Reading Assignment', 'duration_minutes' => 7, 'is_complete' => false],
            ['name' => 'Module 1: Interactive Exercise', 'duration_minutes' => 5, 'is_complete' => false],
            ['name' => 'Module 1: Quiz', 'duration_minutes' => 31, 'is_complete' => false],
            ['name' => 'Module 1: Exam', 'duration_minutes' => 60, 'is_complete' => false],  

            ['name' => 'Module 2: Reading Assignment', 'duration_minutes' => 6, 'is_complete' => false],
            ['name' => 'Module 2: Interactive Exercise', 'duration_minutes' => 8, 'is_complete' => false],
            ['name' => 'Module 2: Quiz', 'duration_minutes' => 30, 'is_complete' => false],
            ['name' => 'Module 2: Exam', 'duration_minutes' => 61, 'is_complete' => false],

            ['name' => 'Module 3: Reading Assignment', 'duration_minutes' => 9, 'is_complete' => false],
            ['name' => 'Module 3: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 3: Quiz', 'duration_minutes' => 25, 'is_complete' => false],
            ['name' => 'Module 3: Exam', 'duration_minutes' => 55, 'is_complete' => false],

            ['name' => 'Module 4: Reading Assignment', 'duration_minutes' => 15, 'is_complete' => false],
            ['name' => 'Module 4: Interactive Exercise', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 4: Quiz', 'duration_minutes' => 36, 'is_complete' => false],
            ['name' => 'Module 4: Exam', 'duration_minutes' => 66, 'is_complete' => false],

            ['name' => 'Module 5: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 5: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 5: Quiz', 'duration_minutes' => 32, 'is_complete' => false],
            ['name' => 'Module 5: Exam', 'duration_minutes' => 60, 'is_complete' => false],

            ['name' => 'Module 6: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 6: Interactive Exercise', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 6: Quiz', 'duration_minutes' => 30, 'is_complete' => false],
            ['name' => 'Module 6: Exam', 'duration_minutes' => 63, 'is_complete' => false],

            ['name' => 'Module 7: Reading Assignment', 'duration_minutes' => 9, 'is_complete' => false],
            ['name' => 'Module 7: Interactive Exercise', 'duration_minutes' => 8, 'is_complete' => false],
            ['name' => 'Module 7: Quiz', 'duration_minutes' => 30, 'is_complete' => false],
            ['name' => 'Module 7: Exam', 'duration_minutes' => 60, 'is_complete' => false],

            ['name' => 'Module 8: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 8: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 8: Quiz', 'duration_minutes' => 31, 'is_complete' => false],
            ['name' => 'Module 8: Exam', 'duration_minutes' => 60, 'is_complete' => false],

            ['name' => 'Module 9: Reading Assignment', 'duration_minutes' => 9, 'is_complete' => false],
            ['name' => 'Module 9: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 9: Quiz', 'duration_minutes' => 35, 'is_complete' => false],
            ['name' => 'Module 9: Exam', 'duration_minutes' => 67, 'is_complete' => false],

            ['name' => 'Module 10: Reading Assignment', 'duration_minutes' => 9, 'is_complete' => false],
            ['name' => 'Module 10: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 10: Quiz', 'duration_minutes' => 32, 'is_complete' => false],
            ['name' => 'Module 10: Exam', 'duration_minutes' => 62, 'is_complete' => false],

            ['name' => 'Module 11: Reading Assignment', 'duration_minutes' => 6, 'is_complete' => false],
            ['name' => 'Module 11: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 11: Quiz', 'duration_minutes' => 34, 'is_complete' => false],
            ['name' => 'Module 11: Exam', 'duration_minutes' => 60, 'is_complete' => false],
            
            ['name' => 'Module 12: Reading Assignment', 'duration_minutes' => 8, 'is_complete' => false],
            ['name' => 'Module 12: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 12: Quiz', 'duration_minutes' => 34, 'is_complete' => false],
            ['name' => 'Module 12: Exam', 'duration_minutes' => 70, 'is_complete' => false],
            
            ['name' => 'Module 13: Reading Assignment', 'duration_minutes' => 9, 'is_complete' => false],
            ['name' => 'Module 13: Interactive Exercise', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 13: Quiz', 'duration_minutes' => 34, 'is_complete' => false],
            ['name' => 'Module 13: Exam', 'duration_minutes' => 60, 'is_complete' => false],
            
            ['name' => 'Module 14: Reading Assignment', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 14: Interactive Exercise', 'duration_minutes' => 15, 'is_complete' => false],
            ['name' => 'Module 14: Quiz', 'duration_minutes' => 24, 'is_complete' => false],
            ['name' => 'Module 14: Exam', 'duration_minutes' => 65, 'is_complete' => false],
            
            ['name' => 'Module 15: Reading Assignment', 'duration_minutes' => 5, 'is_complete' => false],
            ['name' => 'Module 15: Interactive Exercise', 'duration_minutes' => 8, 'is_complete' => false],
            ['name' => 'Module 15: Quiz', 'duration_minutes' => 35, 'is_complete' => false],
            ['name' => 'Module 15: Exam', 'duration_minutes' => 70, 'is_complete' => false],
            
            ['name' => 'Module 16: Reading Assignment', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 16: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 16: Quiz', 'duration_minutes' => 40, 'is_complete' => false],
            ['name' => 'Module 16: Exam', 'duration_minutes' => 63, 'is_complete' => false],
            
            ['name' => 'Module 17: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
            ['name' => 'Module 17: Interactive Exercise', 'duration_minutes' => 7, 'is_complete' => false],
            ['name' => 'Module 17: Quiz', 'duration_minutes' => 25, 'is_complete' => false],
            ['name' => 'Module 17: Exam', 'duration_minutes' => 64, 'is_complete' => false],
            
            ['name' => 'Module 18: Reading Assignment', 'duration_minutes' => 5, 'is_complete' => false],
            ['name' => 'Module 18: Interactive Exercise', 'duration_minutes' => 7, 'is_complete' => false],
            ['name' => 'Module 18: Quiz', 'duration_minutes' => 34, 'is_complete' => false],
            ['name' => 'Module 18: Exam', 'duration_minutes' => 65, 'is_complete' => false],
            
            ['name' => 'Module 19: Reading Assignment', 'duration_minutes' => 5, 'is_complete' => false],
            ['name' => 'Module 19: Interactive Exercise', 'duration_minutes' => 5, 'is_complete' => false],
            ['name' => 'Module 19: Quiz', 'duration_minutes' => 30, 'is_complete' => false],
            ['name' => 'Module 19: Exam', 'duration_minutes' => 60, 'is_complete' => false],
            
            ['name' => 'Module 20: Reading Assignment', 'duration_minutes' => 12, 'is_complete' => false],
            ['name' => 'Module 20: Interactive Exercise', 'duration_minutes' => 7, 'is_complete' => false],
            ['name' => 'Module 20: Quiz', 'duration_minutes' => 45, 'is_complete' => false],
            ['name' => 'Module 20: Exam', 'duration_minutes' => 80, 'is_complete' => false],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}

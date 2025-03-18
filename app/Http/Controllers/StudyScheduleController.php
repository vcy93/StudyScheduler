<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;

class StudyScheduleController extends Controller
{
    public function generateSchedule()
    {
        try {
            $activities = Activity::where('is_complete', false)->get()->toArray();

            $activityModel = new Activity();
            $schedule = $activityModel->generateSchedule($activities);
            $studyTime = $activityModel->calculateWeeklyStudyTime($schedule);

            return response()->json([
                'success' => true,
                'schedule' => $schedule,
                'weekly_study_time' => $studyTime['total_study_time'],
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating schedule: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while generating the schedule: ' . $e->getMessage(),
            ], 500);
        }
    }
}

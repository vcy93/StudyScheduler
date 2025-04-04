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

    public function showSchedule()
    {
        $activities = Activity::where('is_complete', false)->get()->toArray();

        $activityModel = new Activity();
        $schedule = $activityModel->generateSchedule($activities);
        $studyTime = $activityModel->calculateWeeklyStudyTime($schedule);

        // Calculate daily study time for each day
        $dailyTime = [];
        foreach ($schedule as $date => $activities) {
            $totalMinutes = 0;
            foreach ($activities as $activity) {
                preg_match('/(\d+)h (\d+)m/', $activity['duration'], $matches);
                $hours = intval($matches[1]);
                $minutes = intval($matches[2]);
                $totalMinutes += ($hours * 60) + $minutes;
            }
            $dailyTime[$date] = sprintf('%dh %02dm', floor($totalMinutes / 60), $totalMinutes % 60);
        }

        return view('schedule', [
            'schedule' => $schedule,
            'studyTime' => $dailyTime,
            'totalStudyTime' => $studyTime['total_study_time'],
        ]);
    }
}

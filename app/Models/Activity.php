<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'duration_minutes',
        'is_complete',
    ];

    // Max 120 minutes per day (2 hours)
    private $maxDailyMinutes = 120;
    private $threshold = 10;

    // Holiday List
    protected $holidays = [
        '2025-03-22', '2025-03-23', '2025-03-29', '2025-03-30',
        '2025-04-05', '2025-04-06', '2025-04-12', '2025-04-13',
        '2025-04-19', '2025-04-20'
    ];

    //Generate the weekly study schedule.
    public function generateSchedule($activities)
    {
        try {
            // $currentDate = Carbon::create(2025, 3, 22);
            $currentDate = Carbon::now(); 
            $schedule = [];
            $remainingMinutes = $this->maxDailyMinutes;
            $totalWeeklyMinutes = 0; // Track total weekly minutes

            foreach ($activities as $activity) {
                // Stop adding activities if weekly limit (600 minutes) is reached
                if ($totalWeeklyMinutes >= 600) {
                    break;
                }

                $activityMinutes = $activity['duration_minutes'];

                // Check if the activity fits into the remaining minutes of the current day
                while ($activityMinutes > 0) {
                    // If the remaining minutes can fit the activity, schedule it fully
                    if ($remainingMinutes >= $activityMinutes) {
                        if (($totalWeeklyMinutes + $activityMinutes) <= 600) {
                            $schedule[$currentDate->format('d-M-Y')][] = [
                                'activity' => $activity['name'],
                                'duration' => $this->formatMinutes($activityMinutes)
                            ];
                            $totalWeeklyMinutes += $activityMinutes;
                            $remainingMinutes -= $activityMinutes;
                            $activityMinutes = 0; // Activity fully scheduled
                        } else {
                            // Skip if total weekly minutes exceed 600
                            break 2;
                        }
                    } else {
                        // Split activity: add part to the current day
                        if (($totalWeeklyMinutes + $remainingMinutes) <= 600) {
                            $schedule[$currentDate->format('d-M-Y')][] = [
                                'activity' => $activity['name'],
                                'duration' => $this->formatMinutes($remainingMinutes)
                            ];
                            $activityMinutes -= $remainingMinutes;
                            $totalWeeklyMinutes += $remainingMinutes;
                        }

                        // Move to the next available day and add the remaining part
                        $currentDate = $this->getNextAvailableDate($currentDate);
                        $remainingMinutes = $this->maxDailyMinutes;
                    }
                }

                // Move to the next day if remaining time is less than threshold or exhausted
                if ($remainingMinutes <= $this->threshold || $totalWeeklyMinutes >= 600) {
                    $currentDate = $this->getNextAvailableDate($currentDate);
                    $remainingMinutes = $this->maxDailyMinutes;
                }
            }

            return $schedule;

        } catch (\Exception $e) {
            Log::error('Error generating schedule: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while generating the schedule: ' . $e->getMessage(),
            ], 500);
        }
    }

    //Get the next available date (skip weekends and holidays).
    private function getNextAvailableDate($currentDate)
    {
        try {
            do {
                $currentDate->addDay();
            } while ($currentDate->isWeekend() || in_array($currentDate->toDateString(), $this->holidays));

            return $currentDate;
        } catch (\Exception $e) {
            Log::error('Error calculating next available date: ' . $e->getMessage());
            return null;
        }
    }


    //Format minutes into h:m format.
    private function formatMinutes($minutes)
    {
        try {
            $hours = floor($minutes / 60);
            $minutes = $minutes % 60;
            return sprintf('%dh %02dm', $hours, $minutes);
        } catch (\Exception $e) {
            Log::error('Error formatting minutes: ' . $e->getMessage());
            return null;
        }
    }


    //Calculate total weekly study time.
    public function calculateWeeklyStudyTime($schedule)
    {
        try {
            $totalMinutes = 0;
            foreach ($schedule as $activities) {
                foreach ($activities as $activity) {
                    preg_match('/(\d+)h (\d+)m/', $activity['duration'], $matches);
                    $hours = intval($matches[1]);
                    $minutes = intval($matches[2]);
                    $totalMinutes += ($hours * 60) + $minutes;
                }
            }

            $totalHours = floor($totalMinutes / 60);
            $remainingMinutes = $totalMinutes % 60;
            return [
                'total_study_time' => sprintf('%dh %02dm', $totalHours, $remainingMinutes),
                'total_minutes' => $totalMinutes
            ];
        } catch (\Exception $e) {
            Log::error('Error calculating weekly study time: ' . $e->getMessage());
            return [
                'total_study_time' => '0h 00m',
                'total_minutes' => 0
            ];
        }
    }

}

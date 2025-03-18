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
            $currentDate = Carbon::now(); // Start from today
            $schedule = [];
            $remainingMinutes = $this->maxDailyMinutes;
    
            foreach ($activities as $activity) {
                if ($remainingMinutes >= $activity['duration_minutes']) {
                    // Schedule activity for the current day
                    $schedule[$currentDate->format('d-M-Y')][] = [
                        'activity' => $activity['name'],
                        'duration' => $this->formatMinutes($activity['duration_minutes'])
                    ];
                    $remainingMinutes -= $activity['duration_minutes'];
                } else {
                    // Split activity into remaining + next day
                    $splitMinutes = $remainingMinutes;
                    $remainingPart = $activity['duration_minutes'] - $splitMinutes;
    
                    // Schedule the split activity for today
                    $schedule[$currentDate->format('d-M-Y')][] = [
                        'activity' => $activity['name'],
                        'duration' => $this->formatMinutes($splitMinutes)
                    ];
    
                    // Move to next available day and schedule the remaining part
                    $currentDate = $this->getNextAvailableDate($currentDate);
                    $schedule[$currentDate->format('d-M-Y')][] = [
                        'activity' => $activity['name'],
                        'duration' => $this->formatMinutes($remainingPart)
                    ];
                    $remainingMinutes = $this->maxDailyMinutes - $remainingPart;
                }
    
                // Move to next day if remaining time is less than threshold
                if ($remainingMinutes <= $this->threshold) {
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

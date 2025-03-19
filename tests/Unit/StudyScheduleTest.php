<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudyScheduleTest extends TestCase
{
    use RefreshDatabase;

    protected $activities = [
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
        ['name' => 'Module 6: Quiz', 'duration_minutes' => 30, 'is_complete' => false]
    ];

    protected $expectedActivities = [
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
        ['name' => 'Module 4: Quiz', 'duration_minutes' => 36, 'is_complete' => false],
        ['name' => 'Module 4: Exam', 'duration_minutes' => 66, 'is_complete' => false],

        ['name' => 'Module 5: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
        ['name' => 'Module 5: Interactive Exercise', 'duration_minutes' => 10, 'is_complete' => false],
        ['name' => 'Module 5: Quiz', 'duration_minutes' => 32, 'is_complete' => false],
        ['name' => 'Module 5: Quiz', 'duration_minutes' => 32, 'is_complete' => false],
        ['name' => 'Module 5: Exam', 'duration_minutes' => 60, 'is_complete' => false],

        ['name' => 'Module 6: Reading Assignment', 'duration_minutes' => 10, 'is_complete' => false],
        ['name' => 'Module 6: Interactive Exercise', 'duration_minutes' => 12, 'is_complete' => false],
        ['name' => 'Module 6: Quiz', 'duration_minutes' => 30, 'is_complete' => false]
    ];

     // List of holidays
     protected $holidays = [
        '2025-03-22', '2025-03-23', '2025-03-29', '2025-03-30',
        '2025-04-05', '2025-04-06', '2025-04-12', '2025-04-13',
        '2025-04-19', '2025-04-20'
    ];


    public function setUp(): void
    {
        parent::setUp();
        Activity::insert($this->activities);
    }

    public function test_generate_schedule_with_threshold_and_split_logic()
    {
        // Fetch all activities
        $activities = Activity::where('is_complete', false)->get()->toArray();

        // Instantiate the model
        $activityModel = new Activity();

        // Generate schedule
        $schedule = $activityModel->generateSchedule($activities);
        $studyTime = $activityModel->calculateWeeklyStudyTime($schedule);

        // Assertions
        $this->assertIsArray($schedule, 'The schedule should be an array');
        $this->assertNotEmpty($schedule, 'The schedule should not be empty');

        // Validate daily study time does not exceed 120 minutes (2 hours)
        foreach ($schedule as $date => $activities) {
            $totalMinutes = 0;
            foreach ($activities as $activity) {
                preg_match('/(\d+)h (\d+)m/', $activity['duration'], $matches);
                $hours = intval($matches[1]);
                $minutes = intval($matches[2]);
                $totalMinutes += ($hours * 60) + $minutes;
            }
            $this->assertLessThanOrEqual(120, $totalMinutes, "Daily study time on {$date} should not exceed 2 hours.");
        }

        // Check that total weekly study time does not exceed 10 hours (600 minutes)
        $this->assertLessThanOrEqual(600, $studyTime['total_minutes'], 'Total weekly study time should not exceed 10 hours');

        // Check for weekends and holidays
        foreach (array_keys($schedule) as $date) {
            $carbonDate = Carbon::createFromFormat('d-M-Y', $date);
            $this->assertFalse($carbonDate->isWeekend(), "The schedule should not include weekends.");
            $this->assertFalse($this->isHoliday($carbonDate), "The schedule should not include holidays.");
        }

        // Validate that the sequence of activities is maintained
        $expectedActivities = array_column($this->expectedActivities, 'name');
        $scheduledActivities = [];
        foreach ($schedule as $dayActivities) {
            foreach ($dayActivities as $activity) {
                $scheduledActivities[] = $activity['activity'];
            }
        }

        $this->assertEquals($expectedActivities, $scheduledActivities, 'The sequence of activities should be maintained.');

        // Validate threshold handling and activity split scenario
        $this->validateThresholdAndSplitScenario($schedule);
    }

    private function isHoliday(Carbon $date)
    {
        return in_array($date->toDateString(), $this->holidays);
    }

    private function validateThresholdAndSplitScenario($schedule)
    {
        // Validate that threshold logic is applied and activities split correctly
        $foundSplit = false;

        foreach ($schedule as $date => $activities) {
            $totalMinutes = 0;
            foreach ($activities as $activity) {
                preg_match('/(\d+)h (\d+)m/', $activity['duration'], $matches);
                $hours = intval($matches[1]);
                $minutes = intval($matches[2]);
                $totalMinutes += ($hours * 60) + $minutes;

                // If total minutes exceed the limit but with threshold allows one more activity
                if ($totalMinutes >= 110 && $totalMinutes <= 120) {
                    $foundSplit = true;
                }
            }
        }

        $this->assertTrue($foundSplit, 'At least one activity should be split or moved correctly due to the threshold.');
    }
}

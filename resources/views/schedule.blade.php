@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <h2 class="text-center mb-4"><i class="fas fa-calendar-alt"></i> Weekly Study Schedule</h2>

        @foreach ($schedule as $date => $activities)
        <div class="schedule-card">
            <div class="date-header">
                <i class="fas fa-calendar-day"></i> {{ $date }} 
                <span class="badge bg-info float-end">
                    Total Study Time: {{ $studyTime[$date] }}
                </span>
            </div>
            <ul class="activity-list">
                @foreach ($activities as $activity)
                <li>
                    <span class="activity-name">
                        <i class="fas fa-book icon"></i> {{ $activity['activity'] }}
                    </span>
                    <span class="activity-duration">
                        <i class="fas fa-clock icon"></i> {{ $activity['duration'] }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <div class="text-center mt-4">
            <h5><i class="fas fa-hourglass-end"></i> Total Weekly Study Time: <strong>{{ $totalStudyTime }}</strong></h5>
        </div>
    </div>
</div>
@endsection

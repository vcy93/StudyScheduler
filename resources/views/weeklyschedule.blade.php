@extends('layouts.appnew')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4"><i class="fas fa-calendar-alt"></i> Weekly Study Schedule</h2>

    <!-- Tabs for Weeks -->
    <ul class="nav nav-pills mb-4" id="scheduleTab" role="tablist">
        @foreach ($weeksSchedule as $weekIndex => $schedule)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ $weekIndex == 0 ? 'active' : '' }}" id="week-{{ $weekIndex }}-tab" data-bs-toggle="pill" href="#week-{{ $weekIndex }}" role="tab" aria-controls="week-{{ $weekIndex }}" aria-selected="{{ $weekIndex == 0 ? 'true' : 'false' }}">Week {{ $weekIndex + 1 }}</a>
            </li>
        @endforeach
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="scheduleTabContent">
        @foreach ($weeksSchedule as $weekIndex => $schedule)
            <div class="tab-pane fade {{ $weekIndex == 0 ? 'show active' : '' }}" id="week-{{ $weekIndex }}" role="tabpanel" aria-labelledby="week-{{ $weekIndex }}-tab">
                <h3 class="week-title text-center mb-3">Week {{ $weekIndex + 1 }}</h3>
                <p class="text-center mb-4"><strong>Total Study Time:</strong> {{ $studyTimeByWeek[$weekIndex] }}</p>

                @foreach ($schedule as $date => $activities)
                    <div class="schedule-card mb-3">
                        <div class="card-header">
                            <i class="fas fa-calendar-day"></i> {{ $date }}
                            <span class="badge bg-info float-end">
                                Total Study Time: {{ $studyTimeByWeek[$weekIndex] }}
                            </span>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($activities as $activity)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
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
                    <h5><i class="fas fa-hourglass-end"></i> <strong>{{ $studyTimeByWeek[$weekIndex] }}</strong> Total Weekly Study Time</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    /* General Styles */
    .container {
        max-width: 800px;
        margin-top: 50px;
    }

    .week-title {
        font-size: 1.75rem;
        color: #333;
    }

    /* Tabs Styles */
    .nav-pills .nav-link {
        border-radius: 25px;
        padding: 10px 20px;
        margin-right: 10px;
        font-weight: 500;
    }

    .nav-pills .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }

    .nav-pills .nav-link:hover {
        background-color: #0056b3;
        color: #fff;
    }

    /* Card Styles */
    .schedule-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 20px;
    }

    .card-header {
        background-color: #e9ecef;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 12px 20px;
    }

    .list-group-item {
        background-color: #ffffff;
        border: none;
        padding: 12px 20px;
        border-bottom: 1px solid #e0e0e0;
        font-size: 1rem;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .activity-name {
        font-weight: 600;
    }

    .activity-duration {
        font-size: 0.95rem;
        color: #555;
        /* Align to the right */
    }

    /* Badge styles */
    .badge {
        font-size: 0.875rem;
        padding: 6px 12px;
    }

    .icon {
        margin-right: 8px;
    }

    .text-center h5 {
        font-size: 1.25rem;
        color: #444;
    }

    /* Flexbox for items on opposite sides */
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            margin-top: 30px;
        }

        .nav-pills .nav-link {
            font-size: 14px;
        }

        .card-header {
            font-size: 1rem;
        }
    }
</style>
@endsection

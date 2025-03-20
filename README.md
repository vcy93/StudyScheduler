# StudyScheduler

**StudyScheduler** is an application designed to help students plan their study schedule for an upcoming exam. It provides a recommended weekly study plan based on a series of activities that are displayed day-by-day, taking into account the student’s study constraints and preferences.

## Key Features

- **Displays a study schedule** for the student starting from the current date.
- **Limits study time** to a maximum of 2 hours per day (up to 10 hours per week).
- **Activities are planned from Monday to Friday**, with weekends excluded.
- **Study activities are shown in a timeline format**, displaying accurate times for each activity.
- If an activity’s duration **exceeds the remaining available time for the day**, it will be split across multiple days.
- The application **handles holidays** and automatically shifts activities to the next available date if a holiday occurs.

## Steps and Description of Implementation

### 1. **Application Flow**

- The study schedule starts from the current date and ensures that no activities are scheduled on weekends.
- A maximum of 2 hours (120 minutes) of study time is allocated per day, with a threshold of 10 minutes for overflow.
- If a day’s remaining time is insufficient to accommodate a full activity, the activity will split across multiple days.
- Activities will be listed day-wise with study durations, displaying the activities in sequence.

### 2. **Handling the Timeline**

#### Timeline View:
The study schedule is presented in the following format:

```
04-Mar-2025 (Study Time: 2h 03m)
---------------------------------
Getting Started              (1h)
Intro to Your Course         (58m)
Module 1                     (5m)
```
#### Scenario 1: 
If an activity takes less time than the remaining available time for the day, it’s assigned completely to that day. For example:
```
04-Mar-2025 (Study Time: 2h 03m)
Getting Started (1h)
Intro to Your Course (58m)
Module 1 (5m)
```

#### Scenario 2: 
If an activity is longer than the available time, it will be split across multiple days. For example:
```
04-Mar-2025 (Study Time: 2h 03m)
Getting Started (1h)
Intro to Your Course (58m)
Module 1 (5m)

05-Mar-2025 (Study Time: 2h 05m)
Module 1 (10m) // Module 1 activity was split across days.
Module 2 (1h)
Module 3 (40m)
Module 4 (15m)
```

### 3. **Holiday Handling**

- The application maintains a static list of holiday dates.
- If the schedule tries to assign activities to a holiday, the activities will automatically be shifted to the next available study day.

### 4. **Constraints**

- **Maximum Study Time:** A student can only study up to 10 hours a week (2 hours per day, Monday to Friday).
- **Threshold:** The threshold for adding extra time is 10 minutes. If there’s a small remainder of study time that can accommodate part of an activity (up to the threshold), it will be added to the current day’s schedule.

## Technologies Used

- **PHP 8.2+**: The backend implementation is built using PHP 8.2, offering modern features and performance improvements for handling the application's logic and scheduling.
  
- **Laravel 12.0**: Laravel is used to implement the MVC (Model-View-Controller) architecture, providing an elegant and expressive syntax to handle routing, database interactions, and views.

- **JSON Format**: Data is exposed in JSON format, making it easy to integrate with other platforms, front-end frameworks, or APIs for further use.

## Installation Instructions## Installation Instructions

1. Clone the repository
    ```bash
    git clone https://github.com/yourusername/StudyScheduler.git
    cd StudyScheduler
    ```

2. Install the dependencies:
    ```bash
    composer install
    ```

3. Configure the application:
    - Set up your preferred database or file storage for storing holiday dates and schedules.
    - Update configuration settings in the `config` files as needed.

4. Seed the database with initial study activities:
    ```bash
    php artisan db:seed --class=StudyActivitySeeder
    ```

5. Serve the application locally:
    ```bash
    php artisan serve
    ```

6. Run tests to ensure everything is working:
    ```bash
    php artisan test --filter=StudyScheduleTest
    ```

## Branches

### 1. **Main Branch**
    The main branch contains the full implementation of the study schedule system, including functionality that works with a database to store and manage study activities. It provides full backend support for database migrations and seeders:
    ```bash
    git checkout main
    ```

### 2. **Dev Branch**
    The dev branch contains the version of the application that uses file storage (such as a JSON file) for storing study activities. This branch is ideal when a simple file-based storage system is preferred over a full database setup:
    ```bash
    git checkout dev
    ```

## Contributing

Feel free to fork this repository and submit pull requests for any enhancements, bug fixes, or feature requests. We welcome contributions from the community to improve StudyScheduler!

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
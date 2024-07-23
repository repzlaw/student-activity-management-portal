# Student Activity Management Portal

This is a comprehensive student portal designed to facilitate student and admin interactions within an academic environment. The portal offers robust features for both students and administrators.

## Features

### User Interface

- **Home Page & Login Page**
  - Utilizes Jetstream for authentication.
  - No registration option; all users must be added by an admin.

- **User Profile Management**
  - Powered by Jetstream.

- **User Dashboard**
  - **Panels:**
    - Required Tasks
    - Activity Hours Year to Date
    - Event Calendar
      - Displays student-specific events.
      - Displays global events based on student attributes (e.g., specific program alumni events, all student events).

- **Submit Activities**
  - Added activities create an admin task and require admin review/approval.
  - Admins are required to review every activity document.

- **Submit Credentials**
  - Added credentials create an admin task and require admin review/approval.
  - Admins are required to review every credential document.

### Admin Dashboard

- **Panels:**
  - Number of Registered Users
  - Number of Active Users Past 30 Days
  - Required Tasks
- **CRUD Operations:**
  - Users
  - Groups
  - Activities
  - Credentials
  - Events
    - Add/Edit supports maintaining assignments of events to one or more students.
  - Tasks
    - Add/Edit supports maintaining assignments of tasks to one or more students/admins.

## Installation

1. Clone the repository:
   ```bash
   git clone https://kanoci@dev.azure.com/kanoci/kanocentral/_git/kanocentral


2. Navigate to the project directory:
   ```bash
   cd kano-central

3. Install dependencies:
   ```bash
    composer install
    npm install
    npm run dev

4. Set up your .env file and generate an application key:
   ```bash
    cp .env.example .env
    php artisan key:generate

5. Run migrations:
   ```bash
   php artisan migrate

6. Link storage:
   ```bash
   php artisan storage:link

7. Serve the application:
   ```bash
   php artisan serve
# student-activity-management-portal
# student-activity-management-portal

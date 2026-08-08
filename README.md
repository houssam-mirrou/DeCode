# DeCode

DeCode is a web platform for managing project-based learning inside a coding school or training program. It connects administrators, teachers, and students around classes, sprints, briefs, competencies, submissions, and evaluations.

The project is built as a native PHP application. Instead of using a full framework such as Laravel or Symfony, the core application flow is written manually: routing, controllers, session handling, database access, repositories, services, models, DTOs, and mappers are all implemented inside the project.

## Table of Contents

- [Project Overview](#project-overview)
- [Main Features](#main-features)
- [User Roles](#user-roles)
- [Technology Stack](#technology-stack)
- [Native PHP Implementation](#native-php-implementation)
- [Architecture](#architecture)
- [Database Model](#database-model)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Running the Project](#running-the-project)
- [Useful Routes](#useful-routes)
- [Development Notes](#development-notes)

## Project Overview

DeCode helps organize a learning workflow based on briefs and competencies.

An administrator can create the academic structure of the platform by managing classes, users, sprints, and competencies. Teachers can create project briefs, attach competencies to them, follow student work, and evaluate submitted deliverables. Students can view assigned briefs, submit project links, and check their evaluations.

The goal of the project is to provide a complete learning management flow while also demonstrating how an MVC-style PHP application can be built natively from the ground up.

## Main Features

- Authentication with role-based redirection.
- Admin dashboard.
- User management for admins, teachers, and students.
- Class management.
- Teacher assignment to classes.
- Sprint management.
- Competency management.
- Brief creation and management.
- Competency linking for each brief.
- Student dashboard with assigned briefs.
- Student deliverable submission using repository/project links.
- Teacher evaluation workflow.
- Student evaluation history.
- PostgreSQL persistence.
- Dockerized PHP, Apache, PostgreSQL, and pgAdmin environment.

## User Roles

### Admin

Admins manage the platform structure:

- Create, update, and delete users.
- Assign students to classes.
- Manage classes.
- Assign teachers to classes.
- Create and manage sprints.
- Create and manage competencies.
- Access the admin dashboard.

### Teacher

Teachers manage learning work and grading:

- View the teacher dashboard.
- Create briefs for sprints.
- Attach competencies to briefs.
- Define required competency levels.
- View students.
- Review submitted deliverables.
- Evaluate students by brief and competency.

### Student

Students use the platform to follow and submit work:

- View assigned sprints and briefs.
- Open brief details.
- Submit deliverable links.
- Add comments to submissions.
- View evaluations and competency feedback.

## Technology Stack

### Backend

- PHP 8.2
- Native PHP MVC-style architecture
- Composer autoloading with PSR-4
- PDO for database access
- PostgreSQL
- PHP sessions for authentication state

### Views

- BladeOne template engine
- Blade-style `.blade.php` views
- Tailwind CSS loaded through CDN
- Lucide icons loaded through CDN
- Inter font from Google Fonts

### Infrastructure

- Docker
- Docker Compose
- Apache HTTP Server
- PostgreSQL 16
- pgAdmin

## Native PHP Implementation

This project was made natively in PHP, meaning the main framework behavior was created manually inside the codebase instead of being provided by a large external framework.

### Native Routing

The application entry point is:

```text
src/Public/index.php
```

This file creates an instance of the custom router and registers every route manually:

```php
$router = new Router();
$router->get('/', 'HomeController@index');
$router->post('/login', 'LogInController@log_in');
$router->get('/admin/dashboard', 'AdminDashboardController@index');
$router->get('/student/brief/{id}', 'StudentBriefController@index');
$router->dispatch();
```

The router is implemented in:

```text
src/App/Core/Router.php
```

It uses the current request URI and request method, matches the route, converts dynamic parameters such as `{id}` into regular expressions, finds the correct controller class, and calls the requested controller method.

This gives the project clean URLs like:

```text
/student/brief/3
/teacher/evaluate/5/student/12
```

without relying on a framework router.

### Native Front Controller

Apache is configured to serve the application from:

```text
src/Public
```

The Apache config uses `FallbackResource /index.php`, which means all unknown routes are sent to `index.php`. From there, the custom router decides what controller should handle the request.

This is the same architectural idea used by many frameworks, but here it is implemented directly.

### Native Controllers

Controllers live in:

```text
src/App/Controllers
```

They are grouped by role:

```text
src/App/Controllers/Admin
src/App/Controllers/Teacher
src/App/Controllers/Student
```

Each controller receives request data, calls the service layer, and returns a rendered BladeOne view or redirects the user.

Example responsibilities:

- `LogInController` handles login form submission.
- `HomeController` redirects authenticated users based on role.
- `AdminUsersController` manages user creation, updates, and deletion.
- `TeacherBriefController` manages briefs and linked competencies.
- `StudentDashController` displays assigned work and handles submissions.

### Native Session Handling

Session logic is centralized in:

```text
src/App/Core/Session.php
```

The project uses native PHP sessions through `session_start()`. After a successful login, the current user object is stored in:

```php
$_SESSION['current_user']
```

The home route checks this session value and redirects the user to the correct dashboard:

- Admin: `/admin/dashboard`
- Teacher: `/teacher/dashboard`
- Student: `/student/dashboard`

### Native Database Layer

Database access is handled with PDO in:

```text
src/App/Core/DataBase.php
```

The database class creates a PostgreSQL connection using a DSN and executes prepared statements.

The project uses a layered data flow:

```text
Controller -> Service -> Repository -> DAO -> Database
```

This keeps business validation, SQL access, and request handling separated.

### Native Models, DTOs, and Mappers

Domain objects are stored in:

```text
src/App/Models
```

DTOs are stored in:

```text
src/App/Dtos
```

Mappers are stored in:

```text
src/App/Mappers
```

These classes help convert database rows into objects that are easier to pass through the application. This avoids mixing raw SQL result arrays directly into every controller and view.

### Blade Views Without Laravel

The project uses BladeOne:

```json
"eftec/bladeone": "^4.19"
```

BladeOne allows the project to use Blade-style templates without installing Laravel.

The base controller renders views from:

```text
src/Views
```

Blade cache is stored in:

```text
src/cache
```

This gives the project familiar Blade syntax while keeping the rest of the application native PHP.

## Architecture

The project follows an MVC-inspired architecture with extra layers for cleaner data handling.

### Request Flow

```text
Browser
  -> Apache
  -> src/Public/index.php
  -> App\Core\Router
  -> Controller
  -> Service
  -> Repository
  -> DAO
  -> App\Core\DataBase
  -> PostgreSQL
```

### Layer Responsibilities

| Layer | Folder | Responsibility |
| --- | --- | --- |
| Public entry | `src/Public` | Receives every HTTP request |
| Core | `src/App/Core` | Router, controller base class, sessions, config, database wrapper |
| Controllers | `src/App/Controllers` | Handle routes, request data, redirects, and views |
| Services | `src/App/Services` | Business rules and validation |
| Repositories | `src/App/Repositories` | Coordinate DAO calls and mapping |
| DAOs | `src/App/Daos` | SQL queries and persistence logic |
| Models | `src/App/Models` | Main domain objects |
| DTOs | `src/App/Dtos` | Read models for view-specific data |
| Mappers | `src/App/Mappers` | Convert database rows into PHP objects |
| Views | `src/Views` | BladeOne templates |

## Database Model

The database schema is defined in:

```text
db.sql
```

Main tables:

- `class`: stores classes and school years.
- `users`: stores admins, teachers, and students.
- `teachers_in_class`: links teachers to classes.
- `sprint`: stores learning sprints.
- `brief`: stores project briefs.
- `brief_teacher`: links teachers to briefs.
- `competence`: stores competencies.
- `brief_competence`: links briefs to competencies and required levels.
- `livrable`: stores student submissions.
- `evaluation`: stores final evaluation records.
- `evaluation_competences`: stores competency-level evaluation details.

The platform uses three competency levels:

- `IMITER`
- `S_ADAPTER`
- `TRANSPOSER`

Evaluation reviews use:

- `bad`
- `good`
- `excellent`

## Project Structure

```text
.
|-- Dockerfile
|-- docker-compose.yml
|-- apache.conf
|-- db.sql
|-- README.md
`-- src
    |-- App
    |   |-- Controllers
    |   |   |-- Admin
    |   |   |-- Student
    |   |   `-- Teacher
    |   |-- Core
    |   |-- Daos
    |   |-- Dtos
    |   |-- Mappers
    |   |-- Models
    |   |-- Repositories
    |   `-- Services
    |-- Public
    |   `-- index.php
    |-- Views
    |   |-- Pages
    |   `-- Partials
    |-- composer.json
    `-- composer.lock
```

## Installation

### Requirements

- Docker
- Docker Compose
- A terminal

Composer is included inside the PHP Docker image, so you can install PHP dependencies from inside the container.

### 1. Clone the Repository

```bash
git clone <repository-url>
cd DeCode
```

### 2. Build and Start Containers

```bash
docker compose up -d --build
```

This starts:

- PHP and Apache application container on port `8000`
- PostgreSQL database on port `5432`
- pgAdmin on port `5050`

### 3. Install PHP Dependencies

```bash
docker compose exec app composer install
```

This installs BladeOne and generates Composer autoload files inside `src/vendor`.

### 4. Import the Database Schema

```bash
docker compose exec -T db psql -U user -d brief_db < db.sql
```

If the SQL import fails, check the order and syntax around the `brief_teacher` table in `db.sql`. That table references `brief`, so `brief` must exist before the foreign key is created.

## Running the Project

After the containers are running, open:

```text
http://localhost:8000
```

pgAdmin is available at:

```text
http://localhost:5050
```

Default pgAdmin credentials from `docker-compose.yml`:

```text
Email: admin@admin.com
Password: root
```

PostgreSQL credentials from `docker-compose.yml`:

```text
Host: db
Port: 5432
Database: brief_db
User: user
Password: password
```

When connecting from your host machine instead of another Docker container, use:

```text
Host: localhost
Port: 5432
```

## Useful Routes

### Authentication

| Method | Route | Description |
| --- | --- | --- |
| GET | `/` | Login page or role-based redirect |
| POST | `/login` | Login submission |
| POST | `/logout` | Logout |

### Admin

| Method | Route | Description |
| --- | --- | --- |
| GET | `/admin/dashboard` | Admin dashboard |
| GET | `/admin/users` | Manage users |
| POST | `/admin/user/create` | Create user |
| POST | `/admin/user/update` | Update user |
| POST | `/admin/user/delete` | Delete user |
| GET | `/admin/classes` | Manage classes |
| POST | `/admin/class/create` | Create class |
| POST | `/admin/class/update` | Update class |
| POST | `/admin/class/delete` | Delete class |
| POST | `/admin/class/assign-teachers` | Assign teachers to class |
| POST | `/admin/class/remove-teacher` | Remove teacher from class |
| GET | `/admin/sprints` | Manage sprints |
| POST | `/admin/sprint/create` | Create sprint |
| POST | `/admin/sprint/update` | Update sprint |
| POST | `/admin/sprint/delete` | Delete sprint |
| GET | `/admin/competences` | Manage competencies |
| POST | `/admin/competence/create` | Create competency |
| POST | `/admin/competence/update` | Update competency |
| POST | `/admin/competence/delete` | Delete competency |

### Teacher

| Method | Route | Description |
| --- | --- | --- |
| GET | `/teacher/dashboard` | Teacher dashboard |
| GET | `/teacher/briefs` | Manage briefs |
| POST | `/teacher/brief/create` | Create brief |
| POST | `/teacher/brief/update` | Update brief |
| POST | `/teacher/brief/delete` | Delete brief |
| GET | `/teacher/evaluations` | Evaluation overview |
| GET | `/teacher/evaluate/{brief_id}/student/{student_id}` | Evaluate one student for one brief |
| POST | `/teacher/evaluate/submit` | Submit evaluation |
| GET | `/teacher/students` | View teacher students |

### Student

| Method | Route | Description |
| --- | --- | --- |
| GET | `/student/dashboard` | Student dashboard |
| GET | `/student/briefs` | Student briefs/projects |
| GET | `/student/brief/{id}` | Brief details |
| POST | `/student/brief/submit` | Submit deliverable |
| GET | `/student/evaluations` | View evaluation results |

## Development Notes

### Composer Autoloading

The project uses PSR-4 autoloading:

```json
"App\\": "App/"
```

Because `composer.json` is inside `src`, Composer commands should be run from `/var/www/html` inside the app container or from the local `src` directory.

### Adding a New Page

To add a new page natively:

1. Add a route in `src/Public/index.php`.
2. Create or update a controller in `src/App/Controllers`.
3. Add service/repository/DAO methods if the page needs data.
4. Create a Blade view in `src/Views/Pages`.
5. Return the view through `Controller::view()`.

### Adding a New Database Operation

The existing pattern is:

1. Add SQL logic in a DAO class.
2. Expose it through a repository.
3. Add validation or business rules in a service.
4. Call the service from the controller.
5. Render the result in a Blade view.

### Styling

The project currently loads Tailwind CSS through CDN in:

```text
src/Views/layout.blade.php
```

The Tailwind config file exists at:

```text
src/App/tailwind.config.js
```

For production, a compiled Tailwind build would be better than CDN loading.

### Security Notes

- Passwords are hashed with PHP `password_hash()`.
- Database operations use PDO prepared statements through the database wrapper.
- Session state is handled with native PHP sessions.
- Additional route-level authorization checks can be added to make sure each route is protected by role, not only by dashboard redirection.

## Summary

DeCode is a native PHP learning management platform for coding-school workflows. It shows how to build a structured web application without a full framework by combining a custom router, controller layer, service layer, repository/DAO pattern, PDO database access, BladeOne templates, and a Dockerized PostgreSQL environment.

# Routing, Requests & Responses — Laravel Assignment

A Laravel project demonstrating basic and named routes, URL parameters and constraints, query parameters, JSON responses, custom headers and cookies, and redirects. All assignment routes are in `routes/web.php` under `// Assignment: Routing, Requests & Responses`.

## Setup

Requirements: PHP 8.3+, Composer, and the PHP extensions required by Laravel.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

On Windows, use `copy .env.example .env` instead of `cp`.

## Assignment endpoints

| Route | Result |
| --- | --- |
| `GET /courses` | `<h1>Available Courses</h1>` (named `courses`) |
| `GET /home` | Link generated with `route('courses')` |
| `GET /courses/12` | `Course 12` |
| `GET /courses/12/Laravel` | `Course 12: Laravel` |
| `GET /courses/category` | `All categories` |
| `GET /courses/category/Web` | `Category: Web` |
| `GET /courses/search?keyword=laravel` | `{"keyword":"laravel","level":"Beginner","hasKeyword":true}` |
| `GET /courses/featured` | JSON message, status 200, custom header and cookie |
| `GET /catalog` | Redirects to `/courses` |

`/courses/abc` returns 404 because course IDs must be numeric. Course titles accept letters only.

## Verification

```bash
php artisan route:list
curl -i http://localhost:8000/courses/featured
curl -i http://localhost:8000/courses/search?keyword=laravel
curl -i http://localhost:8000/courses/abc
```

## Submission

Push this project to a **public** GitHub repository and submit the repository URL in Google Classroom. Dependencies (`vendor/`, `node_modules/`) and local `.env` secrets are not committed.

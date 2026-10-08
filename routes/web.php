<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Different return types

Route::get("/jobs", function() {
    return "<h1>Available Jobs</h1>";
})->name("randomName");

Route:: get("/test-jobs", function() {
    $url=route('randomName');

    return "<a href='$url'>Click here to go to Jobs!</a>";
});

//JSON Example
Route::get("/api/users", function () {
    return [
        'id' => "123",
        'name' => "John Doe",
        'email' => "johndoe@gmail.com"
    ];
});

//Redirect Example
Route::redirect("/first", "/second");

//Path Parameters
Route::get("/students/{id}", function (string $id) {
    return "This is the students with the id: $id";
});

Route::get("/students/{studentId}/courses/{courseId}", function (string $studentId, string $courseId) {
    return "This is the student with the id: $studentId and course id: $courseId";
});

Route::get("/teachers/{teacherId?}", function ($teacherId=null) {
    return $teacherId ? "The teacher id is: $teacherId" : "No teacher specified!";
});

//Path Param Types
Route::get('/classes/{classId}', function ($classId) {
    return "The class id is: $classId";
})->where('classId', '[0-9]+');

//Route::get('/courses/{courseId}', function ($courseId) {
//    return "The course id is: $courseId";
//})->whereAlpha('courseId');


//Testing global id type
Route::get('/buildings/{id}', function ($id) {
    return "The building id is: $id";
});

//Testing the Request object
Route::get("/test", function (Request $request) {
    return [
        'method' => $request->method(),
        'url' => $request->url(),
        'path' => $request->path(),
        'fullUrl' => $request->fullUrl(),
        'ip' => $request->ip(),
        'userAgent' => $request->userAgent(),
        'header' => $request->header(),
        'query' => $request->query("name"),
    ];
});

//Testing the Response helpers
Route::get("/response-helper", function() {
    return response("Hello World!", 200);
});

Route::get("/response-helper-header", function () {
    return response('<h1>Hello World</h1>')->header("Content-Type", "text/html");
});

//Testing cookies
Route::get("/response-helper-cookies", function () {
    return response("Hello World!", 200)->cookie("firstName", "John Doe");
});

Route::get('/read-cookie', function (Request $request) {
    $cookieValue = $request->cookie('firstName');
    return response()->json(['cookie' => $cookieValue]);
});


// Assignment: Routing, Requests & Responses

// Task 1: Basic & Named Routes
Route::get('/courses', function () {
    return '<h1>Available Courses</h1>';
})->name('courses');

Route::get('/home', function () {
    return '<a href="' . route('courses') . '">View Courses</a>';
});

// Task 2: Route Parameters & Constraints
// Fixed paths must be defined before parameterized routes.
Route::get('/courses/category/{category?}', function (?string $category = null) {
    return $category !== null ? "Category: {$category}" : 'All categories';
});

// Task 3: Request Object & Query Params
Route::get('/courses/search', function (Request $request) {
    return response()->json([
        'keyword' => $request->query('keyword'),
        'level' => $request->input('level', 'Beginner'),
        'hasKeyword' => $request->has('keyword'),
    ]);
});

// Task 4: Response Helper
Route::get('/courses/featured', function () {
    return response()->json(['message' => 'Featured courses'], 200)
        ->header('X-Course-Source', 'Laravel')
        ->cookie('last_visited', 'featured');
});

Route::get('/courses/{id}/{title}', function (string $id, string $title) {
    return "Course {$id}: {$title}";
})->whereNumber('id')->whereAlpha('title');

Route::get('/courses/{id}', function (string $id) {
    return "Course {$id}";
})->whereNumber('id');

// Task 5: Redirect & Route List
Route::redirect('/catalog', '/courses');

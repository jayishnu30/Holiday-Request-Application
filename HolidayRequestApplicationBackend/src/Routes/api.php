<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayRequestController;
use App\Http\Controllers\AuthController;

// Public routes for authentication
Route::post('login', [AuthController::class, 'login']); // Login route for both employee and validator
Route::post('register', [AuthController::class, 'register']); // Register new user (if needed for the app)

// Employee routes
Route::middleware('auth:sanctum')->group(function () {
    // Route for employees to request a holiday
    Route::post('holiday-requests', [HolidayRequestController::class, 'requestHoliday']);
    
    // Route for employees to view their own holiday requests
    Route::get('holiday-requests', [HolidayRequestController::class, 'getHolidayRequests']);
});

// Validator routes (only for users with the validator role)
Route::middleware(['auth:sanctum', 'role:validator'])->group(function () {
    // Route for validators to view pending holiday requests
    Route::get('holiday-requests/pending', [HolidayRequestController::class, 'viewPendingRequests']);
    
    // Route for validators to approve a holiday request
    Route::put('holiday-requests/{id}/approve', [HolidayRequestController::class, 'validateRequest']);
    
    // Route for validators to deny a holiday request
    Route::put('holiday-requests/{id}/deny', [HolidayRequestController::class, 'denyRequest']);
});
?>
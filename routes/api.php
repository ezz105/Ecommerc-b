<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

use App\Http\Controllers\Api\Customer\OrderController;

use App\Http\Controllers\Api\Customer\ReviewController;
use App\Http\Controllers\Api\Customer\ProductController;





// public routes ---
Route::get('/test', function () {
    return " Un-Protected Route ((Test page))";
})->withoutMiddleware('auth:sanctum');


// auth routes
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    // Endpoint: /api/auth/register
    Route::post('/register', 'register');

    // Endpoint: /api/auth/login
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// prrotected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Endpoint: /api/logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //admin Routes
    Route::middleware('role:admin')->group(function () {
        //Endpoint: /api/admin
        Route::get('/admin', function () {
            return "Hello Admin";
        });

        Route::prefix('admin')->group(function () {
            // update review status for admin
            Route::put('reviews/{reviewId}/status', [ReviewController::class, 'updateReviewStatus']);
            // list other admin routes here :
        });
    });

    //vendor Routes
    Route::middleware('role:vendor')->group(function () {
        //Endpoint: /api/vendor
        Route::get('/vendor', function () {
            return "Hello Vendor";
        });

        // list other vendor routes here:


    });

    Route::middleware('role:customer')->group(function () {
        // Customer-specific endpoints
        Route::prefix('customer')->group(function () {
            Route::prefix('orders')->group(function () {
                // List all orders for the authenticated customer
                Route::get('/', [OrderController::class, 'index']);
    
                // View a specific order
                Route::get('/{id}', [OrderController::class, 'show'])
                    ->where('id', '[0-9]+'); // Ensure 'id' is numeric
    
                // Place a new order
                Route::post('/', [OrderController::class, 'store']);
    
                // Update an existing order (e.g., status update)
                Route::put('/{id}', [OrderController::class, 'update'])
                    ->where('id', '[0-9]+');
    
                // Cancel an order
                Route::patch('/{id}/cancel', [OrderController::class, 'cancelOrder'])
                    ->where('id', '[0-9]+');
    
                // Delete an order
                Route::delete('/{id}', [OrderController::class, 'destroy'])
                    ->where('id', '[0-9]+');
            });
    

            // show all products
            Route::get('products', [ProductController::class, 'index']);

            // show single product details
            Route::get('products/{productId}', [ProductController::class, 'show']);

            // show all reviews
            Route::get('products/{productId}/reviews', [ReviewController::class, 'getReviews']);

            // add review
            Route::post('products/{productId}/reviews', [ReviewController::class, 'addReview']);

            // delete review
            Route::delete('reviews/{reviewId}', [ReviewController::class, 'deleteReview']);
        });
    });
});
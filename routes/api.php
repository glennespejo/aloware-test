<?php

use App\Http\Controllers\Api\PostApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'namespace'  => 'Api',
    'prefix'     => 'v1',
    'middleware' => 'api',
], function () {

Route::get('/', function () {
    return response()->json([
        'service' => 'Aloware API',
        'version' => '1.0',
    ]);
});

Route::get('posts', [PostApiController::class, 'getAllPostWithComments']);
Route::post('comment/add', [PostApiController::class, 'addComment']);

});

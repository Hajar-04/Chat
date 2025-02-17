<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::post('/message', [HomeController::class, 'message'])->name('message');
Route::get('/find/{id}', [FriendController::class, 'find']);
Route::post('/friend', [FriendController::class, 'addFriend']);
Route::get('/friend', [HomeController::class, 'fetchAllFriends']);
Route::post('/chat/{id}', [ChatController::class, 'startChat']);
Route::get('/chats', [HomeController::class, 'fetchAllRecentChats']);
Route::post('/send', [ChatController::class, 'sendMessage']);
Route::post('/clear', [ChatController::class, 'clearChat']);
Route::post('/unfriend', [FriendController::class, 'unfriend']);
Route::post('/clearall', [ChatController::class, 'deleteAllChats']);
Route::put('/read', [HomeControllers::class, 'markAsRead']);
Route::post('/friendreq/{id}', [FriendController::class, 'sendFriendRequest']);
Route::get('/notif', [HomeController::class, 'fetchAllNotifications']);
Route::post('/updateprofile', [HomeController::class, 'updateProfile']);
Route::delete('/deletechatroom', [ChatController::class, 'deleteChatroom']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/chat/{friendId}', [MessageController::class, 'show'])->name('chat.show');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

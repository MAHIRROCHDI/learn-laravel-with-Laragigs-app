<?php

use App\Models\Listing ; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//All listings : 
Route::get('/',[ListingController::class ,'index']);

//Show Create Form :
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth') ;
//Store Listing data : 
Route::post('/listings' ,[ListingController::class,'store'])->middleware('auth');
//Show Edit Form : 
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth'); 
//Edit listing to update : 
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth'); 
//delete listing : 
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth'); 
//Manage listing : 
Route::get('listings/manage' , [ListingController::class , 'manage'])->middleware('auth'); 
//Single Listing : 
Route::get('/listings/{listing}' ,[ListingController::class,'show']);

//Users : 

//Show regester Create Form : 

Route::get('/register' , [UserController::class , 'create'])->middleware('guest') ;
//register 
Route::post('/users', [UserController::class , 'store']) ; 
//logout : 
Route::post('/logout',[UserController::class , 'logout']);

//show login form : 
Route::get('/login' , [UserController::class , 'login'])->name('login')->middleware('guest') ; 

//login : 
Route::post('/users/authenticate' ,[UserController::class ,'authenticate']); 

/*
Common ressource Route :
 - index : show all listing ; 
 - show : show single listing ; 
 - create : show form to create new listing ; 
 - store : store new listing ; 
 - edit : show form to edit listing ; 
 - update : update listing ; 
 - destroy : delete listing ;  
*/
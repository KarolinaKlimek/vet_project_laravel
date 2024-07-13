<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [HomeController::class, "index"]);

Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/appointments/create', [AppointmentController::class, 'create']);
Route::post('/appointments/add-to-db', [AppointmentController::class, 'addToDB']);
Route::get('/appointments/edit/{id}', [AppointmentController::class, 'edit']);
Route::post('/appointments/update/{id}', [AppointmentController::class, 'update']);
Route::delete('/appointments/delete/{id}', [AppointmentController::class, 'delete'])->name("appointments.delete"); ;
Route::get("/appointments/add-service/{id}", [AppointmentController::class, "addService"]);
Route::post("/appointments/add-service-to-db/{id}", [AppointmentController::class, "addServiceToDB"]);
Route::get('/appointments/{appointmentId}/services/{serviceId}', [AppointmentController::class, 'showServiceDetails']);

Route::get('/pets', [PetController::class, 'index']);
Route::get('/pets/create', [PetController::class, 'create']);
Route::post('/pets/add-to-db', [PetController::class, 'addToDB']);
Route::get('/pets/edit/{id}', [PetController::class, 'edit']);
Route::post('/pets/update/{id}', [PetController::class, 'update']);
Route::delete('/pets/delete/{id}', [PetController::class, 'delete'])->name("pets.delete"); 

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/create', [ServiceController::class, 'create']);
Route::post('/services/add-to-db', [ServiceController::class, 'addToDB']);
Route::get('/services/edit/{id}', [ServiceController::class, 'edit']);
Route::post('/services/update/{id}', [ServiceController::class, 'update']);
Route::delete('/services/delete/{id}', [ServiceController::class, 'delete'])->name("services.delete"); 



Route::get('/trainings', [TrainingController::class, 'index']);
Route::get('/trainings/create', [TrainingController::class, 'create']);
Route::post('/trainings/add-to-db', [TrainingController::class, 'addToDB']);
Route::get('/trainings/edit/{id}', [TrainingController::class, 'edit']);
Route::post('/trainings/update/{id}', [TrainingController::class, 'update']);
Route::delete('/trainings/delete/{id}', [TrainingController::class, 'delete'])->name("trainings.delete"); 
Route::get("/trainings/add-vet/{id}", [TrainingController::class, "addVet"]);
Route::post("/trainings/add-vet-to-db/{id}", [TrainingController::class, "addVetToDB"]);


Route::get('/vets', [VetController::class, 'index']);
Route::get('/vets/create', [VetController::class, 'create']);
Route::post('/vets/add-to-db', [VetController::class, 'addToDB']);
Route::get('/vets/edit/{id}', [VetController::class, 'edit']);
Route::post('/vets/update/{id}', [VetController::class, 'update']);
Route::delete('/vets/delete/{id}', [VetController::class, 'delete'])->name("vets.delete"); 


Route::post("/appointments/validate", [AppointmentController::class, "validateProperty"]);
Route::post("/pets/validate", [PetController::class, "validateProperty"]);
Route::post("/vets/validate", [VetController::class, "validateProperty"]);
Route::post("/services/validate", [ServiceController::class, "validateProperty"]);
Route::post("/trainings/validate", [TrainingController::class, "validateProperty"]);

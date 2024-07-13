<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Vet;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\AppointmentService;
use App\Models\Service;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $models = Appointment::where('IsActive', '=', true)->get();
        return view('appointments.index', ['models' => $models]);
    }

    public function create(): View
    {
        
        $model = new Appointment();
        $vets = Vet::where('IsActive', '=', true)->get();
        $pets = Pet::where('IsActive', '=', true)->get();
        $model->AppointmentDatetime = date('Y-m-d\TH:i');
        return view('appointments.create', ['model' => $model, 'vets' => $vets, 'pets' => $pets]);
    }

    public function addToDb(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'AppointmentDatetime' => 'required|date_format:Y-m-d\TH:i',
            'Reason' => 'required|string|max:255',
            'PetId' => 'required|integer',
            'VetId' => 'required|integer'
        ]);

        $model = new Appointment();
        $model->AppointmentDatetime = $request->input('AppointmentDatetime');
        $model->Reason = $request->input('Reason');
        $model->PetId = $request->input('PetId');
        $model->VetId = $request->input('VetId');
        $model->IsActive = true;
        $model->save();

        return redirect('/appointments');
    }

    public function edit($id): View
    {
        $model = Appointment::find($id);
        $vets = Vet::where('IsActive', '=', true)->get();
        $pets = Pet::where('IsActive', '=', true)->get();
        return view('appointments.edit', ['model' => $model, 'vets' => $vets, 'pets' => $pets]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'AppointmentDatetime' => 'required|date_format:Y-m-d\TH:i',
            'Reason' => 'required|string|max:255',
            'PetId' => 'required|integer',
            'VetId' => 'required|integer'
        ]);
        
        $model = Appointment::find($id);
        $model->AppointmentDatetime = $request->input('AppointmentDatetime');
        $model->Reason = $request->input('Reason');
        $model->PetId = $request->input('PetId');
        $model->VetId = $request->input('VetId');
        $model->IsActive = true;
        $model->save();

        return redirect('/appointments');
    }

    public function delete($id): RedirectResponse
    {
        $model = Appointment::find($id);
        $model->IsActive = false;
        $model->save();
        return redirect('/appointments');
    }

    public function addService($id)
    {
        $model = new AppointmentService();
        $model->AppointmentId = $id;
        $services = Service::where("IsActive", '=', true)->get();
        return view("appointments.addService", ["model" => $model, "services" => $services]);
    }

    public function addServiceToDB($id, Request $request)
    {
        $request->validate([
            'Quantity' =>  'required|integer|min:1',
            'TotalPrice' => 'required|numeric|min:0'
        ]);

        $model = new AppointmentService();
        $model->AppointmentId = $id;
        $model->ServiceId = $request->input("ServiceId");
        $model->Quantity = $request->input("Quantity");
        $model->TotalPrice = $request->input("TotalPrice");

        $model->save();
        
        return redirect("/appointments");
    }

    public function showServiceDetails($appointmentId, $serviceId)
    {
        $service = Service::find($serviceId);

        $appointmentService = AppointmentService::where('AppointmentId', $appointmentId)
            ->where('ServiceId', $serviceId)->first();

        if (!$service || !$appointmentService) {
            return redirect("/appointments");
        }

        return view('appointments.show', [ 
            'service' => $service,
            'appointmentService' => $appointmentService
        ]);
    }

    public function validateProperty(Request $request)
    {

        $property = $request->input("property");
        $value = $request->input("value");
        $success = "";
        $warning = "";
        $error = "";

        switch ($property) {
            case "AppointmentDatetime":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                } else if (!strtotime($value)) {
                    $error = "Niepoprawny format daty.";
                }
                break;
            case "Reason":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
            case "PetId":
            case "VetId":
                if ($value == null || !is_numeric($value)) {
                    $error = "Id jest niepoprawne.";
                }
                break;
            case "Quantity":
            case "TotalPrice":
                if ($value == null && !is_numeric($value)) {
                    $error = "To pole jest wymagane i musi być liczbą.";
                }
                break;
        }

        return response()->json(["success" => $success, "warning" => $warning, "error" => $error]);
    }
}

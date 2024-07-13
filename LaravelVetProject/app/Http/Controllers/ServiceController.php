<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\AppointmentService;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $db = Service::where('IsActive', '=', true);
        // $models = Service::where('IsActive', '=', true)->get();

        if ($request->has('search')) {
            $db->where('Name', 'LIKE', '%' . $request->input('search') . '%');
        }

        $models = $db->get();

        return view('services.index', ['models' => $models]);
    }

    public function create(): View
    {
        $model = new Service();
        return view('services.create', ['model' => $model]);
    }

    public function addToDB(Request $request): RedirectResponse
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Price' => 'required|numeric'
        ]);

        $model = new Service();
        $model->Name = $request->input('Name');
        $model->Description = $request->input('Description');
        $model->Price = $request->input('Price');
        $model->IsActive = true;
        $model->save();

        return redirect('/services');
    }

    public function edit($id): View
    {
        $model = Service::find($id);
        return view('services.edit', ['model' => $model]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Price' => 'required|numeric'
        ]);

        $model = Service::find($id);
        $model->Name = $request->input('Name');
        $model->Description = $request->input('Description');
        $model->Price = $request->input('Price');
        $model->IsActive = $request->input('IsActive', true);
        $model->save();

        return redirect('/services');
    }

    public function delete($id): RedirectResponse
    {
        $model = Service::find($id);
        $model->IsActive = false;
        $model->save();
        return redirect('/services');
    }

    public function validateProperty(Request $request)
    {
        $property = $request->input("property");
        $value = $request->input("value");

        $success = "";
        $warning = "";
        $error = "";

        switch ($property) {
            case "Name":
            case "Description":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
            case "Price":
                if (!is_numeric($value)) {
                    $error = "To pole musi być liczbą.";
                }
                break;
        }

        return response()->json(["success" => $success, "warning" => $warning, "error" => $error]);
    }
}

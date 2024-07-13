<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Vet;
use Illuminate\Http\RedirectResponse;

class VetController extends Controller
{
    public function index(Request $request) : View {
        $db = Vet::where('IsActive', '=', true);

        if ($request->has('search')) {
            $db->where('VetName', 'LIKE', '%' . $request->input('search') . '%');
        }

        $models = $db->get();
        
        return view('vets.index', ['models' => $models]);
    }

    public function create() : View {
        $model = new Vet();
        return view('vets.create', ['model' => $model]);
    }

    public function addToDB(Request $request) : RedirectResponse {

        $request->validate([
            'VetName' => 'required|string|max:255',
            'VetSurname' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'required|string|max:255'
        ]);
        
        $model = new Vet();
        $model->VetName = $request->input('VetName');
        $model->VetSurname = $request->input('VetSurname');
        $model->Email = $request->input('Email');
        $model->Phone = $request->input('Phone');
        $model->IsActive = true;
        $model->save();

        return redirect('/vets');
    }

    public function edit($id) : View {
        $model = Vet::find($id);
        return view('vets.edit', ['model' => $model]);
    }

    public function update(Request $request, $id) : RedirectResponse {

        $request->validate([
            'VetName' => 'required|string|max:255',
            'VetSurname' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'required|string|max:255'
        ]);

        $model = Vet::find($id);
        $model->VetName = $request->input('VetName');
        $model->VetSurname = $request->input('VetSurname');
        $model->Email = $request->input('Email');
        $model->Phone = $request->input('Phone');
        $model->IsActive = $request->input('IsActive', true);
        $model->save();

        return redirect('/vets');
    }

    public function delete($id) : RedirectResponse {
        $model = Vet::find($id);
        $model->IsActive = false;
        $model->save();
        return redirect('/vets');
    }

    public function validateProperty(Request $request) {

        $property = $request->input("property");
        $value = $request->input("value");
        $success = "";
        $warning = "";
        $error = "";

        switch($property) {
            case "VetName":
            case "VetSurname":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
            case "Email":
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $error = "Niepoprawny format e-mail.";
                }
                break;
            case "Phone":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
        }

        return response()->json(["success" => $success, "warning" => $warning, "error" => $error]);
    }
}

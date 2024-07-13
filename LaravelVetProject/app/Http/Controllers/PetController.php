<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController extends Controller
{
    public function index(Request $request): View
    {
        $db = Pet::where('IsActive', '=', true); 

        if ($request->has('search')) {
            $db->where('PetName', 'LIKE', '%' . $request->input('search') . '%');
        }

        $models = $db->get();
        
        return view('pets.index', ['models' => $models]);
    }

    public function create(): View
    {
        $model = new Pet();
        return view('pets.create', ['model' => $model]);
    }

    public function addToDB(Request $request): RedirectResponse
    {
        $request->validate([
            'PetName' => 'required|string|max:255',
            'Breed' => 'required|string|max:255',
            'PetWeight' => 'required|numeric',
            'BirthDate' => 'required|date'
        ]);

        $model = new Pet();
        $model->PetName = $request->input('PetName');
        $model->Breed = $request->input('Breed');
        $model->PetWeight = $request->input('PetWeight');
        $model->BirthDate = $request->input('BirthDate');
        $model->IsActive = true;
        $model->save();

        return redirect('/pets');
    }

    public function edit($id): View
    {
        $model = Pet::find($id);
        return view('pets.edit', ['model' => $model]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'PetName' => 'required|string|max:255',
            'Breed' => 'required|string|max:255',
            'PetWeight' => 'required|numeric',
            'BirthDate' => 'required|date'
        ]);

        $model = Pet::find($id);
        $model->PetName = $request->input('PetName');
        $model->Breed = $request->input('Breed');
        $model->PetWeight = $request->input('PetWeight');
        $model->BirthDate = $request->input('BirthDate');
        $model->IsActive = true;
        $model->save();

        return redirect('/pets');
    }

    public function delete($id): RedirectResponse
    {

        $model = Pet::find($id);

        $model->IsActive = false;
        $model->save();

        return redirect('/pets');
    }

    public function validateProperty(Request $request)
    {
        $property = $request->input("property");
        $value = $request->input("value");
        $success = "";
        $warning = "";
        $error = "";

        switch ($property) {
            case "PetName":
            case "Breed":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
            case "PetWeight":
                if (!is_numeric($value)) {
                    $error = "To pole jest wymagane i musi być liczbą.";
                }
                break;
            case "BirthDate":
                if ($value != null && !strtotime($value)) {
                    $error = "Niepoprawny format daty.";
                }
                break;
        }

        return response()->json(["success" => $success, "warning" => $warning, "error" => $error]);
    }
}

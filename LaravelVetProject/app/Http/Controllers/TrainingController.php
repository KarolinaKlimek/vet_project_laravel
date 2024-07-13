<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Training;
use App\Models\TrainingVet;
use App\Models\Vet;


class TrainingController extends Controller
{
    public function index(Request $request): View
    {
        $db = Training::where('IsActive', '=', true);

        if ($request->has('search')) {
            $db->where('Title', 'LIKE', '%' . $request->input('search') . '%');
        }

        $models = $db->get();

        return view('trainings.index', ['models' => $models]);
    }

    public function create(): View
    {
        $model = new Training();
        return view('trainings.create', ['model' => $model]);
    }

    public function addToDB(Request $request): RedirectResponse
    {
        $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Date' => 'required|date',
        ]);

        $model = new Training();
        $model->Title = $request->input('Title');
        $model->Description = $request->input('Description');
        $model->Date = $request->input('Date');
        $model->IsActive = true;
        $model->save();

        return redirect('/trainings');
    }

    public function edit($id): View
    {
        $model = Training::find($id);
        return view('trainings.edit', ['model' => $model]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
            'Date' => 'required|date',
        ]);

        $model = Training::find($id);
        $model->Title = $request->input('Title');
        $model->Description = $request->input('Description');
        $model->Date = $request->input('Date');
        $model->IsActive = $request->input('IsActive', true);
        $model->save();

        return redirect('/trainings');
    }

    public function delete($id): RedirectResponse
    {
        $model = Training::find($id);
        $model->IsActive = false;
        $model->save();
        return redirect('/trainings');
    }

    public function addVet($id)
    {
        $model = Training::find($id);
        $vets = Vet::where('IsActive', '=', true)->get();
        return view("trainings.addVet", ["model" => $model, "vets" => $vets]);
    }

    public function addVetToDB($id, Request $request)
    {
        $request->validate([
            'VetId' => 'required|integer',
        ]);

        $trainingId = $id;
        $vetId = $request->input("VetId");

        $rekordExistInDb = TrainingVet::where('TrainingId', $trainingId)->where('VetId', $vetId)->first();


        if ($rekordExistInDb) {
            return redirect("/trainings");
        }

        $model = new TrainingVet();
        $model->TrainingId = $id;
        $model->VetId = $vetId; //$request->input("VetId");
        $model->save();
        
        return redirect("/trainings");
    }

    public function validateProperty(Request $request)
    {
        $property = $request->input("property");
        $value = $request->input("value");

        $success = "";
        $warning = "";
        $error = "";

        switch ($property) {
            case "Title":
            case "Description":
                if ($value == null || $value == "") {
                    $error = "To pole jest wymagane.";
                }
                break;
            case "Date":
                if ($value == null || !strtotime($value)) {
                    $error = "Niepoprawny format daty.";
                }
                break;
        }

        return response()->json(["success" => $success, "warning" => $warning, "error" => $error]);
    }
}

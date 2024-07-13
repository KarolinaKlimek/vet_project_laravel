@extends("main", ["title" => "Trainings"])

@section("menu")
<a class="btn btn-primary" href="/trainings/create">Create new training</a>
<a class="btn btn-primary" href="/trainings">All trainings</a>
<a class="btn btn-primary" href="/">Menu</a>
@endsection

@section("content")
<div class="container">
    <div class="row mb-3 justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ url('/trainings') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row gy-3">
        @foreach($models as $model)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title h5">{{ $model->Title }}</p>
                    <p><span class="text-primary">{{ $model->Description }}</span></p>
                    <p>{{ $model->Date }}</p>
                    <p>Vets taking part in training</p>
                    <!-- <div> 
                        @foreach($model->TrainingsVets as $item)
                        <div class="badge bg-secondary text-light">
                                {{ $item->Vet->VetName ?? 'No vets have been assigned yet' }}
                                {{ $item->Vet->VetSurname }}
                        </div>
                        @endforeach
                    </div> -->
                    <div>
                        @foreach($model->TrainingsVets as $item)
                            @if($item->Vet && $item->Vet->IsActive)
                                <div class="badge bg-secondary text-light">
                                    {{ $item->Vet->VetName ?? 'No vets have been assigned yet' }} {{ $item->Vet->VetSurname }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="/trainings/edit/{{$model->TrainingId}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('trainings.delete', $model->TrainingId) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ url()->current() }}/add-vet/{{ $model->TrainingId }}" class="btn btn-secondary">Add Vet</a>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
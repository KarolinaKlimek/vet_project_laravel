@extends("main", ["title" => "Vets"])

@section("menu")
<a class="btn btn-primary" href="/vets/create">Create new vet</a>
<a class="btn btn-primary" href="/vets">All vets</a>
<a class="btn btn-primary" href="/">Menu</a>
@endsection

@section("content") 
<div class="container">
    <div class="row mb-3 justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ url('/vets') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search"  value="{{ request('search') }}">
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
                    <p class="card-title h5">{{ $model->VetName }} {{ $model->VetSurname }}</p>
                    <p><span class="text-primary">{{ $model->Email }}</span></p>
                    <p>{{ $model->Phone }}</p>
                </div>
                <div class="card-footer">
                    <a href="/vets/edit/{{$model->VetId}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('vets.delete', $model->VetId) }}" method="POST" style="display:inline;" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> 
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

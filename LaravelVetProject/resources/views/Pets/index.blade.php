@extends("main", ["title" => "Pets"])

@section("menu")
<a class="btn btn-primary" href="/pets/create">Create new pet</a>
<a class="btn btn-primary" href="/pets">All pets</a>
<a class="btn btn-primary" href="/">Menu</a>
@endsection

@section("content") 
<div class="container">
    <div class="row mb-3 justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ url('/pets') }}">
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
                    <p class="card-title h5 ">{{ $model->PetName }}</p>
                    <p><span class="text-primary">{{ $model->Breed }}</span></p>
                    <p >{{ $model->PetWeight }} kg</p>
                    <p >{{ $model->BirthDate }}</p>
                </div>
                <div class="card-footer">
                    <a href="/pets/edit/{{$model->PetId}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('pets.delete', $model->PetId) }}" method="POST" style="display:inline;" >
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

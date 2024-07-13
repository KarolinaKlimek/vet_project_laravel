@extends("main")

@section("menu")
    <a class="btn btn-primary" href="/pets/create">Create new</a>
    <a class="btn btn-primary" href="/pets">All</a>
@endsection

@section("content")
<div class="container">
    <form method="post" action="/pets/add-to-db" id="form">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">pets</i>
                        Pet Name
                    </label>
                    <input class="form-control validate" name="PetName" value="{{ $model->PetName }}">
                    <div id="PetName-success" class="text-success"></div>
                    <div id="PetName-warning" class="text-warning"></div>
                    <div id="PetName-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">pets</i>
                        Breed
                    </label>
                    <input class="form-control validate" name="Breed" value="{{ $model->Breed }}">
                    <div id="Breed-success" class="text-success"></div>
                    <div id="Breed-warning" class="text-warning"></div>
                    <div id="Breed-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">scale</i>
                        Pet Weight
                    </label>
                    <input class="form-control validate" name="PetWeight" value="{{ $model->PetWeight }}">
                    <div id="PetWeight-success" class="text-success"></div>
                    <div id="PetWeight-warning" class="text-warning"></div>
                    <div id="PetWeight-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">cake</i>
                        Birth Date
                    </label>
                    <input class="form-control validate" type="date" name="BirthDate" value="{{ $model->BirthDate }}">
                    <div id="BirthDate-success" class="text-success"></div>
                    <div id="BirthDate-warning" class="text-warning"></div>
                    <div id="BirthDate-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary" type="submit" >Create</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section("scripts")
<script> 
    $(document).ready(function() {
        $(".validate").on("focusout", function() {
           // console.log(this); 
            let input = this; 
            $.ajax({
                url: "/pets/validate",
                method: "POST",
                dataType: "json", 
                data: {
                    property: this.name, //przesylamy nazwę inputa
                    value: this.value,
                    _token: "{{ csrf_token() }}" //wartosc ktora wpisal uzytkownik
                }, 
                success: function(result) {
                    document.getElementById(input.name + "-success").innerHTML = result.success;
                    document.getElementById(input.name + "-warning").innerHTML = result.warning;
                    document.getElementById(input.name + "-error").innerHTML = result.error;
                    if(result.error == "") { 
                        input.classList.remove("invalid");
                    } else {
                        input.classList.add("invalid"); 
                    }
                }
            });
        }) 

        document.getElementById("form").addEventListener("submit", function(event) {
            if(document.getElementsByClassName("invalid").length > 0) { 
                event.preventDefault();
                alert("Popraw błędy na widoku.");
            }
        });
    })
</script>
@endsection


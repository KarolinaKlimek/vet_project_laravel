@extends("main")

@section("menu")
<a class="btn btn-primary" href="/vets/create">Create new</a>
<a class="btn btn-primary" href="/vets">All</a>
@endsection

@section("content")
<div class="container">
    <form method="post" action="/vets/add-to-db" id="form">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">person</i>
                        Vet Name
                    </label>
                    <input class="form-control validate" name="VetName" value="{{ $model->VetName }}">
                    <div id="VetName-success" class="text-success"></div>
                    <div id="VetName-warning" class="text-warning"></div>
                    <div id="VetName-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">person</i>
                        Vet Surname
                    </label>
                    <input class="form-control validate" name="VetSurname" value="{{ $model->VetSurname }}">
                    <div id="VetSurname-success" class="text-success"></div>
                    <div id="VetSurname-warning" class="text-warning"></div>
                    <div id="VetSurname-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">email</i>
                        Email
                    </label>
                    <input class="form-control validate" name="Email" value="{{ $model->Email }}">
                    <div id="Email-success" class="text-success"></div>
                    <div id="Email-warning" class="text-warning"></div>
                    <div id="Email-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">phone</i>
                        Phone
                    </label>
                    <input class="form-control validate" name="Phone" value="{{ $model->Phone }}">
                    <div id="Phone-success" class="text-success"></div>
                    <div id="Phone-warning" class="text-warning"></div>
                    <div id="Phone-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary" type="submit">Create</button>
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
                url: "/vets/validate",
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
                    if (result.error == "") {
                        input.classList.remove("invalid");
                    } else {
                        input.classList.add("invalid");
                    }
                }
            });
        })

        document.getElementById("form").addEventListener("submit", function(event) {
            if (document.getElementsByClassName("invalid").length > 0) {
                event.preventDefault();
                alert("Popraw błędy na widoku.");
            }
        });
    })
</script>
@endsection
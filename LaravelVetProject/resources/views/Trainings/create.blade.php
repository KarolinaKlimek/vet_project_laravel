@extends("main")

@section("menu")
<a class="btn btn-primary" href="/trainings/create">Create new</a>
<a class="btn btn-primary" href="/trainings">All</a>
@endsection

@section("content")
<div class="container">
    <form method="post" action="/trainings/add-to-db" id="form">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">label</i>
                        Title
                    </label>
                    <input class="form-control validate" name="Title" value="{{ $model->Title }}">
                    <div id="Title-success" class="text-success"></div>
                    <div id="Title-warning" class="text-warning"></div>
                    <div id="Title-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <label class="form-label">
                    <i class="material-icons-round align-middle">description</i>
                    Description
                </label>
                <textarea class="form-control validate" name="Description">{{ $model->Description }}</textarea>
                <div id="Description-success" class="text-success"></div>
                <div id="Description-warning" class="text-warning"></div>
                <div id="Description-error" class="text-danger"></div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">event</i>
                        Date
                    </label>
                    <input class="form-control validate" type="datetime-local" name="Date" value="{{ $model->Date }}">
                    <div id="Date-success" class="text-success"></div>
                    <div id="Date-warning" class="text-warning"></div>
                    <div id="Date-error" class="text-danger"></div>
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
                url: "/trainings/validate",
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

        //zaleca się podpięcie do kolekcji elementów, ale w sumie do jednego też można
        // $("#form").on("submit", function() {

        // });
        //do elemntu o 1 jednym podanym id, podpięcie wydarzenia do 1 konkretnego elementu
        document.getElementById("form").addEventListener("submit", function(event) {
            if (document.getElementsByClassName("invalid").length > 0) {
                event.preventDefault();
                alert("Popraw błędy na widoku.");
            }
        });
    })
</script>
@endsection
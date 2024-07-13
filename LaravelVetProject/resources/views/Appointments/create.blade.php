@extends("main")

@section("menu")
    <a class="btn btn-primary" href="/appointments/create">Create new appointment</a>
    <a class="btn btn-primary" href="/appointments">All appointments</a>
@endsection

@section("content")
<div class="container">
    <form method="post" action="/appointments/add-to-db" id="form">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">calendar_today</i>
                        Appointment Date
                    </label>
                    <input class="form-control validate" name="AppointmentDatetime" type="datetime-local" value="{{ $model->AppointmentDatetime }}">
                    <div id="AppointmentDatetime-success" class="text-success"></div>
                    <div id="AppointmentDatetime-warning" class="text-warning"></div>
                    <div id="AppointmentDatetime-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">description</i>
                        Reason
                    </label>
                    <input class="form-control validate" name="Reason" value="{{ $model->Reason }}">
                    <div id="Reason-success" class="text-success"></div>
                    <div id="Reason-warning" class="text-warning"></div>
                    <div id="Reason-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <select class="form-select validate" name="PetId">
                    @foreach($pets as $pet)
                        <option {{ $pet->PetId == $model->PetId ? 'selected' : '' }} value="{{ $pet->PetId }}"> {{ $pet->PetName }}</option>
                    @endforeach
                </select>
                <div id="PetId-success" class="text-success"></div>
                <div id="PetId-warning" class="text-warning"></div>
                <div id="PetId-error" class="text-danger"></div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <select class="form-select validate" name="VetId">
                    @foreach($vets as $vet)
                        <option {{ $vet->VetId == $model->VetId  ? 'selected' : '' }} value="{{ $vet->VetId }} "> {{ $vet->VetName }} {{ $vet->VetSurname }}</option>
                    @endforeach
                </select>
                <div id="VetId-success" class="text-success"></div>
                <div id="VetId-warning" class="text-warning"></div>
                <div id="VetId-error" class="text-danger"></div>
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
                url: "/appointments/validate",
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

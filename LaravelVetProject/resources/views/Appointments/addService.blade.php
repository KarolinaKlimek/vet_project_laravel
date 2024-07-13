@extends('main')

@section('menu')
    <a href="/appointments/create" class="btn btn-primary">Create new appointment</a>
    <a href="/appointments" class="btn btn-primary">All appointments</a>
@endsection

@section('content')
<div class="container">
    <form method="POST" action="/appointments/add-service-to-db/{{ $model->AppointmentId }}">
        @csrf 
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">label</i>
                        Service
                    </label>
                    <select class="form-select" name="ServiceId">
                        @foreach($services as $service)
                            <option {{ $service->ServiceId == $model->ServiceId ? 'selected' : '' }} value="{{ $service->ServiceId }}"> {{ $service->Name }}, price: {{ $service->Price }} PLN</option>
                        @endforeach
                    </select>
                    <div id="ServiceId-success" class="text-success"></div>
                    <div id="ServiceId-warning" class="text-warning"></div>
                    <div id="ServiceId-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">filter_1</i>
                        Quantity
                    </label>
                    <input class="form-control validate" name="Quantity" type="number" value="{{ $model->Quantity }}">
                    <div id="Quantity-success" class="text-success"></div>
                    <div id="Quantity-warning" class="text-warning"></div>
                    <div id="Quantity-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">attach_money</i>
                           Total Price </label>
                    <input class="form-control validate" name="TotalPrice" type="number" step="0.01" value="{{ $model->TotalPrice }}">
                    <div id="TotalPrice-success" class="text-success"></div>
                    <div id="TotalPrice-warning" class="text-warning"></div>
                    <div id="TotalPrice-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary" name="action" value="add_new">Save</button>
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


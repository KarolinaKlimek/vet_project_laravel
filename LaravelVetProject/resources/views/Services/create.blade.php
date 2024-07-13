@extends("main")

@section("menu")
    <a class="btn btn-primary" href="/services/create">Create new service</a>
    <a class="btn btn-primary" href="/services">All services</a>
@endsection

@section("content")
<div class="container">
    <form method="post" action="/services/add-to-db" id="form">
        @csrf
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">label</i>
                        Name
                    </label>
                    <input class="form-control validate" name="Name" value="{{ $model->Name }}">
                    <div id="Name-success" class="text-success"></div>
                    <div id="Name-warning" class="text-warning"></div>
                    <div id="Name-error" class="text-danger"></div>
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
                        <i class="material-icons-round align-middle">attach_money</i>
                        Price
                    </label>
                    <input class="form-control validate" name="Price" type="number" step="0.01" value="{{ $model->Price }}">
                    <div id="Price-success" class="text-success"></div>
                    <div id="Price-warning" class="text-warning"></div>
                    <div id="Price-error" class="text-danger"></div>
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
                url: "/services/validate",
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


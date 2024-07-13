@extends('main')

@section('menu')
    <a href="/trainings/create" class="btn btn-primary">Create new training</a>
    <a href="/trainings" class="btn btn-primary">All trainings</a>
@endsection

@section('content')
<div class="container">
    <form method="POST" action="/trainings/add-vet-to-db/{{ $model->TrainingId }}">
        @csrf 
        <div class="row gy-3">
            <div class="col-md-12 col-lg-6 col-xxl-4">
                <div class="input-group">
                    <label class="input-group-text">
                        <i class="material-icons-round align-middle">label</i>
                        Vet
                    </label>
                    <select class="form-select" name="VetId">
                        @foreach($vets as $vet)
                            <option value="{{ $vet->VetId }}"> {{ $vet->VetName }} {{ $vet->VetSurname }}</option>
                        @endforeach
                    </select>
                    <div id="VetId-success" class="text-success"></div>
                    <div id="VetId-warning" class="text-warning"></div>
                    <div id="VetId-error" class="text-danger"></div>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary" >Save</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section("scripts")
<script> 
    $(document).ready(function() {
        $(".validate").on("focusout", function() {
           let input = this; 
            $.ajax({
                url: "/trainings/validate",
                method: "POST",
                dataType: "json", 
                data: {
                    property: this.name,
                    value: this.value,
                    _token: "{{ csrf_token() }}"
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

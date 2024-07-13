@extends("main", ["title" => "Appointments"])

@section("menu")
<a class="btn btn-primary" href="/appointments/create">Create new appointment</a>
<a class="btn btn-primary" href="/appointments">All appointments</a>
<a class="btn btn-primary" href="/">Menu</a>
@endsection

@section("content")
<div class="container">
    <div class="row gy-3">
        @foreach($models as $model)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="card-title h5">{{ $model->AppointmentDatetime }}</p>
                    <p><span class="text-primary">{{ $model->Reason }}</span></p>
                    <p>Pet: {{ $model->pet->PetName }}</p>
                    <p>Vet: {{ $model->vet->VetName }} {{ $model->vet->VetSurname }}</p>
                    <!-- <div>
                        @foreach($model->AppointmentsServices as $item)
                        <div class="badge bg-secondary">
                            <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#serviceModal" data-appointment-id="{{ $model->AppointmentId }}" data-service-id="{{ $item->ServiceId }}">
                                {{ $item->Service->Name ?? 'No service' }}
                            </a>
                        </div>
                        @endforeach
                    </div> -->
                    <div>
                        @foreach($model->AppointmentsServices as $item)
                            @if($item->Service && $item->Service->IsActive)
                                <div class="badge bg-secondary">
                                    <a href="#" class="text-light" data-bs-toggle="modal" data-bs-target="#serviceModal" data-appointment-id="{{ $model->AppointmentId }}" data-service-id="{{ $item->ServiceId }}">
                                        {{ $item->Service->Name }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="/appointments/edit/{{$model->AppointmentId}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('appointments.delete', $model->AppointmentId) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ url()->current() }}/add-service/{{ $model->AppointmentId }}" class="btn btn-secondary">Add service</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modalne okno -->

<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $('#serviceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var appointmentId = button.data('appointment-id');
            var serviceId = button.data('service-id');

            $.ajax({
                url: '/appointments/' + appointmentId + '/services/' + serviceId,
                method: 'GET',
                success: function(result) {
                    var modal = $('#serviceModal');
                    modal.find('.modal-body').html(result);
                }
            });
        });
    });
</script>
@endsection
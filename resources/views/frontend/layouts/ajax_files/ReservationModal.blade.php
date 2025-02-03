@php
    $reservationTimes = \App\Models\ReservationTime::where('status', true)->get();
@endphp
<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form" action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input class="reservation_input" type="text" placeholder="Name" name="name">
                        <input class="reservation_input" type="text" placeholder="Phone" name="phone">
                        <input class="reservation_input" type="date" name="date">
                        <select class="reservation_input nice-select" name="time">
                            <option value="">select time</option>
                            @foreach ($reservationTimes as $time)
                            <option value="{{ $time->start_time }}-{{ $time->end_time }}">{{ $time->start_time }} to {{ $time->end_time }}</option>
                            @endforeach
                        </select>
                        <input class="reservation_input" type="text" placeholder="Persons" name="persons">
                        <button type="submit" class="btn_submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function(){
        $('.fp__reservation_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route("reservation.store") }}',
                data: formData,
                beforeSend: function(){
                    $('.btn_submit').html(`<span class="spinner-border text-light"> <span>`);
                },
                success: function(response){
                    toastr.success(response.message);
                    $('.fp__reservation_form').trigger("reset");
                    $('#staticBackdrop').modal('hide');

                },
                error: function(xhr, status, error){
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        toastr.error(value);
                        $('.btn_submit').html(`Book Table`);
                    })
                },
                complete: function(){
                    $('.btn_submit').html(`Book Table`);
                }
            })
        })
    })
</script>
@endpush

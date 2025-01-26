<script>
    $(document).ready(function() {
        let orderId = '';

        $(document).on('click', '.order_status_btn', function() {
            const id = $(this).data('id');
            orderId = id;

            const paymentStatus = $('.payment_status');
            const orderStatus = $('.order_status');

            // Disable the submit button during the request
            $('.submit_btn').prop('disabled', true);

            $.ajax({
                method: 'GET',
                url: '{{ route("admin.orders.status", ":id") }}'.replace(":id", id),
                success: function(response) {
                    // Set the payment status option to selected based on response
                    paymentStatus.val(response.payment_status);
                    // Set the order status option to selected based on response
                    orderStatus.val(response.order_status);
                    // Enable the submit button after the request completes
                    $('.submit_btn').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    // Optionally, handle errors (e.g., alert the user)
                    $('.submit_btn').prop('disabled', false); // Ensure the button is re-enabled on error
                }
            });
        })

        $('.order_status_form').on('submit', function(e){
            e.preventDefault();
            let formContent = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route("admin.orders.status-update", ":id") }}'.replace(":id", orderId),
                data: formContent,
                success: function(response) {
                    $('#order_modal').modal("hide");
                    $('#order-table').DataTable().draw();

                    toastr.success(response.message);
                },
                error: function(xhr, status, error){
                    toastr.error(xhr.responseJSON.message);
                }
            })
        })
    })
</script>

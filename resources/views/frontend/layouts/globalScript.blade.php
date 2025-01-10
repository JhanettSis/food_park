<script>
    /** Load Product modal */
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route("loadProductModal", ":productId") }}'.replace(':productId', productId),
            success: function(response) {
                $('.productModalBody').html(response); // Load the response into the modal body
                $('#cartModal').modal('show'); // Show the modal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to load product details. Please try again.');
            }
        });
    }
</script>

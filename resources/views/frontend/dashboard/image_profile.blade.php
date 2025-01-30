<!--
User Avatar and Upload Form

Avatar Display (<img>) – Displays the currently logged-in user's avatar by
fetching it from Auth::user()->avatar.
Camera Icon (<i class="far fa-camera"></i>) – Serves as a visual cue for
the user to change their avatar.
File Upload Form (<form>) – A hidden form containing an input for selecting
    a new avatar. When the camera icon is clicked, it triggers this file input.
User Name Display

The authenticated user's name is displayed dynamically
using { { Auth::user()->name }}.
-->
<div class="dasboard_header">
    <div class="dasboard_header_img">
        <!-- Display user avatar dynamically using the authenticated user's avatar -->
        <img src="{{ Auth::user()->avatar }}" alt="user" class="img-fluid w-100">

        <!-- Camera icon for updating the avatar, linked to file input -->
        <label for="upload">
            <i class="far fa-camera"></i>
        </label>

        <!-- Form to handle avatar upload (hidden input field) -->
        <form id="avatar_form">
            <!-- Hidden file input for avatar upload -->
            <input type="file" id="upload" hidden name="avatar">
        </form>
    </div>

    <!-- Display authenticated user's name dynamically -->
    <h2>{{ Auth::user()->name }}</h2>
</div>

<!--=============================
    JAVASCRIPT TO HANDLE AVATAR UPLOAD
==============================-->
@push('scripts')
    <script>
        $(document).ready(function(){
            // When the file input (#upload) changes (file selected)
            $('#upload').on('change', function(){

                // Get the form element by its ID (#avatar_form)
                let form = $('#avatar_form')[0];

                // Create a FormData object to hold the uploaded file
                let formData = new FormData(form);

                // Perform an AJAX request to upload the avatar
                $.ajax({
                    method: 'POST',  // Use PUT method to update the user's avatar
                    url: "{{ route('profile.avatar.update') }}",  // Route to handle avatar update
                    data: formData,  // Send form data including the uploaded file

                    // Prevent jQuery from processing the data (since FormData is used)
                    processData: false,

                    // Do not set content type (let browser handle it)
                    contentType: false,

                    // On successful response (avatar uploaded)
                    success: function(response){
                        //console.log(response);  // Log response to console (debugging)
                        if(response.status === 'success')
                    {
                        window.location.reload();
                    }
                    },

                    // On error during AJAX request (upload failure)
                    error: function (error){
                        console.error(error);  // Log error to console
                    }
                });
            })
        })
    </script>
@endpush

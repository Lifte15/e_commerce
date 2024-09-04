<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eternal Nap Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-body-secondary justify-content-center">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('storage/images/Eternal_Nap_Letter-Bg.png') }}" alt="EternalNap Logo" height="40" style="vertical-align: middle;">
    </a>
            <a href="{{ route('helloworl') }}" style="color: inherit; vertical-align: middle; margin-left: -15px; margin-bottom: -5.5px">.</a>
</nav>

    <div class="container mt-4">
        @yield('content')
    </div>
<!-- Modal -->
<!-- <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Product Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDescriptionBody"> -->
                <!-- Description content will be inserted here 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script>
    // Event listener for showing the modal with product description
    document.querySelectorAll('.view-description').forEach(button => {
        button.addEventListener('click', function () {
            const description = this.getAttribute('data-description');
            const modalBody = document.getElementById('modalDescriptionBody');
            modalBody.textContent = description; // Set the description content
            $('#descriptionModal').modal('show'); // Show the modal
        });
    });
</script> -->

</body>
</html>

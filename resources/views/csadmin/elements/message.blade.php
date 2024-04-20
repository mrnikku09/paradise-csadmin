@if(session()->has('success'))
<div class="alert alert-success" id="flash-message">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" id="flash-message">{{ session()->get('error') }}</div>
@endif
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('#flash-message').fadeOut('slow');
        }, 3000);
    });
</script>
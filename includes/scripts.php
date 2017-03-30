<!-- jQuery -->
<script src="lib/jquery/jquery.min.js"></script>
<!-- JavaScript Boostrap plugin -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<!-- Expanding textarea -->
<script src="lib/expanding.jquery.js"></script>
<!-- Confirm action -->
<!-- <script src="lib/confirm.js"></script> -->
<script>
    $('#confirm-alert').on('show.bs.modal',function(e){$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>
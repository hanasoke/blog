<!-- Bootstrap core JavaScript-->
<script src="{{ url('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('admin_assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ url('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

<script src="{{ url('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('admin_assets/js/demo/datatables-demo.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ url('admin_assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('admin_assets/js/demo/chart-pie-demo.js') }}"></script>

<script>
    $(document).ready(function() {
        // Update file input label when file is selected
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            
            // Preview image
            var inputId = $(this).attr('id');
            if (inputId === 'thumbnail') {
                previewImage(this, '#thumbnailPreview');
            } else if (inputId === 'image_2') {
                previewImage(this, '#image2Preview');
            } else if (inputId === 'image_3') {
                previewImage(this, '#image3Preview');
            }
        });
        
        function previewImage(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewElement).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $(previewElement).hide();
            }
        }
    });
</script>
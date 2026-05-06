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

        // Filter out blogs thhat already have access 
        $('#blog_id option').each(function(){
            if($(this).text().includes('Already has access:')) {
                $(this).attr('disabled', 'disabled');
                $(this).hide();
            }
        });

        // Auto fill price based on access selection
        $('#access').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var price = selectedOption.data('price');
            
            if(price) {
                $('#price').val(price);
            } else {
                $('#price').val('');
            }
        });

        // Trigger change on page load if there's old value
        if($('#access').val()) {
            $('#access').trigger('change');
        }

        // Update price display when access level changes
        $('#member_id').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var price = selectedOption.data('price');
            
            if(price !== undefined && price !== null) {
                var formattedPrice = new Intl.NumberFormat('id-ID').format(price);
                $('#price_display').val(formattedPrice);
                
                // Add visual feedback
                $('#price_display').css('background-color', '#d4edda');
                setTimeout(function() {
                    $('#price_display').css('background-color', '');
                }, 500);
            } else {
                $('#price_display').val('0');
            }
        });
        
        // Trigger on page load if there's old value
        if($('#member_id').val()) {
            $('#member_id').trigger('change');
        }

        $('#report_type').on('change', function() {
        if($(this).val() == 'date_range') {
            $('#date_range_fields').slideDown();
        } else {
            $('#date_range_fields').slideUp();
        }
    });
</script>
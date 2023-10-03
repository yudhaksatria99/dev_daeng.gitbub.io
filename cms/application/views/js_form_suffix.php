<?php
// Call PHP function from javascript with parameters
function myphpfunction($x, $y)
{
    $z = $x + $y;
    return 'The sum is: ' . $z;
}
?>

<script>
    $('#formActions').on('submit', (function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                window.alert(data['message']);
                if (data['success']) {
                   
                    if (data['success']) {
                        var Cntl = '<?= $this->router->class ?>';
                        var Suffix = '<?= $suffix ?>';
                        var theUrl = '<?= base_url() ?>' + Cntl + Suffix;
                        window.location = theUrl;
                    }
                   
                } 
            },
            error: function(data) {
                var errHtml = data['responseText'];
                $('#formActions').html(errHtml);

            }
        });
    }));

</script>
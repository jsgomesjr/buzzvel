<script type="text/javascript" comment="QR Code Script">
    function generateQRCode(text) {

        $('#qrcode canvas').remove();
        $('#qrcode img').remove();

        let qrcode = new QRCode($('#qrcode')[0], {
            text: text,
            width: 256,
            height: 256,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        });

        $('#qrcode').addClass('qrcode_loaded');
        $('#qrcode img').on('load', function() {
            $(this).addClass('loaded');
        });

        $('#qrcode').hide().fadeIn(2000);
    }

    const const_MESSAGE = {
        type: 'error',
        name: 'Error submitting form.',
        exception: 'unexpected error',
        object: null
    };

    $(document).ready(function() {
        let form = $('form#people_information_form');
        form.on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'JSON',
                cache: false,
                data: new FormData(this),
                processData: false,
                contentType: false,
            }).done(function(data) {
                try {
                    if (data.message_type && data.message_name) {
                        const_MESSAGE.type = data.message_type;
                        const_MESSAGE.name = data.message_name;

                        generateQRCode(data.qrcode_url);
                    } else {
                        throw new Exception('Unexpected error, please contact support!');
                    }
                    if (data.object) {
                        form[0].reset();
                    }
                } catch (exception) {
                    alert(exception);
                } finally {
                    toastr[const_MESSAGE.type](const_MESSAGE.name);
                }
            }).fail(function(data) {
                toastr[const_MESSAGE.type](const_MESSAGE.name);
                alert(exception);
            });
        });

    });
</script>

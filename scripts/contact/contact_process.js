$(function () {
    $('#contact_form').submit(function (e) {
        e.preventDefault();
        var form = $('#contact_form');
        var formData = $(this).serialize();
        let URL = $(form).attr('action');
        let msg_div = $('#contact_msg');

        $.ajax({
            url: URL,
            type: 'post',
            // dataType: 'json',
            cache: false,
            process: false,
            data: formData,

            success: function f(res) {
                alert('Success');
                let resObj = JSON.parse(res);
                alert(resObj.valid);
                if (resObj.valid) {
                    $.getJSON('../scripts/contact/email/contact_email.php', {'valid': resObj.valid}, function (responseObj) {
                        var responseTxt = JSON.parse(responseObj);
                        alert(responseObj.success);
                    });
                }
            },
            error: function f1(obj) {
                alert('Error');
                var resObj = JSON.parse(obj);
                alert(resObj.error);
            }
        });
    });
});
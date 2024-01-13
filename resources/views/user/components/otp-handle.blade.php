<script>
    let timerOn = true;

    $(document).ready(function () {
        var remaining = localStorage['OTPTimeOut'];
        // console.log(remaining);
        if (remaining) {
            $('#request-btn').prop("disabled", true);
            timer(remaining);
        }

    });

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        $('#request-btn').html(m + ':' + s);


        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function () {
                timer(remaining);
                localStorage['OTPTimeOut'] = remaining;
            }, 1000);
            return;
        }

        if (!timerOn) {
            // Do validate stuff here
            return;
        }

        // Do timeout stuff here
        $('#request-btn').prop("disabled", false);
        $('#request-btn').html('{{ __('user-portal.request_otp') }}');
    }

    function requestOTP(message) {
        $('#request-btn').prop("disabled", true);
        $('#request-btn').html('<i class="fa fa-spinner fa-spin mr-2"></i>{{__('user-portal.loading')}}');
        var formData = {
            "_token": "{{ csrf_token() }}",
            'type': message,
        };
        var type = "POST";
        var ajaxurl = '/user/send-otp';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            success: function (data) {
                // console.log(data);
                var decoded = JSON.parse(data);
                if (decoded.success) {
                    alert('OTP has sent to your phone number: {{ Auth::user()->phone }}');
                    timer(60);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    }

</script>

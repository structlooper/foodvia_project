$('.login_btn').on('click',function(){
    var phoneNumber = $('#phone-field').val();
    var password = $('#password-field').val();
    var csrf = $("input[name='_token']").val();
    var url = $('#login_form').attr('url');
    $.ajax({
        url: url,
        type:'POST',
        data:{ phone : phoneNumber,password:password,'_token':csrf },
        success: function(data) {
            // if($('#latitude_cur').val()){
            //     $('#my_map_form_current').submit();
            // }else{
            //     alert('logged in successfully')
            //     location.reload();
            // }
            $('#login_form').submit()
        },
        error:function(jqXhr,status) {
            if(jqXhr.status === 422) {
                $("#login_form .print-error-msg").html('');
                $("#login_form .print-error-msg").show();
                var errors = jqXhr.responseJSON;
                console.log(errors);
                $.each( errors , function( key, value ) {
                $.toast({
                    heading: 'error',
                    text: key +' -> '+value,
                    icon: 'error',
                    // loader: true,        // Change it to false to disable loader
                    // loaderBg: '#9EC600',  // To change the background
                    position: 'top-right',
                })
                    $("#login_form").find(".error_"+key).html(value);
                });
            }
        }
    });
});


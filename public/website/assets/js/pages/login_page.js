$('.login_btn').on('click',function(){
    let phoneNumber = '+91' + $('#phone-field').val();
    const password = $('#password-field').val();
    const csrf = $("input[name='_token']").val();
    const url = $('#login_form').attr('url');
    $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`)
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
        error:function(jqXhr) {
            if(jqXhr.status === 422) {
                $("#login_form .print-error-msg").html('');
                $("#login_form .print-error-msg").show();
                const errors = jqXhr.responseJSON;
                console.log(errors);
                $.each( errors , function( key, value ) {
                    $('.login_btn').html(`Sign in`)
                $.toast({
                    heading: 'error',
                    text: key +' -> '+value,
                    icon: 'error',
                    position: 'top-right',
                })
                });
            }
        }
    });

});


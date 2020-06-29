$('.register_btn').on('click',function(){
    var csrf = $("input[name='_token']").val();
    let url = $('#register_form').attr('action')
    if($('#check_2').is(':checked')){
        $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`)
        $.ajax({
            url: url,
            type:'POST',
            data:$('#register_form').serialize(),
            success: function(data) {

                $('#register_form').submit();
            },
            error:function(jqXhr,status) {
                if(jqXhr.status === 422) {
                    var errors = jqXhr.responseJSON;
                    $('.register_btn').html('create your account')

                    $.each( errors , function( key, value ) {
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
    }else{
        $.toast({
            heading: 'error',
            text: 'Please Check Term & Condition',
            icon: 'info',
            position: 'top-right',
        })
       console.log('check before procedure')
    }
});
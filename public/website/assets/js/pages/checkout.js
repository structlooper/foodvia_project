
/*
* method to apply promo_code
* @structlooper
* */

$('.apply_promo').click(function () {
    let base_url = $('#urlfinder').attr('url');
    let promo_code = $('#promocode_input').val()
    const csrf = $("input[name='_token']").val();
    // alert(promo_code);
    $.ajax({
        type:'post',
        url: base_url + '/api/apply_promo',
        data: { 'promo_code':promo_code ,'_token':csrf },


        success:function(result){
            console.log(result)
            if (result.status === 1) {
                // console.log(result.message);
                $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position : 'top-right',
                })
                // if (result.data.)
                let type = ''
                let grand_amount = 0
                let amount = $('.final_price').html();
                if (result.data.promocode_type == "percent"){
                    type = '%';
                    grand_amount = (result.data.discount/100) * parseInt(amount)
                }else{
                    type = '₹';
                    grand_amount = parseInt(amount) - parseInt(result.data.discount)
                }
                // cart_data_database();
                $('.promo_code_info_area').html(`
                                    <span class="text-success getPromoId" key_id="${result.data.id}" ><B>${result.data.promo_code}:</B></span>
                                    <span class="text-light-green fw-600">-${result.data.discount} ${type}</span>
                
                `)
                $('#promoce_id_01').val(result.data.id);
                $('.grand_total').removeClass('final_price')
                const amt = Math.round(grand_amount)
                $('.grand_total').html(amt +' ₹')
                $('#promoCodeModal').modal('hide');
            }
            if (result.status === 2){
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })
            }
            if (result.status === 0){
                console.log(result);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }

        },
        error:function(jqXHR)
        {
            console.log(jqXHR)
            $.toast({
                heading: 'error',
                text : "Can't connect with server right now" ,
                icon : 'error',
                position: 'top-right',

            })
        }

    })
})



/*
* FUNCTION TO CHECKOUT WITH DETAILS
* @structlooper
* */
function place_order(){


    let base_url = $('#urlfinder').attr('url');
    let address_id = $('input[name="address_id"]:checked').val();
    let payment_mode = 'cash'
    let promo_code_id = $('#promoce_id_01').val();
    // console.log(promo_code_id)
    const csrf = $("input[name='_token']").val();
    // alert(promo_code);
    $.ajax({
        type:'post',
        url: base_url + '/api/place_order',
        data: { 'address_id':address_id ,'payment_mode':payment_mode,'promo_code_id':promo_code_id,'_token':csrf },


        success:function(result) {
            console.log(result)
            if (result.status === 1) {
                // console.log(result.message);
                $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position: 'top-right',
                })


            }
                else {
                    $.toast({
                        heading: 'warning',
                        text: result.message,
                        icon: 'warning',
                        position: 'top-right',
                    })

                }

        },
        error:function(jqXHR)
        {
            console.log(jqXHR)
            $.toast({
                heading: 'error',
                text : "Can't connect with server right now" ,
                icon : 'error',
                position: 'top-right',

            })
        }

    })
}

/*
* PLACE ORDER ONLINE FUNCTION
* :.@STRUCTLOOPER
* */
$('#place_order_online').click(function(){
        let url = $(this).attr('url')
        let address_id = $('input[name="address_id"]:checked').val();
        const csrf = $("input[name='_token']").val();
        if (address_id === undefined)
        {
            $.toast({
                heading: 'warning',
                text : "Please Select a delivery address" ,
                icon : 'info',
                position: 'top-right',

            })
        }else{

         $(this).html(`    
          <form action="${url}" method="post" style="display: none;" id="myform">
               <input type="hidden" name="address_id" value="${address_id}" >
               <input type="hidden" name="_token" value="${csrf}" >
               <button type="submit" ></button>
                                                                
           </form>
         
         `)
            $('#myform').submit();
        }
})

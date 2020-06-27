
$(document).ready(function(){
    cart_data_database();

})


$('#signOut').click(function(){
    $('#logout-form').submit();
})




/*
   * method to get  cart data if present in database
   * @structlooper
   * */
function cart_data_database(){
    let base_url = $('#urlfinder').attr('url');
    let shop_id = $('#addData').attr('shop_id');
    // alert(shop_id)
    $.ajax({
        type: "Get",
        url: base_url + '/api/get_cart_data',
        processData: false,
        contentType: false,
        success: function(result) {
            if(result.status === 1){

                    $('#addDataCart').html('');
                    $('.addToHeaderCart').html('');

                    let total_price = 0
                    let total_item = 0
                    result.data.forEach(element => {
                        let dish_count = element.quantity
                        let dish_price = element.price
                        if (dish_count > 1) { dish_price = dish_price * dish_count }
                        total_price += dish_price;
                        total_item += 1
                        // console.log(element);
                        $('#addDataCart').append(`<div class="cat-product-box product_struct" key="${element.product_id}" id="currentItem${element.id}">
                          <div class="cat-product" >
                          <div class="cat-name row" style="width:180px;">
                          <div class="col-sm-12">
                          <a href="#">
                          <p>${element.name}</p>
                          <span class="text-light-white fw-700">${element.description}</span>
                          </a>
                          </div>
                          </div>
                          <div class="row text-center border" style="width:55px;">
                          <div style="width:15px; margin-left:2px;">
                          <button type="button" class="text-dark-white" onclick="product_decrement(${element.product_id})"  >
                           <i class="fa fa-minus" aria-hidden="true"></i>
                           </button>
                           </div>
                           <div class="text-center" id="count_menu${element.id}" product_count${element.product_id}="${dish_count}"         style="width:15px;">${element.quantity}
                           </div>
                           <div style="width:15px;">
                           <button type="button" class="text-center"  onclick="product_increment(${element.product_id});">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                           </div>
                           </div>
                           <div class="price" style="width:40px;"> <span id="price_menu${element.product_id}" >${dish_price}</span>${element.currency}
                           </div>
                           </div>
                           </div> `);

                        $('.addToHeaderCart').append(`<div class="cat-product-box">
                                                    <div class="cat-product" shop_id = ${shop_id}>
                                                        <div class="cat-name" style="width: 170px;">
                                                            <a href="#">
                                                                <p class="text-light-green" ><span class="text-light-white">${element.quantity}</span>${element.name}</p> <span class="text-light-white">${element.description}</span>
                                                            </a>
                                                        </div>
    
                                <div class="price"> <a href="#" class="text-dark-white fw-500">
                                    ${element.price} ${element.currency}
                                </a>
                                </div>
                                </div>
                                </div> `)

                    });
                    $('.showItem01').show('slow')
                    $('.blankDiv').hide()

                    $('.user-alert-cart').html(total_item)
                    $('.final_price').html(`${total_price} ₹`)

                }

            // }
            else if (result.status === 2)
            {
                console.log(result.message)
                $.toast({
                    heading: 'info',
                    text : result.message ,
                    icon : 'info',
                    position: 'top-right',

                })
            }

            else if (result.status === 3)
            {
                console.log(result.message)
                $.toast({
                    heading: 'info',
                    text : result.message ,
                    icon : 'info',
                    position: 'top-right',

                })
            }
            else{
                console.log(result.message)


            }

        },
        error: function(error){
            console.log(error)

        }
    })
}

function empty_cart(){
    let base_url = $('#urlfinder').attr('url');
    $.ajax({
        type:'POST',
        url: base_url + '/api/empty_cart',

        success:function(result){
            console.log(result)
            if (result.status === 1) {
                console.log(result.message);
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })
                cart_data_database();
            }

            else if (result.status === 0){
                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })
                cart_data_database();
            }
            else if (result.status === 2){
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })
                cart_data_database();
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
* FUNCTION TO GET IF PROMO CODE SELECTED OR NOT
* @structlooper
* */
// function get_procode_details(amount) {
//     let base_url = $('#urlfinder').attr('url');
//
//     $.ajax({
//         type:'get',
//         url: base_url + '/api/get_promo',
//
//
//         success:function(result){
//             console.log(result)
//             if (result.status === 1) {
//                 // console.log(result.message);
//                 $.toast({
//                     heading: 'success',
//                     text: result.message,
//                     icon: 'success',
//                     position : 'top-right',
//                 })
//                 // if (result.data.)
//                 let type = ''
//                 let grand_amount = 0
//                 // console.log(amount)
//                 if (result.data.promocode_type === "percent"){
//                     type = '%';
//                     grand_amount = (result.data.discount/100) * parseInt(amount)
//                 }else{
//                     type = '₹';
//                     grand_amount = parseInt(amount) - parseInt(result.data.discount)
//                 }
//                 // cart_data_database();
//                 $('.promo_code_info_area').html(`
//                                     <span class="text-success "><B>${result.data.promo_code}:</B></span>
//                                     <span class="text-light-green fw-600">-${result.data.discount} ${type}</span>
//
//                 `)
//                 $('.grand_total').removeClass('final_price')
//                 $('.grand_total').html(grand_amount.toFixed(2) +' ₹')
//                 $('#promoCodeModal').modal('hide');
//             }
//             if (result.status === 2){
//                 $.toast({
//                     heading: 'info',
//                     text: result.message,
//                     icon: 'info',
//                     position : 'top-right',
//                 })
//             }
//             if (result.status === 0){
//                 // console.log(result.message);
//                 $.toast({
//                     heading: 'warning',
//                     text: result.message,
//                     icon: 'warning',
//                     position : 'top-right',
//                 })
//
//             }
//
//         },
//         error:function(jqXHR)
//         {
//             console.log(jqXHR)
//             $.toast({
//                 heading: 'error',
//                 text : "Can't connect with server right now" ,
//                 icon : 'error',
//                 position: 'top-right',
//
//             })
//         }
//
//     })
// }
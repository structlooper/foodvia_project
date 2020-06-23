
$(document).ready(function(){

    cart_data_database();

    /**
     * function to get product category wise on page
     * @ structlooper
     * 
     */
    $('.item_class_str').click(function(event){

        event.preventDefault();
        $('.item_class_str').removeClass('working')
        let key =  $(this).attr('key');
        $(function() {
              
                let base_url = $('#urlfinder').attr('url');
                $.ajax({
                    type: "Get",
                    url: base_url + '/api/product_category/' + key,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                            // console.log(result);

                            if (result.status == 1) {
                                // console.log(result.data[0]);
                                result.data.forEach(element => {
                                    // console.log(element[0]);
                                    let data = element[0];
                                        // console.log(data.name)
                                        $('.currentCards').hide()

                                        let food_type = ''
                                        if (element[0].food_type === 'veg') {
                                            food_type = '<span class="type-tag bg-gradient-green text-custom-white">pure Veg</span>'
                                        }
                                        else{
                                            food_type = ''
                                        }

                                        $('#append_after_this').append(`
                                        <div class="col-lg-4 col-md-6 col-sm-6 currentCards ${key}">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="#">


                                            <img src="${data.url}" class="img-fluid full-width" style="height:100px;" alt="product-img">
                                        </a>
                                        <div class="overlay">
                                            <div class="product-tags padding-10"> <span class="circle-tag">
                                                <img src="${base_url}/public/website/assets/img/svg/013-heart-1.svg" alt="tag">
                                            </span>

                                            <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">
                                               ${data.discount}% off hurry!!
                                            </span>
                                            ${food_type}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="title-box">
                                    <h6 class="product-title" style="width: 50%; "><a href="restaurant.html" class="text-light-black "> ${data.name}</a></h6>
                                        <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">
                                            ${data.price} ${data.currency}
                                        </span>
                                </div>
                                    </div>
                                    <p class="text-light-white">${data.description} ${data.id}</p>
                                    <div class="product-details">
                                        <div class="price-time"> <span class="text-light-black time">45 mins</span>
                                            <span class="text-light-white price"> </span>
                                        </div>

                                    </div>
                                    <div class="product-footer offset-auto">

                                    <button type="button" id="dish${data.id}" onclick="add_to_cart(${data.id})" dataname="${data.name}" currency="${data.currency}" dataprice="${data.price}" dataid="${data.id}" class="btn btn-sm btn-outline-primary "><i class="fas fa-plus"></i> Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                                        `);
                                        $('.'+key).show()
                                        $('#item_'+key).addClass('working')

                                });

                            }

                            else{

                                console.log(result.message);
                                $.toast({
                                    heading: 'Warning',
                                    text: result.message,
                                    icon: 'error',
                                    position : 'top-right',
                                })
                            }
                        },
                        error: function(jqXHR) {
                            console.log(jqXHR.responseText);
                        }
                    })
            });
          });

        })



/*
* function for open modal
* @structlooper
* */
function add_to_cart(id){
    let p_name = $('#dish'+ id).attr('dataname')
    let p_currency = $('#dish'+ id).attr('currency')
    let p_dataprice = $('#dish'+ id).attr('dataprice')
    // $('.finalAddCart').attr('p_id',id)
    $('#product_id').val(id)
    $('.modal-body').html(`
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">1. Item</h5>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i><h6 class="card-subtitle mb-2 text-muted">${p_name}</h6>
            <p class="card-text">${p_dataprice}${p_currency}, ${p_name}.</p>
          </div>
        </div>
        <div class="container mb-4">
                        <label class="form-control-label">Note</label>
                        <textarea class="form-control note" name="note"></textarea>
                    </div>
    
    `)
    $('#addData').html(`<i class="fa fa-shopping-cart" aria-hidden="true"></i> ${p_dataprice}${p_currency} Add Item`)
    $('#exampleModal').modal()
}

/*
* method to add data in cart
* @structlooper
* */
function saveData(shop_id){
    let url = $('#addToCartForm').attr('url');
    // let url = '/login'
    const csrf = $("input[name='_token']").val();
    const id = $("input[name='product_id']").val();
    const note = $('.note').val()
    // console.log(shop_id)
    $.ajax({
        type:'post',
        url: url,
        data: { 'product_id':id ,'note':note ,'shop_id':shop_id,'_token':csrf },

        
        success:function(result){
            // console.log(result)
            if (result.status === 1) {
                // console.log(result.message);
                $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position : 'top-right',
                })
                cart_data_database();
                $('#exampleModal').modal('hide');
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
                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 4){
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })
                cart_data_database();
                $('#exampleModal').modal('hide');
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
* method to increment product item
* @structlooper
* */
function product_increment(product_id)
{
    let base_url = $('#urlfinder').attr('url');
    console.log(product_id);
    $.ajax({
        type:'GET',
        url: base_url + '/api/increment/' + product_id,

        success:function(result){
            console.log(result)
            if (result.status === 1) {
                console.log(result.message);
                cart_data_database();
            }

            if (result.status === 0){
                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 2){
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
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
}

/*
* method to decrement product
* @structlooper
* */
function product_decrement(product_id)
{
    let base_url = $('#urlfinder').attr('url');
    // console.log(product_id);
    $.ajax({
        type:'GET',
        url: base_url + '/api/decrement/' + product_id,

        success:function(result){
            console.log(result)
            if (result.status === 1) {
                console.log(result.message);
                cart_data_database();
            }

            if (result.status === 0){
                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 2){
                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })

            }
            if (result.status === 3){
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


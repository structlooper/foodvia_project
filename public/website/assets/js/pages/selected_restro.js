
$(document).ready(function(){

    cart_data_database();

    /**
     * function to get product category wise on page
     * @ structlooper
     * 
     */
    $('.item_class_str').click(function(){

        $('.item_class_str').removeClass('working')
        $('.item_class_str').removeClass('active')
        let key =  $(this).attr('key');
        let base_url = $('#urlfinder').attr('url');
        $('#append_after_this').html(`<img class="ml-5 currentCards" src="${base_url}/public/loader1.gif" style="width:150px; height:100px; margin: 0;
        position: absolute;
        left: 30%;
        top: 30%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);">`);
        // $(function() {
                $.ajax({
                    type: "Get",
                    url: base_url + '/api/product_category/' + key,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                            // console.log(result);

                            if (result.status == 1) {
                                // console.log(result.data[0]);
                                        $('.currentCards').hide()
                                result.data.forEach(element => {
                                    // console.log(element[0]);
                                    let data = element[0];
                                        // console.log(data.name)

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
                                    <div class="product-img" style="min-width: 180px; min-height: 150px; ">
                                        <a href="#" >


                                            <img src="${data.url}" class="img-fluid full-width" style="height:100px;" alt="product-img" >
                                        </a>
                                        <div class="overlay">
                                            <div class="product-tags padding-10"> <span class="circle-tag">
                                                <img src="${base_url}/public/website/assets/img/svg/013-heart-1.svg" alt="tag" >
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
                                    <h6 class="product-title" style="width: 50%; "><a href="#" class="text-light-black "> ${data.name}</a></h6>
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

                                    <button type="button" id="dish${data.product_id}" onclick="add_to_cart(${data.product_id})" dataname="${data.name}" currency="${data.currency}" dataprice="${data.price}" dataid="${data.id}" class="btn btn-sm btn-outline-primary "><i class="fas fa-plus"></i> Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                                        `);
                                        $('.'+key).show()
                                        $('#item_'+key).addClass('working')
                                        $('#item_'+key).addClass('active')

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
            // });
          });


    $('.mainLink').click(function(){
        location.reload();
    })

})



/*
* function for open add cart product modal
* @structlooper
* */
function add_to_cart(id){
    let base_url = $('#urlfinder').attr('url')
    let logged = $('#userInfo').attr('logged')
    const csrf = $("input[name='_token']").val();
    if (logged == 0) {
        $.toast({
            heading: 'info',
            text: 'Please login first',
            icon: 'info',
            position : 'top-right',
        })
        $('.modal-body').html(`
<!--        this is modal ${csrf}-->
            <form action="" id="loginViaModal">
                <input type="hidden" name="_token" value="${csrf}">
              <div class="form-group">
                <label for="modalInputphone">Phone</label>
                <input type="number" class="form-control" id="modalInputphone" aria-describedby="phoneHelp" name="phoneNumber" placeholder="Enter phone number">
                <small id="phoneHelp" class="form-text text-muted">We'll never share your phone with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="modalInputPassword1">Password</label>
                <input type="password" class="form-control" id="modalInputPassword1" name="password" placeholder="Password">
              </div>
              
              <button type="button" onclick="loginByModal();" class="btn btn-danger btn-block">Login</button>
              <p class="text-center">Don't have account <a href="${base_url}/web/register">create</a></p>
            </form>
    
    `).unbind();
        $('#addData').css('display','none');
        $('#exampleModalLabel').html('Please Login first');
        $('#exampleModal').modal();

    }else{
        let p_name = $('#dish' + id).attr('dataname')
        let p_currency = $('#dish' + id).attr('currency')
        let p_dataprice = $('#dish' + id).attr('dataprice')
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
    $('#addData').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`)
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
                $('#addData').html('<button type="button" onclick="saveData(${shop_id})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>')

                $.toast({
                    heading: 'info',
                    text: result.message,
                    icon: 'info',
                    position : 'top-right',
                })
            }
            if (result.status === 0){
                $('#addData').html('<button type="button" onclick="saveData(${shop_id})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>')

                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 3){
                $('#addData').html('<button type="button" onclick="saveData(${shop_id})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>')

                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    hideAfter: false,
                    position : 'top-right',
                })

            }
            if (result.status === 4){
                $('#addData').html('<button type="button" onclick="saveData(${shop_id})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>')

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
            $('#addData').html('<button type="button" onclick="saveData(${shop_id})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>')
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
    $('#plusIncrement'+product_id).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`)
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
                $('#plusIncrement'+product_id).html('<i class="fa fa-plus" aria-hidden="true"></i>')

                console.log(result.message);
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 2){
                $('#plusIncrement'+product_id).html('<i class="fa fa-plus" aria-hidden="true"></i>')

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
            $('#plusIncrement'+product_id).html('<i class="fa fa-plus" aria-hidden="true"></i>')

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
    $('#minusIncrement'+product_id).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`)
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
                $('#minusIncrement'+product_id).html('<i class="fa fa-minus" aria-hidden="true"></i>')
                cart_data_database();
                $.toast({
                    heading: 'warning',
                    text: result.message,
                    icon: 'warning',
                    position : 'top-right',
                })

            }
            if (result.status === 2){
                $('#minusIncrement'+product_id).html('<i class="fa fa-minus" aria-hidden="true"></i>')
                cart_data_database();
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
            $('#minusIncrement'+product_id).html('<i class="fa fa-minus" aria-hidden="true"></i>')

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
* METHOD TO LOGIN USER VIA MODAL
* :.@STRUCTLOOPER
* */
function loginByModal(){
    const csrf = $("input[name='_token']").val();
    let phoneNumber = '+91' + $('#modalInputphone').val()
    let password = $('#modalInputPassword1').val()
    let base_url = $('#urlfinder').attr('url');
    $.ajax({
        type:'POST',
        url: base_url + '/api/customLogin',
        data: { phoneNumber:phoneNumber,password:password,'_token':csrf },


        success:function(result){
            console.log(result)
            if (result.status === 1) {
                console.log(result.message);
                $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position : 'top-right',
                })
                cart_data_database();
                location.reload();
            }

            else{
                console.log(result.message);
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
}

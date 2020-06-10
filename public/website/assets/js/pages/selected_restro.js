$(document).ready(function(){
    
    $('.addToCart').click(function(){
        // alert('at')
        $('.blankDiv').hide('fast')
        $('.checkoutButton').show('fast')
        $('#cradboxShow').show('fast')
        let name = $(this).attr('dataname')
        let id = $(this).attr('dataid')
        var price = $(this).attr('dataprice')
        let currency = $(this).attr('currency')
        $(this).addClass('disabled');


        let product_count = 1 
        $('#addDataCart').prepend('<div class="cat-product-box" id="currentItem'+id+'">      <div class="cat-product " >          <div class="cat-name row" style="width:180px;">              <div class="col-sm-12" ">              <a href="#">                  <p > '+name+'</p> <span class="text-light-white fw-700">'+name+'</span>              </a>              </div>          </div>          <div class="row text-center border" style="width:55px;">              <div   style="width:15px; margin-left:2px;">              <button type="button" class="text-dark-white" id="subtract_one_product'+id+'" > <i class="fa fa-minus " aria-hidden="true"></i>              </button>          </div>          <div class="text-center" id="count_menu'+id+'" style="width:15px;">              '+product_count+'                       </div>          <div style="width:15px;">              <button type="button" class="text-center " id="pluse_one_product'+id+'"> <i class="fa fa-plus" aria-hidden="true"></i>              </button>          </div>          </div>          <div class="price" style="width:40px;"> <span id="price_menu'+id+'" >  '+price+' </span>'+currency+'                                                      </div>      </div>  </div>')

        // finding current product id in cart box
        // $('.item').click(function(){
        //     let key = $(this).attr('key')
        //     // alert(key)
        // })
        $('#pluse_one_product'+id).click(function(){
            product_count += 1;
            current_price = $('#price_menu'+id).html()
            let new_price = parseInt(price) +  parseInt(current_price) ;
            // alert(price)
            $('#count_menu'+id).empty()
            $('#count_menu'+id).append(product_count);
            $('#price_menu'+id).empty()
            $('#price_menu'+id).append(new_price);
        })
        $('#subtract_one_product'+id).click(function(){
            product_count -= 1;
            current_price = $('#price_menu'+id).html()
            let new_price = parseInt(current_price) - parseInt(price);
            // alert(new_price)
            if (product_count > 0) {
                
                $('#count_menu'+id).empty()
                $('#count_menu'+id).append(product_count);
            } else {
                $('#currentItem'+id).empty()
                $('.addToCart').removeClass('disabled')
            }
            $('#price_menu'+id).empty()
            $('#price_menu'+id).append(new_price);

        })

    })


})
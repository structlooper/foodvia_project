$(document).ready(function(){
  
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
                            // console.log(result.status);
                            if (result.status == 1) {
                                // console.log(result.data[0]);
                                result.data.forEach(element => {
                                    // console.log(element);
                                    element.forEach(data => {
                                        // console.log(data.name)
                                        $('.currentCards').hide()
                                        
                                        let food_type = ''
                                        if (data.food_type === 'veg') {
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
                                                                                                                                
                                            
                                            <img src="${base_url}/public/website/assets/img/restaurants/255x150/shop-7.jpg" class="img-fluid full-width" style="height:100px;" alt="product-img">
                                        </a>
                                        <div class="overlay">
                                            <div class="product-tags padding-10"> <span class="circle-tag">
                                                <img src="${base_url}/public/website/assets/img/svg/013-heart-1.svg" alt="tag">
                                            </span>
                                                                                                                                        
                                            <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">
                                                hurry!!
                                            </span>
                                            ${food_type}
                                                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="title-box">
                                    <h6 class="product-title" style="width: 50%; text-overflow: hidden;"><a href="restaurant.html" class="text-light-black "> ${data.name}</a></h6>
                                        <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">
                                            20 ₹
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
                                        
                                    <button type="button" id="dish${data.id}" onclick="add_to_cart(${data.id})" dataname="${data.name}" currency="₹" dataprice="20" dataid="${data.id}" class="btn btn-sm btn-outline-primary "><i class="fas fa-plus"></i> Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
                                        
                                        
                                        `);
                                        $('.'+key).show()
                                        $('#item_'+key).addClass('working')

                                    });
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
/**
 * function performed in cart 
 * addition subtraction item etc
 * @structlooper
 */
function add_to_cart(p_id){
        
            // alert(p_id)
            $('.blankDiv').hide('fast')
            $('.checkoutButton').show('fast')
            $('#cradboxShow').show('fast')
            let name = $('#dish'+p_id).attr('dataname')
            let id = $('#dish'+p_id).attr('dataid')
            var price = $('#dish'+p_id).attr('dataprice')
            let currency = $('#dish'+p_id).attr('currency')
            let product_count = 1 
            let id_arrray = []
            let url = 'api/add_to_cart'
            let data = [
                // product_name = name,
                product_id = id,
                count = product_count,
            ]
            ajaxInsertDataDom(data);


  
              $('.product_struct').each(function(){
                  
                  var $this = $(this)
                  id_arrray.push( $this.attr('key'));
                  
              })
              
              let granter = 0;
              id_arrray.forEach(product_id => {
                  
                  if (product_id == parseInt(id)) {
                      let p_count = $('#count_menu'+id).html()
                      $.toast({
                          heading: 'Information',
                          position:'top-right',
                          text: `${name} is already added count increased by ${ parseInt(p_count) + 1 }`,
                          icon: 'info',
                          loader: false,        // Change it to false to disable loader
                          loaderBg: '#9EC600'  // To change the background
                        })
                      if (product_count == undefined ) {
                          $('#addDataCart').prepend(`<div class="cat-product-box product_struct" key="${id}        "id="currentItem${id}">
                          <div class="cat-product" >
                                  <div class="cat-name row" style="width:180px;">
                                  <div class="col-sm-12">
                                  <a href="#">
                                  <p>${name}</p>
                                  <span class="text-light-white fw-700">${name}</span>
                                  </a>
                                  </div>
                                  </div>
                                  <div class="row text-center border" style="width:55px;">
                                  <div style="width:15px; margin-left:2px;">
                                  <button type="button" class="text-dark-white" id="subtract_one_product${id}" >
                                  <i class="fa fa-minus" aria-hidden="true"></i>
                                  </button>
                                  </div>
                                  <div class="text-center" id="count_menu${id}"  style="width:15px;">${product_count}
                                  </div>
                                  <div style="width:15px;">
                                  <button type="button" class="text-center" id="pluse_one_product${id}">
                                  <i class="fa fa-plus" aria-hidden="true"></i>
                                  </button> 
                                  </div> 
                                  </div> 
                                  <div class="price" style="width:40px;"> <span id="price_menu${id}" >${price}</span>${currency}
                                  </div>
                                  </div>
                                  </div> `)
                                  
                              }
                              else{
                                  p_count = parseInt(p_count)
                                  p_count += 1;
                                  current_price = $('#price_menu'+id).html()
                                  let new_price = parseInt(price) +  parseInt(current_price) ;
                                  // alert(price)
                                  $('#count_menu'+id).empty()
                                  $('#count_menu'+id).append(p_count);
                                  $('#price_menu'+id).empty()
                                  $('#price_menu'+id).append(new_price);
                              }
                              granter += 1;
                      
                  }
              
                  
              });
              if (granter == 0) {
                  $('#addDataCart').prepend(`<div class="cat-product-box product_struct" key="${id}"id="currentItem${id}">
                      <div class="cat-product" >
                      <div class="cat-name row" style="width:180px;">
                      <div class="col-sm-12">
                      <a href="#">
                      <p>${name}</p>
                      <span class="text-light-white fw-700">${name}</span>
                      </a>
                      </div>
                      </div>
                      <div class="row text-center border" style="width:55px;">
                      <div style="width:15px; margin-left:2px;">
                      <button type="button" class="text-dark-white" id="subtract_one_product${id}" >
                       <i class="fa fa-minus" aria-hidden="true"></i>
                       </button>
                       </div>
                       <div class="text-center" id="count_menu${id}" product_count${id}="${product_count}"         style="width:15px;">${product_count}
                       </div>
                       <div style="width:15px;">
                       <button type="button" class="text-center" id="pluse_one_product${id}">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                      </button> 
                       </div> 
                       </div> 
                       <div class="price" style="width:40px;"> <span id="price_menu${id}" >${price}</span>${currency}
                       </div>
                       </div>
                       </div> `)

                $('#addToHeaderCart').prepend(`
                <div class="cat-product-box">
                <div class="cat-product">
                    <div class="cat-name">
                        <a href="#">
                            <p class="text-light-green"><span class="text-dark-white">1</span> ${name}</p> <span class="text-light-white">${name}</span>
                        </a>
                    </div>
                    <div class="delete-btn">
                        <a href="#" class="text-dark-white"> <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                    <div class="price"> 
                        <a href="#" class="text-dark-white fw-500">
                            ${price} ${currency}
                        </a>
                    </div>
                </div>
                </div>
                
                `)
                      
                              
                   
              }
              
              console.log(id_arrray)
          // }      
  
 

          $('#pluse_one_product'+id).unbind().click(function(){
              let p_count = $('#count_menu'+id).html()
              p_count = parseInt(p_count)
              p_count += 1;
              current_price = $('#price_menu'+id).html()
              let new_price = parseInt(price) +  parseInt(current_price) ;
              // alert(price)
              $('#count_menu'+id).empty()
              $('#count_menu'+id).append(p_count);
              $('#price_menu'+id).empty()
              $('#price_menu'+id).append(new_price);
          })
          $('#subtract_one_product'+id).unbind().click(function() {
              let p_count = $('#count_menu'+id).html()
              p_count = parseInt(p_count)
              p_count -= 1;
              current_price = $('#price_menu'+id).html()
              let new_price = parseInt(current_price) - parseInt(price);
              // alert(new_price)
              if (p_count > 0) {
                  
                  $('#count_menu'+id).empty()
                  $('#count_menu'+id).append(p_count);
              } else {
                  let del_id = $('#currentItem'+id).removeAttr('key');
                  

                  id_arrray.pop(del_id);
                  console.log(id_arrray)
                  $('#currentItem'+id).remove()
              }
              $('#price_menu'+id).empty()
              $('#price_menu'+id).append(new_price);
      
          })
}


/** function for the Dom for ajax
* for post data's
* @structlooper
*
*/
function ajaxInsertDataDom(data){
    let base_url = $('#urlfinder').attr('url');
    $.ajax({
        type:'POST',
        url: base_url + '/api/',
        data: data,
        processData: false,
        contentType: false,
        success:function(result){
            if (result.status === 1) {
                console.log(result.message);
                $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position : 'top-right',
                })
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


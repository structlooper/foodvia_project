// $(function() {
//     $('.categoryWise').click(function(event) {
//         event.preventDefault();
      
//         let base_url = $('#thisIdforUrl').attr('url');
//         // let home = $(this).attr('home');
//         let category_id = $('.categoryVal').val()
//         // console.log(category_id)
//         $.ajax({
//             type: "Get",
//             url: base_url + '/product_category/' + category_id,
//             processData: false,
//             contentType: false,
//             success: function(result) {
//                     // alert('logged in')
//                     // console.log(result.status);
//                     if (result.status == 1) {
//                         console.log(result.data[0]);
//                         result.data.forEach(element => {
//                             console.log(element);
//                             element.forEach(data => {
//                                 // console.log(data.name)
//                                 $('#append_after_this').prepend(' <div class="col-lg-4 col-md-6 col-sm-6 currentCards '+ data.shop_id +'" >      <div class="product-box mb-xl-20">          <div class="product-img">              <a href="#">                  <img                  src="public/website/assets/img/restaurants/255x150/shop-7.jpg"                  class="img-fluid full-width" alt="product-img">              </a>              <div class="overlay">                  <div class="product-tags padding-10"> <span class="circle-tag">                      <img src="public/website/assets/img/svg/013-heart-1.svg" alt="tag">                  </span>                  <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">                      Discount Discount_type                  </span>              </div>          </div>      </div>  </div>  <div class="product-caption">      <div class="title-box">          <h6 class="product-title"><a href="restaurant.html" class="text-light-black "> '+ data.name +'</a></h6>          <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">              3.1          </span>      </div>          </div>          <p class="text-light-white">'+data.description+'</p>          <div class="product-details">              <div class="price-time"> <span class="text-light-black time">'+data.food_type+'</span>                  <span class="text-light-white price">Curency price min</span>              </div>              <div class="rating"> <span>                  <i class="fas fa-star text-yellow"></i>                  <i class="fas fa-star text-yellow"></i>                  <i class="fas fa-star text-yellow"></i>          <i class="fas fa-star text-yellow"></i>                      <i class="fas fa-star text-yellow"></i>                  </span>                  <span class="text-light-white text-right">4225 ratings</span>              </div>          </div>          <div class="product-footer"> <span class="text-custom-white square-tag">              <img src="public/website/assets/img/svg/004-leaf.svg" alt="tag">          </span>          <span class="text-custom-white square-tag">              <img src="public/website/assets/img/svg/006-chili.svg" alt="tag">          </span>          <span class="text-custom-white square-tag">              <img src="public/website/assets/img/svg/005-chef.svg" alt="tag">          </span>          <span class="text-custom-white square-tag">              <img src="public/website/assets/img/svg/008-protein.svg" alt="tag">          </span>          <span class="text-custom-white square-tag">              <img src="public/website/assets/img/svg/009-lemon.svg" alt="tag">          </span>              </div>          </div>      </div>  </div>');
//                                 $('.currentCards').hide()
//                                 $('.'+data.shop_id).show()
//                             });
//                         });






//                         // $.toast({
//                         //     heading: 'success',
//                         //     text: result.message,
//                         //     icon: 'success',
//                         //     position : 'top-right',
//                         // })
//                         // window.location.href = home + '/safe_wash/verify_phone';
//                     }
//                     // if (result.error) {
//                     //     console.log(result.error)
//                     // } 
//                     else{
                        
//                         console.log(result.message);
//                         // $.toast({
//                         //     heading: 'Warning',
//                         //     text: result.message,
//                         //     icon: 'error',
//                         //     position : 'top-right',
//                         // })
//                     }
//                 },
//                 error: function(jqXHR) {
//                     console.log(jqXHR.responseText);
//                 }
//             })
//     });
//   });

// // jQuery(function() {
    
// //     let base_url = $('thisIdforUrl').attr('url')
// //     // let base_url = '{{url("api")}}';
// //     $.get({
// //         url :base_url + 'categories',
// //         success: function(data){
// //             console.log(data)
// //         },
// //         error: function(jqXHR) {
// //         console.log(jqXHR.responseText);
// //         }
        
// //     })

// //     }
// // // $(document).ready()



  $(function () {

    // Filter
  
    function filter(data) {
  
      $.ajax({
        type: "POST",
        url: '/interface/search-filter',
        data: {
          data: data,
        },
        cache: false,
        success: function (data) {
          let html = '';
       
          data.map(element => {
            const imageUrl = element.images[0].path;
            const productDetails = element.product_details ? JSON.parse(element.product_details) : {};
        
            html += `
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="rounded position-relative fruite-item border border-secondary rounded-bottom">
                        <div class="fruite-img">
                            <a href="/interface/shop-details/${element.id}" target="_blank">
                                <img src="${imageUrl}" class="img-fluid w-100 rounded-top" alt="">
                            </a>
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                            ${element.category.name}
                        </div>
                        <div class="p-4">
                            <h4>${productDetails.title || ''}</h4>
                            <p>Кешбек: ${productDetails.cashback || 0}%</p>
                            <p>Согласовать выкуп с: 
                                <a href="https://t.me/${productDetails.owner || ''}" target="_blank">
                                    ${productDetails.owner || ''}
                                </a>
                            </p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">
                                    ${productDetails.price_in_store || 0} руб.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
          });
  
          if(data.length == 0){
            html = `<h3 class="text-center">Ничего не найдено</h3>`
          }
       
          $('#product-start').html(html);
         
        }
      });
    }
  
    //add button submit
    $('#title-search-submit').on('click', function(){
      let textInput = $('#title-search').val();
      $('#select-submit').val('');
      $('#procent-submit').val(0);
      $('#procent').text(0);
      $('.category-button').removeClass('active');
      filter({'title': textInput})
    });
    
    $('.category-button').on('click', function(){
      let category = $(this).val();
      $('#select-submit').val('');
      $('#title-search').val('');
      $('#procent-submit').val(0);
      $('#procent').text(0);
      $('.category-button').removeClass('active');
      $(this).addClass('active');
      filter({'category': category})
    });
  
    $('#select-submit').on('change', function(){
      let sorting = $(this).val();
      $('#title-search').val('');
      $('#procent-submit').val(0);
      $('#procent').text(0);
      $('.category-button').removeClass('active');
      filter({'sorting': sorting})
    });
  
    $('#procent-submit').on('change', function(){
      let procent = $(this).val();
      $('#select-submit').val('');
      $('#title-search').val('');
      $('.category-button').removeClass('active');
      filter({'procent': procent})
    });
  
    // function removeFilter(indelible) {
    //   let filters = {
    //     'title': $('#title-search').val(''),
    //     'category': $('.category-button').removeClass('active'),
    //     'sorting': $('#select-submit').val(''),
    //     'procent': $('#procent-submit').val(''),
    //     'procent-value': $('#procent').text(0)
    //   }
  
    //   Object.keys(filters).map(element => {
    //     filters.element
    //   })
    //   // $('#select-submit').val('');
    //   // $('#title-search').val('');
    //   // $('#procent-submit').val(0);
    //   // $('#procent').text(0);
    //   // $('.category-button').removeClass('active');
    // }
  
    
  //   $('#title-search-submit').on('click', function() {
        
  //     // const dataToSend = { key: 'value' }; // Данные, которые вы хотите отправить
  
  //     // $.ajax({
  //     //     url: 'your-server-endpoint', // Замените на нужный URL
  //     //     type: 'POST',
  //     //     contentType: 'application/json',
  //     //     data: JSON.stringify(dataToSend),
  //     //     success: function(response) {
  //     //         console.log('Success:', response);
  //     //     },
  //     //     error: function(error) {
  //     //         console.error('Error:', error);
  //     //     }
  //     // });
  // });
    
  });
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
            const fileUrl = element.videos.length ? element.videos[0].path : element.images[0].path;
            const productDetails = element.product_details ? JSON.parse(element.product_details) : {};
        
            html += `
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="rounded position-relative fruite-item border rounded-bottom">
                        <div class="fruite-img">
                            <a href="/interface/shop-details/${element.id}" target="_blank">
                                ${element.videos.length
                                    ? `<video style="height: 400px" controls>
                                        <source src="${fileUrl}" type="video/mp4">
                                        Your browser does not support the video tag.
                                      </video>`
                                    : `<img style="height: 400px" src="${fileUrl}" class="img-fluid w-100 rounded-top" alt="">`
                                }
                            </a>
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                            ${element.category.name}
                        </div>
                        <div style="overflow: auto; height: 200px;">
                          <div class="p-4">
                            <h4>${productDetails.title || ''}</h4>
                            <p>Кешбек: ${productDetails.cashback || 0}%</p>
                            <p>Согласовать выкуп с: 
                              <a style="color: #ac51b5;" href="https://t.me/${productDetails.owner || ''}" target="_blank">
                                  ${productDetails.owner || ''}
                              </a>
                            </p>
                          </div>
                        </div>
                        <div class="d-flex  flex-lg-wrap p-4">
                          <p style="text-decoration: line-through;">
                              ${productDetails.price_in_store || 0}₽
                          </p>
                          &nbsp;&nbsp;
                          <p class="text-danger fs-5 fw-bold mb-0">
                              ${productDetails.price_in_store  - Math.round((productDetails.price_in_store * productDetails.cashback  ) / 100)}₽
                          </p>
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
      if($(this).text() == "18+"){
        if(sessionStorage.getItem('year') === null){
          $("#myModal").modal('show');
          return;
        }
      }
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

    //modal

    $("#myBtn").on('click', function(){
      $("#myModal").modal('show');
    });

    $('#year-btn-yes').on('click', function(){
      sessionStorage.setItem('year', true);

      $('#select-submit').val('');
      $('#title-search').val('');
      $('#procent-submit').val(0);
      $('#procent').text(0);
      $('.category-button').removeClass('active');
      $(this).addClass('active');
      filter({'category': $(this).val()})
      $("#myModal").modal('hide');

    });

    $('#year-btn-no').on('click', function(){
      sessionStorage.setItem('year', false);
      // $(this).prop('disabled', true);
      $('.categorie-list li').each(function() {
        if ($(this).find('button').text() === '18+') {
          $(this).find('button').prop('disabled', true);
        }
      });
   
      $("#myModal").modal('hide');

    });


    //check 18+ confirm

    if(sessionStorage.getItem('year') !== null && sessionStorage.getItem('year') == 'false'){
      $('.categorie-list li').each(function() {
        if ($(this).find('button').text() === '18+') {
          $(this).find('button').prop('disabled', true);
        }
      });
    }
   

  
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
 
  });
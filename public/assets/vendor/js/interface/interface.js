// const { data } = require("jquery");

  $(function () {

    //get begin product
    // let adult = sessionStorage.getItem('year');
    var globalAdult = null;
    let adult = $('#adult-agree').val();
    var page = 1;
    var isLoading = false;
    var html = '';
    var thisPage = 1;
    var lastPage = 1;
    var filteredInfo = null;

    function loadMoreData(page) {
      $('#spinner').addClass('show');
      isLoading = true;
  
      $.ajax({
        type: "POST",
        url: `/interface/get-products?page=${page}`,
        cache: false,
        data: {
          adult: $('#adult-agree').val(),
          data: filteredInfo,
        },
        success: function (data) {
          $('#spinner').removeClass('show');
          lastPage = data.data.last_page;
          thisPage = data.data.current_page;
          addProducts(data.data);
          isLoading = false;
        },
        error: function (xhr) {
          $('#spinner').removeClass('show');
          isLoading = false;
        }
      });
    }

    $(window).scroll(function () {
      if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !isLoading) {
        console.log(thisPage, lastPage);
        if(thisPage !== lastPage) {
          page++;
          loadMoreData(page);
        }
      }
    });
    loadMoreData(page);

    //add spiner
    // $('#spinner').addClass('show')
    // $.ajax({
    //   type: "POST",
    //   url: `/interface/get-products?page=${page}`,
    //   cache: false,
    //   data: {
    //     adult: adult,
    //   },
    //   success: function (data) {
    //     $('#spinner').removeClass('show')
    //     addProducts(data.data)
    //   },
    //   error: function(xhr) {
    //     $('#spinner').removeClass('show')
    //   }
    // });

    // function loadMoreData(page) {
    //   $('#spinner').addClass('show')
    //   $.ajax({
    //     type: "POST",
    //     url: `/interface/get-products?page=${page}`,
    //     cache: false,
    //     data: {
    //       adult: adult,
    //     },
    //     success: function (data) {
    //       $('#spinner').removeClass('show')
    //       addProducts(data.data)
    //     },
    //     error: function(xhr) {
    //       $('#spinner').removeClass('show')
    //     }
    //   });
    // }

    // Filter

    function filter(data) {
      // $('#spinner').addClass('show')
      filteredInfo = data;
      html = '';
      page = 1;
      loadMoreData(page)

      // $.ajax({
      //   type: "POST",
      //   url: '/interface/search-filter',
      //   data: {
      //     adult: globalAdult,
      //     data: data,
      //   },
      //   cache: false,
      //   success: function (data) { 
      //     $('#spinner').removeClass('show')
      //     addProducts(data.data)        
      //   }
      // });
    }
  
    $('#title-search-submit').on('click', function() {
      executeSearch();
    });
  
  $('#title-search').on('keydown', function(e) {
      if (e.key === 'Enter') {
          e.preventDefault(); 
          executeSearch();
      }
  });
  
  function executeSearch() {
      let textInput = $('#title-search').val();
      $('#select-submit').val('');
      $('#procent-submit').val(0);
      $('#procent').text(0);
      $('.category-button').removeClass('active');
      filter({'title': textInput});
  }

  $('#h1-click').on('click', function(){
    cashBack100()
  })

  $('#cahsback100').on('click', function(){
    cashBack100()
  });

  function cashBack100(){
    $('#title-search').val('');
    $('#select-submit').val('');
    $('#procent-submit').val(0);
    $('#procent').text(0);
    $('.category-button').removeClass('active');
    filter({'cahsback100': true})
  }

  
  $('.category-button').on('click', function(){
    let category = $(this).val();
    if($(this).text() == "18+"){
      // let adult = $('#adult-agree').val() || null
      if(globalAdult === null){
        $('#last-adult').val(category)
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
    // sessionStorage.setItem('year', true);
    // addInput();
    globalAdult = 'true';
    $('#select-submit').val('');
    $('#title-search').val('');
    $('#procent-submit').val(0);
    $('#procent').text(0);
    $('.category-button').removeClass('active');
    $(this).addClass('active');
    let categoyId = $('#last-adult').val();
    filter({'category': categoyId})
    $("#myModal").modal('hide');

  });

  // function addInput(){
  //   let hiddenInput = $('<input>').attr({
  //     type: 'hidden',
  //     name: 'adult-agree',
  //     value: 'true'
  // });

  // $('#myModal').append(hiddenInput);
  // }


  $('#year-btn-no').on('click', function(){
    // sessionStorage.setItem('year', false);
    // $('#adult-agree').val('false')
    globalAdult = 'false';
    // $(this).prop('disabled', true);
    $('.categorie-list li').each(function() {
      if ($(this).find('button').text() === '18+') {
        $(this).find('button').prop('disabled', true);
      }
    });
  
    $("#myModal").modal('hide');

  });

  //modal show 18+

  $(document).on('click', '.modal-trigger', function(event) {
    event.preventDefault();

    $('#last-clicked-value').val($(this).attr('data-type'))
    $('#myModalFilter').modal('show');
  });


  $('#year-filter-btn-yes').on('click', function(){
    let id = $('#last-clicked-value').val();
    let href = `/interface/shop-details/${id}`;
    $('#title-search').val('')
    // sessionStorage.setItem('year', true);
    // $('#adult-agree').val('true')
    globalAdult = 'true';
    window.location.href = href;
    // $("#myModalFilter").modal('hide');
  });


  $('#year-filter-btn-no').on('click', function(){
    $("#myModalFilter").modal('hide');
  });

  //check 18+ confirm

  if($('#adult-agree').val() !== null && $('#adult-agree').val() == 'false'){
    $('.categorie-list li').each(function() {
      if ($(this).find('button').text() === '18+') {
        $(this).find('button').prop('disabled', true);
      }
    });
  }


  function addProducts(data)
  {
    // let html = '';
    let currentDate = new Date();
    currentDate.setDate(currentDate.getDate() + 10);

    data.data.map(element => {
      const fileUrl = element.videos.length ? element.videos[0].path : element.images[0].path;
      const productDetails = element.product_details ? JSON.parse(element.product_details) : {};
      // let adult = sessionStorage.getItem('year');
      // let adult = $('#adult-agree').val();
      let categoryName = element.category.name;

      let adultResult = globalAdult !== 'true' && categoryName === '18+';
  
      let topImg = false;
      if(element.top_at){
        let elementDate = new Date(element.top_at);

        if (currentDate.getTime() > elementDate.getTime()) {
          topImg = true;
          } 
      }

      html += `
          <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="rounded position-relative fruite-item border rounded-bottom">
                  <div data-type="${element.id}" class="${adultResult ? 'modal-trigger fruite-img ' : 'fruite-img'}" >
                      <a href="${adultResult? '#' :`/interface/shop-details/${element.id}`}" 
                        style="position: relative" >
                          ${element.videos.length
                              ? `<video style="height: 400px; width: -webkit-fill-available;" controls>
                                  <source src="${fileUrl}" type="video/mp4">
                                  Your browser does not support the video tag.
                                </video>`
                              : `<img src="${fileUrl}" class="${adultResult?'top-photo-adult ':''}img-fluid w-100 rounded-top product-img" alt="">`
                          }
                      </a>
                      ${topImg ? `<img src="../../../../assets/img/interface/top.png" class="top-photo" width="70" alt="Топ"/>` : ''}
                  </div>
                  <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                      ${categoryName}
                  </div>
                  <div class="${adultResult?'text-blur ':''}">
                    <div style="overflow: auto; height: 200px;">
                      <div class="p-4">
                        <h4>${productDetails.title || ''}</h4>
                        <p>Кешбек: ${productDetails.cashback || 0}%</p>
                        <p>Согласовать выкуп с: 
                          <a style="color: #ac51b5;" href="https://t.me/${productDetails.owner || ''}" >
                              ${productDetails.owner || ''}
                          </a>
                        </p>
                      </div>
                    </div>
                    <div class="d-flex flex-lg-wrap p-4">
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
          </div>
      `;
    });

    if(data.length == 0){
      html = `<h3 class="text-center">Ничего не найдено</h3>`
    }
  
    $('#product-start').html(html);
  }

});
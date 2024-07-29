$(function () {
    var categories = [];

    function loadCategories() {
        return $.ajax({
            type: "GET",
            url: '/interface/get-all-categories',
            cache: false
        }).done(function(data) {
            categories = data.data;
        }).fail(function(error) {
            console.error('Ошибка загрузки категорий:', error);
        });
    }

    $('#add-product').on('click', function() {
        loadCategories().then(function() {
            $('#add-product-modal').modal('show');
        });
    });

    $('#add-yourself').on('change', function() {
        if ($(this).is(':checked')) {
            $('#add-from-suppot').prop('checked', false);
            let options = '<option value="">Выберите категорию</option>';
            categories.forEach(category => {
                options += `<option value="${category.id}">${category.name}</option>`;
            });

            let html = `<form id="formAccountSettings" method="POST" action="/interface/add-product" class='mt-4' onsubmit="return true" enctype="multipart/form-data">
                <input type="hidden" name="type" value="add-yourself">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Название товара<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="title" autofocus  />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Цена на площадке (руб.)<span style="color:red">*</span></label>
                        <input class="form-control" type="number" name="price_in_store"  />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Кешбек(%)<span style="color:red">*</span></label>
                        <input class="form-control" type="number" name="cashback" autofocus  />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Телеграм(@)<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="owner"  />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="language" class="form-label">Категория<span style="color:red">*</span></label>
                        <select id="language" class="select2 form-select" name="category_id" >
                            ${options}
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Электронная почта<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="owner_email"  />
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Фотографии<span style="color:red">*</span></label>
                    <input class="form-control" type="file" name="photos[]" id="formFileMultiple" accept="image/*" multiple >
                </div>
                <div class="mt-2">
                    <button type="submit" id="submitForm" class="btn btn-outline-secondary me-2">Отправить</button>
                    <button type="reset" class="btn btn-outline-secondary" id="cancelButton">Отмена</button>
                </div>
            </form>`;
            $('#add-content').html(html);
        }
    });

    $('#add-from-suppot').on('change', function() {
        if ($(this).is(':checked')) {
            $('#add-yourself').prop('checked', false);
            let html = `<form id="formAccountSettings" method="POST" action="/interface/add-product" class='mt-4' onsubmit="return true" enctype="multipart/form-data">
                <input type="hidden" name="type" value="add-from-suppot">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Ссылка на товар<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="link" autofocus  />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Кешбек(%)<span style="color:red">*</span></label>
                        <input class="form-control" type="number" name="cashback" autofocus  />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Телеграм(@)<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="owner"  />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Электронная почта<span style="color:red">*</span></label>
                        <input class="form-control" type="text" name="owner_email"  />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" id="submitForm" class="btn btn-outline-secondary me-2">Отправить</button>
                    <button type="reset" class="btn btn-outline-secondary" id="cancelButton">Отмена</button>
                </div>
            </form>`;
            $('#add-content').html(html);
        }
    });

    $(document).on('submit', '#formAccountSettings', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        if (formData.get('type') === 'add-yourself' && !formData.has('photos')) {
            formData.append('photos', []);
        }
        $('#spinner').addClass('show')
        $('#submitForm').prop('disabled', true).text('Отправляется...');
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#spinner').removeClass('show')
                if(response.success) {
                    let successMessage = `
                     <div class="modal-answer-content">
                        <div>
                            <h4 class="modal-title">Товар успешно добавлен</h4>
                        </div>
                        <div class="modal-body">
                            <p>Для подтверждения добавления, пожалуйста, совершите платеж, а затем отправьте ID и скриншот платежа на указанный email: info@webex.am</p>
                            <h3>ID: <span style="color: #8A2BE2;">1235468796</span></h3>
                            <div class="payment-info">
                                <p>Способ оплаты</p>
                                <p>Сбербанк по номеру телефона: <span>${response.payment_id}</span></p>
                                <p>Перевод на территории Армении(карта): <span>4355033921535674</span></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="refreshButton" type="button" class="btn btn-orange">Понятно</button>
                        </div>
                    </div>`;

                    $('#header-modal-content').html(successMessage);
                }
            },
            error: function(xhr) {
                $('#spinner').removeClass('show')
                $('#submitForm').prop('disabled', false).text('Отправить');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    displayValidationErrors(errors);
                }
            }
        });
    });

    function displayValidationErrors(errors) {
        $('.header-error-message').remove(); 
        let showError = '';
        for (const [key, value] of Object.entries(errors)) {
            console.log(`${key}: ${value}`);
            showError += `<p class="header-error-message" style="color: red; margin: 0">${value}</p>`;
          }

          $('#add-content').append(showError);
       
    }
    
    $(document).on('click', '#refreshButton', function() {
        location.reload();
    });

    $(document).on('click', '#cancelButton', function() {
        $('#add-product-modal').modal('hide');
    });
});

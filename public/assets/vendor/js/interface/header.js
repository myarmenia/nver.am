
$(function () {
    var categories = [];
    $('#add-product').on('click', function() {
        $.ajax({
            type: "GET",
            url: '/interface/get-all-categories',
            cache: false,
            success: function (data) {
                categories = data.data
            }
          });
        $('#add-product-modal').modal('show');

        
    });

    
    $('#add-yourself').on('change',function() {
        if ($(this).is(':checked')) {
            $('#add-from-suppot').prop('checked', false);
            let options = '<option value="">Выберите категорию</option>';
            categories.forEach(category => {
                options += `<option value="${category.id}">${category.name}</option>`;
            });
     
            html = `<form id="formAccountSettings" method="POST" action="/interface/add-product" class='mt-4' onsubmit="return true" enctype="multipart/form-data">
                <input type="hidden" name="type" value="add-yourself">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Название товара</label>
                        <input class="form-control" type="text" name="title" autofocus required  />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Цена на площадке (руб.)</label>
                        <input class="form-control" type="number" name="price_in_store"  required  />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Кешбек(%)</label>
                        <input class="form-control" type="number" name="cashback" autofocus required  />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Телеграм(@)</label>
                        <input class="form-control" type="text" name="owner" required  />
                    </div>
                </div>
                 <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Фотографии</label>
                    <input class="form-control" type="file" name="photos[]" id="formFileMultiple" multiple required >
                </div>
                <div class="mb-3">
                    <label for="language" class="form-label">Категория</label>
                    <select id="language" class="select2 form-select" required >
                        ${options}
                    </select>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-outline-secondary me-2">Отправить</button>
                    <button type="reset" class="btn btn-outline-secondary" id="cancelButton">Отмена</button>
                </div>
                </form>`;
            $('#add-content').html(html);
            
        }
    });

    $('#add-from-suppot').on('change',function() {
        if ($(this).is(':checked')) {
            $('#add-yourself').prop('checked', false);
            html = `<form id="formAccountSettings" method="POST" action="/interface/add-product" class='mt-4' onsubmit="return true" enctype="multipart/form-data">
            <input type="hidden" name="type" value="add-from-suppot">
            <div class="row">
                <div class="mb-3">
                    <label class="form-label">Ссылка на товар</label>
                    <input class="form-control" type="text" name="link" autofocus required  />
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">Кешбек(%)</label>
                    <input class="form-control" type="number" name="cashback" autofocus required  />
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label">Телеграм(@)</label>
                    <input class="form-control" type="text" name="owner" required  />
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-outline-secondary me-2">Отправить</button>
                <button type="reset" class="btn btn-outline-secondary" id="cancelButton">Отмена</button>
            </div>
            </form>`;
            $('#add-content').html(html);

        }
    });

    $(document).on('submit', '#formAccountSettings', function(e) {
        e.preventDefault(); 

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Success:', response);
                // Обработка успешного ответа
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Обработка ошибки
            }
        });
    });

    $(document).on('click', '#cancelButton', function() {
        $('#add-product-modal').modal('hide');
    });
    

});
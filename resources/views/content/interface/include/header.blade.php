<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/vendor/js/interface/header.js') }}"></script>

<!-- Navbar start -->
 <div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl d-flex justify-content-between">
            <a href="{{ route('get-interface') }}" class="navbar-brand">
                {{-- <h1 class="text-primary display-6">Fruitables</h1> --}}
                <img src="{{ asset('assets/img/interface/logo.png') }}" alt="logo" class="logo">
            </a>
            <div class="d-flex m-3 me-0">
                <button type="submit" id="add-product">Add product</button>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Add product modal -->
<div class="modal fade" id="add-product-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p>Добавление товара.</p>
            </div>
            <div class="modal-body">
                <label>
                    <input type="radio" name="option" value="add-yourself" id="add-yourself"> Добавить самостоятельно(50 руб)!
                </label>
                <br>
                <label>
                    <input type="radio" name="option" value="add-from-suppot" id="add-from-suppot"> Воспользоваться помощью поддержки(300руб)!
                </label>

                <div class="add-modal-content" id="add-content"> </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" id="year-filter-btn-yes" class="btn yes-btn-modal"
                    data-dismiss="modal">Да</button>
                <button type="button" id="year-filter-btn-no" class="btn no-btn-modal"
                    data-dismiss="modal">Нет</button>
            </div> --}}
        </div>
        <input type="hidden" id="last-clicked-value" value="false">
    </div>
</div>
<!-- End add product modal -->

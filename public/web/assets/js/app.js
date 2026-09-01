// ================================
// SEARCH TOGGLE
// ================================
function toggleSearch(e) {
    e.preventDefault();
    document.getElementById('searchOverlay').classList.toggle('active');
}

// ================================
// MOBILE MENU TOGGLE
// ================================
function toggleMenu() {
    const nav = document.querySelector('.header-nav');
    nav.style.display = nav.style.display === 'none' ? 'block' : '';
}



// ================================
// FOOTER ACCORDION (MOBILE)
// ================================
document.querySelectorAll('.footer-col h4').forEach(function(heading) {
    heading.addEventListener('click', function() {
        const col = this.closest('.footer-col');
        col.classList.toggle('open');
    });
});


// ===============================
// MENU OPEN / CLOSE
// ===============================

function toggleMenu() {

    document.getElementById("sideMenu").classList.toggle("open");

    document.getElementById("menuOverlay").classList.toggle("open");

}


// ===============================
// CATEGORY CLICK
// ===============================

function showSubCat(categoryId, element) {

    // Active category remove
    document.querySelectorAll(".main-cat").forEach(function(cat){
        cat.classList.remove("active");
    });

    element.classList.add("active");


    // Hide all sub groups
    document.querySelectorAll(".sub-group").forEach(function(group){
        group.style.display = "none";
    });

    // Show selected sub group
    document.getElementById("sub_" + categoryId).style.display = "flex";


    // Hide all child groups
    document.querySelectorAll(".child-group").forEach(function(group){
        group.style.display = "none";
    });

    // Remove active sub category
    document.querySelectorAll(".sub-cat").forEach(function(sub){
        sub.classList.remove("active");
    });

}


// ===============================
// SUB CATEGORY CLICK
// ===============================

function showChildCat(subId, element) {

    // Active sub remove
    document.querySelectorAll(".sub-cat").forEach(function(sub){
        sub.classList.remove("active");
    });

    element.classList.add("active");


    // Hide all child groups
    document.querySelectorAll(".child-group").forEach(function(group){
        group.style.display = "none";
    });

    // Show selected child group
    let child = document.getElementById("child_" + subId);

    if(child){

        child.style.display = "flex";

    }

}


// ===============================
// DEFAULT OPEN
// ===============================

window.onload = function () {

    let firstCategory = document.querySelector(".main-cat");

    if(firstCategory){

        firstCategory.click();

    }

    let firstSub = document.querySelector(".sub-group .sub-cat");

    if(firstSub){

        firstSub.click();

    }

};

// product slider on home page
new Swiper(".productSwiper", {

    slidesPerView: 4,
    spaceBetween: 2,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    breakpoints: {

        0: {
            slidesPerView: 2
        },

        768: {
            slidesPerView: 3
        },

        1024: {
            slidesPerView: 4
        }

    }

});

// product detail page js
document.addEventListener('DOMContentLoaded', function () {

    // --------------------------------------------
    // ELEMENTS
    // --------------------------------------------
    const addToBagBtn      = document.getElementById('pdAddToBagBtn');
    const addToBagForm     = document.getElementById('pdAddToBagForm');
    const variantInput     = document.getElementById('pdVariantId');
    const sizeSection       = document.querySelector('.pd-size-section');
    const sizeButtons        = document.querySelectorAll('.pd-size-btn');
    const qtyValue           = document.getElementById('pdQtyValue');
    const qtyMinus           = document.getElementById('pdQtyMinus');
    const qtyPlus            = document.getElementById('pdQtyPlus');
    const stockWarning       = document.getElementById('pdStockWarning');
    const stockWarningText   = document.getElementById('pdStockWarningText');
    const stockWarningClose  = document.getElementById('pdStockWarningClose');

    // Agar is page par ye button hi nahi hai, to yahan se aage kuch mat chalao
    if (!addToBagBtn) {
        return;
    }

    const stock    = parseInt(addToBagBtn.getAttribute('data-stock')) || 0;
    const hasSizes = sizeSection && sizeSection.getAttribute('data-has-sizes') === 'true';

    // --------------------------------------------
    // SIZE SELECTION (button disable/enable)
    // --------------------------------------------
    if (hasSizes) {
        addToBagBtn.disabled = true;

        sizeButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {

                sizeButtons.forEach(function (b) {
                    b.classList.remove('pd-size-active');
                });

                this.classList.add('pd-size-active');
                addToBagBtn.disabled = false;

                if (variantInput) {
                    variantInput.value = this.getAttribute('data-variant-id');
                }
            });
        });
    } else {
        addToBagBtn.disabled = false;
    }

    // --------------------------------------------
    // STOCK CHECK
    // --------------------------------------------
    function checkStock() {
        if (!qtyValue) return true;

        const qty = parseInt(qtyValue.textContent);

        if (stock <= 0) {
            if (stockWarningText) stockWarningText.textContent = 'Not enough items available. Only 0 left.';
            if (stockWarning) stockWarning.classList.add('pd-stock-warning-show');
            return false;
        }

        if (qty >= stock) {
            if (stockWarningText) stockWarningText.textContent = 'Not enough items available. Only ' + stock + ' left.';
            if (stockWarning) stockWarning.classList.add('pd-stock-warning-show');
        } else {
            if (stockWarning) stockWarning.classList.remove('pd-stock-warning-show');
        }

        return qty <= stock;
    }

    checkStock();

    // --------------------------------------------
    // QUANTITY BUTTONS
    // --------------------------------------------
    if (qtyMinus) {
        qtyMinus.addEventListener('click', function () {
            let qty = parseInt(qtyValue.textContent);
            if (qty > 1) qtyValue.textContent = qty - 1;
            checkStock();
        });
    }

    if (qtyPlus) {
        qtyPlus.addEventListener('click', function () {
            let qty = parseInt(qtyValue.textContent);
            if (qty < stock) qtyValue.textContent = qty + 1;
            checkStock();
        });
    }

    if (stockWarningClose) {
        stockWarningClose.addEventListener('click', function () {
            stockWarning.classList.remove('pd-stock-warning-show');
        });
    }

    // --------------------------------------------
    // ADD TO BAG (AJAX submit — login check ke sath)
    // --------------------------------------------
    if (addToBagForm) {
        addToBagForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (addToBagBtn.disabled) return;
            if (!checkStock()) return;

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                if (res.login) {
                    toggleAuth();
                    return;
                }
                if (res.status) {
                    loadCartDrawer();
                }
            });
        });
    }

    // --------------------------------------------
    // COLOR SELECTION
    // --------------------------------------------
    const colorButtons = document.querySelectorAll('.pd-color-swatch');

    colorButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            colorButtons.forEach(function (b) {
                b.classList.remove('pd-color-active');
            });
            this.classList.add('pd-color-active');
        });
    });

    // --------------------------------------------
    // BAADMAY POPUP
    // --------------------------------------------
    const baadmayBtn   = document.getElementById('pdBaadmayBtn');
    const baadmayModal = document.getElementById('pdBaadmayModal');
    const baadmayClose = document.getElementById('pdBaadmayClose');

    if (baadmayBtn && baadmayModal && baadmayClose) {
        baadmayBtn.addEventListener('click', function () {
            baadmayModal.classList.add('pd-baadmay-open');
        });

        baadmayClose.addEventListener('click', function () {
            baadmayModal.classList.remove('pd-baadmay-open');
        });
    }

    // --------------------------------------------
    // IMAGE GALLERY + LIGHTBOX SETUP
    // --------------------------------------------
    const imageBoxes = document.querySelectorAll('.pd-image-box');
    let allImages = [];

    imageBoxes.forEach(function (box, index) {
        const icon = box.querySelector('.pd-zoom-icon');
        const img  = box.querySelector('.pd-gallery-trigger');

        if (!img) return;

        allImages.push(img.src);

        if (icon) {
            box.addEventListener('mousemove', function (e) {
                const rect = box.getBoundingClientRect();
                icon.style.left = (e.clientX - rect.left) + 'px';
                icon.style.top  = (e.clientY - rect.top) + 'px';
            });

            icon.addEventListener('click', function (e) {
                e.stopPropagation();
                openLightbox(index);
            });
        }
    });

    // --------------------------------------------
    // LIGHTBOX
    // --------------------------------------------
    const lightbox            = document.getElementById('pdLightbox');
    const lightboxMain         = document.getElementById('pdLightboxMainImage');
    const lightboxMainWrapper  = document.querySelector('.pd-lightbox-main');
    const lightboxCounter      = document.getElementById('pdLightboxCounter');
    const lightboxThumbs       = document.getElementById('pdLightboxThumbs');
    const lightboxClose        = document.getElementById('pdLightboxClose');
    const lightboxPrev         = document.getElementById('pdLightboxPrev');
    const lightboxNext         = document.getElementById('pdLightboxNext');
    const lightboxZoomBtn      = document.getElementById('pdLightboxZoomBtn');

    let currentIndex = 0;
    let isDragging = false;
    let startX = 0, startY = 0;
    let translateX = 0, translateY = 0;

    function buildThumbs() {
        lightboxThumbs.innerHTML = '';

        allImages.forEach(function (src, i) {
            const thumb = document.createElement('img');
            thumb.src = src;
            thumb.classList.add('pd-lightbox-thumb');
            if (i === currentIndex) thumb.classList.add('pd-lightbox-thumb-active');

            thumb.addEventListener('click', function () {
                currentIndex = i;
                updateLightbox();
            });

            lightboxThumbs.appendChild(thumb);
        });
    }

    function resetImagePosition() {
        translateX = 0;
        translateY = 0;
        lightboxMain.style.transform = '';
    }

    function updateLightbox() {
        lightboxMain.src = allImages[currentIndex];
        lightboxCounter.textContent = (currentIndex + 1) + '/' + allImages.length;
        lightboxMainWrapper.classList.remove('pd-lightbox-zoomed');
        resetImagePosition();

        document.querySelectorAll('.pd-lightbox-thumb').forEach(function (t, i) {
            t.classList.toggle('pd-lightbox-thumb-active', i === currentIndex);
        });
    }

    function openLightbox(index) {
        currentIndex = index;
        buildThumbs();
        updateLightbox();
        lightbox.classList.add('pd-lightbox-open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('pd-lightbox-open');
        document.body.style.overflow = '';
    }

    if (lightbox) {
        lightboxClose.addEventListener('click', closeLightbox);

        lightboxPrev.addEventListener('click', function () {
            currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
            updateLightbox();
        });

        lightboxNext.addEventListener('click', function () {
            currentIndex = (currentIndex + 1) % allImages.length;
            updateLightbox();
        });

        function toggleZoom() {
            lightboxMainWrapper.classList.toggle('pd-lightbox-zoomed');
            if (!lightboxMainWrapper.classList.contains('pd-lightbox-zoomed')) {
                resetImagePosition();
            }
        }

        lightboxMainWrapper.addEventListener('click', function () {
            if (!isDragging) toggleZoom();
        });

        lightboxZoomBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleZoom();
        });

        lightboxMain.addEventListener('mousedown', function (e) {
            if (!lightboxMainWrapper.classList.contains('pd-lightbox-zoomed')) return;
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            e.preventDefault();
        });

        document.addEventListener('mousemove', function (e) {
            if (!isDragging) return;
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            lightboxMain.style.transform = `scale(1.8) translate(${translateX / 1.8}px, ${translateY / 1.8}px)`;
        });

        document.addEventListener('mouseup', function () {
            isDragging = false;
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeLightbox();
        });
    }

    // --------------------------------------------
    // TABS (Details / Description / Size Guide)
    // --------------------------------------------
    const tabLinks    = document.querySelectorAll('.pd-tab-link');
    const tabContents = document.querySelectorAll('.pd-tab-content');

    tabLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            const target = this.getAttribute('data-tab');

            tabLinks.forEach(function (btn) { btn.classList.remove('pd-tab-active'); });
            tabContents.forEach(function (content) { content.classList.remove('pd-tab-content-active'); });

            this.classList.add('pd-tab-active');
            document.getElementById(target).classList.add('pd-tab-content-active');
        });
    });

});

// auth drawer js
function toggleAuth() {
    document.getElementById('authDrawer').classList.toggle('auth-open');
    document.getElementById('authOverlay').classList.toggle('auth-overlay-show');
}

function showRegisterForm() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
    document.getElementById('backToLoginText').style.display = 'block';
    document.getElementById('authDrawerTitle').textContent = 'CREATE ACCOUNT';
}

function showLoginForm() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('backToLoginText').style.display = 'none';
    document.getElementById('authDrawerTitle').textContent = 'ACCOUNT';
}

document.addEventListener('DOMContentLoaded', function () {

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.content : '';

    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            submitAuthForm(this, '/login');
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            submitAuthForm(this, '/register');
        });
    }

    function submitAuthForm(form, url) {
        const formData = new FormData(form);
        const errorBox = document.getElementById('authError');
        errorBox.style.display = 'none';

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            return response.json().then(data => ({ status: response.status, body: data }));
        })
        .then(({ status, body }) => {
            if (status === 200 || status === 201) {
                window.location.href = body.redirect_url;
            } else if (status === 422) {
                // Validation errors
                const firstError = Object.values(body.errors)[0][0];
                errorBox.textContent = firstError;
                errorBox.style.display = 'block';
            } else {
                errorBox.textContent = body.message || 'Something went wrong.';
                errorBox.style.display = 'block';
            }
        })
        .catch(() => {
            errorBox.textContent = 'Network error. Please try again.';
            errorBox.style.display = 'block';
        });
    }

});

// whishlist successfull msg on bottom
// wishlist successful msg on bottom
document.querySelectorAll('.wishlist-form').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (res.status === 401) {
                toggleAuth();   // auth-drawer.js mein yehi function hai
                return null;
            }
            return res.json();
        })
        .then(response => {
            if (!response) return;   // 401 tha, already handle ho chuka

            let message = document.getElementById('wishlist-message');

            message.innerText = response.message;
            message.style.display = 'block';

            setTimeout(() => {
                message.style.display = 'none';
            }, 3000);
        });

    });

});

// // code for cart drawer //
// $(document).on('submit', '.grid-cart-form', function(e){

//     e.preventDefault();

//     let form = $(this);

//     let button = form.find('.pd-add-to-bag-btn');

//     let productId = button.data('product');

//     // Agar already remove mode me hai
//     if(button.hasClass('added')){

//         $.ajax({

//             url:'/cart/product/'+productId,

//             type:'DELETE',

//             data:{
//                 _token:$('meta[name="csrf-token"]').attr('content')
//             },

//             success:function(res){

//                 if(res.status){

//                     button
//                     .removeClass('added')
//                     .text('ADD TO BAG');

//                     loadCartDrawer();

//                 }

//             }

//         });

//         return;

//     }

//     // ADD TO BAG
//     $.ajax({

//         url:form.attr('action'),

//         type:'POST',

//         data:form.serialize(),

//         success:function(res){

//             if(res.login){

//                 toggleAuth();

//                 return;

//             }

//             if(res.status){

//                 button
//                 .addClass('added')
//                 .text('REMOVE FROM BAG');

//                 loadCartDrawer();

//             }

//         }

//     });

// });



// add to cart and remove from cart code

// $(document).on('submit', '.grid-cart-form', function(e){

//     e.preventDefault();

//     let form = $(this);
//     let button = form.find('.pd-add-to-bag-btn');
//     let productId = button.data('product');

//     // REMOVE FROM BAG
//     if(button.hasClass('added')){

//         $.ajax({

//             url:'/cart/' + productId,
//             type:'DELETE',

//             data:{
//                 _token:$('meta[name="csrf-token"]').attr('content')
//             },

//             success:function(res){

//                 if(res.status){

//                     button
//                         .removeClass('added')
//                         .text('ADD TO BAG');

//                     loadCartDrawer();

//                 }

//             }

//         });

//         return;

//     }

//     // ADD TO BAG
//     $.ajax({

//         url:form.attr('action'),
//         type:'POST',
//         data:form.serialize(),

//         success:function(res){

//             if(res.login){

//                 toggleAuth();
//                 return;

//             }

//             if(res.status){

//                 button
//                     .addClass('added')
//                     .text('REMOVE FROM BAG');

//                 loadCartDrawer();

//             }

//         }

//     });

// });

// =======================
// Common Cart Function for cart page and drawer
// =======================

function loadCartDrawer(showDrawer = true) {

    $.ajax({
        url: cartDrawerUrl,
        type: "GET",

        success: function (response) {

            // Drawer Update
            $('.cart-body').html(response.html);

            // Header Count
            $('.cart-count').text(response.count);

            $('#shoppingCartLabel').text('SHOPPING BAG (' + response.count + ')');

            $('.cart-subtotal strong').text('PKR ' + response.subtotal);

            // Cart Page Update
            if ($('#cartPageItems').length) {

                $('#cartPageItems').html(response.page_html);

                $('#cartPageSubtotal').text('Rs.' + response.subtotal);

            }

            // Drawer sirf tab open hoga jab zarurat ho
            if (showDrawer) {

                let cartDrawer = bootstrap.Offcanvas.getOrCreateInstance(
                    document.getElementById('shoppingCart')
                );

                cartDrawer.show();

            }

        }

    });

}

// =======================
// Drawer Open
// =======================

$(document).on('click', '[data-bs-target="#shoppingCart"]', function () {

    loadCartDrawer(true);

});

// =======================
// Quantity Plus
// =======================

$(document).on('click', '.qty-plus', function () {

    let maxStock = $(this).data('max-stock');
    let currentQty = parseInt($(this).siblings('span').text());

    if (currentQty >= maxStock) {

        $('#cartStockWarningText').text(
            'Maximum ' + maxStock + ' pieces of this item can be added to Cart.'
        );

        $('#cartStockWarning').addClass('show');

        setTimeout(function () {
            $('#cartStockWarning').removeClass('show');
        }, 4000);

        return;
    }

    let itemId = $(this).data('item-id');

    $.ajax({

        url: '/cart/' + itemId + '/increase',
        type: 'PATCH',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function () {

            // Agar Cart Page open hai to drawer mat kholo
            if ($('#cartPageItems').length) {

                loadCartDrawer(false);

            } else {

                loadCartDrawer(true);

            }

        }

    });

});

// =======================
// Quantity Minus
// =======================

$(document).on('click', '.qty-minus', function () {

    let itemId = $(this).data('item-id');

    $.ajax({

        url: '/cart/' + itemId + '/decrease',
        type: 'PATCH',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function () {

            if ($('#cartPageItems').length) {

                loadCartDrawer(false);

            } else {

                loadCartDrawer(true);

            }

        }

    });

});

// =======================
// Delete Item
// =======================

// $(document).on('click', '.remove-item, .cart-page-remove', function () {

//     let itemId = $(this).data('item-id');

//     $.ajax({

//         url: '/cart/' + itemId,
//         type: 'DELETE',

//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content')
//         },

//         success: function () {

//             if ($('#cartPageItems').length) {

//                 loadCartDrawer(false);

//             } else {

//                 loadCartDrawer(true);

//             }

//         }

//     });

// });

$(document).on('click', '.remove-item, .cart-page-remove', function () {

    let itemId = $(this).data('item-id');

    $.ajax({

        url: '/cart/' + itemId,
        type: 'DELETE',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function () {

            if ($('#cartPageItems').length) {

                // loadCartDrawer(false);
                location.reload();

            } else {

                // loadCartDrawer(true);
                loadCartDrawer();
                location.reload();

            }

        }

    });

});

// checkout file js
const provinces = {

Pakistan:[
"Punjab",
"Sindh",
"KPK",
"Balochistan",
"Gilgit Baltistan",
"AJK"
],

UAE:[
"Dubai",
"Abu Dhabi",
"Sharjah"
],

Saudi:[
"Riyadh",
"Jeddah",
"Makkah"
]

};


const cities={

Punjab:[
"Lahore",
"Rawalpindi",
"Faisalabad",
"Multan",
"Sialkot"
],

Sindh:[
"Karachi",
"Hyderabad",
"Sukkur"
],

KPK:[
"Peshawar",
"Mardan",
"Abbottabad"
],

Balochistan:[
"Quetta",
"Gwadar"
],

"Gilgit Baltistan":[
"Gilgit",
"Skardu"
],

AJK:[
"Muzaffarabad",
"Mirpur"
],

Dubai:[
"Dubai"
],

"Abu Dhabi":[
"Abu Dhabi"
],

Sharjah:[
"Sharjah"
],

Riyadh:[
"Riyadh"
],

Jeddah:[
"Jeddah"
],

Makkah:[
"Makkah"
]

};


function loadProvince(){

let country=$("#country").val();

$("#province").html("<option>Select Province</option>");
$("#city").html("<option>Select City</option>");

if(!provinces[country]) return;

$.each(provinces[country],function(i,item){

$("#province").append(

'<option value="'+item+'">'+item+'</option>'

);

});

}


function loadCity(){

let province=$("#province").val();

$("#city").html("<option>Select City</option>");

if(!cities[province]) return;

$.each(cities[province],function(i,item){

$("#city").append(

'<option value="'+item+'">'+item+'</option>'

);

});

}


$("#country").change(loadProvince);

$("#province").change(loadCity);

loadProvince();



// product images sizes selection compulsory 
// =======================
// GRID CARD - SIZE SELECTION
// =======================
$(document).on('click', '.grid-size-option', function (e) {

    e.preventDefault();
    e.stopPropagation();

    let card = $(this).closest('.grid-product-card');

    card.find('.grid-size-option').removeClass('active-size');
    $(this).addClass('active-size');

    let variantId = $(this).data('variant-id');
    card.find('.grid-variant-id').val(variantId);

});


// =======================
// GRID CARD - ADD TO BAG / REMOVE FROM BAG
// =======================
$(document).on('submit', '.grid-cart-form', function (e) {

    e.preventDefault();

    let form = $(this);
    let card = form.closest('.grid-product-card');
    let button = form.find('.pd-add-to-bag-btn');
    let productId = button.data('product');
    let variantId = form.find('.grid-variant-id').val();

    let sizesExist = card.find('.grid-size-option').length > 0;

    if (sizesExist && !variantId && !button.hasClass('added')) {
        card.find('.grid-product-sizes').addClass('size-required-shake');
        setTimeout(function () {
            card.find('.grid-product-sizes').removeClass('size-required-shake');
        }, 500);
        return;
    }

    // REMOVE FROM BAG
    if (button.hasClass('added')) {

        $.ajax({
            url: '/cart/' + productId,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                if (res.status) {
                    button.removeClass('added').text('ADD TO BAG');
                    loadCartDrawer();
                }
            }
        });

        return;
    }

    // ADD TO BAG
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function (res) {
            if (res.login) {
                toggleAuth();
                return;
            }
            if (res.status) {
                button.addClass('added').text('REMOVE FROM BAG');
                loadCartDrawer();
            }
        }
    });

});



// checkout page work
$(function(){

    // Blade se pass ki hui values, data-attributes se utha rahe hain
    

    const CHECKOUT_PLACE_ORDER_URL = $('.checkout').data('place-order-url');
    const CSRF_TOKEN = $('.checkout').data('csrf-token');
    const CHECKOUT_CONFIRMATION_URL = $('.checkout').data('confirmation-url');



    /*
    =============================
    Payment Method Select
    =============================
    */
    $('.payment-option').click(function(){
        $('.payment-option').removeClass('active');
        $(this).addClass('active');

        if($(this).data('method') === 'bank'){
            $('#cardFields').slideDown(200);
        } else {
            $('#cardFields').slideUp(200);
        }
    });


    /*
    =============================
    Proceed to Payment
    =============================
    */
    $('#proceedPaymentBtn').click(function(){

        let summary =
            $('#first_name').val() + ' ' + $('#last_name').val() + '<br>' +
            $('#address').val() + '<br>' +
            $('#city').val() + ', ' + $('#province').val() + ' ' + $('#postal_code').val() + '<br>' +
            $('#country').val() + '<br>' +
            '+92 ' + $('#phone').val();

        $('#summaryText').html(summary);

        $('#shippingForm').slideUp(200);
        $('#shippingSummary').slideDown(200);

        $('#shippingCheck').show();
        $('#editShipping').show();

        $('#payment').slideDown(300, function(){
            $('html,body').animate({
                scrollTop: $('#payment').offset().top - 40
            }, 500);
        });

    });


    /*
    =============================
    Edit Shipping
    =============================
    */
    $('#editShipping').click(function(e){
        e.preventDefault();

        $('#shippingSummary').slideUp(200);
        $('#shippingForm').slideDown(200);

        $('#shippingCheck').hide();
        $('#editShipping').hide();

        $('#payment').slideUp(200);
    });


    /*
    =============================
    Place Order
    =============================
    */
    $('#placeOrderBtn').click(function(){

        let paymentMethod = $('.payment-option.active').data('method');
        let btn = $(this);

        btn.prop('disabled', true).text('Placing Order...');

        $.ajax({
            url: CHECKOUT_PLACE_ORDER_URL,
            method: "POST",
            data: {
                _token:         CSRF_TOKEN,
                first_name:     $('#first_name').val(),
                last_name:      $('#last_name').val(),
                address:        $('#address').val(),
                country:        $('#country').val(),
                province:       $('#province').val(),
                city:           $('#city').val(),
                postal_code:    $('#postal_code').val(),
                phone_no:       $('#phone').val(),
                payment_method: paymentMethod,
            },
            success: function(res){

                if(res.status){

                    window.location.href = CHECKOUT_CONFIRMATION_URL + '/' + res.order_id;

                } else {

                    btn.prop('disabled', false).text('PLACE YOUR ORDER');
                    alert(res.message);

                }

            },
            error: function(xhr){

                btn.prop('disabled', false).text('PLACE YOUR ORDER');

                if(xhr.status === 422){
                    let errors = xhr.responseJSON.errors;
                    let firstError = Object.values(errors)[0][0];
                    alert(firstError);
                } else {
                    alert('Something went wrong. Please try again.');
                }

            }
        });

    });

});

// faqs page js
document.addEventListener('DOMContentLoaded', function () {

    const headers = document.querySelectorAll('.faq-category-header');

    headers.forEach(function (header) {
        header.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');
            const body = document.getElementById(targetId);
            const categoryBlock = this.closest('.faq-category');
            const icon = this.querySelector('.faq-toggle-icon');

            const isOpen = categoryBlock.classList.contains('active');

            // Close all categories first (single-open accordion, Sapphire jaisa)
            document.querySelectorAll('.faq-category').forEach(function (block) {
                block.classList.remove('active');
                block.querySelector('.faq-category-body').style.maxHeight = '0';
                block.querySelector('.faq-toggle-icon').textContent = '+';
            });

            // Agar pehle se band tha, to isko open karo
            if (!isOpen) {
                categoryBlock.classList.add('active');
                body.style.maxHeight = body.scrollHeight + 'px';
                icon.textContent = '−';
            }

        });
    });

});

// wishlist on user account
// ============================================
// WISHLIST PAGE — MOVE TO BAG
// ============================================
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.wishlist-move-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                if (res.login) {
                    toggleAuth();
                    return;
                }
                if (res.status) {
                    loadCartDrawer();
                }
            });
        });
    });

});

// search drawer code
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchDrawerInput');

    const defaultBlock = document.getElementById('searchDefaultBlock');
    const resultsBlock = document.getElementById('searchResultsBlock');
    const loadingBlock = document.getElementById('searchLoadingBlock');

    const suggestionsList = document.getElementById('searchSuggestionsList');
    const inspirationProducts = document.getElementById('searchInspirationProducts');

    const resultsHeading = document.getElementById('searchResultsHeading');
    const resultsProducts = document.getElementById('searchResultsProducts');


    // ==============================
    // Load Drawer Data
    // ==============================

    async function loadSearchDrawerData() {

        try {

            const response = await fetch(searchDrawerDataUrl);

            if (!response.ok) {
                throw new Error('Drawer request failed');
            }

            const data = await response.json();

            renderSuggestions();

            renderProducts(
                data.products || [],
                inspirationProducts
            );

        } catch (error) {

            console.error('Search drawer error:', error);

            inspirationProducts.innerHTML =
                '<p>Unable to load products.</p>';
        }
    }


    // ==============================
    // Suggestions
    // ==============================

    function renderSuggestions() {

        const suggestions = [
            'Lawn',
            'Smart Casual',
            'Matching Separates',
            'Outfits',
            'Tops'
        ];

        suggestionsList.innerHTML = '';

        suggestions.forEach(function (suggestion) {

            const li = document.createElement('li');

            li.textContent = suggestion;

            li.style.cursor = 'pointer';

            li.addEventListener('click', function () {

                searchInput.value = suggestion;

                performSearch(suggestion);

            });

            suggestionsList.appendChild(li);

        });
    }


    // ==============================
    // Live Search
    // ==============================

    let searchTimer;

    searchInput.addEventListener('input', function () {

        const query = this.value.trim();

        clearTimeout(searchTimer);

        if (query.length === 0) {

            defaultBlock.style.display = 'block';
            resultsBlock.style.display = 'none';
            loadingBlock.style.display = 'none';

            return;
        }


        if (query.length < 2) {
            return;
        }


        searchTimer = setTimeout(function () {

            performSearch(query);

        }, 300);

    });


    // ==============================
    // Perform Search
    // ==============================

    async function performSearch(query) {

        defaultBlock.style.display = 'none';
        resultsBlock.style.display = 'none';
        loadingBlock.style.display = 'block';


        try {

            const url =
                searchLiveUrl +
                '?q=' +
                encodeURIComponent(query);


            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });


            if (!response.ok) {
                throw new Error('Search request failed');
            }


            const data = await response.json();


            loadingBlock.style.display = 'none';
            resultsBlock.style.display = 'block';


            resultsHeading.textContent =
                'Search results for "' + query + '"';


            renderProducts(
                data.products || [],
                resultsProducts
            );


        } catch (error) {

            console.error('Search error:', error);

            loadingBlock.style.display = 'none';
            resultsBlock.style.display = 'block';

            resultsHeading.textContent = 'Search Results';

            resultsProducts.innerHTML =
                '<p>Something went wrong. Please try again.</p>';
        }
    }


    // ==============================
    // Render Products
    // ==============================

    function renderProducts(products, container) {

        container.innerHTML = '';


        if (!products.length) {

            container.innerHTML =
                '<p class="no-products">No products found.</p>';

            return;
        }


        products.forEach(function (product) {

            const image =
                product.product_images &&
                product.product_images.length
                    ? product.product_images[0].image_path
                    : null;

            const price =
                product.product_variants &&
                product.product_variants.length
                    ? product.product_variants[0].price
                    : null;


            const productHtml = `

                <a href="/product/${product.id}"
                   class="search-product">

                    <div class="search-product-image">

                        ${
                            image
                            ?
                            `<img src="/storage/${image}"
                                 alt="${product.name}">`
                            :
                            `<div class="no-image">
                                No Image
                             </div>`
                        }

                    </div>


                    <div class="search-product-info">

                        <p>${product.name}</p>

                        ${
                            price
                            ?
                            `<span>PKR ${Number(price).toLocaleString()}</span>`
                            :
                            ''
                        }

                    </div>

                </a>

            `;


            container.insertAdjacentHTML(
                'beforeend',
                productHtml
            );

        });

    }


    // ==============================
    // When Drawer Opens
    // ==============================

    const searchDrawer =
        document.getElementById('searchDrawer');


    if (searchDrawer) {

        searchDrawer.addEventListener(
            'show.bs.offcanvas',
            function () {

                searchInput.value = '';

                defaultBlock.style.display = 'block';
                resultsBlock.style.display = 'none';
                loadingBlock.style.display = 'none';

                loadSearchDrawerData();

            }
        );

    }

});
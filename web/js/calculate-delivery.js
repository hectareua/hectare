function clearMessages() {
  $('#delivery-price').val('');
  $(".delivery_type-message, .delivery_type-price").each(function( i ) {
    $(this).html('');
  });
}

function showMessage($el, message) {
  if (!$('#order-delivery_city').val()) {
    $el.parents('.delivery-radio-container').find('.delivery_type-message').html('<div class="delivery-free"><div class="need_price">' + message + '</div></div>');
  }
}

function caclulateDelivery() {
  var $deliveryCity = $('#order-delivery_city'),
    $deliveryAddress = $('#order-delivery_address'),
    url = '/internet-magazin/cart/get-delivery-price',
    $radioOption = $('#order-delivery_type input[type="radio"]:checked');

  if ($deliveryCity.val() && $radioOption.length) {
    var data = {
      city: $deliveryCity.val(),
      address: $deliveryAddress.val(),
      deliveryType: $radioOption.val(),
    };
  
    $.ajax({
      url: url,
      method: 'POST',
      data: data,
      success: function(response) {
        clearMessages();
        if (response.success === 'true'){
          var $el = $('[name="Order[delivery_type]"][value="' + $radioOption.val() + '"]').parents('.delivery-radio-container');
          
          if (response.isFree){
            $el.find('.delivery_type-price').html('Доступно безкоштовно');
          } else {
            $el.find('.delivery_type-message').html(response.html);
            $el.find('.delivery_type-price').html(response.price + ' грн.');
          }
        }
        if (response.totalPrice){
          $('#total-order-price').html(response.totalPrice);
          $('#total-price').val(response.totalPrice);
        }
      }
    });
  } else {
    clearMessages();
    showMessage($radioOption, 'Укажіть своє місто для доставки');
  }
}

$(document).ready(function () {
  $(document).on('focusout', '#order-delivery_city, #order-delivery_address', function (e) {
    caclulateDelivery();
  });
  
  $(document).on('click', '#order-delivery_type input[type="radio"]', function (e) {
    caclulateDelivery();
  });
});

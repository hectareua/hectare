function clearMessages() {
  $(".delivery_type-message, .delivery_type-price").each(function( i ) {
    $(this).html('');
  });
}

function caclulateDelivery() {
  var $deliveryCity = $('#order-delivery_city'),
    $deliveryAddress = $('#order-delivery_address'),
    url = '/internet-magazin/cart/get-delivery-price',
    $radioOption = $('#order-delivery_type input[type="radio"]:checked');

  if ($deliveryCity.val() && $deliveryAddress.val() && $radioOption.length) {
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
            $el.find('.delivery_type-price').html(': ' + response.price + ' грн.');
          }
          
        }
      }
    });
  }
}

$(document).ready(function () {
  $(document).on('focusout', '#order-delivery_city', function (e) {
    caclulateDelivery();
  });
  
  $(document).on('focusout', '#order-delivery_address', function (e) {
    caclulateDelivery();
  });
  
  $(document).on('click', '#order-delivery_type input[type="radio"]', function (e) {
    caclulateDelivery();
  });
});

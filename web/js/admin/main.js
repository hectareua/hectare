$(function(){
	$('#modalButton').click(function(){
		$('#modal').modal('show')
			.find('#modalContent')
			.show();
	});

	$("#suggestion_items").on("click", ".suggested_button", function(){
		$(this).closest('.block_suggested_main').remove();
	});
	
	$('#modalButtonAlso').click(function(){
		$('#modalAlso').modal('show')
			.find('#modalContentAlso')
			.show();
	});
	
	$("#alsobuy_items").on("click", ".alsobuy_button", function(){
		$(this).closest('.block_alsobuy_main').remove();
	});

	$('#modalButtonBilling').click(function(){
		$('#modalClient').modal('show')
			.find('#modalClientContent')
			.show();
	});

	$('#modalButtonDelivery').click(function(){
		$('#modalDelivery').modal('show')
			.find('#modalDeliveryContent')
			.show();
	});

	$('.billing_form_save').click(function(){
		$('#modalClient').modal('hide');
	});

	$('.delivery_form_save').click(function(){
		$('#modalDelivery').modal('hide');
	});
});
function new_suggestion(index, adress){

	$.get(adress, {id: index}).done(function(data){
		if(!$('.block_suggested_main input[value="'+index+'"]').length)
		{
			$('#suggestion_items').append(data);
		}
		$('#modal').modal('hide');
	});

}
function new_alsobuy(index, adress){

	$.get(adress, {id: index}).done(function(data){
		if(!$('.block_alsobuy_main input[value="'+index+'"]').length)
		{
			$('#alsobuy_items').append(data);
		}
		$('#modalAlso').modal('hide');
	});

}

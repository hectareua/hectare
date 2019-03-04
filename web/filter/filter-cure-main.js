
//	window.onload = function() {
$(document).on('click','.curelist .nav li',function() {
	console.log(1);
	jQuery('.curelist .nav li').removeClass('active');
	jQuery('.curelist .navselect option').attr('selected','');
	jQuery(this).addClass('active');
	jQuery('.curelist .tab-content .tab-pane').removeClass('active');
	jQuery('.curelist .tab-content '+jQuery(this).attr('data-ref')).toggleClass('active');
	jQuery('.curelist .navselect option[data-ref=\''+jQuery(this).attr('data-ref')+'\']').attr('selected','selected');
});
jQuery(document).on('change','.navselect',function() {
	var dr = jQuery('.curelist .navselect option[value=\''+jQuery(this).val()+'\']').attr('data-ref');
	jQuery('.curelist .nav li').removeClass('active');
	jQuery('.curelist .nav li[data-ref=\''+dr+'\']').addClass('active');
	jQuery('.curelist .tab-content .tab-pane').removeClass('active');
	jQuery('.curelist .tab-content '+dr).toggleClass('active');
});
jQuery(document).on('change','.navselect1',function() {
	var dr = jQuery('.navselect1 option[value=\''+jQuery(this).val()+'\']').attr('data-ref');
	jQuery('.privatecure').addClass('hidden');
	jQuery('.privatecure[data-p='+dr+']').removeClass('hidden');
	jQuery('.privateplant').removeClass('active');
	jQuery('.privateplant[data-ref=\''+dr+'\']').addClass('active');
});
jQuery(document).on('mouseover','.cureimg2',function() {
	jQuery('.upinfo').addClass('hidden');
	jQuery(this).parent().children('.upinfo').toggleClass('hidden');
});
jQuery(document).on('mouseleave','.tab-pane.active td li',function() {
	//jQuery(this).toggleClass('hidden');
	//if (!(jQuery(this).parent().find(':hover').length > 0)) {
	jQuery(this).children('.upinfo').toggleClass('hidden');
	//}
});
jQuery(document).on('mouseleave','.ccproblems',function() {
	jQuery(this).children('.upinfo').toggleClass('hidden');
});
jQuery('.ulproblems').each(function(){
	var highestBox = 0;
	jQuery('li', this).each(function(){
		if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height();
		}
	});
	if (parseInt(highestBox)>0) {jQuery('li',this).height(highestBox);}
});
/*	jQuery('.privateul').each(function(){
		var highestBox = 0;
		jQuery('li', this).each(function(){
			if(jQuery(this).height() > highestBox) {
				highestBox = jQuery(this).height();
			}
		});
		jQuery('li',this).height(highestBox);
	}); */
jQuery('.privateblock').each(function(){
	var highestBox = 0;
	jQuery('.ccproblems', this).each(function(){
		if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height();
		}
	});
	jQuery('.ccproblems',this).height(highestBox);
});
jQuery(document).on('click','.privateplant',function() {
	var ref = jQuery(this).data('ref');
	jQuery('.privateplant').removeClass('active');
	jQuery('.privatecure').addClass('hidden');
	jQuery('.privateplant[data-ref='+ref+']').toggleClass('active');
	jQuery('.privatecure[data-p='+ref+']').toggleClass('hidden');
});
//	}
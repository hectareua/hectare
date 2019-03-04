
$('.historyitemtitle').on('click',function(){
    var id = $(this).data('id');
    var text = $(this).find('span').text();
    $('.interview-header').text(text);
    $('.historyitemtitle').removeClass('active');
    $('.historyitemtitle[data-id='+id+']').addClass('active');
    $('.historymenuselect option[value='+id+']').addClass('active');
    $('.historyitemtext').addClass('hidden');
    $('.historyitemtext[data-id='+id+']').removeClass('hidden');
});
$('.historymenuselect').on('change',function(){
    var id = $('.historymenuselect').val();
    var text = $('.historymenuselect :selected').text();
    $('.interview-header').text(text);
    $('.historyitemtitle').removeClass('active');
    $('.historyitemtitle[data-id='+id+']').addClass('active');
    $('.historyitemtext').addClass('hidden');
    $('.historyitemtext[data-id='+id+']').removeClass('hidden');


});

/*
$('.info-wrapper a').click(function (e) {
    var id = $(this).data('id');
    var el = $(this);
    var param = $('meta[name=csrf-param]').attr("content");
    var token = $('meta[name=csrf-token]').attr("content");
    var data = {id:id};
    data[param] = token;
    $.ajax({
        url: 'web/info/add-views',
        data: data,
        type: 'post',
        success: function(res){
            if(!res) console.log('Ошибка');
            if(el.parent().find('.views-count').html()){
                el.parent().find('.views-count').html(res);
            }else{
                el.closest('.info-wrapper').find('.views-count').html(res);
            }

        },
        error: function(){
            console.log('ERROR');
        }
    });
});
*/
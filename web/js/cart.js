
if(typeof(ContainerFlex)!='function'){
    function ContainerFlex(tagclass, el){
        if(typeof(el)=='object') el.preventDefault();
        $('.'+tagclass).css('display','flex');
    }
}

function innerWin(html){
    var win = $('#cart_win');
    if(!win.length){
        var win = $('<div class=\"cartModalContainer modalContainer\" style=\"\" id=\"cart_win\"></div>');
        $('body').append(win);
    }
    $(win).html(html);
    if($('#isajax').length>0) $('#isajax').remove();
    ContainerFlex('cartModalContainer', false);
    $('.modal__close').on('click', function (e) {
        ModalClose('modalContainer', e);
    });
    $('.modalLayout').on('click', function (e) {
        ModalClose('modalContainer', e);
    });

    $('.remove_button').click(function(el){
        el.preventDefault();
        if(confirm(remove_cart_text)){
            var th = this;

            __ajax(remove_cart_link+'?index='+$(th).data('id'),'GET','isajax=1','json', function(responce){ console.log(responce);
                if(responce.success){
                    if(responce.redirect){
                        __ajax(responce.redirect+'','GET','isajax=1','html', function(html){
                            innerWin(html);
                        });
                    }
                }
            });
            return 0;
        }
        return 0;
    });

    return 0;
}

function credit_buy_submit(form){
    $(form).append('<input type=\"hidden\" id=\"isajax\" name=\"isajax\" value=\"1\">');
    __ajax($(form).attr('action')+'',$(form).attr('method'),$(form).serialize(),'json', function(responce){
        if(responce && responce.success){
            if(responce.redirect){
                if($('.refresh_form').length){
                    window.location = responce.redirect;
                    return false;
                }
                __ajax(responce.redirect+'','GET','isajax=1','html', function(html){
                    innerWin(html);
                });
            }
        }
    });

    return false;
}
function __ajax(url,method,data,type,callback){
    $.ajax({
        url:url, type:method, data:data, dataType:type, success:function(responce){ callback(responce) }
    });
    return false;
}
							
                        



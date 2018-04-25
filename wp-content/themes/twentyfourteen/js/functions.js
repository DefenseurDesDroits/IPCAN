jQuery( document ).ready(function() {

    var lg = jQuery('body').attr('data-lang');
    jQuery('#menu-item-167-en').removeClass('current_page_item');
    jQuery('#menu-item-167-fr').removeClass('current_page_item');
    jQuery('#menu-item-143-en').removeClass('current_page_item');
    jQuery('#menu-item-143-fr').removeClass('current_page_item');
    if(lg == 'fr-FR') {
        jQuery('#menu-item-167-fr').addClass('current_page_item');
        jQuery('#menu-item-143-fr').addClass('current_page_item');
    } else {
        jQuery('#menu-item-167-en').addClass('current_page_item');
        jQuery('#menu-item-143-en').addClass('current_page_item');
    }
    var tmp = String(jQuery(location).attr('pathname')).split('/');
    if(tmp.length > 2) {
        jQuery('li.cta--nav').each(function(itm) {
            var obj = jQuery(this).find('a');
            var val = tmp[1];
            if(val == 'fr') {
                val = tmp[2];
            }
            var regExp = new RegExp("/"+val+"$");
            if(regExp.test(obj.attr('href'))) {
                jQuery(this).addClass('current-menu-item');
            }
        });
    }
});
var nav_time = 200; //время в микросекундах

$(document).ready(function() {

	function navigate(key) {
		if($(".catalog-list tbody tr.selected").size() == 0) {
		if(key == 'up') {
			$(".catalog-list tbody tr").last().addClass("selected");
		} else if (key == 'down') {
			$(".catalog-list tbody tr").first().addClass("selected");
		}
		} else {
		var selected = $('.catalog-list tbody tr.selected');
		if(key == 'up') {
			$(".catalog-list tbody tr").removeClass("selected");
			$(selected).prev().addClass("selected");
		} else if (key == 'down') {
			$(".catalog-list tbody tr").removeClass("selected");
			$(selected).next().addClass("selected");
		}
	}
	$(".catalog-list tbody tr.selected input").focus();
	}
	
    $(document).bind('keydown', function(event) {
		if(event.keyCode == 38 ){  
			navigate('up');
		}
		if(event.keyCode == 40 ){  
			navigate('down');
		}
		if((event.ctrlKey) && ((event.keyCode == 0xA)||(event.keyCode == 0xD))) {
        $('.fancybox-inner a.add-to-cart-ok').click();
        }
    });	
	
	$('#ct_filter input').bind('keydown', function(event) {
		if(event.keyCode == 13 ){  
			$('ct_filter form').submit();
		}
	}); 

////////////////////////////////////////////////////
    	
    $('.select-tab').click(function(e){
        $(this).toggleClass('open');
        $(this).next('.select-list').toggleClass('open');
        e.stopPropagation();
    });
    $('body').click(function(){
        if($('.select-tab').hasClass('open')){
            $('.select-tab').toggleClass('open');
            $('.select-list').toggleClass('open');
        }
    });
    	
    $('.select-list a').click(function(e){
	    var val = $(this).attr('value');
	    $('.search-type').val(val);
	    
	    $('.select-list a').removeClass('selected');
	    $(this).addClass('selected');
	    
	    if(!$('.search-text').val()){
	        var placeholder = '';
            switch($(this).attr('value')){
                case 'all':
                    placeholder = 'Поиск...';
                    break;
                case 'articule':
                    placeholder = 'Введите Артикул';
                    break;
                case 'name':
                    placeholder = 'Введите Название';
                    break;
                case 'price':
                    placeholder = 'Введите Цену';
                    break;
            }
	        $('.search-text').attr('placeholder', placeholder);
	    }
        $('.select-tab').toggleClass('open');
        $('.select-list').toggleClass('open');
        
	    return false;
	});
	
////////////////////////////////////////////////////

	$("tr.head").click(function(){
        var num = $(this).attr('id');
	    $('tr.head').find("span").html('+');
	    $(this).find("span").html('-');
	    $('.block').hide();
	    $('.'+num).show();
    });

    $("#accordion").accordion({header:'h3', active:'.selected', selectedClass: 'active', autoHeight: false });
    $("#accordion h3 a").click(function() {
      window.location = $(this).attr('href');
      return false;
    });

    $("#accordion2").accordion({header:'h3', active:'.selected', selectedClass: 'active', autoHeight: false });
    $("#accordion2 h3 a").click(function() {
      window.location = $(this).attr('href');
      return false;
    });

    var $on = $('.leftnav_h a.selected');
    var last_nav = 0;
    
    $($on).parents('ul').each(function(){
        $(this).removeClass('hidden');
        
        var cur = $(this).parent('li').children('div.ul_line').first();
        $(cur).removeClass('ul_line').addClass('ul_line_m');
        $(this).prev('.button').addClass('active');
        $(this).prev('.button').find('.ul_line').removeClass('ul_line').addClass('ul_line_m');
        
        if($(cur).is('.l1') == true){
            $(this).parent('li').addClass('act_nav_line');
        }
    });
    
    $('.ul_line').live('click',function(){
        $(this).removeClass('ul_line').addClass('ul_line_m');
        $(this).parents('li').children('ul').first().slideDown(nav_time)//.removeClass('hidden');
        $(this).parents('.button').addClass('active');
        
        if($(this).is('.l1') == true){
            $(this).parents('li').addClass('act_nav_line');
        }
    });
    
    $('.ul_line_m').live('click',function(){
        $(this).removeClass('ul_line_m').addClass('ul_line');
        $(this).parents('li').children('ul').first().slideUp(nav_time)//.addClass('hidden');
        $(this).parents('.button').removeClass('active');
        
        if($(this).is('.l1') == true){            
            $(this).parents('li').removeClass('act_nav_line');
        }
    });
	
	$('.help').click(function(){
		$('#fon').css('display','block').css('height', $(document).height() + 'px');
		$('#fancy_outer').css('visibility', 'visible');
		return false;
	});
	
    $('#fancy_close').click(function(){
	    $('#fon').css('display','none');
	    $('#fancy_outer').css('visibility', 'hidden');
    });	
	
    $('.search_list').live('click',function(){
        $('.search_list_el').slideToggle(200);
    });
  
    $('.search_list_one').live('click',function(){
        var v = $(this).attr('id');
        var html = $(this).html();

        $('input[name=search_field]').val(v);
        $('.search_tab').html(html)
        $('.search_list_el').slideUp(200);
        });

        $('.search_input .go').live('click',function(){
        $('#search_form').submit();
    });
  
/////////////////////// ENABLE FANCYBOX MODAL WINDOWS /////////////////////////////
  
    $('.show-char').fancybox({
        helpers : {
            title: {
                type: 'inside'
            }
        }
    });
    $('.show-product-image').fancybox();
    
    $("a#image").fancybox();	
    $("a#inline").fancybox({
	    'hideOnContentClick': true
    });
    $("a.group").fancybox({
	    'transitionIn'	:	'elastic',
	    'transitionOut'	:	'elastic',
	    'speedIn'		:	600, 
	    'speedOut'		:	200, 
	    'overlayShow'	:	false
    });
  
///////////////////////////////////////////////////////////////////////////////////


    $('a.add-to-cart-ok').click(function(){
		$(this).parent().prev('table').find('.input_num').dblclick();
		$('a.fancybox-close').click();
	});
    $('a.add-to-cart-cancel').click(function(){
		$('a.fancybox-close').click();
	});
	
    $('a.remove-row').click(function(){
        var input = $(this).parents('tr').find('input.input_num');
        input.val('0');
        change_cart(input,$(this).attr('order_id'));
        return false;
    });
  
///////////////////////////////////////////////////////////////////////////////////

});

$(function() {
    jQuery('#dialog').dialog({
	   height: 70,
       modal: true,
       autoOpen:false
    });
});

function cart_image() {
document.getElementById("cart_image").src="/img/icon-cart-big.png";
setTimeout(function(){ document.getElementById("cart_image").src="/img/icon-cart.png" }, 500);

}

function add_to_cart(num){
    var number = jQuery('#pr' + num).val();
	
    number = parseInt(number);
	
    jQuery.post(siteurl + 'add_to_cart',{'num':num,'number':number},function(data){
        jQuery('#allgoods').html(data.allgoods);
        jQuery('#allsumm').html(data.allsumm);
       //  jQuery('#pr_' + num).html(data.allincart);
	   cart_image();
    }, "json");
}
function add_to_cart_enter(num,event){
	if( event.type == "keypress" && event.keyCode == 13 || event.type == "click" ){
		//var curVal = jQuery('#pr' + num).val();
		//if( curVal != 0 && curVal != '' && curVal != undefined ){
			add_to_cart(num);
		//}		
	}
}


function add_to_cart_char(num, character){
    var number = jQuery('#pr' + num+character).val();

    number = parseInt(number);
	
    jQuery.post(siteurl + 'user/add_to_cart_char',{'num':num,'number':number,'char':character},function(data){
        jQuery('#allgoods').html(data.allgoods);
        jQuery('#allsumm').html(data.allsumm);
        jQuery('#pr_' + num).html(data.allincart);
		cart_image();
    }, "json");
}
function add_to_cart_enter_char(num, character, event){
	//if( event.type == "keypress" && event.keyCode == 13 || event.type == "click" ){
		var curVal = jQuery('#pr' + num + character).val();
		if( curVal != 0 && curVal != '' && curVal != undefined ){
			add_to_cart_char(num, character);
		}		
	//}
}

function change_cart(el,num){
    var number = jQuery(el).val();
   
	jQuery.post(siteurl + 'change_cart',{'num':num,'number':number},function(data){
        if(number == 0){
			var classname =jQuery('#line'+num).attr('class');
			var classsplit = classname.split(' ');
			var cat = classsplit[1];
			jQuery('#line'+num).remove();
			if($("."+cat).length==0) jQuery('#'+cat).remove();
			
        }
        
        jQuery('#l_p' + num).html(data.price);
        jQuery('#allgoods').html(data.allgoods);
        jQuery('#allsumm').html(data.allsumm);
        
        jQuery('#all_pos').html(data.allgoods);
        jQuery('#all_price').html(data.allsumm);
		cart_image();
    },"json");
}
function change_cart_enter(el,num,event){
    if(event.keyCode == 13){
        change_cart(el,num);
    }
}

function plus_cart(guid){
    jQuery.post(siteurl + 'plus_cart',{'guid':guid},function(data){
        jQuery('#allgoods').html(data.allgoods);
		jQuery('#pr' + guid).val(data.number);
        jQuery('#allsumm').html(data.allsumm);
		cart_image();
    }, "json");
}

function minus_cart(guid){
	
	 jQuery.post(siteurl + 'minus_cart',{'guid':guid},function(data){
	 
        jQuery('#allgoods').html(data.allgoods);
		jQuery('#pr' + guid).val(data.number);
        jQuery('#allsumm').html(data.allsumm);
		cart_image();
    },"json");
} 

function char_minus(id) {
var inp = document.getElementById(id);
if(inp.value <=1) {
inp.value = '';
} else {
inp.value--;
}
} 
function char_plus(id) {
var inp = document.getElementById(id);
inp.value++;
}

function comment(){
	var text = $('.comment_text').val();
	jQuery('.comment').val(text);
}

function show_select(id){
	$('.character_all').hide();
	$('.character_overlay').show();
	$('.character_'+id).show();
}

function hide_select(id){
$('.character_overlay').hide();
	$('.character_'+id).hide();
}

function per_page(num){
$.cookie('per_page', num.value, {
path: "/"
});
location.reload();
}



var nav_time = 200; //время в микросекундах

$(document).ready(function() {

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
	    $('.block'+num).show();
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
	
	///////LEFT//////////////////

	$("#navbar").click(function(){
		$("#left").toggleClass("active");
	});
	
	$("#navbar").toggle(function() {
		$('#left').animate({ left: '0' }, { duration: 500, queue: false });
		$('#ct_filter').hide(500);
		$('#left-bg').show(500);
		$('article').animate({ 'margin-left': '280px' }, { duration: 500, queue: false });
		$('article').animate({ 'margin-right': '-280px' }, { duration: 500, queue: false });
	}, function() {       
		$('#left').animate({ left: '-280' }, { duration: 500, queue: false });
		$('#ct_filter').show(500);
		$('#left-bg').hide(500);
		$('article').animate({ 'margin-left': '0' }, { duration: 500, queue: false });
		$('article').animate({ 'margin-right': '0' }, { duration: 500, queue: false });
	}
	);
	$("#left-bg").click(function(){
		$("#left").toggleClass("active");
		$('#left').animate({ left: '-280' }, { duration: 500, queue: false });
		$('#ct_filter').show(500);
		$('#left-bg').hide(500);
		$('article').animate({ 'margin-left': '0' }, { duration: 500, queue: false });
		$('article').animate({ 'margin-right': '0' }, { duration: 500, queue: false });
	});
	
	/////////////////////////////
  
    $('.show-char').fancybox({
		autoSize:false,
		maxWidth: 320,
		width: 320,
		helpers : {
            title: {
                type: 'inside'
            }
        }
    });

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
});

function plus_cart(guid){
    jQuery.post(siteurl + 'mobile/plus_cart',{'guid':guid},function(data){
        jQuery('.goods').html(data.allgoods);
		jQuery('#pr' + guid).html(data.number);
    }, "json");
}

function minus_cart(guid){
	
	 jQuery.post(siteurl + 'mobile/minus_cart',{'guid':guid},function(data){
	 
        jQuery('.goods').html(data.allgoods);
		jQuery('#pr' + guid).html(data.number);
    },"json");
} 

function add_to_cart_char(num, character){
    var number = jQuery('#pr' + num+character).val();

    number = parseInt(number);
	
    jQuery.post(siteurl + 'mobile/add_to_cart_char',{'num':num,'number':number,'char':character},function(data){
        jQuery('.goods').html(data.allgoods);
        jQuery('#pr' + num).html(data.allincart);
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

function change_cart(el,num){
    var number = 0;
   
	jQuery.post(siteurl + 'mobile/change_cart',{'num':num,'number':number},function(data){
        if(number == 0){
			var classname =jQuery('#line'+num).attr('class');
			var classsplit = classname.split(' ');
			var cat = classsplit[1];
			jQuery('#line'+num).remove();
			if($("."+cat).length==0) jQuery('#'+cat).remove();
        }
        
        jQuery('.goods').html(data.allgoods);
        jQuery('.allsumm span').html(data.allsumm);

    },"json");
}

function nav_char(product, num) {
var num1 = parseInt(num)-1;
var num2 = parseInt(num);
$('#char-'+product+' '+'.table-nav .circle').removeClass("active");
$('#char-'+product+' '+'.table-nav .circle'+num).addClass("active");
$('#char-'+product+' '+'.navi').addClass("hidden");
$('#char-'+product+' '+'.col'+num1).removeClass("hidden");
$('#char-'+product+' '+'.col'+num2).removeClass("hidden");

} 

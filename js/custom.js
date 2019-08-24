// set height of cycle
function twitter_text(text) {
	text = text.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/g, function (m) {
		return '<a href="' + m + '" target="_blank">' + m + '</a>';
	});
	// Usernames
	text = text.replace(/@[A-Za-z0-9_]+/g, function (u) {
		return '<a href="http://twitter.com/#!/' + u.replace(/^@/, '') + '" target="_blank">' + u + '</a>';
	});
	// Hashtags
	text = text.replace(/#[A-Za-z0-9_\-]+/g, function (u) {
		return '<a href="http://twitter.com/#!/search?q=' + u.replace(/^#/, '%23') + '" target="_blank">' + u + '</a>';
	});
	
	return text;
}
function onAfterService() {
    var $ht = $(this).height();
    var $wt = $('.service_slider_container').width();
	//set the container's height to that of the current slide
	if ($ht< 50) $ht = 200;
	$(this).parent().css({height: $ht,width:$wt});
} 

function onAfterTwitter(curr, next, opts, fwd) {
	var $ht = $(this).height();
	var $wt= $('#twitter_update_list').width();
	
	$(this).parent().css({height: $ht,width:$wt});
} 

function onAfter(curr, next, opts, fwd) {
	var $ht = $(this).height();
	var $wt= $(this).width();
	
	$(this).css({height: $ht,width:$wt});
} 

$.fn.hasScrollBar = function() {
	alert($(this).get(0).scrollHeight);
	alert($(this).innerHeight());
        return $(this).get(0).scrollHeight > $(this).innerHeight();
}

function hasVerticalScroll(node){
    if(node == undefined){
        if(window.innerHeight){
			//alert('X1 : ' + document.body.offsetHeight);
			//alert('X2 : ' + window.innerHeight);
            return document.body.offsetHeight> innerHeight;
        }
        else {
			return  document.documentElement.scrollHeight > 
                document.documentElement.offsetHeight ||
                document.body.scrollHeight>document.body.offsetHeight;
        }
    }
    else {
        return node.scrollHeight> node.offsetHeight;
    }
}	
//START TWITTER JS

function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><span>'+status+'</span> <a href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');
  }
  document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}

//END TWITTER JS

$(document).ready(function(){
	/* Main Menu */
	
	$('#main_menu').easytabs({
		panelContext: $('#main_content'),
		transitionIn: 'slideDown',
		transitionOut: 'slideUp'
	});
	$('#main_menu').bind('easytabs:after', function() {
		$(window).trigger("scroll");
	});
	
	
	/* Question Answer */
	$('.ul_questions>li .border-center-contain').click(function(){
		$(this).find('.plus_minus').toggleClass('plus_minus_active');
		$(this).parent().find('.answer').toggle();
		$(this).parent().find('.experience').toggleClass('experience_active');
		return false;
	});
	$('.ul_questions .answer_title').click(function(){
		$(this).parent().find('.border-center-contain').trigger('click');
	});
	$('.ul_questions>li:first-child .border-center-contain').trigger('click');
	/* Question Answer 2 */
	$('.ul_questions_2>li .border-center-contain-2').click(function(){
		$(this).find('.plus_minus').toggleClass('plus_minus_active');
		$(this).parent().find('.answer_2').toggle();
		
		return false;
	});
	$('.ul_questions_2 .answer_2_title').click(function(){
		$(this).parent().find('.border-center-contain-2').trigger('click');
	});
	$('.ul_questions_2>li:first-child .border-center-contain-2').trigger('click');
	
	/* Twitter */
	
	/* TWEET 1 */
	$.getJSON('http://api.twitter.com/1/statuses/user_timeline.json?screen_name=wpamanuke&count=5&include_rts=1&callback=?',{})
	.done(function( json ) {
		$.each(json,function(){
			text = this.text;
			text = twitter_text(text);
			$('<div class="slide">').append('<span class="tweet">'+text+'</span>').appendTo('#twitter_update_list_container');
		});
		$('#twitter_update_list_container').cycle({
			fx:'scrollUp',
			timeout:2000,
			pause:true,
			after:onAfterTwitter,
			width: '100%',
			fit: 1
		});
	})
	.fail(function( jqxhr, textStatus, error ) {
		var err = textStatus + ', ' + error;
		console.log( "Request Failed: " + err);
	})
	.always(function() { console.log( "complete" ); });
	

	/*
	$("#twitter_update_list").tweet({
		join_text: "auto",
		username: "wpamanuke",
		avatar_size: null,
		count: 3,
		auto_join_text_default: "", 
		auto_join_text_ed: "",
		auto_join_text_ing: "",
		auto_join_text_reply: "",
		auto_join_text_url: "",
		loading_text: "loading tweets..."
	}).ready(function(){
		alert('');
		$('#twitter_update_list').cycle({fx:'scrollUp'});
		
		/*
		$('#twitter_update_list').vTicker({
		   speed: 500,
		   pause: 3000,
		   showItems: 1,
		   animation: 'fade',
		   mousePause: false,
		   direction: 'down',
		   height: 66
		});
		
	});
	/* TWEET 1 */

	/* PORTFOLIO */
	$('.portfolio_item').live('mouseenter', function() {
		$(this).find('.portfolio_info').show().animate({'top':'0px','display':'block'}, 500);
	});
	$('.portfolio_item').live('mouseleave', function() {
		$(this).find('.portfolio_info').animate({'top':'0%','display':'none'}, 500).hide();
	});
	
	
	//PORTFOLIO AJAX
	$('.portfolio-nav li a').on('click',function() {
		href = $(this).attr('href');
		
		$.ajax({
			type: "GET",
			url: href,
			cache: false,
			beforeSend: function() {
			
			},
			success: function(data){
				$('.portfolio_container').html(data);
				$(".pp_image").colorbox({rel:'pp_image',maxWidth:'100%', maxHeight:'100%'});
				$(".pp_youtube").colorbox({rel:'pp_youtube',iframe:true, innerWidth:425, innerHeight:344});
				$(".pp_vimeo").colorbox({rel:'pp_youtube',maxWidth:'100%', maxHeight:'100%',iframe:true, innerWidth:425, innerHeight:344});

			},
			error : function() {
			
			}
		});
		$('.portfolio-nav').find('.active').removeClass('active');
		$(this).addClass('active');
		return false;
	});
	
	//PORTFOLIO CATEGORY
	$('.ul_portfolio_cat li').on('click',function() {
		$('.ul_portfolio_cat').find('.active').removeClass('active');
		$(this).addClass('active');
		href = $(this).find('a').attr('href');
		
		$.ajax({
			type: "GET",
			url: href,
			cache: false,
			beforeSend: function() {
			
			},
			success: function(data){
				$('.portfolio_container').html(data);
				//COLORBOX
				$(".pp_image").colorbox({rel:'pp_image',maxWidth:'100%', maxHeight:'100%'});
				$(".pp_video").colorbox({rel:'pp_video',maxWidth:'100%', maxHeight:'100%',iframe:true, innerWidth:425, innerHeight:344});
			},
			error : function() {
			
			}
		});
		return false;
	});
	/* PORTFOLIO ENDS */
	
	/* SCROLLBAR */
	//alert(hasVerticalScroll());
	
	//Tooltip
	$(".ul_social_2 li a").tipTip({defaultPosition:'top'});
	$(".ul_social li a").tipTip({defaultPosition:'top'});
	//Placeholder
	$(":input[placeholder]").placeholder();
	
	//Jquery CYCLE
	$('#photo_slider').cycle({
		fx:'scrollUp',
		pager:  '#photo_slider_nav',		
		pagerAnchorBuilder: function(idx, el) {
			return '<a href="#" title="Photo '+ (idx+1) +'"></a>';
		}
	});
	
	$('#service_slider').cycle({
		fx:'scrollUp',
		pager:  '#service_slider_nav',	
		
		containerResize: 1,
		pagerAnchorBuilder: function(idx, el) {
			return '<a href="#" title="Photo '+ (idx+1) +'"></a>';
		},
		after:onAfterService,
		slideResize: 0,
		width: '100%',
		fit: 1
		
	});
	
	
	//PROFILE ICON
	$('.ul_profile_icon li a').on('hover',function(){
		$(this).parent().parent().parent().find('.active').removeClass('active');
		$(this).parent().parent().addClass('active');
	});
	//SUBMIT FORM
	jQuery.validator.addMethod(
		"math", 
		function(value, element, params) { 
			if (value=='')
				return false;
			return this.optional(element) || value == params[0] + params[1]; 
		},
		jQuery.format("Please enter the correct value for {0} + {1}")
	);
	$('#form_contact').validate({
		rules: {
			input_name: {
				minlength: 3,
				required: true
			},
			input_email: {
				required: true,
				email: true
			},
			input_subject: {
				minlength: 3,
				required: true
			},
			input_message: {
				minlength: 10,
				required: true
			},
			input_captcha: {
				math: [3, 4]
			}
		},
		submitHandler: function(form) {
			var a=$('#form_contact').serialize();
			$.ajax({
				type: "POST",
				url: "contact_process.php",
				data:a,
				complete:function(){
				},
				beforeSend: function() {
				
				},
				success: function(data){
					alert(data);
					$('#form_contact').find("input[type=text], textarea").val("");
				},
				error : function() {
				
				}
			});
			return false;
		}
	});
	/*
		$('#form_contact').on('submit', function() {
			var a=$('#form_contact').serialize();
			$.ajax({
				type: "POST",
				url: "contact_process.php",
				data:a,
				complete:function(){
				},
				beforeSend: function() {
				
				},
				success: function(data){
					alert(data);
				},
				error : function() {
				
				}
			});
			return false;
		});
	*/
	//SUBMIT FORM ENDS
	
	//COLORBOX
	$(".pp_image").colorbox({rel:'pp_image',maxWidth:'100%', maxHeight:'100%'});
	$(".pp_video").colorbox({rel:'pp_video',maxWidth:'100%', maxHeight:'100%',iframe:true, innerWidth:425, innerHeight:344});
});


$(window).scroll(function()
{
	
	
	//has vertical scroll
	if (hasVerticalScroll()) 
    {
		temp  = ($(document).height() - window.innerHeight);
		temp2 = (temp - $(window).scrollTop())
		if (3>temp2)
		{
			//$('body').css({'background-color':'#ff0000'});
			$('#nav-scroll-bottom').hide();
		} else {
			//$('body').css({'background-color':'#00ff00'});
			$('#nav-scroll-bottom').show();
			$('#nav-scroll-up').show();
		}
		
		 if ($(window).scrollTop() < 10) {
			$('#nav-scroll-up').hide();
		 }
    } else {
		//$('body').css({'background-color':'#ff0000'});
		$('#nav-scroll-bottom').hide();
		$('#nav-scroll-up').hide();
	}
	
});

$(document).ready(function(){
	$('#nav-scroll-bottom').bind('click',function(){
		 $('html, body')
                .animate({
                scrollTop: $("body")
                    .height()
            },1500);
	});
	$('#nav-scroll-up').bind('click',function(){
		 $('html, body')
                .animate({
                scrollTop: '0'
            },1500);
	});
});

		
$(function() {
  
});
/* ****************************************************************************
	NAIYUMIE KING WANG JJANG Front End Developer <naiyumie@gmail.com>
	FileType:CRLF, Encording:UTF-8, Tab&Space:4/4
	------------------------------------------------------------------------
	추가 라이브러리
**************************************************************************** */
"use strict";

/**************************************************************************************************

	Pagination - 페이지네이션의 width를 결정 한다.

**************************************************************************************************/
	var Pagination = {
		init:function(selector){
			var width = 1;
			$(selector).children().children('li').each(function(){
				width += $(this).outerWidth(true);
			});
			$(selector).children('ul').width(width);
		}
	}


/**************************************************************************************************

	mainVisual - keyvisualFlexSlider wrapper

**************************************************************************************************/

	var keyvisualFlexSlider = {
		count : 0,
		current : 0,
		repeatCounts : 0,
		sliderObj : null,
		// 네비게이션을 세팅한다.
		setNavi:function(){
			keyvisualFlexSlider.count = $('.slides li').length;
			for(var i = 0 ; i < keyvisualFlexSlider.count; i ++){
				var j = i+1;
				$('.navi').append('<li><a href="javascript:void(0)" class="navi_control_items'+i+'" title="'+j+' 번째 슬라이드">'+i+'</a></li>');
			}
		},
		// 네비의 이벤트를 세팅한다.
		naviReActionInit : function(){
			$('.visual-navi').children('ul.navi').children('li').children('a').on('click focus',function(){
				keyvisualFlexSlider.sliderObj.flexslider( parseInt( $(this).text() ) );
			});
		},
		// 슬라이더를 세팅한다.
		sliderInit : function(){
			/*
				animation: "slide",             //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,                //Boolean: Animate slider automatically
				slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 350,         //Integer: Set the speed of animations, in milliseconds
				directionNav: false,            //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Previous",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: false,               //Boolean: Create pause/play dynamic element
				pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
				playText: 'Play',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: true
			*/
			keyvisualFlexSlider.sliderObj = $('.visual-wrap').flexslider({
				animation : "slide",
				directionNav : false,
				controlNav : true,
				animationLoop: true,
				manualControls: "ul.navi li a",
				useCSS: false,
				start : function(slider){
					keyvisualFlexSlider.current = slider.currentSlide;
				},
				before : function(slider){
				},
				after : function(slider){
					keyvisualFlexSlider.current = slider.currentSlide;
					keyvisualFlexSlider.repeatCounts = keyvisualFlexSlider.repeatCounts + 1;
				}
			});

		},

		// 이전 다음 버튼을 세팅한다.
		directionNavInit:function(){
			$('.prev, .next').on('click focus', function(){
				var direction = $(this).attr('class');
				$('.visual-wrap').flexslider(direction);
				return false;
			});
			// 이전 버튼
			$('.visual-navi').children('ul.anchor-prev').children('li.btn-prev').hover(function(){
				$(this).removeClass('normal').addClass('hover');
			}, function(){
				$(this).removeClass('hover').addClass('normal');
			});
			$('.visual-navi').children('ul.anchor-prev').children('li.btn-prev').children('a:first').click(function(){
				$(this).parent().addClass('click');
				$(this).mouseout(function(){
					$(this).parent().removeClass('click').removeClass('hover').addClass('normal');
				});
			});

			//다음 버튼
			$('.visual-navi').children('ul.anchor-next').children('li.btn-next').hover(function(){
				$(this).removeClass('normal').addClass('hover');
			}, function(){
				$(this).removeClass('hover').addClass('normal');
			});
			$('.visual-navi').children('ul.anchor-next').children('li.btn-next').children('a:first').click(function(){
				//console.log('next click;');
				$(this).parent().addClass('click');
				$(this).mouseout(function(){
					$(this).parent().removeClass('click').removeClass('hover').addClass('normal');
				});
			});
		},

		// 세팅 통합
		init:function(){
			keyvisualFlexSlider.setNavi();
			keyvisualFlexSlider.sliderInit();
			keyvisualFlexSlider.naviReActionInit();
			keyvisualFlexSlider.directionNavInit();
		},
		endl:null
	};


/**************************************************************************************************

    Main 아티클 컨텐츠의 탭 구현.

**************************************************************************************************/

	var articlesTab = {
		init:function(object_selector, division_selector, target_selector){
			$(object_selector).addClass('active');
			$(target_selector).hide();
			$(division_selector).show();
		},
		evntBind:function(object_selector, group_selector, target_selector){
			$(object_selector).on('click focus', function(){
				$('[data-group='+group_selector+']').removeClass('active');
				var dtarget = $(this).attr('data-target');
				$(target_selector).hide();
				$('.'+dtarget).show();
				$(this).addClass('active');
				return false;
			});
		},
		endle:null
	};


/**************************************************************************************************

    래디오 그룹.

**************************************************************************************************/
	var RadioGroup = {
		init:function(container_selector, radio_selector){
			$(container_selector).each(function(){
				$(this).removeClass('checked');
			});
			$(radio_selector).each(function(){
				if($(this).prop('checked')){
					$(this).parents(container_selector).addClass('checked');
				}
				$(this).on('click focus',function(){
					$(container_selector).each(function(){
						$(this).removeClass('checked');
					});
					if($(this).prop('checked')){
						$(this).parents(container_selector).addClass('checked');
					}
				});
			});
		},endl:null
	};

	/********************************
	    사인인쪽 타입 선택 구현
	********************************/
		var SignTypeChoose = {
			init:function(radio_selector){
				$('.sign_type').hide();
				$(radio_selector).each(function(){
					if($(this).prop('checked')){
						$(this).parent().next().show();
					}
					$(this).on('click focus',function(){
						$('.sign_type').hide();
						$(this).parent().next().show();
					});
				});
			},
			singlesign:function(radio_selector){
				$(radio_selector).each(function(){
					try{ console.log('xxxx>>'+$(radio_selector + ':checked').val()); }catch(e){}

					if($(radio_selector + ':checked').val() == 'users'){
						$('.single_sign_visual').hide();
						$('.ssv1').show();
					} else {
						$('.single_sign_visual').hide();
						$('.ssv2').show();
					}

					$(this).on('click focus',function(){
						if($(this).prop('checked')){
							if($(this).val() == 'users'){
								$('.single_sign_visual').hide();
								$('.ssv1').show();
							} else {
								$('.single_sign_visual').hide();
								$('.ssv2').show();
							}
						}
					});
				});
			},
			endl:null
		};



/**************************************************************************************************

    체크박스 들.

**************************************************************************************************/

	var CheckBoxes = {
		init:function(selector, checkbox_selector){
			//try{ console.log('selector>>'+selector); }catch(e){}
			//try{ console.log('checkbox_selector>>'+checkbox_selector); }catch(e){}
			if($(checkbox_selector).prop('checked')){
				//try{ console.log('>>checked'); }catch(e){}
				$(selector).addClass('checked');
			} else {
				//try{ console.log('>>unchecked'); }catch(e){}
				$(selector).removeClass('checked');
			}
			$(checkbox_selector).on('click focus', function(){
				//try{ console.log('>>click'+$(checkbox_selector).prop('checked')); }catch(e){}
				if($(checkbox_selector).prop('checked')){
					$(selector).addClass('checked');
				} else {
					$(selector).removeClass('checked');
				}
			});
		}
	}


/**************************************************************************************************

    Main Popup Zone

**************************************************************************************************/

	$.fn.MainPopupZone = function(option) {
		option = option || {};

		var element = $(this);
		var interval = null;
		var current = 0;
		var delay = option.delay ? option.delay : 3000;
		var banner = $(element).children('div.popup').children('ul');
		var size = parseInt($(banner).children('li').size());
		var is_focus = false;
		var is_stop = false;
		var popupzone_functions;
		popupzone_functions = '<ul class="btn-control">';
		popupzone_functions += '    <li><a href="#popupzone" class="btn-pause"><img src="../images/popupzone_remote_pause_n.png" alt="알림판 일시정지" /></a></li>';
		popupzone_functions += '    <li><a href="#popupzone" class="btn-play"><img src="../images/popupzone_remote_play_a.png" alt="알림판 재생" /></a></li>';
		popupzone_functions += '</ul>';
		var popupzone_numbers = '<ul class="popup-navi">';
		var num_src_off_prefix = './../images/popupzone_remote_';
		var num_src_off_suffix = 'n.png';
		var num_src_on_prefix = './../images/popupzone_remote_';
		var num_src_on_suffix = 'a.png';
		var num_src_off;
		var num_src_on;

		if (size == 1) {
			$(banner).css('overflow', 'hidden');
		}
		if (size < 2) {
			return;
		}

		$(banner).css('overflow', 'hidden').children('li').each(function(i) {
			if (i > 0) {
				$(this).hide();
			}

			$(this).children('a:first').focus(function() {
				btn_active('pause');
				is_focus = true;
				clearInterval(interval);
			});
			$(this).children('a:first').blur(function() {
				is_focus = false;
				btn_active('play');
				interval = setInterval(rotate, delay);
			});

			$(this).children('a:first').mouseover(function() {
				btn_active('pause');
				clearInterval(interval);
			});

			$(this).children('a:first').mouseout(function() {
				btn_active('play');
				if (is_focus === true) {
					clearInterval(interval);
				} else if (is_stop === true) {
					clearInterval(interval);
				} else { rotate;
					interval = setInterval(rotate, delay);
				}
			});

		});

		$(element).children('div.popup').before(popupzone_functions);

		$(element).children('ul.btn-control').find('a.btn-play').click(function() {
			is_stop = false;
			interval = setInterval(rotate, delay);
			btn_active('play');
			return false;
		});

		$(element).children('ul.btn-control').find('a.btn-pause').click(function() {
			is_stop = true;
			clearInterval(interval);
			btn_active('pause');
			return false;
		});

		for (var i = 1; i <= size; i++) {
			num_src_off = num_src_off_prefix + i + num_src_off_suffix;
			num_src_on = num_src_on_prefix + i + num_src_on_suffix;
			var href = '#';
			var alt = $(banner).children('li:nth-child(' + (i + 1) + ')').find('img').attr('alt');
			var src = num_src_off;
			if (i == 1) {
				src = num_src_on;
			}
			var cls = '';
			if(i == 1){
				cls = 'active';
			} else {
				cls = '';
			}
			popupzone_numbers += '<li><a href="' + href + '" class="nmb '+cls+'"> '+i+' </a></li>';
		}
		popupzone_numbers += '</ul>';

		$(element).children('div.popup').before(popupzone_numbers);
		$(element).children('ul.popup-navi').children('li').each(function(i) {
			var num = i;

			$(this).click(function() {
				current = num;
				$(banner).children('li').hide();
				$(banner).children('li:nth-child(' + (current + 1) + ')').show();
				$(banner).children('li:nth-child(' + (current + 1) + ')').children('a:first').focus();
				clearInterval(interval);

				for (var j = 1; j <= size; j++) {
					$(element).children('ul.popup-navi').children('li:nth-child(' + j + ')').children('a').removeClass('active');
				}
				$(element).children('ul.popup-navi').children('li:nth-child(' + (current + 1) + ')').children('a').addClass('active');
				//Nlog.puts('current >> ' + (current + 1));

				return false;
			});
		});

		var rotate = function() {
			//Nlog.puts('rotate >> call');
			current++;
			if (current >= size) {
				current = 0;
			}
			$(banner).children('li').hide();
			$(banner).children('li:nth-child(' + (current + 1) + ')').show();

			for (var j = 1; j <= size; j++) {
				$(element).children('ul.popup-navi').children('li:nth-child(' + j + ')').children('a').removeClass('active');
			}

			$(element).children('ul.popup-navi').children('li:nth-child(' + (current + 1) + ')').children('a').addClass('active');
			//Nlog.puts('current >> ' + (current + 1));
		};

		var btn_active = function(mode) {

			if (mode == 'play') {
				$('a.btn-pause').children('img').attr('src', '../images/popupzone_remote_pause_n.png');
				$('a.btn-play').children('img').attr('src', '../images/popupzone_remote_play_a.png');
				//$('.btn-pause').hide();
				//$('.btn-play').show();

			}

			if (mode == 'pause') {
				$('a.btn-pause').children('img').attr('src', '../images/popupzone_remote_pause_a.png');
				$('a.btn-play').children('img').attr('src', '../images/popupzone_remote_play_n.png');
				//$('.btn-pause').show();
				//$('.btn-play').hide();
			}

		}
		interval = setInterval(rotate, delay);

	};


/**************************************************************************************************

    LayoutResizer

**************************************************************************************************/
	var LayoutResizer = {
		singlesign:function(){
			var window_height = $(window).height();
			var header_height = $('.header').outerHeight(true);
			var footer_height = $('.footer').outerHeight(true);
			$('.wrapper .sub .content_wrap2 .in_tbl').height( window_height - (header_height + footer_height) );
		},
		// 하단 footer가 너무 위에 있을 경우
		// innerHeight(창높이) 가 scrollHeight(문서높이) 보다 큰지 아닌지 비교해 보면 알 수 있으며,
		// 이를 픽스 한다.
		content_wrap:function(){
			// 윈도우 높이를 구한다.
			var B = document.body,
				H = document.documentElement,
				wheight;

			if (typeof document.height !== 'undefined') {
				wheight = document.height // For webkit browsers
			} else {
				wheight = Math.max( B.scrollHeight, B.offsetHeight,H.clientHeight, H.scrollHeight, H.offsetHeight );
			}
			// 창높이를 구한다.
			var target_criteria_height = $(window).innerHeight();
			// 여유
			var gap = 100;

			//try{ console.log('target_criteria_height>>'+target_criteria_height); }catch(e){}
			//try{ console.log('wheight>>'+wheight); }catch(e){}
			// 비교한다.
			if( target_criteria_height >= wheight-gap ){
				var window_height = $(window).height();
				var header_height = $('.header').outerHeight(true);
				var footer_height = $('.footer').outerHeight(true)
				var content_wrap_padding = $('.content_wrap').css('padding-bottom');
				content_wrap_padding = parseInt(content_wrap_padding);
				var theight = window_height - (header_height + footer_height) - content_wrap_padding;
				$('.content_wrap').css('min-height',theight+'px');
			}
		},
		endl:null
	};


/**************************************************************************************************

	NavigationActive 네비게이션 활성화

**************************************************************************************************/

	var NavigationActive = {
		init:function(gnb, lnb){
			//try{ console.log('>>'+gnb); }catch(e){}
			//try{ console.log('>>'+lnb); }catch(e){}
			if(gnb != undefined && gnb != ''){
				$(gnb).addClass('active');
			}
			if(lnb != undefined && lnb != ''){
				$(lnb).addClass('active');
			}
		}
	};


/**************************************************************************************************

	아이디 저장 기능
	쿠키에 따른 아이디 저장

**************************************************************************************************/
	var RememberMe = {
		init : function(){
			$('.chk_remember_id').click(function(){
				try{ console.log('remember_me>>'); }catch(e){}
				RememberMe._save_or_destroy();
			});
			$('.inp_id').on('keypress keyup keydown', function(){
				//try{ console.log('>>RememberMe'); }catch(e){}
				RememberMe._save_or_destroy();
			});
		},
		fill_id : function(){
			if($.cookie('id') != null && $.cookie('id') != "null" && $.cookie('id')  != undefined){
				$('input[name="user_id"]').val($.cookie('id'));
				$('input[name="chk_remember_id"]').attr("checked", true);
				$('.remember_id').addClass('checked');
			}
		},
		_save_or_destroy:function(){
			if($('input[name="chk_remember_id"]').is(':checked')){
				try{ console.log('remember_me>>chk'); }catch(e){}
				var id = $('input[name="user_id"]').val();
				try{ console.log('id>>'+id); }catch(e){}
				if(Validation.is_null(id) == false){
					try{ console.log('>>'+id); }catch(e){}
					$.cookie('id', $('input[name="user_id"]').val(), {path:'/'});
				} else {
					$.removeCookie('id');
				}
			} else {
				$.removeCookie('id');
			}
		},
		endl : null
	};

/**************************************************************************************************

	CommentAction
	게시판 수정 / 수정 취소 / 삭제 기능 동작.

**************************************************************************************************/

	var CommentAction = {
		init:function(){
			// 수정
			$('.comment_update_btn').on('click focus',function(){
				var uid = $(this).attr('data-uid');
				var text = $('.comment_content[data-comment-uid='+uid+']').text();
				$('input[name=comment_uid]').val(uid);
				$('input[name=comment_mode]').val('update');
				$('.comment_write_textarea').text(text);
				$('.comment_write_textarea').val(text);
				$('.comment_write_textarea').focus();
				//버튼을 감추고 보여준다.
				$(this).hide();
				$('.comment_update_cancel_btn[data-uid='+uid+']').show();
			});

			// 수정 취소
			$('.comment_update_cancel_btn').on('click focus', function(){
				var uid = $(this).attr('data-uid');
				$('input[name=comment_uid]').val('0');
				$('input[name=comment_mode]').val('create');
				$('.comment_write_textarea').text('');
				$('.comment_write_textarea').val('');
				// 버튼을 감추고 보여준다.
				$(this).hide();
				$('.comment_update_btn[data-uid='+uid+']').show();
			});

			// 삭제
			$('.comment_erase_btn').on('click focus', function(){
				var uid = $(this).attr('data-uid');
				$('input[name=comment_uid]').val(uid);
				$('input[name=comment_mode]').val('erase');
				$('.comment_form').submit();
			});

			// 댓글에 답글
			$('.comment_reply_btn').on('click focus',function(){
				var uid = $(this).attr('data-uid');
				var text = $('.comment_content[data-comment-uid='+uid+']').text();
				$('input[name=comment_parent_uid]').val(uid);
				$('input[name=comment_mode]').val('comment_reply');
				$('.comment_write_textarea').focus();
			});

			// 댓글에 답글에 답글
			$('.comment_reply_for_writer_btn').on('click focus',function(){
				var uid = $(this).attr('data-uid');
				var wuid = $(this).attr('data-writer-uid');
				var text = $('.comment_content[data-comment-uid='+uid+']').text();
				$('input[name=comment_parent_uid]').val(uid);
				$('input[name=comment_mode]').val('comment_reply');
				$('input[name=comment_reply_writer]').val(wuid);
				$('.comment_write_textarea').focus();
			});


		},endl:null
	};
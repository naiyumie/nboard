/**************************************************************************************************

	admin 최종 관리자 구현단.

**************************************************************************************************/
	/***************************************************
		nCalendar : 캘린더 변수 객체
	 ***************************************************/
		var nCalendar = {
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			dateFormat: 'yy-mm-dd',								// 형식(2012-03-03)
			autoSize: false,									// 오토리사이즈(body등 상위태그의 설정에 따른다)
			changeMonth: true,									// 월변경가능
			changeYear: true,									// 년변경가능
			showMonthAfterYear: true,							// 년 뒤에 월 표시
			showOn: "both",										// 엘리먼트와 이미지 동시 사용(both,button)
			yearRange: '1990:2020'								// 1990년부터 2020년까지
		};
		$(document).ready(function() {
			$(".nDatePicker").datepicker(nCalendar);                       //input 객체
			//$("img.ui-datepicker-trigger").attr("style","cursor:pointer;"); //이미지버튼 style적용
			$("button.ui-datepicker-trigger").attr("style","display:none;"); //이미지버튼 style적용
		});


	/********************************
	    nTimePicker : 시간 변수 객체
	********************************/
		var nTimePicker = {
			template: 'modal',
			appendWidgetTo: 'body',
			showSeconds: true,
			showMeridian: false,
			minuteStep: 1,
			secondStep: 1
		};



		$(function(){
			$('.nTimePicker').timepicker(nTimePicker);

			/*$('.nTimePicker').timepicker().on('changeTime.timepicker', function(e) {
				console.log('The time is ' + e.time.value);
				console.log('The hour is ' + e.time.hour);
				console.log('The minute is ' + e.time.minute);
				console.log('The meridian is ' + e.time.meridian);
			});*/

		});

		$(function(){
			$('.backbtn').on('click', function(){
				window.history.back();
				return false;
			});
		});


	/********************************
		manual
	********************************/
		$(function(){
			$('.breadcrumb_help').on('click', function(){
				var uricode = $(this).attr('href');
				uricode = uricode.replace('#','');
				$('.manual_iframe').attr('src','/manual/read/'+uricode);
				$('.curtain').show();
				$('.manual_iframe').show();
				$('html').css({'overflow':'hidden'});
				$('body').on('wheel.modal mousewheel.modal', function () { return false; });
				return false;
			});
			$('.manual_close_button').on('click', function(){
				$('.curtain', window.parent.document).hide();
				$('.manual_iframe', window.parent.document).hide();
				$('body', window.parent.document).off('wheel.modal mousewheel.modal');
				$('html', window.parent.document).css({'overflow':'auto'});
			});
		});


	/********************************
	    체크박스 동작
	********************************/
		$(function(){
			$('.chkc').on('click',function(){
				if($(this).prop('checked')){
					$('.chk').each(function(){
						$(this).parents('span').addClass('checked');
						$(this).attr('checked',true);
					});
				} else {
					$('.chk').each(function(){
						$(this).parents('span').removeClass('checked');
						$(this).removeAttr('checked');
					});
				}
			});
		});


	/********************************
	    submit 바인딩
	********************************/
		$(function(){
			$('.submit').on('click', function(){
				var form_action = $('#form').attr('action');
				form_action = form_action.replace('{mode}','delete_proc');
				$('#form').attr('action', form_action);
				$('#form').attr('onsubmit', '');
				$('#form').submit();
				return false;
			});
			$('.search_submit').on('click', function(){
				var form_action = $('#form').attr('action');
				form_action = form_action.replace('{mode}','lists');
				$('#form').attr('action', form_action);
				$('#form').attr('method','get');
				$('#form').attr('onsubmit', '');
				$('#form').submit();
				return false;
			});
		});


	/********************************
	    카테고리 이동
	********************************/
		$(function(){
			$('.category_choose select').on('change', function(){
				var base_url = $(this).attr('data-base_url');

				location.href= base_url+""+$('.category_choose select option:selected').val()+'/';
			});
		});


	/********************************
		에이젼트에 따른 스코핑
	********************************/
		// AgentFix
		$(function(){
			AgentFix.init();
			AgentFix.linkfix();
		});

	/********************************
	    검색 UI search
	********************************/
		/* 검색 UI 감춘다. */
		var select_hide = function(){
			$('.search_value').attr('name','');
			$('.search_value').add('.search_value_sep').hide();
		};
		/* 검색 UI 보여준다. */
		var select_show = function(selected){
			$('.search_value[data-search_type='+selected+']').show().attr('name','search_value');
			if(selected == 'datetimes'){
				 $('.search_value_start').show().attr('name','search_value_start');
				 $('.search_value_sep').show();
				 $('.search_value_end').show().attr('name','search_value_end');
			}
			$('.search_value').add('.search_value_start').add('.search_value_sep').add('.search_value_end').on('keypress',function(e){
				var p = e.which;
				if(p==13){
					$('.search_submit').trigger('click');
				}
			});
		};
		$(function(){
			var selected = $('select[name=search_key] option:selected').attr('data-search_type');
			select_hide();
			select_show(selected);
			$('select[name=search_key]').on('change', function(){
				selected = $('select[name=search_key] option:selected').attr('data-search_type');
				select_hide();
				select_show(selected);

			});
		});

	/********************************
	    관리자 cleditor
	********************************/
		var cleditor;
		$(function () {
			cleditor = $("#id_content").cleditor({
				width: '101%',
				height: 300,
				controls: "bold italic underline strikethrough | font size style | color highlight removeformat | bullets numbering | image table icon | outdent indent | alignleft center alignright justify | undo redo | rule link unlink | pastetext | print source  ",
				colors: "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C 999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C 666 900 C60 C93 990 090 399 33F 60C 939 333 600 930 963 660 060 366 009 339 636 000 300 630 633 330 030 033 006 309 303",
				fonts: "dotum, gulim, dotumche, gulimche, Malgun Gothic, consolas, Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond, Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
				sizes: "1,2,3,4,5,6,7",
				useCSS:false,
				styles: [["Paragraph", "<p>"], ["Header 4","<h4>"],  ["Header 5","<h5>"], ["Header 6","<h6>"]],
				bodyStyle: "margin:4px; font:12px dotum,Arial,Verdana; color:#333; cursor:text;line-height:20px;",
				docType:'<!doctype html>'
			});
		});
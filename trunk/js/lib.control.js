/* ****************************************************************************
	NAIYUMIE KING WANG JJANG Front End Developer <naiyumie@gmail.com>
	FileType:CRLF, Encording:UTF-8, Tab&Space:4/4
	------------------------------------------------------------------------
	라이브러리 객체 형태로 작성.
**************************************************************************** */
"use strict";

	/***************************************************
	 * Todo : 할일 미리 링크.
	 ***************************************************/
	/*
	*	example)
	*		onclick="Todo.impl(); return false;"
	*/
	var Todo = {
		impl:function(){
			alert('준비중 입니다.');
		}
	};


	/***************************************************
	 * Nlog : 디버그 콘솔에 메시지 출력
	 ***************************************************/
	/*
	*	example)
	*		Nlog.put(var);
	*		Nlog.puts("foo","var");
	*		Nlog.puts(Nlog.var_dump(obj));
	*/
	var Nlog = {
		put : function(param1){
			try{
				console.log(param1);
			} catch(e) {
				return;
			}
		},
		puts : function(param1, param2){
			var locationURL = this.host();

			if(Browser.ie && Browser.ie6 && Browser.ie7) {
				if(param2 == '' || param2 == undefined){
					try{
						alert(''+locationURL+'>>'+param1+'');
					} catch(e) {
						return;
					}
				} else {
					try{
						alert(''+param1+'>>'+param2);
					} catch(e) {
						return;
					}
				}
			} else {
				if(param2 == '' || param2 == undefined){
					try{
						console.log(''+locationURL+'>>'+param1+'');
					} catch(e) {
						return;
					}
				} else {
					try{
						console.log(''+param1+'>>'+param2);
					} catch(e) {
						return;
					}
				}
			}
		},
		cls  : function(){
			try{ console.clear(); }catch(e){}
		},
		var_dump : function(arr, level){
			var var_dumped_text = "";
				if(!level) level = 0;

				//The padding given at the beginning of the line.
				var level_padding = "";
				for(var j=0;j<level+1;j++) level_padding += ">>";

				if(typeof(arr) == 'object') { //Array/Hashes/Objects
					for(var item in arr) {
						var value = arr[item];

						if(typeof(value) == 'object') { //If it is an array,
							var_dumped_text += level_padding + "'" + item + "' ...\n";
							var_dumped_text += Nlog.var_dump(value,level+1);
						} else {
							var_dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
						}
					}
				} else { //Stings/Chars/Numbers etc.
					var_dumped_text = ">>"+arr+"<<("+typeof(arr)+")";
				}
				return var_dumped_text;
		},
		host : function(){
			var Dns;
			Dns=location.href;
			Dns=Dns.split("//");
			Dns="http://"+Dns[1].substr(0,Dns[1].indexOf("/"));
			return Dns;
		}
	};



	/***************************************************
	 * Agent & Browser : 유저에이젼트 관련.
	 ***************************************************/

	var Agent = {
		nUserAgent:window.navigator.userAgent,
		mobileAgent:/iPhone|iPad|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i,
		madeBy:/LG|SAMSUNG|Samsung/,

		isMobile : function(){
			if (Agent.nUserAgent.match(Agent.mobileAgent) != null || Agent.nUserAgent.match(Agent.madeBy) != null){
				return true;
			} else {
				return false;
			}
		}
	};

	//if ((Browser.ie9) || (Browser.ie10)) {
	//if(Browser.ie && Browser.isie && Browser.ie7){}
	// console.log(navigator.userAgent.toLowerCase());
	var Browser = {
	};

	Browser = {
		ie : window.navigator.userAgent.toLowerCase().indexOf('msie') != -1,
		ie6 : window.navigator.userAgent.toLowerCase().indexOf('msie 6') != -1,
		ie7 : window.navigator.userAgent.toLowerCase().indexOf('msie 7') != -1,
		ie8 : window.navigator.userAgent.toLowerCase().indexOf('msie 8') != -1,
		ie9 : window.navigator.userAgent.toLowerCase().indexOf('msie 9') != -1,
		ie10 : window.navigator.userAgent.toLowerCase().indexOf('msie 10') != -1,
		ie11 : window.navigator.userAgent.match(/Trident.*rv:11\./),
		ie8l : function(){ if((!+'\v1')===true){ return true; } },
		opera : !!window.opera,
		safari : window.navigator.userAgent.toLowerCase().indexOf('safari') != -1,
		safari3 : window.navigator.userAgent.toLowerCase().indexOf('applewebkir/5') != -1,
		mac : window.navigator.userAgent.toLowerCase().indexOf('mac') != -1,
		chrome : window.navigator.userAgent.toLowerCase().indexOf('chrome') != -1,
		firefox : window.navigator.userAgent.toLowerCase().indexOf('firefox') != -1,
		//ie전용 css 스코핑 확보를 위한 코드.
		iePageScopeFix : function(){
			if(navigator.userAgent.match(/Trident.*rv:11\./)) {
				$('body').addClass('ie11');
				$('body').addClass('ie');
			}
		}
	};

	/***************************************************
	 * Mover : 페이지 리디렉션
	 ***************************************************/
	/*
	*	example)
	*		Mover.href('index.html');
	*/
	var Mover = {
		//이동(크로스 브라우징)...(히스토리에 남음)
		href : function(urlParam) {
			document.location.href = urlParam;
		},
		//이동(크로스 브라우징)...(히스토리에 남지않음)
		replace : function(urlParam) {
			window.location.replace(urlParam);
		},
		//부모창의 이동(크로스 브라우징)...(히스토리에 남지않음)
		parent_replace : function(urlParam) {
			parent.location.replace(urlParam);
		},
		parent_reload : function(){
			parent.location.reload();
		},
		parent_reload_param : function(urlParam){
			//var sphone_uri = $("#sphone").attr('src');
			//$("#sphone").attr('src', sphone_uri);
			parent.location.replace('../'+INDEX_FILE+urlParam);
		},
		opener_replace : function(urlParam){
			opener.location.replace(urlParam);
		},
		//이동(크로스 브라우징)...href와 하는 역할은 똑같음.
		//인자 url      : 리디렉션 할 경로
		redirect : function(url) {
			if(new RegExp(/MSIE/).test(navigator.userAgent)) {
				document.location.href(url);
			} else if(new RegExp(/Firefox/).test(navigator.userAgent)) {
				document.location.replace(url);
			} else if(new RegExp(/Chrome/).test(navigator.userAgent)){
				document.location.replace(url);
			} else {
				document.location.replace(url);
			}
		},
		//페이지를 새로고침 합니다.
		refresh : function() {
			location.reload();
		},
		//뒤로
		back : function() {
			window.history.go(-1);
		},
		home : function(){
			document.location.href = INDEX_FILE;
		},
		home_param :function(param){
			document.location.href = INDEX_FILE+param;
		},
		admin_home : function(){
			document.location.href = ADMIN_INDEX_FILE;
		},
		admin_home_param :function(param){
			document.location.href = ADMIN_INDEX_FILE+param;
		},
		//아이프레임 src 컨트롤.
		redirect_child : function(obj, url){
			$(obj).attr("src", url);
		}
	};




	/***************************************************
	 * WindowCloser : 윈도우 창을 닫음.
	 *                구글크롬 관련 버그 수정 됨.
	 ***************************************************/
	/*
	*	onclick="WindowCloser.close_with_msg('얼럿!');"
	*/
	var WindowCloser = {
		close : function(){
			window.open('','_self').close();
			window.close();
		},
		close_with_msg : function(param){
			alert(param);
			WindowCloser.close();
		}
	};




	/***************************************************
	 * WinPopup : 팝업을 띄우고 감추기
	 *         의존성 WindowCloser
	 ***************************************************/
	/*
	*	example)
	*		onclick="WinPopup.open('./p.php','p2', '450','330'); return false;"
	*/
	var WinPopup = {
		//일반적인 팝업창을 오픈 합니다.
		open : function(html_uri, pop_up_name, option_width, option_height, option_selection){
			var popupObject = null;
			var option  = "width="       + option_width                      +","
				option += "height="      + option_height                     +","
				option += "left="        + (screen.width - option_width)/2   +","
				option += "top="         + (screen.height - option_height)/2 +",";

			if(option_selection == 'yes' || option_selection == 'y'){
				option += "fullscreen=no, location=no, scrollbars=yes, menubar=no, toolbar=no, titlebar=no, directories=no, resizable=yes";
			} else if(option_selection == 'no' || option_selection == 'n'){
				option += "fullscreen=no, location=no, scrollbars=no, menubar=no, toolbar=no, titlebar=no, directories=no, resizable=no";
			} else {
				option += option_selection;
			}

			popupObject = window.open(html_uri,pop_up_name, option);
		},
		//윈도우 IE전용 모달창을 오픈 합니다.
		modal : function(html_uri, modalArgs, option_width, option_height){
			var modalObject = null;
			if(modalArgs == "") {
				var modalArgs = new Array();
				modalArgs["dummy"] = "dummy";
			}
			modalObject = window.showModalDialog(url, modalArgs, 'dialogWidth:'+option_width+'px; dialogHeight:'+option_height+'px; center:yes; help:no; status:no; scroll:no; resizable:no');
		},
		close : function(){
			WindowCloser.close();
		}
	};


	/***************************************************
	 * LayerPopup : 레이어 팝업
	 ***************************************************/
	/*
	*	example)
	*		onclick="LayerPopup.open($(this).attr('id')); return false;"
	*/
	/*
		을 위한 함수.
		커텐을 띄우고 팝업을 보여준다.
	*/
	var LayerPopup = {
		close:function(){
			$('.modal').remove();
			$('.curtain').css({'display':'none'});

			// 스크롤 가능 상태로 만듬.
			$('body').off('wheel.modal mousewheel.modal');
			$('html').css({'overflow':'auto'});
		},
		open:function(id){
			var id;
			if(id =='npop_a01'){
				//커텐을 켠다.
				$('.curtain').css({
					'display' : 'block',
					'width' : $(window.document).width() + 'px',
					'height': $(window.document).height() + 'px'
				});

				var popupSample = $('.'+id).html();
				var popupSampleHtml = $(popupSample).addClass('modal');
				$('.curtain').before( popupSampleHtml );
				LayerPopup.setPos();

				//스크롤 불가 상태로 만듬.
				$('html').css({'overflow':'hidden'});
				$('body').on('wheel.modal mousewheel.modal', function () { return false; });


				$(window).resize(function(){
					LayerPopup.setPos();
				});
			}
		},
		setPos:function(){
			$('.popup.layer').css({
				'top' : $(window).scrollTop() + 'px',
				'margin-top' : ($(window).height()/2) - ( $('.popupinner').height() /2 ) + 'px',
				'left' : ($(window).width()/2) - ( $('.popupinner').width() /2 ) + 'px'
			});
		}
	};


	/***************************************************
	 * UIControl : UI제어 관련
	 ***************************************************/
	/*
	*	example)
	*		onclick="CheckboxControl.toggle_check_all('#chkctr','.chk');"
	*		onclick="CheckboxControl.get_checked_values('.chk');"
	*		<input type="checkbox" id="chkctr" value="" onclick="CheckboxControl.toggle_check_all('#chkctr','.chk');" />
	*		<input type="checkbox" id="chk<?=$v['m_uid']?>" class="chk" value="<?=$v['m_uid']?>" />
	*/
	var CheckboxControl = {
		//image checkbox ui
		enable:function(obj){
			$(obj).val('Y');
			$(obj).attr("checked", "checked");
			$(obj).unbind('click');
			$(obj).bind('click', function(e){
				CheckboxControl.disenable(obj);
			});
		},
		disenable:function(obj){
			$(obj).val('N');
			$(obj).unbind('click');
			$(obj).bind('click', function(e){
				CheckboxControl.enable(obj);
			});
		},
		//normal checkbox ui
		toggle_check_all:function(chkctr, chk){
			if($(chkctr).is(":checked")) {
				//Nlog.puts("checked t");
				$(chk).each(function(i){
					//Nlog.puts(i);
					$(this).attr("checked","");
					$(this).attr("checked","checked");
				});
			} else {
				//Nlog.puts("checked f");
				$(chk).each(function(i){
					$(this).attr("checked","");
					$(this).removeAttr("checked");
				});
			}
		},
		get_checked_values:function(chk){
			var chkVal = "";
			$(""+chk+":checked").each(function(){
				chkVal += $(this).val()+"|";
			});
			Nlog.puts(chkVal);
			return chkVal;
		},
		//todo
		reverse:function(chkName){
			$("input:checkbox[name="+chkName+"]:checked").each(function(i){
				$(this).attr("checked","");
			});

		}
	};




	/***************************************************
	 * nCalendar : 캘린더 변수 객체
	 * 의존성 : jquery-ui-1.9.1.custom.min.js
	 ***************************************************/
	/*
	*	example)
	*		$(document).ready(function() {
	*			$("#search_start").datepicker(nCalendar);                       //input 객체
	*			$("img.ui-datepicker-trigger").attr("style","cursor:pointer;"); //이미지버튼 style적용
	*			$("#ui-datepicker-div").hide();                                 //자동으로 생성되는 div객체 숨김
	*		});
	*/
	var nCalendar = {
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',								// 형식(2012-03-03)
		autoSize: false,									// 오토리사이즈(body등 상위태그의 설정에 따른다)
		changeMonth: true,									// 월변경가능
		changeYear: true,									// 년변경가능
		showMonthAfterYear: true,							// 년 뒤에 월 표시
		buttonImageOnly: true,								// 이미지표시
		buttonText: '캘린더 선택',							// 버튼 텍스트 표시
		buttonImage: IMG_ASSETS_DIR+'ncalendar.png',		// 이미지주소
		showOn: "both",										// 엘리먼트와 이미지 동시 사용(both,button)
		yearRange: '1990:2020'								// 1990년부터 2020년까지
	};





	/***************************************************
	 * Keyboard : 키보드 제어 관련
	 ***************************************************/
	/*
	*	example)
	*		onfocus="Keyboard.enter($(this), $('#sign_btn'));"
	*/
	var Keyboard = {
		frame_refresh:function(obj){
			document.getElementById(obj).contentDocument.location.reload(true);
		},
		enter:function(bind_object, target_object){
			$(bind_object).bind('keypress blur', function(){
				if(typeof(e) != "undefiend") {
					if(event.keyCode == "13") $(target_object).trigger('click');
				} else {
					if(e.which == "13") $(target_object).trigger('click');
				}
				return;
			});
			e.preventDefault;
		}
	};




	/***************************************************
	 * StartFocus : 페이지 시작시 포커싱
	 ***************************************************/
	/*
	*	example)
	*		$(document).ready(function() {
	*			Focusing.init_focus("#target");
	*		});
	*/
	var Focusing = {
		init_focus:function(obj){
			$(obj).focus();
		},
		init_focus_formx:function() {
			var obj = document.forms.formx;
			var arr = new Array("id");
			obj.elements[0].focus();

			document.onkeydown = keyDown;
		}
	};




	/***************************************************
	 * AjaxAction : 데이터 트랜잭션 및 ajax 호출
	 ***************************************************/
	/*
	*	example)
	*		AjaxAction.call({
	*			"url" : {throw_url:"call.php"},
	*			"val" : {variable1:"hello",variable2:"world"},
	*			"callback" : {func_success:Action.signincheck_callback_success,func_failed:Action.signincheck_callback_failed}
	*		});
	*/
	var AjaxAction = {
		call:function(args){
			//try{console.log("0>>" + args)}catch(e){}
			//try{console.log("1>>" + args.url)}catch(e){}
			//try{console.log("2>>" + args.url.throw_url)}catch(e){}
			//try{console.log("3>>" + args.val)}catch(e){}
			//try{console.log("4>>" + args.val.variable1)}catch(e){}
			//try{console.log("5>>" + args.val.variable2)}catch(e){}
			//try{console.log("6>>" + args.callback)}catch(e){}
			//try{console.log("7>>" + args.callback.func)}catch(e){}
			try {
				$.ajaxSetup({dataType:"text"});
				$.post(args.url.throw_url, args.val, function(request){
					request_parse = jQuery.parseJSON(request);
					request_state = request_parse.result;
					if(request_state == "success"){
						//try{console.log("response request_state>>"+request_state)}catch(e){}
						//try{console.log("response request_parse.variable1>>"+request_parse.variable1)}catch(e){}
						//try{console.log("response request_parse.variable2>>"+request_parse.variable2)}catch(e){}
						args.callback.func_success(request_parse);
						return false;
					} else {
						//try{console.log("response exception")}catch(e){}
						args.callback.func_failed(request_parse);
						return false;
					}
				});
			} catch(e) {
				this.error();
			}
			return false;
		},
		//signinout_callback_success:function(){
		//	alert("로그아웃 되었습니다.");
		//	Mover.home();
		//},
		//change_class_success:function(){
		//	Mover.href('/sphone/sphone_board_list.htm?page=0&cb_kind=');
		//	Mover.parent_reload();
		//},
		//example.
		error:function(){
			alert("exception error");
		},
		callback:function(args1, args2){
			alert("callback function calling!");
			//try{console.log("callback args1>>"+args1)}catch(e){}
			//try{console.log("callback args2>>"+args2)}catch(e){}
		},
		null_call_back:function(){
			return;
		}
	};




	/***************************************************
	 * Action & PageAction : 페이지 밸리데이션
	 ***************************************************/
	/*
	*	comment)
	*		var PageAction = {
	*			validate:function(){
	*				var check = [
	*					Validation.check_is_null("#name", "name을 입력 하세요."),
	*					Validation.check_is_null("#name_eng", "name_eng을 입력 하세요."),
	*					Validation.check_is_do_not_chooesed("enable", "enable을 선택 하세요."),
	*					Validation.check_is_null_textarea("#description", "description을 입력 하세요.")
	*				];
	*				return Validation.check(check);
	*			}
	*		}
	*		<form id="form1" name="form1" method="post" action="" onsubmit="return PageAction.validate();">
	*		</form>
	*/
	var Action = {
		validate:function(){
			$("#sign_form").submit();
		}
	};

	var PageAction = {
		validate:function(){
			return true;
		}
	};




	/***************************************************
	 * Validation : 밸리데이션
	 ***************************************************/
	/*
	*	example)
	*		var obj = "#target";
	*		var obj2 = "#target2";
	*		//널인지 처리
	*		if(Validation.is_null($(obj).val()) == true){
	*			Validation.msg(Validation.msg_phone_null);
	*			$(obj).focus();
	*			return false;
	*		}
	*		//휴대폰 형식이 맞는지 처리
	*		if(Validation.is_phone($(obj).val()) == false){
	*			Validation.msg(Validation.msg_phone);
	*			$(obj).focus();
	*			return false;
	*		}
	*		//이메일 형식이 맞는지 처리
	*		if(Validation.is_email($(obj).val()) == false){
	*			Validation.msg(Validation.msg_email);
	*			$(obj).focus();
	*			return false;
	*		}
	*		//아이디 혹은 패스워드가 형식에 맞는지 처리
	*		if(Validation.is_idpw($(obj).val()) == false){
	*			Validation.msg("비밀번호 확인 형식이 올바르지 않습니다. 숫자와 영문, 특수문자로 이루어진 6~20자 사이의 값을 입력 주시기 바랍니다.");
	*			$(obj).focus();
	*			return false;
	*		}
	*		//값과 값의 확인이 일치하는지 처리
	*		if(Validation.is_equal($(obj).val(), $(obj2).val()) == false){
	*			Validation.msg(Validation.msg_is_equal);
	*			$(obj).focus();
	*			return false;
	*		}
	*		//이용약관 체크 여부
	*		if($(obj).is(":checked") != true){
	*			Validation.msg("이용약관 동의에 체크 해 주시기 바랍니다.");
	*			$(obj).focus();
	*			return false;
	*		}
	*/
	var Validation = {
		regexp_email	: /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i,
		regexp_phone	: /^\d{3}\d{3,4}\d{4}$/,
		regexp_idpw		: /^[a-z0-9_!#$%^&*()?+=\/]{6,20}$/,

		msg_email		: "이메일 형식이 올바르지 않습니다. 올바른 이메일을 입력해 주시기 바랍니다.",
		msg_phone		: "휴대전화 형식이 올바르지 않습니다.",
		msg_idpw		: "비밀번호 형식이 올바르지 않습니다. 숫자와 영문, 특수문자로 이루어진 6~20자 사이의 값을 입력 주시기 바랍니다.",
		msg_idpw_null	: "비밀번호 정보가 누락되었습니다. 비밀번호를 입력해 주시기 바랍니다.",
		msg_email_null	: "이메일 정보가 누락 되었습니다. 이메일을 입력해 주시기 바랍니다.",
		msg_phone_null	: "휴대전화 번호 정보가 누락 되었습니다. 휴대전화 번호를 입력해 주시기 바랍니다.",
		msg_is_equal	: "값이 일치 하지 않습니다.",
		msg:function(p_obj){
			alert(p_obj);
		},
		check:function(check){
			Nlog.puts(check);
			for(var key in check){
				var val  = check[key];
				if(val == false){
					return false;
				}
			}
			return true;
		},

		check_is_null:function(obj, msg){
			if(Validation.is_null($(obj).val()) == true){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_email:function(obj, msg){
			if(Validation.is_email($(obj).val()) == false){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_phone:function(obj, msg){
			if(Validation.is_phone($(obj).val()) == false){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_idpw:function(obj, msg){
			if(Validation.is_idpw($(obj).val()) == false){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_equal:function(obj1, obj2, msg){
			if(Validation.is_equal($(obj1).val(), $(obj2).val()) == false){
				Validation.msg(msg);
				$(obj1).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_checked:function(obj, msg){
			if(Validation.is_checked($(obj)) == false){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_null_textarea:function(obj, msg){
			if(Validation.is_null_textarea($(obj)) == true){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_do_not_chooesed:function(radio_name, msg){
			if(Validation.is_do_not_chooesed(radio_name) == true){
				Validation.msg(msg);
				$('input:radio[name="'+radio_name+'"]').focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_do_not_select:function(obj, msg){
			if(Validation.is_do_not_select(obj) == true){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		//Validation.check_is_lowerthan($('#t1'), 100, '값이 작습니다.'),
		//Validation.check_is_higherthan($('#t2'), 100, '값이 큽니다.')
		check_is_lowerthan:function(obj, num, msg){
			if(Validation.is_lowerthan(obj, num) == true){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		check_is_higherthan:function(obj, num, msg){
			if(Validation.is_higherthan(obj, num) == true){
				Validation.msg(msg);
				$(obj).focus();
				return false;
			} else {
				return true;
			}
		},
		//Validation.check_is_allow_file('test', 'image')
		check_is_allow_file:function(obj,option) {
			file_name = document.getElementById(obj).value;
			var all = /.+.(jpg|jpeg|jpe|gif|png|pdf|bmp|psd|tiff|eps|pcx|raw|pct|pict|pxr|fla|swf|as|txt|rtf|rtfd|doc|docx|hwp|ppt|xlsx|xls|xml|html|htm|pdf|zip|alz|lzh|jar|tar|tgz|bh|sitx|JPG|JPEG|JPE|GIF|PNG|PDF|BMP|PSD|TIFF|EPS|PCX|RAW|PCT|PICT|PXR|FLA|SWF|AS|TXT|RTF|RTFD|DOC|DOCX|HWP|PPT|XLSX|XLS|XML|HTML|HTM|PDF|ZIP|ALZ|LZH|JAR|TAR|TGZ|BH|SITX)/;
			var image = /.+.(jpg|jpeg|jpe|gif|png)/;
			var doc = /.+.(doc|docx|hwp|rtf|txt)/;
			var regexp = option;
			if (file_name.match(regexp)) {
				return true;
			} else {
				alert("허용되지 않는 확장자 입니다. 파일을 확인 하십시오.");
				return false;
			}
		},
		is_null:function(p_val){
			var p_val = $.trim(p_val);
			if(p_val == '' || p_val == undefined){
				//Nlog.puts("Validation.is_null>>",'true');
				return true;
			} else {
				//Nlog.puts("Validation.is_null>>",'false');
				return false;
			}
		},
		is_email:function(p_val){
			var regexp = this.regexp_email;
			if(regexp.test(p_val) == true){
				//Nlog.puts("Validation.is_email>>",'true');
				return true;
			} else {
				//Nlog.puts("Validation.is_email>>",'false');
				return false;
			}
		},
		is_phone:function(p_val){
			var regexp = this.regexp_phone;

			var p_val_num = p_val.replace(/-/gi,"");
			//Nlog.puts("Validation.is_phone>>", p_val_num);
			if(p_val_num.length <= 11 && p_val_num.length >= 10){
				if(regexp.test(p_val_num) == true){
					//Nlog.puts("Validation.is_phone>>",'true');
					return true;
				} else {
					//Nlog.puts("Validation.is_phone>>",'false');
					return false;
				}
			} else {
				//Nlog.puts("Validation.is_phone>>",'false p_val.length less or higher');
				return false;
			}
		},
		is_idpw:function(p_val){
			var regexp = this.regexp_idpw;
			if(regexp.test(p_val) == true){
				//Nlog.puts("Validation.is_idpw>>",'true');
				return true;
			} else {
				//Nlog.puts("Validation.is_idpw>>",'false');
				return false;
			}
		},
		is_equal:function(p1, p2){
			if(p1 == p2){
				return true;
			} else {
				return false;
			}
		},
		is_checked:function(chkctr){
			if($(chkctr).is(":checked") == true){
				return true;
			} else {
				return false;
			}
		},
		is_null_textarea:function(p1){
			if($.browser.safari == true){
				var p1 = $(p1).val();
			} else {
				var p1 = $(p1).text();
			}
			//Nlog.puts("Validation.is_null_textarea>>", p1);
			var p = $.trim(p1);
			if(p == '' || p == undefined){
				return true;
			} else {
				return false;
			}
		},
		is_do_not_chooesed:function(radio_name){
			var val = $('input:radio[name="'+radio_name+'"]:checked').val();
			//Nlog.puts(val);
			if(val == '' || val == undefined){
				return true;
			} else {
				return false;
			}
		},
		is_do_not_select:function(p1){
			var a = $(p1 + " > option:selected").val();
			//Nlog.puts(a);
			if(a == '' || a == undefined){
				return true;
			} else {
				return false;
			}
		},
		is_lowerthan:function(p1,p2){
			var val = $.trim( $(p1).val() );
			Nlog.puts(val);
			Nlog.puts(p2);
			if( val < p2){
				return true;
			} else {
				return false;
			}
		},
		is_higherthan:function(p1,p2){
			var val = $.trim( $(p1).val() );
			Nlog.puts(val);
			Nlog.puts(p2);
			if( val > p2){
				return true;
			} else {
				return false;
			}
		}
	};




	/***************************************************
	 * StringUtil : 스트링 유틸
	 ***************************************************/
	/*
	*	example)
	*		<textarea onkeyup="StringUtil.num_count($(this), $('#target_text'), 150);" name="class_infomation" id="class_infomation" cols="82" rows="5" class="rn">text</textarea>
	*		<span id="target_text">0/150</span>
	*/
	var StringUtil = {
		num_count:function(obj, target, maxlen){
			var chk = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_0123456789\~!@#$%^&*()_+| ";
			var len = 0;

			if($.browser.safari == true){
				var str = $(obj).val();
			} else {
				var str = $(obj).text();
			}

			for(var i = 0; i < str.length; i++){
				if(chk.indexOf(str.charAt(i)) >= 0 ){
					len++;
				} else {
					len+=2;
				}
			}

			if(len >= maxlen){
				alert("이용하신 글이 너무 깁니다. " + maxlen + "자 보다 짧게 입력 해주시기 바랍니다.");

				if($.browser.safari == true){
					var str2 = $(obj).val( this.cut_str(str, maxlen-1, false) );
				} else {
					var str2 = $(obj).text( this.cut_str(str, maxlen-1 , false) );
				}

				len2 = 0;
				for(var i = 0; i < str2.length; i++){
					if(chk.indexOf(str2.charAt(i)) >= 0 ){
						len2++;
					}else{
						len2+=2;
					}
				}
				$(target).text( len2 + "/" + maxlen );
				return;

			} else {
				$(target).text( len + "/" + maxlen );
				return;
			}
		},
		//private
		chr_byte:function(chr){
			if(escape(chr).length > 4)      return 2;
			else                            return 1;
		},
		cut_str:function(str, limit, is_dot_enable){
			var tmpStr = str;
			var byte_count = 0;
			var len = str.length;
			var dot = "";

			for(i=0; i<len; i++){
				byte_count += this.chr_byte(str.charAt(i));
				if(byte_count == limit-1){
					if(this.chr_byte(str.charAt(i+1)) == 2){
						tmpStr = str.substring(0,i+1);
						dot = "...";
					} else {
						if(i+2 != len) dot = "...";
						tmpStr = str.substring(0,i+2);
					}
					break;
				} else if(byte_count == limit){
					if(i+1 != len) dot = "...";
					tmpStr = str.substring(0,i+1);
					break;
				}
			}

			if(is_dot_enable == true){
				var ret = (tmpStr+dot);
			} else {
				var ret = tmpStr;
			}
			return ret;
		},
		//1,000 단위로 콤마를 찍어줌
		commity:function(num){
			var reg = /(^[+-]?\d+)(\d{3})/;
			num +='';
			while(reg.test(num))
				num = num.replace(reg, '$1' + ',' + '$2');
			return num;
		}
	};




	/***************************************************
	 * ValueControl : pure javascript only validation.
	 ***************************************************/
	var ValueControl = {

		/**
		* 입력값이 NULL인지 체크
		*/
		is_null:function(input) {
			if (input.value == null || input.value == "") {
				return true;
			}
			return false;
		},

		/**
		* 입력값에 스페이스 이외의 의미있는 값이 있는지 체크
		* ex) if (ValueControl.is_empty(form.keyword)) {
		*         alert("검색조건을 입력하세요.");
		*     }
		*/
		is_empty:function(input) {
			if (input.value == null || input.value.replace(/ /gi,"") == "") {
				return true;
			}
			return false;
		},

		/**
		* 입력값에 특정 문자(chars)가 있는지 체크
		* 특정 문자를 허용하지 않으려 할 때 사용
		* ex) if (ValueControl.contains_chars(form.name,"!,*&^%$#@~;")) {
		*         alert("이름 필드에는 특수 문자를 사용할 수 없습니다.");
		*     }
		*/
		contains_chars:function(input,chars) {
			for (var inx = 0; inx < input.value.length; inx++) {
				if (chars.indexOf(input.value.charAt(inx)) != -1)
					return true;
			}
			return false;
		},

		/**
		* 입력값이 특정 문자(chars)만으로 되어있는지 체크
		* 특정 문자만 허용하려 할 때 사용
		* ex) if (!ValueControl.contains_chars_only(form.blood,"ABO")) {
		*         alert("혈액형 필드에는 A,B,O 문자만 사용할 수 있습니다.");
		*     }
		*/
		contains_chars_only:function(input,chars) {
			for (var inx = 0; inx < input.value.length; inx++) {
				if (chars.indexOf(input.value.charAt(inx)) == -1)
					return false;
			}
			return true;
		},

		/**
		* 입력값이 알파벳인지 체크
		* 아래 is_alphabet() 부터 is_upper_case()까지의 메소드가
		* 자주 쓰이는 경우에는 var chars 변수를 global 변수로 선언하고 사용하도록 한다.
		* ex) var uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		*     var lowercase = "abcdefghijklmnopqrstuvwxyz";
		*     var number    = "0123456789";
		*     isAlphaNum(input) {
		*         var chars = uppercase + lowercase + number;
		*         return containsCharsOnly(input,chars);
		*     }
		*/
		is_alphabet:function(input) {
			var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 알파벳 대문자인지 체크
		*/
		is_upper_case:function(input) {
			var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 알파벳 소문자인지 체크
		*/
		is_lower_case:function(input) {
			var chars = "abcdefghijklmnopqrstuvwxyz";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값에 숫자만 있는지 체크
		*/
		is_number:function(input) {
			var chars = "0123456789";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 알파벳,숫자로 되어있는지 체크
		*/
		is_alpha_num:function(input) {
			var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 숫자,대시(-)로 되어있는지 체크
		*/
		is_num_dash:function(input) {
			var chars = "-0123456789";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 숫자,콤마(,)로 되어있는지 체크
		*/
		is_num_comma:function(input) {
			var chars = ",0123456789";
			return ValueControl.contains_chars_only(input,chars);
		},

		/**
		* 입력값이 사용자가 정의한 포맷 형식인지 체크
		* 자세한 format 형식은 자바스크립트의 `regular expression`을 참조
		*/
		is_valid_format:function(input,format) {
			if (input.value.search(format) != -1) {
				return true; //올바른 포맷 형식
			}
			return false;
		},

		/**
		* 입력값이 이메일 형식인지 체크
		* ex) if (!ValueControl.is_valid_email(form.email)) {
		*         alert("올바른 이메일 주소가 아닙니다.");
		*     }
		*/
		is_valid_email:function(input) {
			//var format = /^(\S+)@(\S+)\.([A-Za-z]+)$/;
			var format = /^((\w[\-\.])+)@((\w[\-\.])+)\.([A-Za-z]+)$/;
			return ValueControl.is_valid_format(input,format);
		},

		/**
		* 입력값이 전화번호 형식(숫자-숫자-숫자)인지 체크
		*/
		is_valid_phone:function(input) {
			var format = /^(\d+)-(\d+)-(\d+)$/;
			return ValueControl.is_valid_format(input,format);
		},

		/**
		* 입력값의 바이트 길이를 리턴
		* ex) if (ValueControl.get_byte_length(form.title) > 100) {
		*         alert("제목은 한글 50자(영문 100자) 이상 입력할 수 없습니다.");
		*     }
		*/
		get_byte_length:function(input) {
			var byteLength = 0;
			for (var inx = 0; inx < input.value.length; inx++) {
				var oneChar = escape(input.value.charAt(inx));
				if ( oneChar.length == 1 ) {
					byteLength ++;
				} else if (oneChar.indexOf("%u") != -1) {
					byteLength += 2;
				} else if (oneChar.indexOf("%") != -1) {
					byteLength += oneChar.length/3;
				}
			}
			return byteLength;
		},

		/**
		* 입력값에서 콤마를 없앤다.
		*/
		remove_comma:function(input) {
			return input.value.replace(/,/gi,"");
		},

		/**
		* 선택된 라디오버튼이 있는지 체크
		*/
		has_checked_radio:function(input) {
			if (input.length > 1) {
				for (var inx = 0; inx < input.length; inx++) {
					if (input[inx].checked) return true;
				}
			} else {
				if (input.checked) return true;
			}
			return false;
		},

		/**
		* 선택된 체크박스가 있는지 체크
		*/
		has_checked_box:function(input) {
			return ValueControl.hasCheckedRadio(input);
		}

	};




	/***************************************************
	 * Picker : 돔을 잡습니다
	 ***************************************************/
	var Picker = {
		//엘레멘트를 기준으로 돔을 피킹 합니다.
		element:function(element) {
			if(document.getElementById(element)){
				return true;
			} else {
				return false;
			}
		},
		//아이디로 돔을 피킹 합니다.
		dom_id : function(element){
			return document.getElementById(element);
		},
		//네임으로 돔을 피킹 합니다.
		dom_name : function(element){
			return document.getElementByName(element);
		}
	};

	//델리게이트 패턴 $$를 document.getElementById()로 사용 합니다.
	//jQuery가 동작 하지 않을 예외 상황에 사용 됩니다.
	var $$           = Picker.dom_id;
	var $$$          = Picker.dom_name;
	var $$$$         = Picker.element;
	var pick_id      = Picker.dom_id;
	var pick_name    = Picker.dom_name;
	var pick_element = Picker.element;



	/***************************************************
	 * Alert : 얼럿을 관리 합니다.
	 ***************************************************/
	/*
	* 메세지 출력 여부.
	* example)
	*	onclick="Alert.msg('안녕세상'); return false;"
	*/
	var theAlertMessageEnabled = false;

	//디버그 메세지를 출력 합니다.
	var theAlertDebugEnabled = false;

	var Alert = {
		message : function(param){
			if(theAlertMessageEnabled){
				alert(param);
			} else {
				return;
			}
		},
		msg : function(param){
			this.message(param);
		},
		debug : function(param){
			if(theAlertDebugEnabled){
				alert(param);
			} else {
				return;
			}
		}
	};




	/***************************************************
	 * Cookier : 클라이언트에서 구어주는 쿠키
	 * Cookier.set_cookie("foo", "bar", 1);
	 ***************************************************/
	var Cookier = {
		set_cookie : function(name, value, expires) {
			var todayDate = new Date();
			todayDate.setDate (todayDate.getDate() + expires);
			document.cookie = name + "=" + escape (value) + "; path=/; expires=" + todayDate.toGMTString();
		},
		get_cookie : function(Name) {
			var search = Name + "="
			if (document.cookie.length > 0) { // 쿠키가 설정되어 있다면
				offset = document.cookie.indexOf(search)
				if (offset != -1) { // 쿠키가 존재하면
					offset += search.length
					// set index of beginning of value
					end = document.cookie.indexOf(";", offset)
					// 쿠키 값의 마지막 위치 인덱스 번호 설정
						if (end == -1)
							end = document.cookie.length
					return unescape(document.cookie.substring(offset, end))
				}
			}
			return "";
		}
	};




	/***************************************************
	 * Png24Util : 투명 PNG IE6
	 ***************************************************/
	/*
	* class="png24"
	* 아래와 같은 css와 태그를 사용 합니다.
	* .png24{ tmp:expression(Png24Util.set_png24(this)); }
	* <img class="png24" src="test.png" width="140" height="50" alt="" />
	*/

	var Png24Util = {
		//ie6 png24를 위한 이미지 렌더러
		set_png24:function(obj) {
			if( navigator.appVersion.indexOf("MSIE 6") > -1){
				obj.width=obj.height=1;
				obj.className=obj.className.replace(/\bpng24\b/i,"");
				obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\""+ obj.src +"\",sizingMethod=\"image\");"
				obj.src = IMG_ASSETS_DIR+"1px.png";
				return IMG_ASSETS_DIR+"1px.png";
			} else {
				return;
			}
		},
		//제이쿼리를 이용한 ie 버전 감지
		set_png_24_with_jquery:function(obj) {
			if($.browser.msie && $.browser.version.substring(0, 1) === "6"){
				obj.width=obj.height=1;
				obj.className=obj.className.replace(/\bpng24\b/i,"");
				obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\""+ obj.src +"\",sizingMethod=\"image\");"
				obj.src = IMG_ASSETS_DIR+"1px.png";
				return IMG_ASSETS_DIR+"1px.png";
			} else {
				return;
			}
		},
		jqPngFix:function() {
			try {
				//ie6 png transperency fix
				$.each($("img[src$=.png],img[src$=.PNG]"), function () {
					var img = $(this);
					img.css({"width": img.width(),"height": img.height(), "filter": "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + img.attr("src") + "', sizingMethod='scale')"});
					img.attr({"width": img.width(), "height": img.height(), "src": "/_vendors/images/blank.gif"});
				});
			} catch(e) {
				alert(e.description)
			}
		}
	};



	/***************************************************
	 * Flash : 플래시
	 ***************************************************/
	/*
	*	Flash.write('loading.swf','100%','100%','','','','')
	*
	*	플래시 ins : 경로, 넓이, 높이, 아이디, 배경색, 플래시 속성(window[html 위] , opaque[html 아래] , transparent[투명])
	*
	*	insert
	*	- swf         : 위치/플래시파일명
	*	- width       : 가로크기
	*	- height      : 세로크기
	*	- flashvars   : 현재페이지 정보
	*	- base        : 경로설정
	*/
	var Flash = {
		write:function(url,w,h,id,bg,vars,win){
			var flashStr=
			"<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+w+"' height='"+h+"' id='"+id+"' align='middle'>"+ "<param name='allowScriptAccess' value='always' />"+
			"<param name='movie' value='"+url+"' />"+
			"<param name='FlashVars' value='"+vars+"' />"+
			"<param name='wmode' value='"+win+"' />"+
			"<param name='menu' value='false' />"+
			"<param name='quality' value='high' />"+
			"<param name='bgcolor' value='"+bg+"' />"+
			"<embed src='"+url+"' FlashVars='"+vars+"' wmode='"+win+"' menu='false' quality='high' bgcolor='"+bg+"' width='"+w+"' height='"+h+"' name='"+id+"' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"+
			"</object>";
			document.write(flashStr);
		},
		ins:function(url,w,h,id,bg,vars,win){
			var flashStr = new Array();
			flashStr.push("<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+w+"' height='"+h+"' id='"+id+"' align='middle' style='z-index:1'>");
			flashStr.push("<param name='allowScriptAccess' value='always' />");
			flashStr.push("<param name='movie' value='"+url+"' />");
			flashStr.push("<param name='wmode' value='"+win+"' />");
			flashStr.push("<param name='menu' value='false' />");
			flashStr.push("<param name='quality' value='high' />");
			flashStr.push("<param name='bgcolor' value='"+bg+"' />");
			flashStr.push("<embed src='"+url+"' wmode='"+win+"' menu='false' quality='high' bgcolor='"+bg+"' width='"+w+"' height='"+h+"' name='"+id+"' align='middle' allowScriptAccess='always'  type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />");
			flashStr.push("</object>");
			document.write(flashStr.join("")); // 플래시 코드 출력
		},
		insert:function(swf, width, height, flashvars, base){
			var strFlashTag = new String();
			if (navigator.appName.indexOf("Microsoft") != -1) {
				strFlashTag += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
				strFlashTag += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=version=8,0,0,0" ';
				strFlashTag += 'width="' + width + '" height="' + height + '">';
				strFlashTag += '<param name="movie" value="' + swf + '"/>';
				strFlashTag += '<param name="flashvars" value="' + flashvars + '"/>';
				//        strFlashTag += '<param name="base" value="' + base + '"/>';
				strFlashTag += '<param name="quality" value="best"/>';
				//      strFlashTag += '<param name="bgcolor" value="' + bgcolor + '"/>';
				strFlashTag += '<param name="menu" value="false"/>';
				//        strFlashTag += '<param name="salign" value="LT"/>';
				//        strFlashTag += '<param name="scale" value="noscale"/>';
				strFlashTag += '<param name="wmode" value="transparent"/>';
				strFlashTag += '<param name="wmode" value="opaque"/>';
				strFlashTag += '<param name="allowScriptAccess" value="always"/>';
				strFlashTag += '</object>';
			} else {
				strFlashTag += '<embed src="' + swf + '" ';
				strFlashTag += 'quality="best" ';
				//      strFlashTag += 'bgcolor="' + bgcolor + '" ';
				strFlashTag += 'width="' + width + '" ';
				strFlashTag += 'height="' + height + '" ';
				//        strFlashTag += 'base="' + base + '" ';
				strFlashTag += 'menu="false" ';
				strFlashTag += 'scale="noscale" ';
				//        strFlashTag += 'salign="LT" ';
				strFlashTag += 'wmode="window" ';
				strFlashTag += 'allowScriptAccess="always" ';
				if(flashvars != null) {strFlashTag += 'flashvars="' + flashvars + '" '};
				strFlashTag += 'type="application/x-shockwave-flash" ';
				strFlashTag += 'pluginspage="http://www.macromedia.com/go/getflashplayer">';
				strFlashTag += '</embed>';
			}
			document.write(strFlashTag);
		},
		mapping:function(step){
			//alert(step);
			//mapping번호
			switch (step) {
				//메인페이지로 이동함
				case 1:
					window.location.href="/";
				break;
				case 10:
					window.location.href="/";
				break;
				case 11:
					window.location.href="/";
				break;
				case 20:
					window.location.href="/";
				break;
				case 21:
					window.location.href="/";
				break;
				case 30:
					window.location.href="/";
				break;
				case 31:
					window.location.href="/";
				break;
				case 40:
					window.location.href="/";
				break;
				case 41:
					window.location.href="/";
				break;

				default:
					return false;
				break;
			}
		}
	};




	/***************************************************
	 * jquery를 쓰지 않는 에이잭스 Ajax
	 ***************************************************/
	/*
	*	example)
	*		Ajax.request({
	*			url: "random.aspx?reqId=1",
	*			onBeginCallback : function () { alert ("시작"); },
	*			onSuccessCallback : function(result) { alert(result.responseText); },
	*			onErrorCallback : function () { alert ("error");}
	*		});
	*
	*		Ajax.request({
	*			url: "random.aspx?reqId=2",
	*			onBeginCallback : function () { alert ("시작"); },
	*			onSuccessCallback : function(result) { alert(result.responseText); },
	*			onErrorCallback : function () { alert ("error");}
	*		});
	*/
	function Ajax() {
		var o = new Object();
		o.url = window.location.href;
		o.onBeginCallback = null;
		o.onSuccessCallback =null;
		o.onErrorCallback = null;
		o.method ="GET";
		o.responseText =null;
		o.responseXML = null;
		o.postData = null;

		o.getXmlHttp = function () {
			var req;
			if (window.XMLHttpRequest) {
				req = new XMLHttpRequest(); //FF 계열, IE7 을 위한 XMLHTTP 생성
			} else {
				req = new ActiveXObject("Microsoft.XMLHTTP"); //IE6 이하를 위한 XMLHTTP 생성
			}
			req.onreadystatechange = function () {
				switch (req.readyState) {
					case 1:
						o.onLoading();
						break;
					case 4:
						o.onComplete();
						break;
				}
			}
			return req;

		}
		o.xhr = o.getXmlHttp();

		o.onLoading =function () {
			o.raiseEvent ("BeginCallback");
		}

		o.onComplete = function () {
			o.responseText = o.xhr.responseText;
			o.responseXML = o.xhr.responseXML;
			if (o.xhr.status==200)
				o.raiseEvent("SuccessCallback");
			else
				o.raiseEvent("ErrorCallback");
		}

		o.raiseEvent = function (ev) {
			if (typeof o["on"+ev] == "function")
				o["on"+ev].call (this,o);
		}

		//request 메소드로 호출된 파라메터를 Ajax에 설정
		o.handleArgs = function (args) {
			for (param in args) {
				o[param] = args[param];
			}
		}

		//요청을 보냄
		o.run = function () {
			if (o.xhr ==null) {
				return false;
			}
			if (o.postData != null) {
				o.method = "POST";
				o.xhr.open (o.method , o.url , true);
				o.xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				o.xhr.send(o.postData); // 서버에 form 값 전송
			} else {
				o.xhr.open (o.method , o.url , true);
				o.xhr.send(null);
			}

		}
		return o;
	};

	Ajax.handleRequest = function (args){
		if (typeof args == "undefined" || args == null) //파라메터가 유효한 지 검사
			return -1;
		var request = new Ajax();
		request.handleArgs(args); // 설정된 파라메터로 Ajax의 속성과 콜백 핸들러를 설정.
		return request.run();
	};

	Ajax.request = function(args){
		return Ajax.handleRequest(args); //Ajax 요청의 시작점
	};




	/***************************************************
	 * InputActiver : 이미지 포커싱시 색상 주기
	 ***************************************************/
	/*
	* ipt_normal css 클래스를 가진 input, textarea객체에 이벤트를 추가합니다.
	* 아래와 같은 CSS 스타일이 존재 하여야 합니다.
	* 	.ipt_normal{border:1px solid #c2c2c2;font:normal 12px/18px 'Dotum';text-inent:5px;margin-right:5px; color:#393939;}
	*	.ipt_active{border:1px solid #4b91cd;font:normal 12px/18px 'Dotum';text-inent:5px;margin-right:5px; color:#4b91cd;}
	*/
	var InputActiver = {
		init : function(){
			$(".ipt_normal").bind('focus ',function(){
				$(this).removeClass("ipt_normal");
				$(this).addClass("ipt_active");
			}).bind('blur',function(){
				$(this).removeClass("ipt_active");
				$(this).addClass("ipt_normal");
			});
		}
	};




	/***************************************************
	 * ClipBoardCopy : 클립보드로 복사 파이어폭스 포함.
	 ***************************************************/
	/*
	* 파이어폭스의 경우 보안 관계상 막혀 있음 about:config에서 signed.applets.codebase_princiapl_support의 값을 true로 놓아야 동작됨
	*/
	var ClipBoardCopy = {
		setData:function(src){
			if(window.clipboardData){
				clipboardData.setData("text",src);
			} else if(window.netscape) {
				netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
				var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);

				if(!clip) return;
				var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);

				if(!trans) return;
				trans.addDataFlavor('text/unicode');
				var str = new Object(),len = new Object();
				var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
				str.data=src;
				trans.setTransferData("text/unicode",str,src.length*2);
				var clipid=Components.interfaces.nsIClipboard;

				if(!clipid) return false;
					clip.setData(trans,null,clipid.kGlobalClipboard);
			}
		}
	};




	/***************************************************
	 * Folding : 타겟 감추고 보이기
	 ***************************************************/
	var Folding = {
		//보이기
		fold : function(obj_element){
			$(obj_element).attr('style','display:block;');
		},
		//감추기
		unfold : function(obj_element){
			$(obj_element).attr('style','display:none;');
		}
	};




	/***************************************************
	 * Clocker : 시간을 채워줍니다.
	 ***************************************************/

	var Clocker = {
		//오늘 날짜를 채워줍니다. 2011-01-01
		current_filling_calendar : function(obj){
			var temp_date = new Date();
			var temp_date_year  = temp_date.getFullYear();
			var temp_date_month = temp_date.getMonth()+1;
			var temp_date_date  = temp_date.getDate();
			if(temp_date_month < 10){
				temp_date_month = "0"+temp_date_month;
			}
			if(temp_date_date < 10){
				temp_date_date = "0"+temp_date_date;
			}

			$(obj).val(temp_date_year+"-"+temp_date_month+"-"+temp_date_date);
		},
		//오늘 시간을 채워 줍니다. 10:10:10
		current_filling_clock : function(type, obj){
			var temp_date = new Date();
			var current_clock = '';
			if(type == 'h') {
				current_clock = temp_date.getHours();
			}
			if(type == 'm') {
				current_clock = temp_date.getMinutes();
			}
			if(type == 's') {
				current_clock = temp_date.getSeconds();
			}
			if(current_clock < 10){
				current_clock = "0"+current_clock;
			}

			$(obj).val(current_clock);
		}
	};




	/***************************************************
	 * Dropdown_debug :  ie6버그 -
	 * 드롭다운이 모달 레이어 보다 위로 오는 현상을 수정
	 ***************************************************/

	var Dropdown_debug = {
		//객체를 감춤
		//Dropdown_debug.debug_dropdown_ie6_off($("#board_type"+no));
		debug_dropdown_ie6_off:function(obj){
			if($.browser.msie && $.browser.version.substring(0, 1) === "6"){
				$(obj).attr('style','width:0px;height:0px;border:0');
			}
		},
		//객체를 보임
		//Dropdown_debug.debug_dropdown_ie6_on($("#board_type"+no));
		debug_dropdown_ie6_on:function(obj){
			if($.browser.msie && $.browser.version.substring(0, 1) === "6"){
				$(obj).attr('style','');
			}
		}
	};




	/***************************************************
	 * BookMark : 북마크에 추가합니다
	 ***************************************************/

	var BookMark = {
		add:function(url,title){
			if (window.sidebar) { // Firefox / Mozilla
				window.sidebar.addPanel(title, url, "");
			} else if(window.opera && window.print) { // Opera
				var elem = document.createElement('a');
					elem.setAttribute('href',url);
					elem.setAttribute('title',title);
					elem.setAttribute('rel','sidebar');
					elem.click();
			}  else if(document.all && window.external) { //IE
				window.external.AddFavorite(url, title);
			} else {
				alert('귀하의 웹브라우저는 자바스크립트에 의한 북마크 추가 기능을 지원 하지 않습니다. \n페이지 북마크 버튼을 눌러 북마크를 추가 하십시오.');
			}
		}
	};

	/***************************************************
	 * Trace : 자바스크립트 트레이스 UI를 만듭니다.
	 ***************************************************/

	var Trace = {
		msg : "[HowToUse]\nyou can call method Trace.show(\"Message is test...\");",
		traceUi : "<div id='traceUi'style='border:1px solid gray;background-color:#fdfdfd;width:100%;height:500px;display:block;overflow-x:hidden;overflow-y:scroll;'><div id='puts' style='overflow-y:hidden;background-color:white;font:normal 12px/14px Consolas;text-indent:5px;'>OutPuts &gt;&gt;<br /></div></div>",
		show : function(argumentsMessage) {
			if(!document.getElementById('traceUi')){
				alert(this.msg);
			} else {
				document.getElementById('puts').innerHTML += "<span style='border-left:3px solid white;'>"+argumentsMessage+"</span><br />";
			}
		},
		init : function() {
			if(new RegExp(/Firefox/).test(navigator.userAgent)){
				var TraceContainerNS = document.createElement("div");
				TraceContainerNS.setAttribute("id", "trace");
				TraceContainerNS.setAttribute("style", "border:1px solid silver;");
				document.getElementsByTagName('body')[0].appendChild(TraceContainerNS);
				document.getElementById('trace').innerHTML = this.traceUi;
			}else if(new RegExp(/MSIE/).test(navigator.userAgent)){
				var TraceContainerAX = document.createElement('<div id="trace" style="border:1px solid silver;">');
				document.getElementsByTagName('body')[0].appendChild(TraceContainerAX);
				trace.innerHTML = this.traceUi;
			}else if(new RegExp(/Chrome/).test(navigator.userAgent)){
				var TraceContainerWK = document.createElement('div');
				TraceContainerWK.setAttribute('id', 'trace');
				TraceContainerWK.setAttribute('style', 'border:1px solid silver;');
				document.getElementsByTagName('body')[0].appendChild(TraceContainerWK);
				trace.innerHTML = this.traceUi;
			}else{
				alert("javascript is poop"+navigator.userAgent);
			}
		},
		remove : function() {
			document.getElementById('traceUi').style.display = "none";
		}
	};

	/***************************************************
	 * Random : 랜덤 값 얻기.
	 ***************************************************/

	var Random = {
		range:function(min,max){
			return Math.floor( (Math.random() * (max - min + 1)) + min );
		}
	};







	/**************************************************************************************************

		쿼리스트링 자바스크립트에서 쓰기 위한 라이브러리

	**************************************************************************************************/
	var QueryString = function () {
		// This function is anonymous, is executed immediately and
		// the return value is assigned to QueryString!
		var query_string = {};
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("=");
				// If first entry with this name
			if (typeof query_string[pair[0]] === "undefined") {
				query_string[pair[0]] = pair[1];
				// If second entry with this name
			} else if (typeof query_string[pair[0]] === "string") {
				var arr = [ query_string[pair[0]], pair[1] ];
				query_string[pair[0]] = arr;
				// If third or later entry with this name
			} else {
				query_string[pair[0]].push(pair[1]);
			}
		}
			return query_string;
	} ();



	/**************************************************************************************************

		AgentFix

		Firefox
		Firefox는 아래와 같은 형태로 User Agent 정보를 제공한다.

		Mozilla/5.0 (Windows; U; Windows NT 6.1; ko; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 IPMS/A640400A-14D460801A1-000000426571

		- Mozilla/5.0 : 모질라 5.0 기반이다.
		- platform: 플랫폼 정보
		- rv: Gecko 레이아웃 엔진의 배포 버전
		- Gecko/yyyymmdd : Gecko의 개발용 배포일로 yyyymmdd 형태이다. 실제 배포일은 아니며, 추후 삭제될 수 있다.
		- Firefox/appversion : Firefox 의 버전이다.


		Internet Explorer
		IE는 아래와 같은 형태로 User Agent 정보를 제공한다.

		Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; IPMS/A640400A-14D460801A1-000000426571; TCO_20110131100426; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; Tablet PC 2.0)

		- Mozilla/4.0 : Mozilla 4.0과 "호환 가능"하다.
		- MSIE 8.0 : Internet Explorer 8.0이다.
		- Trident/4.0 : Trident 레이아웃 엔진 4.0 버전으로 구현됐다.


		Chrome
		Chrome의 User Agent 정보는 좀 복잡하다.

		Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.517.44 Safari/534.7

		- Mozilla/5.0 : Mozilla 5.0과 호환 가능하다.
		- AppleWebKit/version (KHTML, like Gecko) : "Gecko 같은" 브라우저 레이아웃 엔진인 KHTML을 사용한다.
		Webkit은 KHTML를 기반으로 한 엔진이다.
		- Chrome/version : Chrome이며 해당 버전이다.
		- Safari/version : Safari의 해당 버전과 비슷하다.


		Safari
		Chrome과 거의 동일하지만 버전 정보를 포함하고 있다.

		Mozilla/5.0 (Windows; U; Windows NT 6.1; ko-KR) AppleWebKit/533.18.1 (KHTML, like Gecko) Version/5.0.2 Safari/533.18.5


		Opera
		Opera는 가장 깔끔하다.

		Opera/9.80 (Windows NT 6.1; U; ko) Presto/2.6.30 Version/10.62

		- Opera/version : Opera 해당 버전이다.
		- Presto/version : Presto 레이아웃 엔진을 사용하고 있다.

	**************************************************************************************************/
	var AgentFix = {
		init:function(){
			/* 유저 에이젼트 체크 IE FIX */
			if((window.navigator.userAgent.toLowerCase().indexOf('msie') != -1) || (window.navigator.userAgent.match(/Trident.*rv:11\./))){
				$('body').addClass('agent_scope_ie');
				try{console.log('browser > ie');}catch(e){}
				if(window.navigator.userAgent.toLowerCase().indexOf('msie 7') != -1){
					try{console.log('browser > ie7');}catch(e){}
					$('body').addClass('ie7');
				}
				if(window.navigator.userAgent.toLowerCase().indexOf('msie 8') != -1){
					try{console.log('browser > ie8');}catch(e){}
					$('body').addClass('ie8');
				}
				if(window.navigator.userAgent.toLowerCase().indexOf('msie 9') != -1){
					try{console.log('browser > ie9');}catch(e){}
					$('body').addClass('ie9');
				}
				if(window.navigator.userAgent.toLowerCase().indexOf('msie 10') != -1){
					try{console.log('browser > ie10');}catch(e){}
					$('body').addClass('ie10');
				}
				if((window.navigator.userAgent.match(/Trident.*rv:11\./))){
					try{console.log('browser > ie11');}catch(e){}
					$('body').addClass('ie11');
				}
			}

			/* 유저 에이젼트 체크 IE 가 아닌 브라우저 */
			if(window.navigator.userAgent.toLowerCase().indexOf('chrome/') != -1 && window.navigator.userAgent.toLowerCase().indexOf('safari/') != -1){
				//console.log('agent_scope_chrome');
				$('body').addClass('agent_scope_chrome');
			} else if(window.navigator.userAgent.toLowerCase().indexOf('firefox/') != -1){
				//console.log('agent_scope_firefox');
				$('body').addClass('agent_scope_firefox');
			} else if(window.navigator.userAgent.toLowerCase().indexOf('safari/') != -1){
				// console.log('agent_scope_safari');
				$('body').addClass('agent_scope_safari');
			}
		},
		linkfix:function(){
			if(window.navigator.userAgent.toLowerCase().indexOf('msie 8') != -1){
				$('a[href="javascript:void(0);"]').each(function(){
					//console.log( $(this).attr('href') );
					$(this).attr('onclick','return false;');
				});
			}
		}
	};
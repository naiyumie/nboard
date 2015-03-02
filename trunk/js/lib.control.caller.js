/* ****************************************************************************
	NAIYUMIE KING WANG JJANG Front End Developer <naiyumie@gmail.com>
	FileType:CRLF, Encording:UTF-8, Tab&Space:4/4
	------------------------------------------------------------------------
	호출단
**************************************************************************** */
"use strict";

/**************************************************************************************************

    무조건 실행

**************************************************************************************************/
	// AgentFix
	$(function(){
		AgentFix.init();
		AgentFix.linkfix();
	});

	// 리사이저
	$(function(){
		LayoutResizer.content_wrap();
	});
	$(window).load(function(){
		LayoutResizer.content_wrap();
	});
	$(window).resize(function(){
		LayoutResizer.content_wrap();
	});

	// 서브밋 버튼 바인딩
	$(function(){
		$('.submit_button').on('click focus', function(){
			//alert('submit');
			var submit_target_form = $(this).attr('data-form');
			$(submit_target_form).submit();
			return false;
		});
	});

/**************************************************************************************************

    조건부 흐름.

**************************************************************************************************/
	//try{ console.log('front_scope>>'+front_scope); }catch(e){}
	switch(front_scope) {
		/********************************
			메인
		********************************/
			case "main":
				$(function(){
					// 아티클
					articlesTab.evntBind('.tab01.tab_a', 'tab_a', '.atype');
					articlesTab.evntBind('.tab02.tab_a', 'tab_a', '.atype');
					articlesTab.evntBind('.tab03.tab_a', 'tab_a', '.atype');
					articlesTab.init('.tab01.tab_a', '.a01', '.atype');

					articlesTab.evntBind('.tab01.tab_b', 'tab_b', '.btype');
					articlesTab.evntBind('.tab02.tab_b', 'tab_b', '.btype');
					articlesTab.evntBind('.tab03.tab_b', 'tab_b', '.btype');
					articlesTab.init('.tab01.tab_b', '.b01',  '.btype');

					// 사인인
					RadioGroup.init('.nrdg','.nrdgx');
					SignTypeChoose.init('.nrdgx');
					CheckBoxes.init('.remember_id','.chk_remember_id');

					// 팝업존
					$('.uPopupZone').MainPopupZone();

					// 아이디 저장
					RememberMe.init();
					RememberMe.fill_id();
				});

				$(window).load(function() {
					// KEY VISUAL
					if($('.keyvisual').length > 0){
						keyvisualFlexSlider.init();
					}
				});
				break;


		/********************************
		    introduce
		********************************/
			case "introduce_0":
				$(function(){
					NavigationActive.init('.gnb .g01','.lnb .l01');
				});
				break;
			case "introduce_1":
				$(function(){
					NavigationActive.init('.gnb .g01','.lnb .l02');
				});
				break;
			case "introduce_2":
				$(function(){
					NavigationActive.init('.gnb .g01','.lnb .l03');
				});
				break;
			case "introduce_3":
				$(function(){
					NavigationActive.init('.gnb .g01','.lnb .l04');
				});
				break;
			case "introduce_4":
				$(function(){
					NavigationActive.init('.gnb .g01','.lnb .l05');
				});
				break;


		/********************************
		    단일 사인인
		********************************/
			case "singlesign":
				$(function(){
					// 사인인
					RadioGroup.init('.nrdg','.nrdgx');
					SignTypeChoose.init('.nrdgx');
					SignTypeChoose.singlesign('.nrdgx');
					CheckBoxes.init('.remember_id','.chk_remember_id');
					// 아이디 저장
					RememberMe.init();
					RememberMe.fill_id();
				});
				// 리사이저
				$(function(){
					LayoutResizer.singlesign();
				});
				$(window).resize(function(){
					LayoutResizer.singlesign();
				});

				break;


		/********************************
		    멤버 조인
		********************************/
			case "signup_licence_agreement":
				$(function(){
					NavigationActive.init('','.lnb .l01');

					RadioGroup.init('.radio1','.radio1x');
					RadioGroup.init('.radio2','.radio2x');
					CheckBoxes.init('.checkbox1','.checkbox1x');
					$('.checkbox1x').click(function(){
						if($(this).prop('checked')){
							$('#donot_agree1').add('#donot_agree2').removeAttr('checked');
							$('#donot_agree1').parent().removeClass('checked');
							$('#donot_agree2').parent().removeClass('checked');
							$('#agree1').add('#agree2').attr('checked','checked');
							$('#agree1').parent().addClass('checked');
							$('#agree2').parent().addClass('checked');

						} else {
							$('#agree1').add('#agree2').removeAttr('checked');
							$('#agree1').parent().removeClass('checked');
							$('#agree2').parent().removeClass('checked');
							$('#donot_agree1').add('#donot_agree2').attr('checked','checked');
							$('#donot_agree1').parent().addClass('checked');
							$('#donot_agree2').parent().addClass('checked');
						}
					});
					//$('.submit_button').on('click focus', function(){
					//	$('.form').submit();
					//	return false;
					//});
				});
				break;
			case "signup_join_form":
				$(function(){
					NavigationActive.init('','.lnb .l01');
					RadioGroup.init('.radio1','.radio1x');
					RadioGroup.init('.radio2','.radio2x');
				});
				break;
			case "signup_join_authentication":
				$(function(){
					NavigationActive.init('','.lnb .l01');
					$('.captcha_refresh').on('click focus', function(){
						$.get("/member/get_ajax_captcha", function(data){
							$('.captcha_container').html( data );
							return false;
						});
					});
				});
				break;
			case "signup_compleate":
				$(function(){
					NavigationActive.init('','.lnb .l01');
				});
				break;

		/********************************
			멤버탈퇴
		********************************/
			case "member_leave":
				$(function(){
					NavigationActive.init('','.lnb .l01_notsession');
				});
				break;

		/********************************
		    멤버 정보 보기
		********************************/
			case "password_change":
				$(function(){
					NavigationActive.init('','.lnb .l03_notsession');
				});
				break;
			case "signinfo_retrieve_and_update":
				$(function(){
					NavigationActive.init('','.lnb .l02_notsession');
					RadioGroup.init('.radio1','.radio1x');
					RadioGroup.init('.radio2','.radio2x');
				});
				break;

		/********************************
		    아이디 비밀번호 찾기
		********************************/
			case "findid":
				$(function(){
					NavigationActive.init('','.lnb .l02');
				});
				break;
			case "findpassword":
				$(function(){
					NavigationActive.init('','.lnb .l03');
				});
				break;

		/********************************
		    게시판
		********************************/
			case "board_list":
				$(function(){
					Pagination.init('.pagination1');
				});
				break;
			case "board_retrieve":
				$(function(){
					Pagination.init('.pagination1');
					// 게시판 조회의 - 커멘트 수정 / 수정 취소 / 삭제 기능 동작.
					CommentAction.init();
				});
				break;
			case "board_write":
			case "board_update":
				var cleditor;
				$(function () {
					cleditor = $("textarea[name=content]").cleditor({
						width: 736,
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
					// 이미지 어태치 버튼을 눌렀을때
					$('.attach_item.image').on('click', function(){
						$('.image_attach').show();
					});
					//삽입 예제 1 : var htmlx = '<img src="/attach/2a5fff03eca69ac89cf5d8d6dbece4c8.png" alt="사용자 삽입 이미지">';
					//삽입 예제 2 : $("textarea[name=content]").val($('textarea[name=content]').val()+htmlx);
					//삽입 예제 3 : a[0].refresh();

					// 체크박스
					CheckBoxes.init('.checkbox1','.checkbox1x');

					// 클라이언트 밸리데이션
					$('.form').submit(function(){
						if($('input[name=title]').val() == ''){
							alert('제목을 입력해 주세요.');
							return false;
						}
						if($('textarea[name=content]').val() == ''){
							alert('내용을 입력해 주세요.');
							return false;
						}
						return true;
					});
				});
				break;
			case "image_append_next":
				var ImageAppender = {
					// 본문에 이미지 첨부
					image_append : function(){
						var image_for_contents = $('.image_for_thumbs').attr('data-image_for_contents');
						var html_for_contents = '<img src="'+image_for_contents+'" alt="사용자 삽입 이미지">';
						$("textarea[name=content]", parent.document).val($('textarea[name=content]', parent.document).val()+html_for_contents);
						parent.cleditor[0].refresh();
					},
					// 섬네일 등록하기
					thumb_nail_append : function(){
						var thumb_image = $('.image_for_thumbs').attr('src');
						try{ console.log('thumb_image>>'+thumb_image); }catch(e){}
						$('.thumbnail_container', parent.document).attr('style','background:url(\"'+thumb_image+'\") center center no-repeat;');
						$('input[name=thumbnail]', parent.document).val(thumb_image);
						$('.thumbnail_wrapper', parent.document).show();
					},
					// 닫기
					close_image_appender : function(){
						$('.image_attach', parent.document).hide();
					},
					endl:null
				};
				$(function(){
					// 이미지 첨부
					$('.image_append_btn').on('click', function(){
						ImageAppender.image_append();
						ImageAppender.thumb_nail_append();
						ImageAppender.close_image_appender();
					});

					// 업데이트시 단계별로 실행을 위한 버튼.
					$('.image_append_btn_step').on('click', function(){
						ImageAppender.image_append();
					});
					$('.thumbnail_append_btn_step').on('click', function(){
						ImageAppender.thumb_nail_append();
					});
					$('.image_appender_close_btn_step').on('click', function(){
						ImageAppender.close_image_appender();
					});

				});
				break;

		/********************************
			기본
		********************************/
		default:
			break;
	}

/**************************************************************************************************

    게시판 조건부 흐름.

**************************************************************************************************/
	//try{ console.log('board_front_scope>>'+board_front_scope); }catch(e){}
	switch(board_front_scope){
		case "freeboard" :
			$(function(){
				NavigationActive.init('.gnb .g03','.lnb .l01');
			});
			break;
		case "noticeboard" :
			$(function(){
				NavigationActive.init('.gnb .g02','.lnb .l01');
			});
			break;
		case "updatenews" :
			$(function(){
				NavigationActive.init('.gnb .g02','.lnb .l02');
			});
			break;
		case "gallery" :
			$(function(){
				NavigationActive.init('.gnb .g03','.lnb .l02');
			});
			break;
		default :
			break;
	}

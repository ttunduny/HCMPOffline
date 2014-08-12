$(document).ready(function(){
	var protocol =window.location.protocol;
	var host =window.location.host;
	pathArray = window.location.pathname.split( '/' );
	base_url =protocol+'//'+ host+'/'+pathArray[1]+'/';
	eid_click = 0;
	//Get only first part of hash when reloading the page
	var hash_split = window.location.hash.split('/');
	window.location.hash="#eid_management";
	x = 1;//This is used to check hashchange when clicking on menu
	sub_menu_click = 0;//Sub menu click check (submission trackin, submission reports ...)
	
	$(window).trigger('hashchange');
	$(document).on("click",".top_menu",function(event){
		sub_menu_click = 0;
		event.preventDefault();
		document.location.hash =$(this).attr('id');
		if($(this).attr('id')=="eid_management"){
			
		}
		
	});
	
	$(".back_page").on("click",function(){
		var hash = window.location.hash;
		parent.history.back();
        return false;
	});
	
	//EID Menus click
	$(".eid_menus").on("click",function(){
		
	});
	
	$("#subm_month").on("change",function(){
		if($(this).val!=""){
			$("#subm_month").css("border-color","none");
		}
	});
	
	$("#subm_testing_lab").on("change",function(){
		if($(this).val!=""){
			$("#subm_testing_lab").css("border-color","#cccccc");
		}
	});
	
	//Generate report
	$(document).on("click","#btn_submit_cons_report",function(){
		
		//Validation
		var lab = $("#subm_testing_lab").val();
		var lab_name = $("#subm_testing_lab :selected").text();
		var platform = $("input[type='radio'][name='platform']:checked").val();
		var month = $("#subm_month").val();
		var month_name = $("#subm_month").text();
		var year =  $("#subm_year").val();
		if(month==""){
			$("#subm_month").css("border-color","red");
			return;
		}else{
			$("#subm_month").css("border-color","#cccccc");
		}
		if(lab==""){
			$("#subm_testing_lab").css("border-color","red");
			return;
		}else{
			$("#subm_testing_lab").css("border-color","#cccccc");
		}
		var _url = base_url+"eid_management/displayconsumption";
		
		//After check, submit
		//Get consumption report title name
		var text = $(".eid_menus.active").text();
		var request = $.ajax({
				url : _url,
				type : 'post',
				data : {
					"testinglab" : lab,
					"lab_name"   : lab_name,		
					"platform"   : platform,
					"month"      : month,
					"monthyear"  : year,
					"report_text": text
				},
				dataType : "html"
			});
			request.done(function(data) {
				$( "#inner_wrapper" ).html( data);
			});
			request.fail(function(jqXHR, textStatus) {
				
			});
	});
	
	//Approval button
	$(document).on("click",".btn_approve",function(event){
		event.preventDefault();
		var href = $(this).attr("href");
		$("#eid_main").load(href);
		sub_menu_click = 2;
		document.location.hash ="eid_management/consumption";
	});
	
	//Going back to eid
	$(document).on("click",".btn_back_eid",function(event){
		event.preventDefault();
		sub_menu_click = 0;
		document.location.hash ="";
		document.location.hash ="eid_management";
		
	});
	
	
});

$(window).bind( 'hashchange', function(e) {
	
	if(!window.location.hash){
		return;
	}
	var location = ( window.location.hash.replace("#",""));
	
	if(x==1){//Make sure hash is checked only once when initializing
		hash = location;
		x=2;
	}
	if(sub_menu_click==0){
		$("#tab_tracking").load(base_url+"eid_management/menus/submission_tracking");
		$("#tab_consumption").load(base_url+"eid_management/menus/kit_consumption");
		$("#tab_forecasting").load(base_url+"eid_management/menus/kit_forecasting");
		$("#tab_report").load(base_url+"eid_management/menus/submission_report");
	}else if(sub_menu_click==1){//If hash is changing when clicking sub menus, no need to change the whole content
		$( "#eid_subcontent" ).load( base_url+location, function() {
		  
		});
		sub_menu_click = 0;
	}
	
});
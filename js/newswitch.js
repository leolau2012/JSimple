$(document).ready(function(){
	var text=$.ajax({url:"txt/ad.txt",async:false});
	var str = text.responseText;
	var arr=new Array();
	arr = str.split("\n");
	var vali = $("#vali").val();

	

	i=vali;

	current =$("#images ul li:eq("+i+")");
	
	$("#images li").hide();
	$(current).show();
	$("p").html(arr[i]);

	$("#prev").click(function(){
		current = $(current).prev();
		i--;
		if($(current).length==0){
			current =$("#images ul li:last");
			i=arr.length-1;
		}
		$("#images li").hide();
		$(current).show();
		$("p").html(arr[i]);
		return false;
	});

	$("#next").click(function(){
		current = $(current).next();
		i++;
		if($(current).length==0){
			current =$("#images ul li:first");
			i=0;
		}
		$("#images li").hide();
		$(current).show();
		$("p").html(arr[i]);
		return false;
	});
});
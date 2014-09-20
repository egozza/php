$(document).ready(function(){
var post=(function(){
	var string='';

	return {
		set:function(string){
			 $.post("server.php",{metod:'set',string:string},
			 	function(data){
			 		if(data=="ok")
			 			return true;
			 	});

		},
		get:function(string){
			$.post("server.php",{metod:'get',string:string},
			 	function(data){
			 		data=$.trim(data)
			 		if(data!="noTable")
			 		select.setSelect(eval("("+data+")"));
			 	else
			 	 $('#select').html("");

			 	});

		}

	}
}());
var select=(function(){
	return {
		setSelect:function(array){
			var string='';
			for(var i=0;i<array.length;i++)
			{
				string+="<div class='option' id='option"+i+"'>"+array[i]['string']+"</div>";
			}
			$('#select').html("");
			$('#select').html(string);

		}
	}
}());

document.onkeydown=function(e) {
    if(e.which == 17) isCtrl=true;
    if(e.which == 67 && isCtrl === true) {
    	var string=getSelection(document.getElementById("input"));
    	if(string!=='')
    	{
    		
    		if(post.set(string))
    			alert("ok");
    	}

        
    }
};

$('#input').keyup( function(){
   var string=$('#input').val();
   var bufer=string.split(' ');
   if(string!==bufer)
  { 
  		bufer=bufer.pop();
  	if((bufer.length<=5)&&(bufer.length>=2))
  	{
  
  	
  	
  	post.get(bufer);
  }
  else
  	$('#select').html("");
  }
		



});
$("#select").on('click',function(e){
	var id=e.target.id;
	var string=$("#"+id).text();
	string=$.trim(string);
	if(string!='')
	{
		var textarea=$('#input').val();
		for(var i=textarea.length;i>=0;i--)
		{
			if(textarea[i]==" ")
				{
			break;
				}
			else if(i-1<0)
			{
				textarea=textarea.slice(0,i);
				break;
			}
					textarea=textarea.slice(0,i);
			


		}
		$('#input').val(textarea+=string);
		$('#select').html("");
		$('#input').focus();


	}
});
function getSelection( textarea )
{

var uagent    = navigator.userAgent.toLowerCase();
var is_safari = ( (uagent.indexOf('safari') != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var is_ie     = ( (uagent.indexOf('msie') != -1) && (!is_opera) && (!is_safari) && (!is_webtv) );
var is_ie4    = ( (is_ie) && (uagent.indexOf("msie 4.") != -1) );
var is_moz    = (navigator.product == 'Gecko');
var is_ns     = ( (uagent.indexOf('compatible') == -1) && (uagent.indexOf('mozilla') != -1) && (!is_opera) && (!is_webtv) && (!is_safari) );
var is_ns4    = ( (is_ns) && (parseInt(navigator.appVersion) == 4) );
var is_opera  = (uagent.indexOf('opera') != -1);  
var is_kon    = (uagent.indexOf('konqueror') != -1);
var is_webtv  = (uagent.indexOf('webtv') != -1);

var is_win    =  ( (uagent.indexOf("win") != -1) || (uagent.indexOf("16bit") !=- 1) );
var is_mac    = ( (uagent.indexOf("mac") != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var ua_vers   = parseInt(navigator.appVersion);



    var selection = null;
    if ((ua_vers >= 4) && is_ie && is_win) {
        if (textarea.isTextEdit) {
            textarea.focus();
            var sel = document.selection;
            var rng = sel.createRange();
            rng.collapse;
            if((sel.type == "Text" || sel.type == "None") && rng != null)
                selection = rng.text;
        }
    } else if (typeof(textarea.selectionEnd) != "undefined" ) { 
        selection = (textarea.value).substring(textarea.selectionStart, textarea.selectionEnd);
    }
    return selection;
}

});



$(document).ready(function(){
//    console.log("me ready");
    $('#sendrequest').on('click',function(){
//	console.log("me clicked");
	SendRequest();
    });
});
function SendRequest(){
//	console.log("me done");
	var data = $("#data").val();
	var supresslogin_box = supresslogin.checked;
//	console.log(supresslogin);
	$.ajax({
	    type: 'POST',
	    url: 'http://10.0.0.6/webnames-proxy/proxy.php',
	    data: data+"&extendedlog=true&supresslogin="+supresslogin_box,
	    success: function(text) {
		$( "#result" ).append( text+"\n" );
//		console.log("me done");
	    }
	});
};
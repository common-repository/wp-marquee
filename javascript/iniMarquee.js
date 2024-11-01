
	<!--//
	var use_debug = false;

	function debug(){
		if( use_debug && window.console && window.console.log ) console.log(arguments);
	}

	// on DOM ready
	$(document).ready(function (){ 
  $("#marquee").marquee('pause'); 
}); 
	
	var iNewMessageCount = 0;
	
	function addMessage(selector){
		// increase counter
		iNewMessageCount++;

		// append a new message to the marquee scrolling list
		var $ul = $(selector).append("<li>New message #" + iNewMessageCount + "</li>");
		// update the marquee
		$ul.marquee("update");
	}
	
	function pause(selector){
		$(selector).marquee('pause');
	}
	
	function resume(selector){
		$(selector).marquee('resume');
	}
	//-->

$(document).ready(function(){ 
	$("div.play_button").click(function(){
		var _this = $(this);
		var _parent = _this.parent("div");
		var _gif_name = _this.attr("data-gif-filename");

		//check to see if gif is playing
		if( _parent.hasClass("playing") ){
			//gif is playing. remove it.

			// _parent.children("div.gif_holder img").eq(0).remove();
			// _parent.removeClass("playing");
		} else {
			//gif is not playing. kill all other playing gifs and load it.

			killothergifs();

			if(!_parent.hasClass("playing"))
				_parent.addClass("playing");

			var image = $("<img/>");
			image.attr("src",base_url + "export/" + _gif_name);

			_parent.children("div.gif_holder").eq(0).append(image);
		}
	});
});

function killothergifs(){
	$("div.playing").removeClass("playing");
	$("#photos div.photo div.gif_holder img").remove();
}

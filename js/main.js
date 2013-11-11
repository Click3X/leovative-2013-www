$(document).ready(function(){ 
	$("div.play_button").click(function(){
		var _this = $(this);
		var _parent = _this.parent("div");
		var _gif_name = _this.attr("data-gif-filename");

		//check to see if gif is playing
		if(_parent.hasClass("playing")){
			//gif is playing. remove it.

			_parent.children("div.gif_holder img").eq(0).remove();
			_parent.removeClass("playing");
		} else {
			//gif is not playing. kill all other playing gifs and load it.

			killothergifs();

			_parent.addClass("playing");

			var image = $("<img/>");
			image.attr("src",base_url + "exports/" + _gif_name);

			_parent.children("div.gif_holder").eq(0).append(image);
		}

		console.log( "loading gif", _gif_name );
	});
});

function killothergifs(){
	$("#photos div.photo div.gif_holder img").remove();
}

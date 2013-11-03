var io;
function start($io){
	io = $io;
	console.log('--> Socket controller start');
	defeault_functions();
};

function setup(route){
	switch(route){
		default:
			defeault_functions();
			break;
		'controller'
			controller_functions();
			break;
	}
};

function defeault_functions(){
	io.sockets.on('connection', function (socket) {
	  console.log('---> we have socket connection');
	  console.log('---> Joining room');
	  socket.join('room');  
	});
}

function controller_functions(){

};


exports.start = start;
exports.setup   = setup;
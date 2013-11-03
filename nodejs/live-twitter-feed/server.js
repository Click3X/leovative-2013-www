var url     = require("url");
var util    = require('util');
var http    = require("http");
var app     = require('express')();
var server  = http.createServer(app);
var io      = require('socket.io').listen(server);
var port    = process.env.OPENSHIFT_NODEJS_PORT || 8080
var ip      = process.env.OPENSHIFT_NODEJS_IP || "127.0.0.1";
var socket;

io.set('log level', 1); // reduce logging

function start()
{

    //set server connection
    server.listen(port, ip);

    //start twitter stream api
    require('./twitter_tag_monitor').start(http,io);

    //create socket controller
    socket = require('./socket_controller');
    socket.start(io);
    
    //express application
    /*
    app.get('/', function (req, res) {
        
        socket.setup('/');
        res.sendfile(__dirname + '/app.html');
    });

    app.get('/controller', function (req, res) {
        socket.set('controller');
        res.sendfile(__dirname + '/app.html');
    });
    */
}

exports.start = start;
var util = require('util');
var twitter = require('ntwitter');
var http = require("http");
// var app = require("http").createServer(handler);
var io = require('socket.io').listen(80);
// var fs = require('fs');
 
// Twitter Setup
var twit = new twitter({
  consumer_key: '0Lq12FPHlTgvl2Q5gnHBQ',
  consumer_secret: 'vjda2nMXZIfCDoSqFcvQIhlUl3CwKq2XvYwHuIo8',
  access_token_key: '396970137-aHRyebmtXzaBMWCKBHrZiF9qVR67RfYIbqS9guZw',
  access_token_secret: 'zu9vOlkp0DAjRg1W3G6NfyPnaoNs4JeB8Ag3n6E5cQs51'
});

var $tags = ['#this_is_test','#this_is_test2'];
var $valid_tags = [];

console.log('--> Twitter hashtag monitor started');
console.log('--> I\'m monitoring ' + $tags);

twit.stream('statuses/filter', {'track': $tags}, function(stream) {
  stream.on('data', function(data) {

    //Post only if tweet has photo attached
    if(data['entities']['media'] != undefined){

      $valid_tags = getTags(data['text']);

      console.log('-------------------------');
      console.log('New tweet has photo with tag ' + '#'+ $valid_tags + ' is here -- ' + data['created_at']);
      console.log('Screen name: ' + data['user']['screen_name']);
      console.log('Content: ' + data['text']);
      console.log('Image: ' + data['entities']['media'][0].media_url);
      // console.log(util.inspect(data));
      postData(data);
    }
  });
  stream.on('error', function(err){
    console.log(err.message);
  });
});


// socket.io
io.sockets.on('connection', function (socket) {
  // socket.emit('news', { hello: 'world' });
  // socket.on('my other event', function (data) {
  //   console.log(data);
  // });
});

function getTags(str){
  $words = str.split(' ');
  $valid_tags = [];

  $tags.forEach(function(tag,i){
    $words.forEach(function(w,j){
      if(tag == w){
        $valid_tags.push(tag.replace('#',''));
      }
    });

  });
  return $valid_tags.toString();
};

function postData(data){
  var _parameter = '?tag=' + $valid_tags + '&image_url=' + escape(data['entities']['media'][0].media_url) + '&screen_name=' + data['user']['screen_name'];
  
  http
    .get("http://leo.dev/node/twitterNodeListener/" + _parameter, success)
    .on('error', error);

    function success(res) {
      if(res.statusCode == 200){
        console.log('Successed');
      }
      else{
        console.log('Error code: ' + res.statusCode);
      }
    }  
    function error(e) {
      console.log("Got error response: " + e.message);
    }
};

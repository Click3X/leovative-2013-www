var http, io;
var twitter = require('ntwitter');

//Test
// var twit = new twitter({
//   consumer_key: '0Lq12FPHlTgvl2Q5gnHBQ',
//   consumer_secret: 'vjda2nMXZIfCDoSqFcvQIhlUl3CwKq2XvYwHuIo8',
//   access_token_key: '396970137-aHRyebmtXzaBMWCKBHrZiF9qVR67RfYIbqS9guZw',
//   access_token_secret: 'zu9vOlkp0DAjRg1W3G6NfyPnaoNs4JeB8Ag3n6E5cQs51'
// });

//Live

var twit = new twitter({
  consumer_key: '7tHnp6M1AJMgkazPhpaqYQ',
  consumer_secret: 'dRZTWMy3gomxgsQKqrs73srL2hC7zz5tNxmvQa3xK0',
  access_token_key: '28368165-fDel2ufE958elGmNk73UHib7RjDpQPSm4i6aDj9DU',
  access_token_secret: 'CzVGueFzGSYQ4zxkwrDOyRAP0t96WEwPf5bQ5vcAceWOL'
});


var $tags = ['#leovative', '#click3x'];
// var $tags = ['#c3xdev', '#test_tag'];
// var $tags = ['photo'];
var $valid_tags = [];

console.log('--> Twitter hashtag monitor start: ', $tags);
function start($http, $io){
  http = $http;
  io   = $io;
  twit.stream('statuses/filter', {'track': $tags}, streamListener);
};


function streamListener(stream){
  stream.on('data', function(data) {
    //Post only if tweet has photo attached
    if(data['entities'] != null){
      if(data['entities']['media'] != undefined){
        // $valid_tags = getTags(data['text']);      

        // if(getTags(data['text'])){

          console.log('-------------------------');
          console.log('New tweet has photo with tag ' + $tags.toString() + ' is here -- ' + data['created_at']);
          // console.log('Screen name: ' + data['user']['screen_name']);
          // console.log('Content: ' + data['text']);
          // console.log('Image: ' + data['entities']['media'][0].media_url);
          // console.log(util.inspect(data));
          postData(data);
   
          //Send data through socket
          io.sockets.in('room').emit('new_twit', data['entities']['media'][0].media_url);
        // }
      }
    }
    else{
      console.log(util.inspect(data));
    }


  });
  stream.on('error', function(err){
    console.log(err.message);
  });

};

//Workers
function getTags(str){

  $tag_num = 0;

  $words = str.split(' ');
  // $valid_tags = [];

  $tags.forEach(function(tag,i){
    $words.forEach(function(w,j){
      // console.log(tag + ' == ' + w);
      if(tag == w){
        // $valid_tags.push(tag.replace('#',''));
        $tag_num++;
      }
    });

  });

  return ($tag_num >= $tags.length);

  // return $valid_tags.toString();
};

function postData(data){
  var _parameter = '?tag=leovative' + '&image_url=' + escape(data['entities']['media'][0].media_url) + '&screen_name=' + data['user']['screen_name'];

  // console.log(_parameter);
  http
    .get("http://leo.dev/node/twitternodelistener/" + _parameter, success)
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

exports.start = start;
import Echo from 'laravel-echo';
// var express = require('express');
// var app = express();
// var server =require('http').createServer(app);
// var io = require('socket.io').listen(server);
// var request=require("request");
// var redis = require('redis');


window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

// connections = [];

// server.listen(7000);

// console.log('Server is running...');



// const users     = {};

// io.sockets.on('connection', function(socket){

//     // connections.push(socket);

//     console.log('Terhubung: %s sockets sedang terhubung', connections.length);

//     socket.on('send data', function (data) {

//         io.sockets.emit('new data', data);

//     });

// });
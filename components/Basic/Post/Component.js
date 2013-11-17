console.log('hier12');
Kwf.onElementReady('.basicPost', function () {
    var conn = new ab.Session(
        'ws://localhost:8080', // The host (our Ratchet WebSocket server) to connect to
        function() {            // Once the connection has been established
            conn.subscribe('post', function(topic, data) {
                // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                console.log('New article published to category "' + topic + '" : ' + data.key+' '+data.comment);
                console.log(data);
            });
        },
        function() {   // When the connection is closed
            console.warn('WebSocket connection closed');
        },
        {   // Additional parameters, we're ignoring the WAMP sub-protocol for older browsers
            'skipSubprotocolCheck': true
        }
    );
});

// JavaScript Document

var main = function() {
    // Functions
	var connectionStatusUpdate = function(status) {
		if(status == 'connecting') {
            // Connecting ...
            $('#connectionStatus').removeClass('btn-danger');
            $('#connectionStatus').removeClass('btn-info');
            $('#connectionStatus').addClass('btn-warning');
            $('#connectionStatus').text('Connecting ...');
        }
        if(status == 'connected') {
            // Connected
            $('#connectionStatus').removeClass('btn-danger');
            $('#connectionStatus').removeClass('btn-warning');
            $('#connectionStatus').addClass('btn-info');
            $('#connectionStatus').text('Connected');
        }
        if(status == 'retry') {
            // Retry Connection
            $('#connectionStatus').removeClass('btn-info');
            $('#connectionStatus').removeClass('btn-warning');
            $('#connectionStatus').addClass('btn-danger');
            $('#connectionStatus').text('Retry Connection');
        }
	}
    var ajaxPing = function(ip, timeout) {
        $.ajax({
            type: "POST",
            url: "ping.php",
            data: {ip: ip, timeout: timeout},
            dataType: "json",

            success: function(response) {
                if(response['connected'] == 'true') {
                    // Connected
                    connectionStatus = 'connected';
                    connectionStatusUpdate(connectionStatus);
                } else {
                    // Retry
                    connectionStatus = 'retry';
                    connectionStatusUpdate(connectionStatus);
                }
            },

            error: function( xhr, status, errorThrown ) {
                alert( "Could not connect to Interface host server!" );
            },
        })
    }
    
    // Connection Info
    var ip = 'google.com';
    var timeout = 10; // seconds
    var checkInterval = 1000; // miliseconds
    
    // Connect
    var connectionStatus = 'connecting';
    connectionStatusUpdate(connectionStatus);
    ajaxPing(ip, timeout);
    
    // Periodically Check Connection
    setInterval(function() {
        if(connectionStatus == 'connected') {
            ajaxPing(ip, checkInterval);
        }
    }, checkInterval);
}

$(document).ready(main);
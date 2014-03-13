var page = require('webpage').create();
var system = require('system');

if(system.args.length === 2)
	var AS = system.args[1];
else
	var AS = "http://www.bbc.co.uk/programmes/b03865ns";

page.onConsoleMessage = function(msg) {
      console.log(msg);
};

function wat (m) {
    console.log(m);
}

var A = [];

page.open(AS, function(status) {
    if ( status === "success" ) {
            page.evaluate(function() {
		var TNames = document.querySelectorAll("#segments .artist , #segments  .artist,#segments  .artist,#segments  .title,#segments  .artist");
		var L = TNames.length;
		var A = [];
		for(var i = 0; i < L; i = i + 2)
		{
			if(TNames[i] && TNames[i+1]) A.push({artist: TNames[i].innerText, track: TNames[i+1].innerText});
		}
                console.log(JSON.stringify(A));
            });
            phantom.exit();
    }
});



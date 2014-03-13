var page = require('webpage').create();
var system = require('system');
var StartYear = 2008;
var StartMonth = 8;
if(system.args.length === 2)
	var AS = system.args[1];
else
	var AS = "b00cjvxv";

page.onConsoleMessage = function(msg) {
      console.log(msg);
};

function wat (m) {
    console.log(m);
}

var A = [];
var d = new Date();
var Month = system.args[2];
var Year = system.args[3];
if(Month > 9)
	MString = Month + "";
else
	MString = "0" + Month;
page.open(AS, function(status) {
    if ( status === "success" ) {
            page.evaluate(function() {
		var TNames = document.querySelectorAll(".summary a");
		var L = TNames.length;
		var A = [];
		for(var i = 0; i < L; i = i + 2)
		{
			A.push(TNames[i].href);
		}
                console.log(JSON.stringify(A));
            });
            phantom.exit();
    }
});


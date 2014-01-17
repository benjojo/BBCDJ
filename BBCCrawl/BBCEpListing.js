var page = require('webpage').create();
var system = require('system');
var StartYear = 2008;
var StartMonth = 8;
if(system.args.length === 2)
	var AS = system.args[1];
else
	var AS = "b00cjvxv";

page.onConsoleMessage = function(msg) {
//    if(msg.substring(0,1) === "[")
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
console.log("http://www.bbc.co.uk/programmes/"+AS+"/broadcasts/"+Year+"/"+MString);
page.open("http://www.bbc.co.uk/programmes/"+AS+"/broadcasts/"+Year+"/"+MString, function(status) {
    if ( status === "success" ) {
        //console.log(status);
        //page.includeJs("http://localhost/jquery.min.js", function() {
            page.evaluate(function() {
                //console.log("boop");
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
        //});
    }
});


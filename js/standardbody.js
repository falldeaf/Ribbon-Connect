//loading object to pop up
var loader_html = "<div id='loading'><div id='coloumn1' class='coloumns'></div><div id='coloumn2' class='coloumns'></div><div id='coloumn3' class='coloumns'></div><div id='coloumn4' class='coloumns'></div><div id='coloumn5' class='coloumns'></div><div id='coloumn6' class='coloumns'></div></div>";

//user scrolls
$(window).scroll(function () { 
	//update xy pos of cursor for anim wallpaper
	
	//change indicator for module rep
});

function scrollModule(modname)
{
	//alert($('#module_header_' + modname).position().top);
	$(window).scrollTop( $('#module_header_' + modname).position().top );
	//alert( $(window).scrollTop() );
}

function toggleModule(modname)
{
	if( $('#module_collapse_' + modname).text() == '+')
	{
		$('#module_body_' + modname).load('module/' + modname  + '/body.php');
		$('#module_collapse_' + modname).text('-');
		$('#module_body_' + modname).slideDown("fast");
		
		$('#module_extended_' + modname).slideDown("fast");
	} else {
		$('#module_collapse_' + modname).text('+');
		$('#module_body_' + modname).html("");
		$('#module_body_' + modname).slideUp("fast");
		
		$('#module_extended_' + modname).slideUp("fast");
	}
}

$(function()
{
	$('.barspark').sparkline( 'html', { type: 'bar', 
										barColor: 'white', 
										negBarColor: 'black',
										zeroColor: 'grey'
										} );

	$('.piespark').sparkline( 'html', { type: 'pie', 
										sliceColors: ['#000', 'rgba(0,0,0,0.2)', '#888', '#555', '#222']
									} );

	$('.linespark').sparkline( 'html', { type: 'line', 
										lineColor: 'black',
										spotColor: '',
										minSpotColor: '',
										maxSpotColor: '',
										fillColor: ''											
									} );		

	
	/*
	var canvas = document.getElementsByTagName("canvas");
	for ( var i = 0; i < canvas.length; i++ )
	{
		//temp turn off processing (why the error?)
		Processing( canvas[i], canvas[i].previousSibling.textContent );
	}
	*/
	//alert( "foo " + webkitNotifications.checkPermission());
	
});

function auth_notify ()
{
		alert(window.webkitNotifications.requestPermission());
}	
		
// Create a simple text notification:
function notify ()
{
	var notification = webkitNotifications.createNotification(
	'48.png',  // icon url - can be relative
	'Hello!',  // notification title
	'Lorem ipsum...'  // notification body text
	);
	notification.show();
}

// Or create an HTML notification:
//var notification = webkitNotifications.createHTMLNotification(
//  'notification.html'  // html url - can be relative
//);
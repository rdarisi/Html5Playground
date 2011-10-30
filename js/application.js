$(document).ready(function () {

    // OUTER/PAGE LAYOUT
    pageLayout = $("body").layout({ // DO NOT use "var pageLayout" here
	west__size:			.30 
	,	south__size:		.40 
	,	east__initClosed: true
	,	south__initClosed:	false
	,	north__initClosed:	true
	,	west__onresize:		$.layout.callbacks.resizePaneAccordions // west accordion a child of pane
	//,	east__onresize:		$.layout.callbacks.resizePaneAccordions // east accordion nested inside a tab-panel 	         
    }); 

    // TABS IN CENTER-PANE
    // create tabs before wrapper-layout so elems are correct size before creating layout
    pageLayout.panes.center.tabs({
	show:				$.layout.callbacks.resizeTabLayout // tab2-accordion is wrapped in a layout
    });

    // WRAPPER-LAYOUT FOR TABS/TAB-PANELS, INSIDE OUTER-CENTER PANE
    pageLayout.panes.center.layout({
	closable:			false
	,	resizable:			false
	,	spacing_open:		0
	,	center__onresize:	$.layout.callbacks.resizeTabLayout // tabs/panels are wrapped with an inner-layout
    });

    // LAYOUT TO CONTAIN HEADER+ACCORDION, INSIDE A TAB, INSIDE OUTER-CENTER PANE
    /*$("#tab-panel-center-2").layout({
      center__onresize:	$.layout.callbacks.resizePaneAccordions // accordion is inside center-pane
      ,	resizeWithWindow:	false	// resizing is handled by callbacks to ensure the correct resizing sequence
      ,	triggerEventsOnLoad: true	// force resize of accordion when layout inits - ie, becomes visible 1st time
      });*/

    // TABS INSIDE EAST-PANE
    /*pageLayout.panes.east.tabs({
      show:				$.layout.callbacks.resizePaneAccordions // resize tab2-accordion when tab is activated
      });
      pageLayout.sizeContent("east"); // resize pane-content-elements after creating east-tabs
    */
    // INIT ALL ACCORDIONS - EVEN THOSE NOT VISIBLE
    $("#accordion-west")	.accordion({ fillSpace: true });
    $("#accordion-center")	.accordion({ fillSpace: true });
    //$("#accordion-east")	.accordion({ fillSpace: true });


    // THEME SWITCHER
    //addThemeSwitcher('#east-toolbar',{ top: '12px', right: '5px' });
    // if a new theme is applied, it could change the height of some content,
    // so call resizeAll to 'correct' any header/footer heights affected
    // NOTE: this is only necessary because we are changing CSS *AFTER LOADING* using themeSwitcher
    setTimeout( pageLayout.resizeAll, 2000 ); /* allow time for browser to re-render with new theme */

    /* Dyanmically build the sidebar */
    var sidebar = $("#example_sidebar");
    $.each(example_data, function(index, value) { 
	sidebar.append(build_sidebar_link(value));
    });

    /* Handle loading the examples */
    $('a.example_link').click(function(e){
	e.preventDefault();
	render_example($(this).attr("href"));
    });
});

function build_sidebar_link(ex) {
    return '<p><a href="index.html?example=' + ex.name + '">' + ex.name + '</a></p>';
}

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}

function buildExampleURL(name) {
    var href = window.location.href.split('?')[0];
    var url =  href.substring(0, href.length - 11) + "/examples/" + name;
    return url;
}

function load_example(example) { 
     $.ajax({
      type: "GET",
	 url: "examples/" + example.htmlfile,
      dataType: 'html',
	 success: function(data){
	     editorHTML.setValue(data);
	 },
     });
}

// Parse the URL parameters and get the example name
var example_name = getURLParameter("example");

// Find the information associated with this example
var exampleJSON = $.grep(example_data, function (ex) { 
    return ex.name === example_name; 
})[0];

if (exampleJSON != undefined) {
    load_example(exampleJSON);
}
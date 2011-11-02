<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

	<title>AppUp HTML Playground!</title> 

	<link rel="stylesheet" type="text/css" href="css/layout_default.css" />
	
	<!-- Load Code Mirror CSS -->
	<link rel="stylesheet" type="text/css" href="css/codemirror.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css" />
		
	<style type="text/css">
	/* neutralize pane formatting BEFORE loading UI Theme */
	.ui-layout-pane ,
	.ui-layout-content {
		background:	none;
		border:		0;
		padding:	0;
		overflow:	visible;
	}
	
	</style>
	<link rel="stylesheet" type="text/css" href="css/jquery_ui_all.css" />
	<style type="text/css">
	p				{ margin:		1em 0; }

	/* use !important to override UI theme styles */
	.grey			{ background:	#333 !important; }
	.outline		{ /*border:		1px dashed #F00 !important;*/ }
	.add-padding	        { padding:		5px !important; }
	.no-padding		{ padding:		0 !important; }
	.add-scrollbar	        { overflow:		auto; }
	.no-scrollbar	        { overflow:		hidden; }
	.allow-overflow	        { overflow:		visible; }
	.full-height	        { height:		100%; }
	button			{ cursor:		pointer; }

	iframe#preview {
	  border: 0;
	  width: 100%;
	  height: 100%;
	}

	#container {
		Min-Height:	300px;
		position:	absolute;
		top:		50px;	/* margins in pixels */
		bottom:		0px;	/* could also use a percent */
		left:		0px;
		right:		0px;
	}
	
	#topbar {
		Min-Height:	50px;
		position:	absolute;
		top:		0px;	/* margins in pixels */
		bottom:		0px;	/* could also use a percent */
		left:		0px;
		right:		0px;
	        background: #000;
	}

	#logo {
	        margin-top: 5px;
	
	}

	#nav {
	float: right;
	margin: 29px 0 0;
	font: 200 18px/1 "Bebas Neue","League Gothic","Arial Narrow",Arial,Helvetica,sans-serif;
	text-transform: uppercase;
	letter-spacing: .5px;
	}

	</style>
	<script language="javascript">
	var id = "";
<?php
	if(isset($_GET) && isset($_GET['id'])) {
		echo 'id = "'.$_GET['id'].'"';		
	}
?>
	</script>
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript" src="js/jquery-ui-latest.js"></script> 
	<script type="text/javascript" src="js/jquery.layout.js"></script>

	<!-- load the Tabs & Accordions callbacks so we can use them below-->
	<script type="text/javascript" src="js/jquery.tabs.js"></script>
	<script type="text/javascript" src="js/jquery.accordions.js"></script>
	<!-- OR load the all-in-one Callbacks package...
	<script type="text/javascript" src="../lib/js/jquery.layout.callbacks.min-latest.js"></script>
	-->

	<!--<script type="text/javascript" src="../lib/js/themeswitchertool.js"></script> 
	<script type="text/javascript" src="../lib/js/debug.js"></script>-->

	<!-- Load Codemirror JavaScript files -->
	<script type="text/javascript" src="js/codemirror.js"></script>
	<script type="text/javascript" src="js/xml.js"></script>	
	<script type="text/javascript" src="js/css.js"></script>	
	<script type="text/javascript" src="js/htmlmixed.js"></script>	
	<script type="text/javascript" src="js/javascript.js"></script>	
	<script type="text/javascript" src="js/local.js"></script>	

	<script>
	  var example_data = [
	  {name:"helloworld", htmlfile:"helloworld.html"}
	  , {name:"Example 2", htmlfile:"example2.html"}];
	</script>

	<script type="text/javascript" src="js/application.js"></script>	
</head> 
<body> 


  <header id="topbar" class="minor">
    <div class="wrap">
      <h1 id="logo"><a href=""><img src="css/images/appup/logo-appup-main.png" alt="AppUp Playground Home Page" title="AppUp Playground"/></a></h1>
    </div>
  </header>
  
<div id="container">
<!--<Div Class="ui-layout-north ui-widget-content add-padding">North</div>--> 
<div class="ui-layout-south ui-widget-content add-padding">
	<iframe id="preview"></iframe>
</div> 


<div class="pane ui-layout-west no-scrollbar add-padding grey">
  <h3><a href="#">Tizen HTML5 Examples</a></h3>

  <h3><a href="#">WAC API examples</a></h3>
  <div>
    <p style="font-weight: bold;">Sed Non Urna</p>
    <p>Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus.
      Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit,
      faucibus interdum tellus libero ac justo.</p>
    <p>Vivamus non quam. In suscipit faucibus urna.</p>
  </div>
  
  <h3><a href="#">JavaScript Examples</a></h3>
  <div>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
    Phasellus pellentesque purus in massa. Aenean in pede.
  </div>
  
  <h3><a href="#">CSS Examples</a></h3>
  <div>
    <p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames 
      ac turpis egestas.</p>
    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
      Aenean lacinia mauris vel est.</p>
    <p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
      Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
  </div>	
</div>






<div id="tabs-center" class="ui-layout-center no-scrollbar add-padding grey">

  <ul class="ui-layout-north no-scrollbar allow-overflow">
    <li><a href="#tab-panel-center-1">HTML</a></li>
    <li><a href="#tab-panel-center-2">JavaScript</a></li>
    <li><a href="#tab-panel-center-3">CSS</a></li>
  </ul>
  <div class="ui-layout-center ui-widget-content add-scrollbar"> 
    <!-- <div id="tab-panel-center-1" class="outline no-padding no-scrollbar"> -->
      <textarea id='editorHTML'>
<html>
  <body>
    <h1>Welcome to the Tizen HTML Playground.</h1>
  </body>
</html>
      </textarea>
    </div>
    <div id="tab-panel-center-2" class="outline no-padding no-scrollbar">
      <textarea id='editorJS'>function myScript(){return 100;}</textarea>
    </div>
    <div id="tab-panel-center-3" class="outline no-padding no-scrollbar">
      <textarea id='editorCSS'>
h1 {
  color: 'blue';
}
			</textarea>
		</div>
	</div>
	<!-- /center Tabs layout -->
</div>


<div id="tabs-east" class="ui-layout-east no-padding no-scrollbar" style="display: none;">
  
</div>
</div>

<script type="text/javascript">
    var delay;
    var editorHTML = CodeMirror.fromTextArea(document.getElementById("editorHTML"), {
	value: "<html></html>"
	, mode: "text/html"
	, tabMode: "indent"
	, lineNumbers: true
	, onChange: function() {
	    clearTimeout(delay);
	    delay = setTimeout(updatePreview, 300);
	}
    });
    var editorJS = CodeMirror.fromTextArea(document.getElementById("editorJS"), {
	lineNumbers: true
	, tabMode: "indent"
	, mode:  "javascript"
    });
    var editorCSS = CodeMirror.fromTextArea(document.getElementById("editorCSS"), {
	lineNumbers: true
	, value: "function myScript(){return 100;}\n"
	, tabMode: "indent"	
	, mode:  "css"
    });

    function updatePreview() {
	var previewFrame = document.getElementById('preview');
	var preview =  previewFrame.contentDocument || previewFrame.contentWindow.document;
	preview.open();
	var v = editorHTML.getValue();
	preview.write(v);
	preview.close();
    }
    // Set the first updatePreview timer
    setTimeout(updatePreview, 300);
</script>
</div>
</body> 
</html>

<?php
function run() {
	$html = '';
	$css  = '';
	$javascript = '';
	if(isset($_POST) && isset($_POST['html'])) {
		$html = $_POST['html'];
	} 
	if(isset($_POST) && isset($_POST['css'])) {
		$css = $_POST['css'];
	} 
	if(isset($_POST) && isset($_POST['javascript'])) {
		$javascript = $_POST['javascript'];
	}
	return makehtml(array("html"=>$html,"javascript"=>$javascript,"css"=>$css,"arefiles"=>false)); 
}
function show() {
	$id = '';
	$return = array();
	if(isset($_POST) && isset($_POST['id'])) {
		$id = $_POST['id'];
		//var_dump(getcwd().'/../content/'.$id.'/html_part.html');exit;
		if(is_file(getcwd().'/../content/'.$id.'/html_part.html')) {
			$return['html'] = file_get_contents(getcwd().'/../content/'.$id.'/html_part.html');
		}
		if(is_file(getcwd().'/../content/'.$id.'/js/local.js')) {
			$return['javascript'] = file_get_contents(getcwd().'/../content/'.$id.'/js/local.js');
		}
		if(is_file('content/'.$id.'/css/local.css')) {
			$return['css'] = file_get_contents(getcwd().'/../content/'.$id.'/css/local.css');
		}
	} 
	return json_encode($return);
}
function save() {
	$html = '';
	$css  = '';
	$javascript = '';
	if(isset($_POST) && isset($_POST['html'])) {
		$html = $_POST['html'];
	} 
	if(isset($_POST) && isset($_POST['css'])) {
		$css = $_POST['css'];
	} 
	if(isset($_POST) && isset($_POST['javascript'])) {
		$javascript = $_POST['javascript'];
	}
	return makefiles(array("filepath"=>'/content/'.uniqid(),"html"=>$html,"javascript"=>$javascript,"css"=>$css,"arefiles"=>false)); 
}

function download() {
}
/**
* takes html, javascript, css and makes files - the folder structure will be :
*	--> md5(timestamp)/index.html
*	--> md5(timestamp)/js/local.js
*	--> md5(timestamp)/css/local.css
*
* @param array $options - to scale for the future needs this is made an array - individual items are explained below
* @param sting $options['filepath'] path to where individual files are to be stored 
* @param sting $options['html'] this is the content that is inside <body></body> tag
* @param sting $options['css'] css content
* @param sting $options['javascript'] javascript content
* @return all integrated html content
*/ 
function makefiles($options) {
	mkdir($options['filepath'],0777, true);
	if(!empty($options['javascript'])) {
		if(mkdir($options['filepath'].'/js/',0777, true)) {
			file_put_contents($options['filepath'].'/js/local.js', $options['javascript']);
		}
	}	
	if(!empty($options['css'])) {
		if(mkdir($options['filepath'].'/css/',0777, true)) {
			file_put_contents($options['filepath'].'/css/local.css', $options['css']);
		}
	}
	file_put_contents($options['filepath'].'/index_part.html',$options['html']);
	$html = makehtml(array('html'=>$options['html'], 'javascript'=>$options['filepath'].'/js/local.js', 'css'=>$options['filepath'].'/css/site.css', 'arefiles'=>true));
	file_put_contents($options['filepath'].'/index.html',$html);
	return true;	
}

/**
* Makes full html depending on 'arefiles', if 'javascript', 'css' are files they are included
* if it is a content then they are included inline 
*
* @param array $options - to scale for the future needs this is made an array - individual items are explained below
* @param sting $options['html'] this is the content that is inside <body></body> tag
* @param sting $options['css'] this can be css content or a file path to a css file
* @param sting $options['javascript'] this can be javascript content or a file path to a javascript file
* @param sting $options['arefiles'] - tells if $javascript and $css are file contents or path to files
* @return all integrated html content
*/ 
function makehtml($options) {
	$return = '';
	$return .= '<!DOCTYPE HTML>\n';
	$return .= '<html>\n';
	$return .= '<meta content="text/html; charset=UTF-8" http=equiv="content-type">\n';
	$return .= '<head>\n';
	$return .= '<title>My Sample</title>\n';
	if($options['arefiles']) {
		if(!empty($options['css'])) {
			$return .= '<link rel="stylesheet" href="'.$options['css'].'" type="text/css" />';
		}
		if(!empty($javascript)) {
			$return .= '<script src="'.$options['javascript'].'" type="text/javascript"></script>';
		}
	}
	else {
		$return .= '<style>\n';
		$return .= $options['css'];
		$return .= '\n</style>\n';
		$return .= '\n<script language="JavaScript">\n';
		$return .= '<![CDATA[';
		$return .= $options['javascript'];
		$return .= '//]]>';
		$return .= '\n</script>\n';
	}
	$return .= '</head>\n';
	$return .= '<body>\n';
	$return .= $options['html'];
	$return .= '\n</body>\n';
	$return .= '</html';
	return $return;	
}
?>

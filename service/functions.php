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
		if(is_file('content/'.$id.'/css/README.txt')) {
			$return['text'] = file_get_contents(getcwd().'/../content/'.$id.'/README.txt');
		}
	} 
	return json_encode($return);
}
function save() {
	$html = '';
	$css  = '';
	$javascript = '';
	$text = '';
	$unique_id = uniqid();
	if(isset($_POST) && isset($_POST['html'])) {
		$html = $_POST['html'];
	} 
	if(isset($_POST) && isset($_POST['css'])) {
		$css = $_POST['css'];
	} 
	if(isset($_POST) && isset($_POST['javascript'])) {
		$javascript = $_POST['javascript'];
	}
	if(isset($_POST) && isset($_POST['text'])) {
		$text = $_POST['text'];
	}
	if(makefiles(array("filepath"=>getcwd().'/../content/'.$unique_id,"html"=>$html,"javascript"=>$javascript,"css"=>$css,"arefiles"=>false,"text"=>$text))) {
		return $unique_id;
	}
	return false; 
}

function download() {
	if(isset($_POST) && isset($_POST['id'])) {
		if(zipit(getcwd().'/../content/'.$_POST['id'], getcwd().'/../content/'.$_POST['id']."/".$_POST['id'].'.zip', "html_part.html")) {
			return '/../content/'.$_POST['id']."/".$_POST['id'].'.zip';
		}
	}
	return false;
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
			if(!file_put_contents($options['filepath'].'/js/local.js', $options['javascript'])) {
				return false;
			}
		}
		else {
			return false;
		}
	}	
	if(!empty($options['css'])) {
		if(mkdir($options['filepath'].'/css/',0777, true)) {
			if(!file_put_contents($options['filepath'].'/css/local.css', $options['css'])) {
				return false;
			}
		}
		else {
			return false;
		}
	}
	if(!file_put_contents($options['filepath'].'/index_part.html',$options['html'])) {
		return false;
	}
	if(!file_put_contents($options['filepath'].'/README.txt',$options['text'])) {
		return false;
	}
	$html = makehtml(array('html'=>$options['html'], 'javascript'=>$options['filepath'].'/js/local.js', 'css'=>$options['filepath'].'/css/site.css', 'arefiles'=>true));
	if(!file_put_contents($options['filepath'].'/index.html',$html)) {
		return false;
	}
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
function Zip($source, $destination, $exclude = array("html_part.html"))
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }
    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }
    $source = str_replace('\\', '/', realpath($source));
    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', realpath($file));
            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true && exclude($exclude, $file) === false)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }
    return $zip->close();
}
function exclude($exclude, $file) {
	foreach ($exclude as $e) {
		if(strpos($file, $e) > 0) {
			return true;
		}
	}
	return false;
}
function zipit($destination, $source, $exclude = "") {
	$output = null;
	$command = "zip  -r ".$destination." ".$source." -x ".$exclude;
	exec($command,$output);
	return is_file($source); 		
}
?>

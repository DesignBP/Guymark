<?php
header("Content-type:text/html;charset=utf-8");
$pagecode = trim($_REQUEST["PageCode"]);
$filename = trim($_REQUEST["FileName"]);
$savepath = trim($_REQUEST["SavePath"]);
$filetype = trim($_REQUEST["FileType"]);
$postmodule = trim($_REQUEST["PostModule"]);
$request_type = trim($_REQUEST["RequestType"]);
$linksplit = trim($_REQUEST["LinkSplit"]);
$host = $_SERVER["HTTP_HOST"]; 
$script_name  = $_SERVER["REQUEST_URI"];

$url = $_SERVER["SCRIPT_FILENAME"];

$script_url = "http://".$host.$script_name;


// $current_path = substr(realpath($url),0,strpos(realpath($url),"\\"));
$real_path = realpath($url);
$current_path = substr($real_path, 0, strrpos($real_path, str_ireplace('\\', '/', $real_path)));
if($savepath == "\\" || $savepath =='')
{
  $savepath = $current_path;
  $savefullpath = $savepath.$filename.".".$filetype;
}
else
{
  $savepath = $current_path . $savepath . "/";
  $savefullpath = $savepath.$filename.".".$filetype;
}

$current_url = substr($script_url,strpos($script_url,"/"));
$current_url = $current_url.str_replace("\\","/",str_replace($current_path,"",$savefullpath));

if($postmodule=="mirror") 
{   
	  CreateFolder($savepath);
	  showFolderFileCount($savepath);
     
}
else
{
  if($request_type=="Post")
  {
	if(!is_dir($savepath));
	{ 
	$savepath=substr($savepath,0,strlen($savepath)-1);
  
	  @mkdir($savepath);
	}
	if (file_exists($savefullpath))
	{
		
		
	  WriteToUTF($savefullpath,$pagecode,"UTF-8") ;
	   

	   $a_a = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
       $a_a = preg_replace('/(.*)\/{1}([^\/]*)/i', '$1', $a_a);

	   
	   $current_url=$a_a."/".$savepath."/".$filename.".".$filetype;
	 
	  echo $current_url . $linksplit . "1";
	  
	}
	else
	{
	  Deltextfile($savefullpath);
	  WriteToUTF($savefullpath,$pagecode,"UTF-8");
	  
	  $a_a = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
       $a_a = preg_replace('/(.*)\/{1}([^\/]*)/i', '$1', $a_a);
	  
	  
	   $current_url=$a_a."/".$savepath."/".$filename.".".$filetype;
	  echo $current_url . $linksplit . "2";
	}
  }
  else if($request_type=="Test")
  {
	echo "======================================================".'<br/>';
	echo "FilePath : - " . $savefullpath.'<br/>';
	echo "URL : - " . $current_url.'<br/>';
	echo "PageCode :" .'<br/>';
	echo $pagecode .'<br/>';
	echo "======================================================";
  }}

function WriteToUTF($savefullpath,$Str,$CharSet)
{
 
  $file=@fopen($savefullpath,'xb+');
  
 if($file=="false")
	  {
		exit;
	   }
  //$Str="\\xEF\\xBB\\xBF".$Str; 
  @fputs($file,$Str);
  @fclose($file);
}


//$time=$_REQUEST["ModifyDate"];

if (file_exists($time))
	{

$time=str_replace("-","",$time);

$time=str_replace(":","",$time);

$time=str_replace(" ","",$time);





touch($savefullpath,$time);	
		
	 }

 
function Deltextfile($fileurl)
{
  if(file_exists($fileurl))
  {
	  @unlink ($fileurl);
  }
}

function CreateFolder($strFolder)
{ 
  do
  {
	  $lastChar=substr($strFolder,strlen($strFolder)-1);
	  if($lastChar=='\\' || $lastChar=="/")
	  {
		  $strFolder=substr($strFolder,0,strlen($strFolder)-1);
	  }
	  else 
	  {
		  break;
	  }
  }while(1);
  if($strFolder != '' && !file_exists($strFolder))
  {
	  @mkdir($strFolder);
  }
}
function showFolderFileCount($path)
{
	$cnt=0;
    if(is_dir($path))
	{
		if (!preg_match("/\/$/si", $path)) {
			$path .= '/';
		}
		$files = glob("{$path}*.*");
		$cnt = count($files);
		unset($files);	
	}
	echo $cnt;
}
?>
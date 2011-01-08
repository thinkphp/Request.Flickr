<?php
if(isset($_GET['username']) && $_GET['username'] != '') {
   $user = $_GET['username'];
} else {$user = "ydn";}

//get time
$oldtime = microtime(true);

$title = "select * from flickr.own.photos where username='$user'";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <title><?php echo$title;?></title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
   <style type="text/css">
   html,body{font-family: georgia,helvetica,arial,sans-serif;}
   h1{ font-size:200%; margin:0; padding-bottom:10px; color:#0f89d6;}
   h1 span{color: #c00}
   form{background:#b4f08a;padding: 5px;-moz-box-shadow:5px 5px 7px rgba(33, 33, 33, 0.7);width: 100%}
   #badge{font-family: georgia,helvetica,arial;}
    ul {width: 500px}  
    ul li{float:left;padding:5px;background:#eee;border:1px solid #999;margin-right:5px; list-style:none;}
   div.loading{margin: 20px;font-weight: bold;}
   .error{color: #fff;background: #c00;padding: 4px;width: 350px}
   #ft{font-size:80%;color:#888;text-align:left;margin:2em 0;font-size: 12px}
   #ft p a{color:#93C37D;}
   </style>
</head>
<body>
<div id="doc2" class="yui-t7">
   <div id="hd" role="banner"><h1><?php echo$title;?></h1></div>
   <div id="bd" role="main">
	<div class="yui-g">
         <form id="f" name="f">
           <label for="username">Enter Username: </label>
           <input type="text" id="username" name="username" value="<?php echo$user;?>"/>
           <input type="submit" value="Search">
         </form>  
         <div id="badge">

<?php

if(isset($_GET['username'])) {

   //filter the search term for insecure URL content
   $username = filter_input(INPUT_GET,'username',FILTER_SANITIZE_SPECIAL_CHARS);

   //your YQL statement
   $yql = "use 'http://thinkphp.ro/apps/YQL/flickr.own.xml' as flickr.own.photos; select * from flickr.own.photos where username='".$username."' and amount=20 and size='s'";

   //start the URL by defining the API endpoint and encoding the query
   $endpoint = 'http://query.yahooapis.com/v1/public/yql?q=';
   $url = $endpoint . urlencode($yql);

   //diagnostics - remove it if you don't need them
   $url .= '&diagnostics=false';

   //format - (xml or JSON)
   $url .= '&format=xml';

   //environment this gives you access to the community tables
   //$url .= '&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';

     echo"<h2>$username 's photostream</h2>";
     echo$results = get($url);
}

?>

         </div>
	</div>
	</div>
   <div id="ft"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> using <a href="http://thinkphp.ro/apps/YQL/flickr.own.xml">Open Data Table</a> | You can grab the source code of this demo on <a href="http://mootools.net/forge/download/Request_Flickr/v1.0">Forge</a> | Time spent: <?php echo (microtime(true) - $oldtime);?></p></div></div>
</div>
</body>
</html>

<?php
function get($url) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
    $data = curl_exec($ch);
    $data = preg_replace('/<\?.*\?>/','',$data);
    $data = preg_replace('/<\!--.*-->/','',$data);
    $data = preg_replace('/.*<ul>/','<ul>',$data);
    $data = preg_replace('/<\/ul>.*/','</ul>',$data);
    curl_close($ch); 
    if(empty($data)) {return 'Server Timeout. Try agai later!';}
                 else {return $data;}
}
?>
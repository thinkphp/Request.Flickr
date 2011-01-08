<?php
if(isset($_GET['username']) && $_GET['username'] != '') {
   $user = $_GET['username'];
} else {$user = "ydn";}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
   <title>Request.Flickr</title>
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
   <script src="http://www.google.com/jsapi?key=ABQIAAAA1XbMiDxx_BTCY2_FkPh06RRaGTYH6UMl8mADNa0YKuWNNa8VNxQEerTAUcfkyrr6OwBovxn7TDAH5Q"></script>
   <script type="text/javascript">google.load("mootools", "1.3.0");</script>
   <script type="text/javascript" src="Request.JSONP.js"></script>
   <script type="text/javascript" src="Request.Flickr.js"></script>
</head>
<body>
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>new Request.Flick<span>r</span>(o,options)</h1></div>
   <div id="bd" role="main">
	<div class="yui-g">
         <form id="f" name="f">
           <label for="username">Enter Username: </label>
           <input type="text" id="username" name="username" value="<?php echo$user;?>"/>
           <input type="submit" value="Search">
         </form>  
         <div id="badge"></div>
	</div>
	</div>
<div id="ft"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a> using <a href="http://thinkphp.ro/apps/YQL/flickr.own.xml">Open Data Table</a> | You can grab the source code of this demo on <a href="http://mootools.net/forge/download/Request_Flickr/v1.0">Forge</a></p></div></div>
</div>
<script type="text/javascript">
           <?php if(isset($_GET['username'])) { ?> 
                        new Request.Flickr({username: '<?php echo$user;?>', amount: 20, size: 's'},{
                                onSuccess: function(o) {
                                     if(window.console){console.log(o);}
                                     if(o.results[0].indexOf('<ul/>') !== -1) {
                                        $('badge').set('html','<h2 class="error">No found photos for this <?php echo$user; ?> </h2>');
                                        $('badge').fade('hide');
                                        $('badge').fade(1);
                                     } else {
                                        $('badge').set('html',o.results[0]);
                                     }
                                },
                                onRequest: function(script) {
                                     //if element with ID 'badge' has children then remove them with this method empty();
                                     $('badge').empty();
                                     new Element('div',{'class': 'loading'}).set('text','Loading...').inject($('badge'));
                                }
                        }).send();
           <?php } ?>
</script>
</body>
</html>

Request.Flickr
==============

This plugin tries to retrieve photos from any user Flickr using YQL and executing JavaScript in Open Data Table.


![Screenshot](http://farm6.static.flickr.com/5122/5336242659_f116cfc454.jpg)

How to use
----------

First you must to include the JS files in the head of your HTML document.

        #HTML
        <script type="text/javascript" src="mootools-core.js"></script>
        <script type="text/javascript" src="JSONP.js"></script>
        <script type="text/javascript" src="Request.Flickr.js"></script>

In your JS.

       #JS
       new Request.Flickr({username: 'ydn',amount: 20, size: 's',tags: 'hackday'},{
             onSuccess: function(o) {
                    if(window.console){console.log(o);}
                    $('badge').set('html',o.results[0]);
             },
             onRequest: function(script) {
                    if(window.console){console.log(script);}
                    new Element('span',{'class': 'loading'}).set('text','Loading...').inject($('badge'));
             }
      }).send();

      //you can load flickr photos using the method 'toFlickr'
      $('badge2').toFlickr({username: 'ericgozar', amount: 20, tags: 'beach', size: 's'});

      //also, you can use the method 'loadFlickrPhotos' like this:
      $('badge3').set('flickr',{username: 'ydn', 
                         amount: 20, 
                         size: 's', 
                         tags: 'hackathon'});
      $('badge3').loadFlickrPhotos();   

      //setting up element with setter and getter
      //for documentation go to: http://mootools.net/blog/2010/06/10/setting-up-elements/
      $('badge4').set('flickr',{username: 'ydn', amount: 10, size: 'm', tags: 'hackathon'});
      $('badge4').get('flickr').send();


In your HTML.

       #HTML
       <div id="badge"></div>
       <div id="badge2"></div>
       <div id="badge3"></div>
       <div id="badge4"></div>

### Notes:

You can view in action:

- [http://thinkphp.github.com/Request.Flickr/Element.loadFlickrPhotos.html](http://thinkphp.github.com/Request.Flickr/Element.loadFlickrPhotos.html)
- [http://thinkphp.github.com/Request.Flickr/Element.toFlickr.html](http://thinkphp.github.com/Request.Flickr/Element.toFlickr.html)
- [http://thinkphp.github.com/Request.Flickr/Request.Flickr.basic.html](http://thinkphp.github.com/Request.Flickr/Request.Flickr.basic.html)
- [http://thinkphp.github.com/Request.Flickr/Request.Flickr.form.html](http://thinkphp.github.com/Request.Flickr/Request.Flickr.form.html)
- [http://thinkphp.github.com/Request.Flickr/Request.Flickr.html](http://thinkphp.github.com/Request.Flickr/Request.Flickr.html)
- [http://thinkphp.github.com/Request.Flickr/myElem.loadFlickrPhotos.html](http://thinkphp.github.com/Request.Flickr/myElem.loadFlickrPhotos.html)
- [http://thinkphp.github.com/Request.Flickr/myElem.toFlickr.html](http://thinkphp.github.com/Request.Flickr/myElem.toFlickr.html)
- [http://thinkphp.github.com/Request.Flickr/getter-setter.html](http://thinkphp.github.com/Request.Flickr/getter-setter.html)


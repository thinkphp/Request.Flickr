Class: Request.Flickr {#Request.Flickr}
=======================================

This plugin tries to retrieve photos from any user Flickr using YQL and executing JavaScript in Open Data Table.


### Extends:

Request.JSONP (creates a JSON request using script tag injection and handles the callbacks for you).


Request.Flickr Method: constructor {#Request.Flickr: constructor}
-----------------------------------------------------------------

### Syntax:

    var flickr = new Request.Flickr(params, options);

### Arguments:

1. params (*Object*) the desired username SlideShare.
2. options (*Object*) An object containing the Request.Flickr instance's options.
Note: all the options you know from the class Request.JSONP because we have an inheritance.

### Returns:

(*Object*) This instance of Request.Flickr.

### Events:

All the events you know from Request.JSONP

### success 

(*Function*) - callback to execute when the data returns.

### Signature

    onSuccess(resp)

#### Arguments:

- resp (*object*) - the response received from YQL proxy service.

   ex: Object { query=Object, more...} 


### complete

(*Function*) - callback to execute when the data returns.

### Signature:

    onComplete(resp)

#### Arguments:

- resp (*object*) - the response received from YQL proxy service.

   ex: Object { query=Object, more...} 

### request

(*Function*) - fired when you make a request.

### Signature:

    onRequest(scriptSrc, scriptEl)

#### Arguments:

- scriptSrc (*string*) - the script's src
  ex: http://query.yahooapis.com/v1/public/yql?q=...
- scriptEl (*object*) - the HTMLScriptElement
  ex: <script type="text/javascript" src="http://query.yahooapis.com/v1/public...

Request.Flickr Method: send(#Request.Flickr:send)
-------------------------------------------------

Executes a JSON request.

### Syntax:

    myreq.send([options]);

#### Arguments: 

- options (*Object*, optional) - key/value options that configure the request. Note: all options you know from Request.JSONP.

### Returns:

- (*Object*) This instance of Request.Flickr.


## Element Method: toFlickr

Updates the content of an Element with the desired photos badge.

### Syntax:

    myElem.toFlickr(params);

#### Arguments: 

1. params (*object*) - parameters configuration.

#### Params:

1. username (*String*) - the username Flickr.com you want.
2. amount (*Integer*)  - number of photos you want from user.
3. tags (*String*)     - the tag name. ex: beach.
4. size (*Char*)       - photos's size (ex: 's' for small, 't': for thumb, 'm': for medium).

### Returns:

(*Element*) - the target Element.

### Example: 

    #html
    <div id="badge"></div>
 
    #js 
    $('badge').toFlickr({username: 'ericgozar', amount: 20, tags: 'beach', size: 's'});    


Object: Element.Properties (#Element-Properties)
================================================

see: [Element.Properties](https://github.com/core/Element/Element/#Element-Properties)

Element Property: flickr {#Element-Properties: flickr}
------------------------------------------------------

### Setter

Sets..

### Syntax:

    el.set('flickr'[, params [, options]);

#### Arguments:

1. params  - (*object*) the params flickr user.
2. options - (*object*) the Request.Flickr options.

#### Returns:

* (*element*) the original element.

#### Example:

$('badge').set('flickr',{username: 'ydn', 
                         amount: 20, 
                         size: 's', 
                         tags: 'hackathon'
                         });

### Getter

Returns the previously set Request.Flickr instance (or a new one with default options).

#### Syntax:

	el.get('flickr');

#### Arguments:

1. property - (*string*) the Request.Flickr property argument.

### Returns:

* (*object*) The Request.Flickr instance.

#### Example:

     myElem.get('flickr').send();



Element Method: loadFlickrPhotos {#Element:loadFlickrPhotos}
-----------------------------------------------------------

this method loads flickr photos from any user Flickr.

### Syntax:

     myElement.loadFlickrPhotos();

### Arguments:

     none.

### Returns:

* (element) This Element.

### Example:

    $('badge').set('flickr',{username: 'ydn', amount: 20, size: 's', tags: 'hackathon'});
    $('badge').loadFlickrPhotos();




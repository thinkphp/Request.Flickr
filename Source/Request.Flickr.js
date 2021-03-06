/*
---
description: This plugin tries to retrieve photos from any user Flickr using YQL and executing JavaScript in Open Data Table.

authors:
- Adrian Statescu (http://thinkphp.ro)

license:
- MIT-style license

requires:
 core/1.3: '*'
 more/1.3.0.1: Request.JSONP

provides: [Request.Flickr]
...
*/

Request.Flickr = new Class({
           Extends: Request.JSONP,
           options: {
                    url: "http://query.yahooapis.com/v1/public/yql?q=use%20'http%3A%2F%2Fthinkphp.ro%2Fapps%2FYQL%2Fflickr.own.xml'%20as%20flickr.own.photos%3B%20select%20*%20from%20flickr.own.photos%20where%20username%3D'{username}'%20and%20amount%3D'{amount}'%20and%20size%3D'{size}'%20and%20tags%3D'{tags}'",
                    data: {
                        format: 'xml',
                        diagnostics: true,
                    }
           },
           initialize: function(o,options) {
               var username = o.username || 'statescua', 
                   amount = o.amount || 10,
                   size = o.size || 's',
                   tags = o.tags || "";
                   this.options.url = this.options.url.substitute({username: username, amount: amount, size: size, tags: tags});
                   this.parent(options); 
            }
});

Element.implement({
        toFlickr: function(o){
             var that = this;
             new Request.Flickr(o, {
                         onSuccess: function(o) {
                              if(window.console){console.log(o);}
                              that.set('html',o.results[0]);
                         },
                         onRequest: function(script) {
                              if(window.console){console.log(script);}
                              new Element('span',{'class': 'loading'}).set('text','Loading...').inject(that);
                         }
            }).send();
        }
});

Element.Properties.flickr = {
        set: function(o,options) {
              this.store('param',o);
              var flickr = this.get('flickr'),
                  that = this,
                  options = Object.merge({onSuccess: function(o) {
                                          if(window.console){console.log(o);}
                                          that.set('html',o.results[0]);
                                         },
                                         onRequest: function(script) {
                                            if(window.console){console.log(script);}
                                            new Element('span',{'class': 'loading'}).set('text','Loading...').inject(that);
                                        }}, options);             
                  flickr.setOptions(options);  
          return this;   
        },
        get: function () {
             var params = this.retrieve('param'),
                 flickr = this.retrieve('flickr');
             if(!flickr) {
                     var flickr = new Request.Flickr(params);
                     this.store('flickr',flickr);
             }
          return flickr;
        } 
};

Element.implement({
        loadFlickrPhotos: function(options){
               this.get('flickr').send();
          return this;     
        }
});

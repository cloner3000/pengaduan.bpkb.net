$(function() {

    if(Modernizr.history){

    var newHash      = "",
        $mainContent = $("#main-content"),
        $detailContent= $("#detail-content");
        
    
    
    
    $("#nav-ajax").delegate("a", "click", function() {
        _link = $(this).attr("href");
        history.pushState(null, null, _link);
        loadContent(_link,'#detail-content');
        return false;
    });
    
     $("#nav-toolbar").delegate("a", "click", function() {
        _link = $(this).attr("href");
        history.pushState(null, null, _link);
        loadContent(_link,'#detail-content');
        return false;
    });

    function loadContent(href,setloadarea){
      var url = getBaseURL();
        $(setloadarea).html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>');
        $mainContent
          .find(setloadarea)
          .load(href +" "+setloadarea, function(response, status, xhr) {
                  $('ul.nav li a').click(function() {
                      $('ul.nav li.active').removeClass('active');
                      $(this).closest('li').addClass('active');
                  });

              });
    }
    
    function getBaseURL(){
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));
    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);
        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
      }
    }
    
    $(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only
       loadContent(_link,'#detail-content');
    });

} // otherwise, history is not supported, so nothing fancy here.
});
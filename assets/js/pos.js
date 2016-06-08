$(document).ready(function(){
var url = getBaseURL();
bkLib.onDomLoaded(function(){ nicEditors.allTextAreas({iconsPath:'/assets/js/nicEditorIcons.gif'}) });
var cfajax = fconfig("#result",false);
  $('#fubahpass').ajaxForm(cfajax);
  $("[autofocus]").on("focus", function() {
    if (this.setSelectionRange) {
      var len = this.value.length * 2;
      this.setSelectionRange(len, len);
    } else {
      this.value = this.value;
    }
    this.scrollTop = 999999;
  }).focus();

var windowSizeArray = "scrollbars=yes,fullscreen=yes";
$('.newwindow').click(function (event){
        var url = $("'.newwindow'").data("url");
        var windowName =$("'.newwindow'").data("title");
        var windowSize = windowSizeArray;
        window.open(url, windowName, windowSize);
        event.preventDefault();
    });

$("span.icon input:checkbox, th input:checkbox").click(function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});
});




function loadContentajax(href,setloadarea){
  var url = getBaseURL();
      $(setloadarea).html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">loading page..</span></div>');
      $(setloadarea).load(href);
}


function setvaledit(selector,value){

    var elem = $('[name='+selector+']').data('tag');
    if(elem == "input"){
      $('input[name='+selector+']').val(value);
      //console.log("select "+elem+" value "+value);
    }else if(elem == 'select'){
      $('select[name='+selector+'] option[value='+value+']').prop("selected",true);

    }else if(elem == "textarea"){
        nicEditors.findEditor( "textarea" ).setContent( value);
    }

}


function getdetail(href,variable){
  $.ajax({
            type: "POST",
            url: href,
            dataType: 'json',

            data:variable,
            beforeSend: function(){
                var url = getBaseURL();
                $("#pesan").html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">sending data..</span></div>');

            },
            success: function(data) {
              jQuery.each(data, function(i, val) {
               setvaledit(i,val);
               $("#pesan").html("");
              });

            },
              error: function(data) {


            }
    });
}

function getdelete(href,variable){
     $.ajax({
       type: "POST",
       url: href,
       dataType: 'json',
       data:variable
     }).done(function(){
         oTable.fnDraw();
     });
   }


function fconfig(target,refresh){
    var optionpesan = {
        target:target,          // target element(s) to be updated with server response
        clearForm: true,        // clear all form fields after successful submit
        resetForm: true,        // reset the form after successful submit
        timeout:   6000,
        beforeSerialize:function(){
          if($("#textarea").length !== 0){
            nicEditors.findEditor( "textarea" ).saveContent();
          }
        },
        beforeSubmit: function(){
          var url = getBaseURL();
          $(target).html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">sending data..</span></div>');

        },
        success: function(html) {

            if(refresh==true){
                //window.setTimeout(function(){location.reload()},2000);
                oTable.fnDraw();
            }
        }
    };
    return optionpesan;
}

function fconfigtrans(target,refresh){
    var optionpesan = {
        target:target,          // target element(s) to be updated with server response
        clearForm: false,        // clear all form fields after successful submit
        resetForm: false,        // reset the form after successful submit
        timeout:   6000,
        beforeSerialize:function(){
          if($("#textarea").length !== 0){
            nicEditors.findEditor( "textarea" ).saveContent();
          }
        },
        beforeSubmit: function(){
          var url = getBaseURL();
          $(target).html('<div id="page_loader"><img src="'+url+'assets/img/loader.gif"/><span class="textload">sending data..</span></div>');

        }
    };
    return optionpesan;
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



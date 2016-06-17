var myApp = new Framework7({
  init: false,
  modalTitle: 'Framework7',
  pushState: true,
  material: true,

});
var $$ = Dom7;
var appUrl = 'http://pengaduan.local/';
// Add main view
var mainView = myApp.addView('.view-main', {
  domCache: true
});

$$(document).on('ajaxStart', function (e) {
  myApp.showIndicator();
});

$$(document).on('ajaxComplete', function (e) {
  myApp.hideIndicator();
});

$$(document).on('ajaxError', function (e) {
  var error = e.detail.xhr.responseText;
  var respond = JSON.parse(error);
  myApp.alert(respond.message, 'App Pengaduan Online');
});

$$('#form-login').on('submitted', function (e) {
  var respond = JSON.parse(e.detail.data);
  $$('#nickname').html(respond.data.name);
  myApp.closeModal();
});

$$('.logout-link').on('click', function (e) {
  var url = $$(this).data('url');
  $$.get(url, function (data) {
    myApp.loginScreen();
  });
});

// infinite scroll notification
myApp.onPageInit('notification', function (page) {
  var url = $$('.notification-list').data('url');
  var loading = false;
  var page = 1;
  var notificationLi = $$('.notification-list li');
  var notificationUl = $$('.notification-list ul');
  var lastLoadedIndex = $$('.notification-list li').length;
  var html = '';
  var result = '';
  var ptrContent = $$('.notif-content');

  ptrContent.on('refresh', function (e) {
    setTimeout(function () {
      html = '';
      $$.get(url, {page: 1, json: true}, function (data) {
        result = JSON.parse(data);
        $$.each(result.data.notification, function (index, el) {
          html += '<li>' +
            '<a href="#" class="item-link item-content notification-detail">' +
            '<div class="item-media"><i class="fa fa-exclamation"></i></div>' +
            '<div class="item-inner">' +
            '<div class="item-title">' + el.title + '</div>' +
            '<div class="item-after">' + el.date_feed + '</div>' +
            '</div>' +
            '</a>' +
            '</li>';
        });
        notificationUl.html(html);
        lastLoadedIndex = notificationLi.length;
      });
      myApp.attachInfiniteScroll(ptrContent);
      myApp.pullToRefreshDone();
    }, 2000);
  });

  ptrContent.on('infinite', function () {
    if (loading) return;
    loading = true;
    page = Math.ceil(lastLoadedIndex / 20);

    $$.get(url, {page: page + 1, json: true}, function (data) {
      loading = false;
      result = JSON.parse(data);
      if (lastLoadedIndex >= result.data.total) {
        myApp.detachInfiniteScroll(ptrContent);
        $$('.infinite-scroll-preloader').remove();
        return;
      }
      else {
        html = '';
        $$.each(result.data.notification, function (index, el) {
          html += '<li>' +
            '<a href="#" class="item-link item-content notification-detail">' +
            '<div class="item-media"><i class="fa fa-exclamation"></i></div>' +
            '<div class="item-inner">' +
            '<div class="item-title">' + el.title + '</div>' +
            '<div class="item-after">' + el.date_feed + '</div>' +
            '</div>' +
            '</a>' +
            '</li>';
        });
        notificationUl.append(html);
        lastLoadedIndex = notificationLi.length;
      }
    });
  });
});

// main

myApp.onPageInit('main', function (page) {
  var ticketList = $$('.ticket-list');
  var url = ticketList.data('url');
  var loading = false;
  var page = 1;
  var lastLoadedIndex = $$('.ticket-list li').length;
  var html = '';
  var result = '';
  var ptrContent = $$('.main-content');
  
  ptrContent.on('refresh', function (e) {
    setTimeout(function () {
      html = '';
      $$.get(url, {page: 1, json: true}, function (data) {
        result = JSON.parse(data);
        $$.each(result.data.ticket, function (index, el) {
          html += '<li>' +
            '<div class="card ks-facebook-card">' +
            '<div class="card-header no-border">' +
            '<div class="ks-facebook-avatar">' +
            '<img src="' + appUrl + 'assets/mobile/img/avatar.jpg" width="34" height="34" class="">' +
            '</div>' +
            '<div class="ks-facebook-name">' + el.full_name + '</div>' +
            '<div class="ks-facebook-date">' + el.date + '</div>' +
            '</div>' +
            '<div class="card-content">' +
            '<div class="card-content-inner">' +
            '<h4 class="item-title">' + el.title + '</h4>' +
            '<p>' + el.question + '</p>' +
            '</div>' +
            '</div>' +
            '<div class="card-footer">' +
            '<a href="#">' +
            '<span class="badge bg-green">' + el.status + '</span>' +
            '<span class="badge bg-deeporange">' + el.priority + '</span>' +
            '</a>' +
            '<a href="#" data-id="' + el.uuid + '" class="link">Balas</a></div>' +
            '</div>' +
            '</li>';
        });
        ticketList.find('ul').html(html);
      });
      lastLoadedIndex = $$('.ticket-list li').length;
      myApp.attachInfiniteScroll(ptrContent);
      myApp.pullToRefreshDone();
    }, 2000);
  });

  ptrContent.on('infinite', function () {
    if (loading) return;
    loading = true;
    lastLoadedIndex = $$('.ticket-list li').length;
    page = Math.ceil(lastLoadedIndex / 20);

    $$.get(url, {page: page + 1, json: true}, function (data) {
      loading = false;
      result = JSON.parse(data);
      if (lastLoadedIndex >= result.data.total) {
        myApp.detachInfiniteScroll(ptrContent);
        $$('.infinite-scroll-preloader').remove();
          return;
      }
      else {
        html = '';
        $$.each(result.data.ticket, function (index, el) {
          html += '<li>' +
            '<div class="card ks-facebook-card">' +
            '<div class="card-header no-border">' +
            '<div class="ks-facebook-avatar">' +
            '<img src="' + appUrl + 'assets/mobile/img/avatar.jpg" width="34" height="34" class="">' +
            '</div>' +
            '<div class="ks-facebook-name">' + el.full_name + '</div>' +
            '<div class="ks-facebook-date">' + el.date + '</div>' +
            '</div>' +
            '<div class="card-content">' +
            '<div class="card-content-inner">' +
            '<h4 class="item-title">' + el.title + '</h4>' +
            '<p>' + el.question + '</p>' +
            '</div>' +
            '</div>' +
            '<div class="card-footer">' +
            '<a href="#">' +
            '<span class="badge bg-green">' + el.status + '</span>' +
            '<span class="badge bg-deeporange">' + el.priority + '</span>' +
            '</a>' +
            '<a href="#" data-id="' + el.uuid + '" class="link">Balas</a></div>' +
            '</div>' +
            '</li>';
        });
        ticketList.find('ul').append(html);
        lastLoadedIndex = $$('.ticket-list li').length;
      }
    });
  });
});

// infinite scroll knowledge
myApp.onPageInit('knowledge', function () {
  var knowledge = $$('.knowledge-list');
  var url = knowledge.data('url');
  var loading = false;
  var page = 1;
  var lastLoadedIndex = $$('.knowledge-list li').length;
  var html = '';
  var result = '';
  var ptrContent = $$('.knowledge-content');

  ptrContent.on('refresh', function (e) {
    setTimeout(function () {
      html = '';
      $$.get(url, {page: 1, json: true}, function (data) {
        result = JSON.parse(data);
        $$.each(result.data.knowledge, function (index, el) {
          html += '<li><a href="#" class="item-link item-content">'+
            '<div class="item-inner">'+
              '<div class="item-title-row">'+
                '<div class="item-title">' + el.title + '</div>'+
                '<div class="item-after">' + el.created + '</div>'+
              '</div>'+
              '<div class="item-text">' + el.content + '</div>'+
            '</div></a>'+
          '</li>';
        });
        knowledge.find('ul').html(html);
        lastLoadedIndex = $$('.knowledge-list li').length;
      });
      myApp.attachInfiniteScroll(ptrContent);
      myApp.pullToRefreshDone();
    }, 2000);
  });

  ptrContent.on('infinite', function () {
    if (loading) return;
    loading = true;
    page = Math.ceil(lastLoadedIndex / 20);

    $$.get(url, {page: page + 1, json: true}, function (data) {
      loading = false;
      result = JSON.parse(data);
      if (lastLoadedIndex >= result.data.total) {
        myApp.detachInfiniteScroll(ptrContent);
        $$('.infinite-scroll-preloader').remove();
        return;
      }
      else {
        html = '';
        $$.each(result.data.knowledge, function (index, el) {
          html += '<li><a href="#" class="item-link item-content">'+
            '<div class="item-inner">'+
            '<div class="item-title-row">'+
            '<div class="item-title">' + el.title + '</div>'+
            '<div class="item-after">' + el.created + '</div>'+
            '</div>'+
            '<div class="item-text">' + el.content + '</div>'+
            '</div></a>'+
            '</li>';
        });
        knowledge.find('ul').append(html);
        lastLoadedIndex =  $$('.knowledge-list li').length;
      }
    });
  });

  $$('.show-popup').on('click', function () {
    var title = $$(this).find('.item-title').text();
    var content = $$(this).find('.item-text').text();
    var popupHTML = '<div class="popup">'+
      '<div class="content-block">'+
      '<h4>'+title+'</h4>'+
      '<p><a href="#" class="close-popup">tutup</a></p>'+
      '<p>'+content+'</p>'+
      '</div>'+
      '</div>'
    myApp.popup(popupHTML);
  });
});

myApp.onPageInit('replay_ticket',function (e) {
  var myMessages = myApp.messages('.messages', {
    autoLayout:true
  });
  var conversationStarted = false;
  var myMessagebar = myApp.messagebar('.messagebar');
  $$('.messagebar .link').on('click', function () {
    var messageText = myMessagebar.value().trim();
    var url = $$(this).data('url');
    var ticket_id = $$(this).data('id');
    var name = $$(this).data('name');

    if (messageText.length === 0) return;
    myMessagebar.clear()
    var messageType = 'received';
    myMessages.addMessage({
      text: messageText,
      type: messageType,
      name: name,
      day: !conversationStarted ? 'Today' : false,
      time: !conversationStarted ? (new Date()).getHours() + ':' + (new Date()).getMinutes() : false
    });
    conversationStarted = true;
    $$.post(url,{ticket_id:ticket_id,answer:messageText});
  });
})
myApp.init();

define (function() {
  var module = {};
  module.init = function() {
    var router = new ApplicationRouter($('.content'));
    Backbone.history.start({pushState: true});
  }
  return module;
});
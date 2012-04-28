// Require.js allows us to configure shortcut alias
// There usage will become more apparent futher along in the tutorial.
require.config({
  paths: {
    templates: "../templates"
  }

});
require([

  // Some plugins have to be loaded in order due to their non AMD compliance
  // Because these scripts are not "modules" they do not pass any values to the definition function below
  'libs/jquery.min',
  'libs/underscore-min',
], function(){
  require([
    'libs/bootstrap.min',
    'order!libs/backbone-min',
    'order!ContentView',
    'order!ApplicationRouter',
    'order!app'
  ], function(a,b,c,d, app){
    // The "app" dependency is passed in as "App"
    // Again, the other dependencies passed in are not "AMD" therefore don't pass a parameter to this function
    app.init();
  });
});

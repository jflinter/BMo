var ApplicationRouter = Backbone.Router.extend({
    initialize: function(el) {
        this.el = el;
    },

    routes: {
        "": "home",
        "blog": "blog",
        "about": "teamInfo",
        "links" : "links",
        "merchandise" : "merchandise",
        "donate" : "donate",
        "*else": "notFound"
    },

    currentView: null,

    switchView: function(view, callback) {
        var that = this;
        require(['text!../templates/' + view.viewPath],
        function(template) {
            if (this.currentView) {
                // Detach the old view
                this.currentView.remove();
            }
            // Move the view element into the DOM (replacing the old content)
            view.template = template;
            that.el.html(view.render().el);
            that.currentView = view;
            if (callback) {
              callback(that.el);
            }
        });

    },

    /*
	 * Change the active element in the topbar 
	 */
    setActiveEntry: function(url) {
        // Unmark all entries
        $('.dropdown').removeClass('active');

        // Mark active entry
        $("li a[href='" + url + "']").parents('li').addClass('active');
    },

    home: function() {
        this.switchView(new ContentView('_home'), function(el) {
          $(el).find("#twitter_widget").html($("#twitter_holder").html());
        });
        this.setActiveEntry('#');
    },

    blog: function() {
      this.switchView(new ContentView('_blog'), function(el) {
        resizeBlog = function() {
          console.log($(window).width());
          $(el).find("#blogger_iframe").height($(window).height());
          $(el).find("#blogger_iframe").width($(window).width());
        }
        resizeBlog();
        $(window).resize(resizeBlog);
      });
      this.setActiveEntry('#blog');
    },

    teamInfo: function() {
        this.switchView(new ContentView('_about'));
        this.setActiveEntry('#about');
    },

    notFound: function() {
        this.switchView(new ContentView('_404'));
    },
    
    links: function() {
      this.switchView(new ContentView('_links'));
      this.setActiveEntry('#links');
    },
    
    merchandise: function() {
      var that = this;
      var textHolder;
      var old_dw = document.write;
      document.write = function(text) { textHolder = text };
      require(['https://www-sgw-opensocial.googleusercontent.com/gadgets/ifr?url=https%3A%2F%2Fstoregadgetwizard.appspot.com%2Fservlets%2FgadgetServlet%3Fkey%3D0AhuzrtuqsTB_dDlIbjFaaUh5NHpGNzlZZXAzcDVUX1E%26mid%3D845888858395241%26currency%3DUSD%26sandbox%3Dfalse%26gadget%3DLARGE&container=storegadgetwizard&w=800&h=700&title=&brand=none&output=js'],
        function(goog) {
          document.write = old_dw;
          that.switchView(new ContentView('_merchandise'), function(el) {
            $(el).find("#store_main").html(textHolder);
          });
          that.setActiveEntry('#merchandise');
        }
      );
      
    },
    
    donate: function() {
      var that = this;
      require(['order!libs/canvas.text',
               'order!libs/helvetiker-normal-normal',
  	           'draw_thermometer'], function() {
  	             that.switchView(new ContentView('_donate'), function(el) {
  	               draw_thermometer($(el).find('#annual_thermometer')[0], 100, 500);
                    that.setActiveEntry('#donate');
  	             });
  	             
  	           });
    }
    
});
var ApplicationRouter = Backbone.Router.extend({
    initialize: function(el) {
        this.el = el;
        this.homeView = new ContentView('_home');
        this.teamInfoView = new ContentView('_about');
        this.linksView = new ContentView('_links');
        this.merchandiseView = new ContentView('_merchandise');
        this.notFoundView = new ContentView('_404');
    },

    routes: {
        "": "home",
        "about": "teamInfo",
        "links" : "links",
        "merchandise" : "merchandise",
        "*else": "notFound"
    },

    currentView: null,

    switchView: function(view) {
        var router = this;
        require(['text!../templates/' + view.viewPath],
        function(template) {
            if (this.currentView) {
                // Detach the old view
                this.currentView.remove();
            }
            // Move the view element into the DOM (replacing the old content)
            router.el.html(view.el);
            view.template = template;
            // Render view after it is in the DOM (styles are applied)
            view.render();

            router.currentView = view;
        });

    },

    /*
	 * Change the active element in the topbar 
	 */
    setActiveEntry: function(url) {
        // Unmark all entries
        $('li .dropdown').removeClass('active');

        // Mark active entry
        $("li a[href='" + url + "']").parents('li').addClass('active');
    },

    home: function() {
        this.switchView(this.homeView);
        this.setActiveEntry('#');
    },

    teamInfo: function() {
        this.switchView(this.teamInfoView);
        this.setActiveEntry('#about');
    },

    notFound: function() {
        this.switchView(this.notFoundView);
    },
    
    links: function() {
      this.switchView(this.linksView);
      this.setActiveEntry('#links');
    },
    
    merchandise: function() {
      this.switchView(this.merchandiseView);
      this.setActiveEntry('#merchandise');
    }
    
});
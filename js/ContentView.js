var ContentView = Backbone.View.extend({
	/*
	 * Initialize with the template-id
	 */
	initialize: function(viewPath) {
		this.viewPath = viewPath;
		this.template = {};
	},
	
	/*
	 * Get the template content and render it into a new div-element
	 */
	render: function() {
  	$(this.el).html(this.template);
  	return this;
	}
});
(function( $ ) {
	'use strict';

	let MP_Front = {

		init: function(){
			this.loadElement();
			this.loadMethods();
			this.events();
		},

		loadElement: function(){
			this.$body = $('body');
			this.$document = $(document);
			this.$myplugin_related_post_container = $('.myplugin-related-post-container');
		},

		templates: {
			related_post_container: wp.template('related_post_container'),
      results_spinner: wp.template('results_spinner'),
		},

		events: function(){
      if ( this.$myplugin_related_post_container.length ) {
        let post_id = this.$myplugin_related_post_container.data( 'post_id' ); //current post id.
        if ( post_id ) {
          this.get_related_posts( post_id );
        }
			}
		},

		loadMethods:function() {
      // Get related post by id
      this.get_related_posts = function( post_id ){
        let mp_front = this;
				let form_data = new FormData();
				form_data.append( 'post_id', post_id );
				form_data.append( 'action', 'get_related_posts' );
        mp_front.$myplugin_related_post_container.append( mp_front.templates.results_spinner( {} ) );

				$.ajax( mp_var.ajaxurl,{
					method: 'POST',
					contentType: false,
					processData: false,
					data: form_data,
					success : function( response ){
						if ( response ) {
              mp_front.$myplugin_related_post_container.html( mp_front.templates.related_post_container( response ) );
						}
					},
				});
			};
    }
	}

	$(document).ready(function(){
		MP_Front.init();
	});
})( jQuery );

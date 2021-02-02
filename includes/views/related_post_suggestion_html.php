<?php
?>

<div class="myplugin-main-wrapper">
  <div class="myplugin-related-post-container" data-post_id="<?php echo $post->ID; ?>">
  </div>
</div>

<script type="text/html" id="tmpl-related_post_container">
    <# if ( data.count ) { #>
      <h3><?php _e( 'YOU MIGHT ALSO LIKE', 'post-suggestions-box' ); ?></h3>
      <div class="myplugin-related-posts">
        <div class="myplugin-top-post-wrap">
        <# for ( r in data.releted_posts_top ) { #>
          <div class="myplugin-top-post" data-post_id="{{r}}">
            <div class="myplugin-post-image">
              <img src="{{data.releted_posts_top[r].image_url}}" alt="">
              <# if ( data.releted_posts_top[r].published ) { #>
              <span class="create-date">{{data.releted_posts_top[r].published}}</span>
              <# } #>
            </div>
            <p class="myplugin-post-title"><a href="{{data.releted_posts_top[r].link}}">{{data.releted_posts_top[r].title}}</a></p>
            <p class="myplugin-post-author">{{data.releted_posts_top[r].author}}</p>
            <p class="myplugin-post-date">{{data.releted_posts_top[r].date}}</;>
          </div>
        <# } #>
        </div>
        <div class="myplugin-all-posts-wrap">
        <# for ( r in data.releted_posts ) { #>
          <div class="myplugin-all-post" data-post_id="{{r}}">
            <div class="myplugin-post-image">
              <img src="{{data.releted_posts[r].image_url}}" alt="">
              <# if ( data.releted_posts[r].published ) { #>
              <span class="create-date">{{data.releted_posts[r].published}}</span>
              <# } #>
            </div>
            <p class="myplugin-post-title"><a href="{{data.releted_posts[r].link}}">{{data.releted_posts[r].title}}</a></p>
            <p class="myplugin-post-author">{{data.releted_posts[r].author}}</p>
            <p class="myplugin-post-date">{{data.releted_posts[r].date}}</;>
          </div>
        <# } #>
        </div>
      </div>
    <# }  #>
</script>

<script type="text/html" id="tmpl-results_spinner">
  <div class="results_spinner">
    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
  </div>
</script>

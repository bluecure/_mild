<?php
/**
 * Widget admin template.
 */
?>
<div class="latest-posts-widget-container">
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mild' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo esc_attr( $this->get_field_id( 'lpw_cats' ) ); ?>"><?php _e( 'Categories:', 'mild' ); ?></label>
        <select multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'lpw_cats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_cats' ) ); ?>[]" class="widefat">
            <optgroup label="categories">
                <?php $categories = get_terms( 'category' ); ?>
                <?php foreach( $categories as $category ) { ?>
                    <option value="<?php echo $category->term_id; ?>" <?php if ( is_array( $lpw_cats ) && in_array( $category->term_id, $lpw_cats ) ) echo ' selected="selected"'; ?>><?php echo $category->name; ?></option>
                <?php } ?>
            </optgroup>
        </select>
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo esc_attr( $this->get_field_id( 'lpw_tags' ) ); ?>"><?php _e( 'Tags:', 'mild' ); ?></label>
        <select multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'lpw_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_tags' ) ); ?>[]" class="widefat">
            <optgroup label="tags">
                <?php $tags = get_terms( 'post_tag' ); ?>
                <?php foreach( $tags as $tag ) { ?>
                    <option value="<?php echo $tag->term_id; ?>" <?php if ( is_array( $lpw_tags ) && in_array( $tag->term_id, $lpw_tags ) ) echo ' selected="selected"'; ?>><?php echo $tag->name; ?></option>
                <?php } ?>
            </optgroup>
        </select>
    </div>
    <div class="latest-posts-widget-row">
        <h4><?php _e( 'Settings', 'mild' ); ?></h4>
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_link' ); ?>"><?php _e( 'Link to full page:', 'mild' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_link' ); ?>" name="<?php echo $this->get_field_name( 'lpw_link' ); ?>" value="<?php echo $lpw_link; ?>" class="widefat" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_limit' ); ?>"><?php _e( 'No. of posts to show:', 'mild' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_limit' ); ?>" name="<?php echo $this->get_field_name( 'lpw_limit' ); ?>" value="<?php echo $lpw_limit; ?>" class="small-text" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_length' ); ?>"><?php _e( 'Length of the excerpt:', 'mild' ); ?></label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_length' ); ?>" name="<?php echo $this->get_field_name( 'lpw_length' ); ?>" value="<?php echo $lpw_length; ?>" class="small-text" />
    </div>
    <div class="latest-posts-widget-row">
        <input id="<?php echo esc_attr( $this->get_field_id( 'lpw_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_image' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $lpw_image ); ?> />
        <label for="<?php echo $this->get_field_id( 'lpw_image' ); ?>"><?php _e( 'Show Image', 'mild' ); ?></label>
    </div>
    <div class="latest-posts-widget-row">
        <input id="<?php echo esc_attr( $this->get_field_id( 'lpw_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_date' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $lpw_date ); ?> />
        <label for="<?php echo $this->get_field_id( 'lpw_date' ); ?>"><?php _e( 'Show Date', 'mild' ); ?></label>
    </div>
</div>

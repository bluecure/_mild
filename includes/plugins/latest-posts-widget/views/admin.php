<?php
/**
 * Widget admin template.
 */
?>
<div class="latest-posts-widget-container">
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo esc_attr( $this->get_field_id( 'lpw_cats' ) ); ?>">Categories:</label>
        <select multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'lpw_cats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_cats' ) ); ?>[]" class="widefat">
            <optgroup label="Categories">
                <?php $categories = get_terms( 'category' ); ?>
                <?php foreach( $categories as $category ) { ?>
                    <option value="<?php echo $category->term_id; ?>" <?php if ( is_array( $lpw_cats ) && in_array( $category->term_id, $lpw_cats ) ) echo ' selected="selected"'; ?>><?php echo $category->name; ?></option>
                <?php } ?>
            </optgroup>
        </select>
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo esc_attr( $this->get_field_id( 'lpw_tags' ) ); ?>">Tags:</label>
        <select multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'lpw_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_tags' ) ); ?>[]" class="widefat">
            <optgroup label="Tags">
                <?php $tags = get_terms( 'post_tag' ); ?>
                <?php foreach( $tags as $tag ) { ?>
                    <option value="<?php echo $tag->term_id; ?>" <?php if ( is_array( $lpw_tags ) && in_array( $tag->term_id, $lpw_tags ) ) echo ' selected="selected"'; ?>><?php echo $tag->name; ?></option>
                <?php } ?>
            </optgroup>
        </select>
    </div>
    <div class="latest-posts-widget-row">
        <h4>Settings</h4>
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_link' ); ?>">Link to full page:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_link' ); ?>" name="<?php echo $this->get_field_name( 'lpw_link' ); ?>" value="<?php echo $lpw_link; ?>" class="widefat" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_limit' ); ?>">No. of posts to show:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_limit' ); ?>" name="<?php echo $this->get_field_name( 'lpw_limit' ); ?>" value="<?php echo $lpw_limit; ?>" class="small-text" />
    </div>
    <div class="latest-posts-widget-row">
        <label for="<?php echo $this->get_field_id( 'lpw_length' ); ?>">Length of the excerpt:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'lpw_length' ); ?>" name="<?php echo $this->get_field_name( 'lpw_length' ); ?>" value="<?php echo $lpw_length; ?>" class="small-text" />
    </div>
    <div class="latest-posts-widget-row">
        <input id="<?php echo esc_attr( $this->get_field_id( 'lpw_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_image' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $lpw_image ); ?> />
        <label for="<?php echo $this->get_field_id( 'lpw_image' ); ?>">Show Image</label>
    </div>
    <div class="latest-posts-widget-row">
        <input id="<?php echo esc_attr( $this->get_field_id( 'lpw_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lpw_date' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $lpw_date ); ?> />
        <label for="<?php echo $this->get_field_id( 'lpw_date' ); ?>">Show Date</label>
    </div>
</div>

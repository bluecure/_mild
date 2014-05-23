<?php
/**
 * Widget admin template.
 */

$placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADoUlEQVRo3u1ZTWgTURAOIYRSikjooUgpRXoQEREPHkRERELz/x/yhwnB/CAk9NBDERFKTqWIBykSPIlITyIiIj1J6al4EBFPOXiQ4KEUKUVEpNRvJBvfbt4mb3fzV9iBoZvdefNm3vtm5s2rxWKSSSaZZJIR8vl8m16v98RwIBBwyBzweDzHLpfr2O12/2OjzxKzv/v5jAU/0+GAZMBJYK4D7MqNO6s6IHmI39vgzTHhLT0Qco86sUjk9/sva4bQuDmgGULj5kDfIJTNZq0YfB/y38G/kJPfhUKhhWE40BcIweCacjsx9lssFjs1SAf6AqFqtWrF6wNe8YLC/KB3wDCE8vn8lFphwc6siBgTDoedWh3AsUEMQiIxALlPvB3AJNcFDFmE7BH+3tTqRCaTcWDcNSwUxd9n3VkI23lVghGznfVeBkSj0WkK/FbMfI3H41NanWCpUChYuQ6I1IFIJDILo1ewGmu0qiITQva1Igg3jDjQQYOsxNi1O5y4OeoGO+zYOYzLwdF7tFh4TiHTzXV1wGghg0FOTPakUqm0txdBuwBVh5wj8R/I3+LoiGK3ZHHG2oVv25C5oeqA3qNEMBi8RLHBwiOXy9mgd1flNLnKjqeYgHEvRU6iLUceI7BtMgf0QgirPIfxTUWaewiu8VIuZBuY3C6NTyaTE3i3o7UngBMvisWi1RCEgNXTGPuF15HxftNf4FlW9GDIBq/zwvtXkF0kxnNdRaaqG0KJRMKOce+1NCJQ+zOVSk0y0LtIAc2ThXGPGCeXVPQdQse0ZgiVy2UrNde8otZj298oVr/eRVbmgJocbF/WDCGqAXqaesTFA1aPFDsq8ODugFKeukdNEIIRd5WGijLwfFvSk06nHQqD3+JofkViFMx23sfzDPsN9j5lbN0XhhAM8FMO73at0o2Rw8OMUWcVUHgukjiIIL/KFkUhCJVKJRvsXyYY6GWs3nlJH9LnDAsJrQ4w9h6MrCfGvPvMnHtU+CTGYi0xsE2w3yDbZBqq3ZHdSrCZzEAWqo2sqacDncEs9Bs65jsgNMiLLUBD1tBQxdVbyKBvXcKiUBYRudztxZjrg+LESs1OgyP7A9xo8R5Hzw6OMva2A8O8naYegd0FHAdmYcNHNXlO8dpCRvt/EzLsy106wwC7F1gn0LBMUM9LK99lXBMyZbqfkgXTKP7BgTnXcaayWRQERybxLYhFXaPaAH5GmQbvnDgIdsibZJJJJplkmP4C0NWrxL0MRqkAAAAASUVORK5CYII=';
$placeholderImg = "<img src='{$placeholder}'' class='placeholder'>";

// Get Images and create galley preview
$gallery = '';
if( $gw_images && $gw_images !== 0 ) {
    $imageIDs = explode(',', $gw_images);
    foreach ($imageIDs as &$imageID) {
        $gallery .= wp_get_attachment_link( $imageID, 'thumbnail' );
    }
}
// Set preview to the gallery or placeholder
$preview = ($gallery) ? $gallery : $placeholderImg; ?>

<div class="gallery-widget-container">
    <div class="gallery-widget-row">
        <div class="gallery-widget-preview">
            <?php echo $preview; ?>
        </div>
        <input type="hidden" id="<?php echo $this->get_field_id( 'gw_images' ); ?>" name="<?php echo $this->get_field_name( 'gw_images' ); ?>" value="<?php echo $gw_images; ?>" class="gallery-widget-images" />
        <button class="gallery-widget-select button button-primary button-hero widefat">Select Images</button>
    </div>
    <div class="gallery-widget-row">
        <p>* Ctrl click on images to select multiple.</p>
    </div>
    <div class="gallery-widget-row">
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="gallery-widget-title widefat" />
    </div>
    <div class="gallery-widget-row">
        <label for="<?php echo $this->get_field_id( 'gw_description' ); ?>">Description:</label>
        <textarea id="<?php echo $this->get_field_id( 'gw_description' ); ?>" name="<?php echo $this->get_field_name( 'gw_description' ); ?>" class="gallery-widget-description widefat"><?php echo $gw_description; ?></textarea>
    </div>
    <div class="gallery-widget-row">
        <label for="<?php echo $this->get_field_id( 'gw_link' ); ?>">Full Gallery Link:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'gw_link' ); ?>" name="<?php echo $this->get_field_name( 'gw_link' ); ?>" value="<?php echo $gw_link; ?>" class="gallery-widget-link widefat" />
    </div>
</div>

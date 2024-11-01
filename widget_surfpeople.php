<?php
/*
Plugin Name: surfpeople Widget
Plugin URI: http://www.surfpeople.net/blog/
Description: A widget which will display your latest surfpeople activity.
Author: Surfpeople
Version: 0.1
Author URI: http://www.surfpeople.net/
*/

function widget_surfpeople($args) {
	
	extract($args);

	$options = get_option('widget_surfpeople');
	if( $options == false ) {
		$options[ 'title' ] = 'Surfpeople Widget';
		
	}
	$title = empty($options['title']) ? __('Surfpeople Widget') : $options['title'];
	
	$surfpeople_rss_url = empty($options['surfpeople_rss_url']) ? __('') : $options['surfpeople_rss_url'];
		
	
	
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>

<?php echo $out ?>
<script src='http://www.surfpeople.net/tool/gadgetstatus.php?url=<?php echo $surfpeople_rss_url; ?>'></script>


		<?php echo $after_widget; ?>
<?php
}

function widget_surfpeople_control() {
	$options = $newoptions = get_option('widget_surfpeople');
	if( $options == false ) {
		$newoptions[ 'title' ] = 'Surfpeople Widget';
	}
	if ( $_POST["surfpeople-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["surfpeople-title"]));
		$newoptions['surfpeople_rss_url'] = strip_tags(stripslashes($_POST["surfpeople-rss-url"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_surfpeople', $options);
	}
	$title = wp_specialchars($options['title']);
	$surfpeople_rss_url = wp_specialchars($options['surfpeople_rss_url']);

	?>
	<p><label for="surfpeople-title"><?php _e('Title:'); ?> <input style="width: 150px;" id="surfpeople-title" name="surfpeople-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="surfpeople-rss-url"><?php _e('My ID Surfpeople :'); ?> <input style="width: 70px;" id="surfpeople-title" name="surfpeople-rss-url" type="text" value="<?php echo $surfpeople_rss_url; ?>" /></label></p>
	<p align='left'>
	* Your ID Surfpeople  can be found on your Surfpeople Account. Forgotten Your ID ?<a target="_blank" href="http://www.surfpeople.net/tool/index.php"> Check My ID </a> Go to my account Surfpeople of the page until you see the <em>ID</em> and copy that into the box above.<br />
	<br clear='all'></p>
	<p><a target="_blank" href="http://www.surfpeople.net/join.php">Join Now </a>Surfpeople is free Social Network</p>
	<input type="hidden" id="surfpeople-submit" name="surfpeople-submit" value="1" />
	<?php
}


function surfpeople_widgets_init() {
	register_widget_control('surfpeople', 'widget_surfpeople_control', 250, 250);
	register_sidebar_widget('surfpeople', 'widget_surfpeople');
}
add_action( "widgets_init", "surfpeople_widgets_init" );

?>

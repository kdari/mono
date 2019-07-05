<?php

$themename = "FreshPick";

$shortname = "fp";

$options = array (

array(  "name" => "About",

        "type" => "title"),

array(    "type" => "open"),

array(    "name" => "Title",

        "desc" => "Enter a title to be displayed in your footer about text.  Default currently set to 'About Me'",

        "id" => $shortname."_about_title",

        "std" => "",

        "type" => "text"),

array(    "name" => "Image URL",

        "desc" => "Provide the full path to the 40x40 image of yourself.  Leave blank if you don't have one.",

        "id" => $shortname."_image_url",

        "std" => "",

        "type" => "text"),

array(    "name" => "Message",

        "desc" => "Input the content of about text.  Tell us about yourself and your blog.",

        "id" => $shortname."_about_message",

        "type" => "textarea"),

array(    "type" => "close")

);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {

                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {

                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");

                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {

                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");

            die;

        }

    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';

    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>

<div class="wrap">

<h2><?php echo $themename; ?> Theme Options</h2>



<form method="post">



<?php foreach ($options as $value) {

switch ( $value['type'] ) {



case "open":

?>

<table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">



<?php break;



case "close":

?>



</table><br />



<?php break;



case "title":

?>

<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>

    <td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>

</tr>



<?php break;



case 'text':

?>



<tr>

    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>

    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>

</tr>



<tr>

    <td><small><?php echo $value['desc']; ?></small></td>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php

break;



case 'textarea':

?>



<tr>

    <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>

    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>



</tr>



<tr>

    <td><small><?php echo $value['desc']; ?></small></td>

</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>



<?php

break;

}

}

?>

<form method="post">

<p class="submit">

<input name="save" type="submit" value="Save changes" />

<input type="hidden" name="action" value="save" />

</p>

</form>

<form method="post">

<p class="submit">

<input name="reset" type="submit" value="Reset" />

<input type="hidden" name="action" value="reset" />

</p>

</form>

<?php

}

add_action('admin_menu', 'mytheme_add_admin');

$new_meta_boxes =

array(

"image" => array(

"name" => "image",

"std" => "",

"title" => "Featured Image",

"description" => "Using the \"<em>Add an Image</em>\" button, upload a 280x250 image and paste the URL here.  Displayed on homepage."),

"pimage" => array(

"name" => "pimage",

"std" => "",

"title" => "Post Image",

"description" => "Using the \"<em>Add an Image</em>\" button, upload a 510x250 image and paste the URL here.  Displayed on single post pages.")

);

function new_meta_boxes() {

global $post, $new_meta_boxes;



foreach($new_meta_boxes as $meta_box) {

$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);



if($meta_box_value == "")

$meta_box_value = $meta_box['std'];



echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';



echo'<h2>'.$meta_box['title'].'</h2>';



echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';



echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';

}

}

function create_meta_box() {

global $theme_name;

if ( function_exists('add_meta_box') ) {

add_meta_box( 'new-meta-boxes', 'FreshPick Post Settings', 'new_meta_boxes', 'post', 'normal', 'high' );

}

}

function save_postdata( $post_id ) {

global $post, $new_meta_boxes;



foreach($new_meta_boxes as $meta_box) {

// Verify

if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {

return $post_id;

}



if ( 'page' == $_POST['post_type'] ) {

if ( !current_user_can( 'edit_page', $post_id ))

return $post_id;

} else {

if ( !current_user_can( 'edit_post', $post_id ))

return $post_id;

}



$data = $_POST[$meta_box['name'].'_value'];



if(get_post_meta($post_id, $meta_box['name'].'_value') == "")

add_post_meta($post_id, $meta_box['name'].'_value', $data, true);

elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))

update_post_meta($post_id, $meta_box['name'].'_value', $data);

elseif($data == "")

delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));

}

}

add_action('admin_menu', 'create_meta_box');

add_action('save_post', 'save_postdata');

if ( function_exists('register_sidebar') )

	register_sidebar(array(

        'name' => 'Sidebar',

        'before_widget' => '<div class="sidemenu">',

        'after_widget' => '</div>',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

    ));

    register_sidebar(array(

        'name' => 'Left Footer',

        'before_widget' => '',

        'after_widget' => '',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

    ));

    register_sidebar(array(

        'name' => 'Middle Footer',

        'before_widget' => '',

        'after_widget' => '',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

    ));

    register_sidebar(array(

        'name' => 'Right Footer',

        'before_widget' => '',

        'after_widget' => '',

        'before_title' => '<h3>',

        'after_title' => '</h3>',

    ));

?>
<?php
add_action('admin_menu', 'banner_info');

function banner_info() {  
    $homePages=array( 'banners');    
    foreach ($homePages as $homePage) { 
    add_meta_box('Button Text', 'Options', 'banner_info_meta', $homePage);
    }
}
function banner_info_meta($post_id) {
    global $post;
    $bannerUrl = get_post_meta($post->ID, 'bannerUrl', true);
    $bannerText = get_post_meta($post->ID, 'bannerText', true);
    $showInHome = get_post_meta($post->ID, 'showInHome', true);
    ?>
 <table cellpadding="5" cellspacing="10">
        <tr>
            <label for="author_meta"><th>Button Url</th></label>
            <td  class="right" >
                <input type="textbox" id="bannerUrl" name="bannerUrl" value="<?php echo $bannerUrl; ?>">
            </td>
        </tr>
    </table>
     <table cellpadding="5" cellspacing="10">
        <tr>
            <label for="author_meta"><th>Button Text</th></label>
            <td  class="right" >
                <input type="textbox" id="bannerText" name="bannerText" value="<?php echo $bannerText; ?>">
            </td>
        </tr>
    </table>
        <div class="form-row select-row">
        <label ><td class="left"><label for="tax-order">Show in home</label></td></label>
        <select class="select-menu" name="showInHome">
            <option value="no"<?php if ($showInHome == 'no') { echo 'selected'; }?> >No</option>
            <option value="yes"<?php if ($showInHome == 'yes') { echo 'selected'; }?>>Yes</option>
        </select>
    </div>
    <?php
}
add_action('save_post', 'banner_info_save');
function banner_info_save($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post->ID;
    if(isset($_POST['bannerUrl'])){
        update_post_meta($post_id, 'bannerUrl',$_POST['bannerUrl']);
    }
    if(isset($_POST['bannerText'])){
        update_post_meta($post_id, 'bannerText',$_POST['bannerText']);
    }
    if(isset($_POST['showInHome'])){
        update_post_meta($post_id, 'showInHome',$_POST['showInHome']);
    }
   }
?>
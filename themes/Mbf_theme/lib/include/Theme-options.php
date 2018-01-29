<?php
add_action('admin_menu', 'theme_menu');

function theme_menu() {
    add_menu_page('MBF Theme Options', 'Theme Options', 'administrator', 'options_page', 'theme_options_page');
}
function theme_options_page() {
    if (isset($_REQUEST['submit'])) {
        update_option('facebook', $_REQUEST['facebook']);
        update_option('twitter', $_REQUEST['twitter']);
        update_option('instagram', $_REQUEST['instagram']);
        update_option('linked_in', $_REQUEST['linked_in']);
        update_option('contact_us_email', $_REQUEST['contact_us_email']);
        update_option('info_email_address', $_REQUEST['info_email_address']);
        update_option('default_image', $_REQUEST['default_image']);
        update_option('googleapp', $_REQUEST['googleapp']);
        update_option('appstore', $_REQUEST['appstore']);
        update_option('reports', $_REQUEST['reports']);
        $updated = 1;
    } ?>
<?php if ($updated == 1) { ?>
        <div class="updated" style="margin-top: 10px;"><p>Details Updated Successfully</p></div>
<?php } ?>
    <div id="usual2" class="usual">
        <form name="options" id="options" action="" method="post">
            <h1>MBF Theme Options</h1>
             <h2>General Settings</h2>
                <div class="contaniner">
                    <div class="label">Contact us email</div>
                    <div class="field"><input type="text" name="contact_us_email" id="contact_us_email" value="<?php echo get_option('contact_us_email'); ?>"  />
                    </div><br />
                    </div>
                 <div class="contaniner">
                        <div class="label">Facebook</div>
                        <div class="field"><input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>"  />
                        </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">Twitter</div>
                    <div class="field"><input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>"  />
                    </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">Linkedin</div>
                    <div class="field"><input type="text" name="linked_in" id="linked_in" value="<?php echo get_option('linked_in'); ?>"  />
                    </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">Instagram</div>
                    <div class="field"><input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>"  />
                    </div><br />
                </div>
                
                <div class="contaniner">
                    <div class="label">Info email address</div>
                    <div class="field"><input type="text" name="info_email_address" id="info_email_address" value="<?php echo get_option('info_email_address'); ?>"  />
                    </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">Default Image</div>
                    <div class="field"><input type="text" name="default_image" id="default_image" value="<?php echo get_option('default_image'); ?>"  />
                    </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">Google App</div>
                    <div class="field"><input type="text" name="googleapp" id="googleapp" value="<?php echo get_option('googleapp'); ?>"  />
                    </div><br />
                </div>
                <div class="contaniner">
                    <div class="label">App Store</div>
                    <div class="field"><input type="text" name="appstore" id="appstore" value="<?php echo get_option('appstore'); ?>"  />
                    </div><br />
                </div>
                 <div class="contaniner">
                    <div class="label">Reports</div>
                    <div class="field"><input type="text" name="reports" id="reports" value="<?php echo get_option('reports'); ?>"  />
                    </div>
                </div>
               <br style="clear:both;" />
            <input type="submit" class="btn" name="submit" value="Save Options" style="margin-top:20px;" />
        </form>
    </div>
<?php } ?>
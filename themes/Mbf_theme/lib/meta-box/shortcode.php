<?php

add_action('admin_menu', 'short_code');

function short_code() {
    $types = array( 'post', 'page', 'careers', 'banners');
    foreach ($types as $type){
        add_meta_box('shortCodes', 'Add Short Codes', 'short_codes', $type,'normal', 'high');
    }
}

function short_codes($post_id) {
    global $post;
    ?>

    <table class="shtCode" style="width:100%">
        <tr>
            <th style="text-align: left"><label for="image_left_aside">Short Codes</label></th>
            <th style="text-align: left"><p>Description</p></th>
        </tr>
        <tr>
            <td class="left heading">[span]</td>
            <td  class="right description" ><p>Span tag.</p></td>
        </tr>
        <tr>
            <td class="left heading">[break]</td>
            <td  class="right description" ><p>Column title.</p></td>
        </tr>
        <tr>
            <td class="left heading">[no_padding]</td>
            <td  class="right description" ><p>Eight column with no padding</p></td>
        </tr>
        <tr>
            <td class="left heading">[image_container]</td>
            <td  class="right description" ><p>Image with Content</p></td>
        </tr>
        <tr>
            <td class="left heading">[image_caption]</td>
            <td  class="right description" ><p>Image with Caption</p></td>
        </tr>
        <tr>
            <td class="left heading">[video_container]</td>
            <td  class="right description" ><p>Video with Image</p></td>
        </tr>
        <tr>
            <td class="left heading">[video_content]</td>
            <td  class="right description" ><p>video with Content</p></td>
        </tr>
        <tr>
            <td class="left heading">[two_column]</td>
            <td  class="right description" ><p>Two column</p></td>
        </tr>
        <tr>
            <td class="left heading">[left_column]</td>
            <td  class="right description" ><p>Left column with Content</p></td>
        </tr>
        
        <tr>
            <td class="left heading">[list_container]</td>
            <td  class="right description" ><p>Generic list</p></td>
        </tr>
    </table>
    <?php
}
?>
<?php 
if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
if(isset($_REQUEST['export']) && $_REQUEST['export'] == 'contact_list'):
    
    /*
     * #Export (Currency Orders)
     */
    $file_name = 'contact-form_'.date("M_d_Y_H_i").'.csv';
    $field_args = array(

        'firstname'  => 'Firstname',
        'lastname' => 'Lastname',
        'phone' => 'Phone',
        'email' => 'Email',
        'message' => 'Message',
        'posted_date' => 'Date'
    );
    // Send Header info.
    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename='".$file_name."'");
    
    $fh = fopen('php://output', 'w');
    
    // Send Export file columns.
    fputcsv($fh, $field_args);
    
    // Read from Database.
    $query = "SELECT * FROM VzQCxSJv7_contactus ORDER BY `posted_date` desc";
    $sql = $wpdb->get_results($query);
    $sql_count = count($sql);
    if($sql_count > 0):
            // Write to export file.
            foreach($sql as $x=>$row):
                $line = array();
                foreach($field_args as $column_name=>$field):
                    $line[] = $row->$column_name;
                endforeach;
                fputcsv($fh, $line);
            endforeach;
    else:
        fputcsv($fh, array('No results found!.'));
    endif;
    exit;
endif;

 
class TT_Example_List_Table extends WP_List_Table {
 
    
    function column_default($item, $column_name) {
        switch ($column_name) {
            case 'link_id':
            case 'link_name':
                return "value of $column_name: " . $item->$column_name;
            default:
                return "col name = $column_name , " . print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }
 
    function get_columns()
    {
        return $columns= array(
        'col_firstname'=>__('Firstname'),
        'col_lastname'=>__('Lastname'),
        'col_phone'=>__('Phone'),
        'col_email'=>__('Email'),
        'col_message'=>__('Message'),
        'col_posted_date'=>__('posted_date')
        );
    }
  
    function prepare_items() {
        global $wpdb; //This is used only if making any database queries
 
           /* -- Preparing your query -- */
       $query = "SELECT * FROM ". $wpdb->prefix ."contactus";
 
        /* -- Ordering parameters -- */
        //Parameters that are going to be used to order the result
        $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
        $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
        if (!empty($orderby) & !empty($order)) {
            $query.=' ORDER BY ' . $orderby . ' ' . $order;
        }
        //
 
        $totalitems = $wpdb->query($query);
 
        /**
         * First, lets decide how many records per page to show
         */
        $perpage = 15;
 
         //Which page is this?
        $paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
        //Page Number
        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
 
        //How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);
        //adjust the query to take pagination into account
        if (!empty($paged) && !empty($perpage)) {
            $offset = ($paged - 1) * $perpage;
            $query.=' LIMIT ' . (int) $offset . ',' . (int) $perpage;
        }
 
        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage,
        ));
 
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
 
        $this->_column_headers = array($columns, $hidden, $sortable);
 
        $this->items = $wpdb->get_results($query);
    }
 function display_rows()
    { ?> <br /><br /><span style="float:right; margin-bottom: 29px; margin-top: 9px;"><a href="?page=<?php echo $_REQUEST['page']?>&export=contact_list" id="export-contact_list" class="button" >Export</a></span>
       <?php
        $records = $this->items;
        list( $columns, $hidden ) = $this->get_column_info();
        //Loop for each record
        if(!empty($records)) {
            foreach($records as $rec) {
                echo '<tr id="record_'.$rec->id.'">';
                foreach ( $columns as $column_name => $column_display_name ) {
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
                        $attributes = $class . $style;
                        $editlink  = '/wp-admin/link.php?action=edit&id='.(int)$rec->id;
                    
                    //Display the cell
                    switch ( $column_name ) {
                        // var_dump($rec);
                        case "col_firstname": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->firstname).'</td>';
                        break;
                        case "col_lastname": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->lastname).'</td>';
                        break;
                        case "col_phone": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->phone).'</td>';
                        break;
                        case "col_email": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->email).'</td>';
                        break;
                         case "col_message": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->message).'</td>';
                        break;
                         case "col_posted_date": 
                            echo '<td '.$attributes.'>'.stripslashes($rec->posted_date).'</td>';
                        break;
                    }
                }
                echo'</tr>';
            }
        }
    }    
}

function tt_add_menu_items() {
    add_menu_page('Contact List Table', 'Contact List', 'activate_plugins', 'tt_list_test', 'tt_render_list_page');
}
 
add_action('admin_menu', 'tt_add_menu_items');
 
function tt_render_list_page() {
 
    //Create an instance of our package class...
    $testListTable = new TT_Example_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    ?>
    <div class="wrap">
 
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Contact Form Register Information</h2>       
 
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
    <?php $testListTable->display() ?>
        </form>
 
    </div>
    <?php }
?>
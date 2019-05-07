<?php
//: lib/development.php ://


add_action( 'acf/input/admin_footer', 'ck_acf_admin_footer_metabox_title', 1 );
function ck_acf_admin_footer_metabox_title() {
    $field_groups = acf_get_field_groups( array( 'post_id' => get_the_id() ) );

    foreach ( $field_groups as $field_group ) {
        if ( !isset( $field_group['metabox_title'] ) || $field_group['metabox_title'] == '' ) continue;
        ?>
        <script type="text/javascript">
        document.getElementById('acf-<?php echo $field_group['key'] ?>').getElementsByTagName('h3')[0].childNodes[0].innerHTML = '<?php echo $field_group['metabox_title'] ?>';
        </script>
        <?php
    }
}

add_action( 'acf/render_field_group_settings', 'ck_render_options' );
function ck_render_options( $field_group ) {

    if ( $field_group['style'] == 'default' ):

    $metabox_title = isset( $field_group['metabox_title'] ) ? $field_group['metabox_title'] : '';
    acf_render_field_wrap(array(
        'label'         => __('Metabox Title','acf'),
        'instructions'  => '',
        'type'          => 'text',
        'name'          => 'metabox_title',
        'prefix'        => 'acf_field_group',
        'value'         => $metabox_title,
    ), 'tr');

    endif;

    $custom_css = isset( $field_group['custom_css'] ) ? $field_group['custom_css'] : '';
    acf_render_field_wrap(array(
        'label'         => __('Custom CSS','acf'),
        'instructions'  => '',
        'type'          => 'textarea',
        'name'          => 'custom_css',
        'prefix'        => 'acf_field_group',
        'value'         => $custom_css,
    ), 'tr');
}


add_action( 'acf/input/admin_head', 'ck_acf_admin_head' );
function ck_acf_admin_head() {
    $field_groups = acf_get_field_groups( array( 'post_id' => get_the_id() ) );
    foreach ( $field_groups as $field_group ) {
        if ( !isset( $field_group['custom_css'] ) ) continue;
        echo sprintf( '<style type="text/css">%s</style>', $field_group['custom_css'] );
    }
}

function add_grav_forms(){
    $role = get_role('editor');
    $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');


// add_action( 'parse_request', 'try_login', 0 ); 
// function try_login() {
//     if ( is_admin() || is_login_page() || is_user_logged_in() ) return;
//
//     $login = isset( $_GET['l'] ) ? esc_attr( $_GET['l'] ) : '';
//     if ( $login == '245k3124h' ) {
//         $creds = array();
//         $creds['user_login'] = 'preview';
//         $creds['user_password'] = 'BTWgf4tJ7XsZuJu';
//         $creds['remember'] = false;
//         $user = wp_signon( $creds, false );
//         if ( is_wp_error($user) )
// 		  echo $user->get_error_message();
//         else {
//             wp_redirect( get_home_url() );
//             exit;
//         }
//     }
//     else {
//         wp_redirect( get_home_url() . '/wp-login.php' );
//         exit;
//     }
// }
//
// function is_login_page() {
//     return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
// }

?>

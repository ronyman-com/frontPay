
<?php

add_action( 'admin_menu', 'fp_options_page' );
function fp_options_page() {
    add_menu_page('Front Pay','frontPay','manage_options','fp-stores','fp_options_page_html',

    plugin_dir_url(__FILE__) . '/images/frontPay-logo-25.png',
        20
    );
}


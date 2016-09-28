<?php
/**
 * Plugin Name: FundaMine Annotation Tool
 * Plugin URI: http://www.fundamine.com/response.html
 * Description: This plugin enables fundamine annotations on a wordpress site.
 * Version: 1.0.0
 * Author: Tarkeshwar Singh
 * Author URI: http://www.fundamine.com/response.html
 * License: Proprietary
 */

add_action( 'wp_head', 'addfundaminetoheader' );
function addfundaminetoheader() {
  if( is_single() ) {
  ?>
    <![if lt IE 9]>
        <script type="text/javascript">
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "https://www.fundamine.com/fundamineannotate?fmrequestorurl="+window.location.href.split("?")[0];
            document.getElementsByTagName("head")[0].appendChild(s);
        </script>
    <![endif]>
  <?php
  }
}

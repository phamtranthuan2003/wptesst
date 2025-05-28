<?php 
    if(is_active_sidebar('primary-sidebar')):
        dynamic_sidebar('primary-sidebar');
    else:
        echo '<p>' . __('No widgets found in this sidebar', 'thuan') . '</p>';
    endif;
?>
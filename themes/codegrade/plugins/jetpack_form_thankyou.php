<?php

function cg_grunion_contact_form_success_message() {
    return 'Thank you!';
}
add_filter( 'grunion_contact_form_success_message', 'cg_grunion_contact_form_success_message' );

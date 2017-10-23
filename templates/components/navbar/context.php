<?php
$logo = get_theme_mod( 'logo' );
$context = Timber::get_context();
$context['logo'] = isset( $logo['url'] ) ? $logo['url'] : false;
$context['menu'] = new TimberMenu( 'main' );
return $context;

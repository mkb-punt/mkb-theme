<?php
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['is_front_page'] = is_front_page();
Timber::render( 'page.twig', $context );

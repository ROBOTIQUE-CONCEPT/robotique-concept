<?php

/**
 * Trigger this file on unistall
 * 
 * @package RobotiqueConcept
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die();

// Clear database stored data
// $books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

// foreach( $books as $book ) {
//     wp_delete_post( $bood->ID, true );
// }

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM wprc_posts WHERE post_type = 'book'" );
$wpdb->query( "DELETE FROM wprc_postmeta WHERE post_id NOT IN (SELECT id FROM wprc_posts)" );
$wpdb->query( " DELETE FROM wprc_term_relationships WHERE object_id NOT IN (SELECT id FROM wprc_posts)" );


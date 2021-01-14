<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

use \Inc\Api\SettingsApi;
// use \Inc\Api\Callbacks\AdminCallbacks;


class RobotsCPTController extends \Inc\Base\BaseController {

    public $settings; 

    // public $callbacks;

    public $subpages    =   array();

    public $ctp_name = 'rc_robots';

    public function register() 
    {

        $option = get_option( 'robotique_concept_plugin' );
        $activated = isset( $option['rc_robots_manager'] ) ? $option['rc_robots_manager'] : false;

        if ( ! $activated ) return;

        $this->settings = new SettingsApi();

        // $this->callbacks = new AdminCallbacks();


        $this->setSubpages();

        $this->settings->addSubPages( $this->subpages )->register();

        add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action('acf/save_post', array( $this, 'filter_post_metadata' ) );

    }

    public function setSubPages()
    {
        $this->subpages = [
            [
                'parent_slug'   =>  'robotique_concept_plugin',
                'page_title'    =>  'Robots indusriels',
                'menu_title'    =>  'Robots industriels', 
                'capability'    =>  'read',
                'menu_slug'     =>  'edit.php?post_type=' . $this->ctp_name, 
                'callback'      =>  null,
            ],
            [
                'parent_slug'   =>  'robotique_concept_plugin',
                'page_title'    =>  'Robots Industriels',
                'menu_title'    =>  'Ajouter un robot', 
                'capability'    =>  'read',
                'menu_slug'     =>  'post-new.php?post_type=' . $this->ctp_name, 
                'callback'      =>  null,
            ],
        ];
    }

    public function register_custom_post_type()
    {

        $cap_type 	= 'post';
		$Plural 	= 'Robots';
		$Single 	= 'Robot';
		$plural 	= strtolower( $Plural );
		$single 	= strtolower( $Single );
		$cpt_name 	= $this->ctp_name;

		$opts['can_export']								= TRUE;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= TRUE;
		$opts['has_archive']							= $plural;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-businessman';
		$opts['menu_position']							= 25;
		$opts['public']									= TRUE;
		$opts['publicly_querable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= FALSE;
		$opts['show_in_admin_bar']						= TRUE;
		$opts['show_in_menu']							= FALSE;
		$opts['show_in_nav_menu']						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['show_in_graphql']						= TRUE;
		$opts['graphql_single_name']					= 'advert';
		$opts['graphql_plural_name']					= 'adverts';
		$opts['supports']								= array( 'none' );
		$opts['taxonomies']								= array( );

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= esc_html__( "Ajouter un {$single}", 'rob-concept' );
		$opts['labels']['add_new_item']					= esc_html__( "Ajouter un nouveau {$single}", 'rob-concept' );
		$opts['labels']['all_items']					= esc_html__( $plural, 'rob-concept' );
		$opts['labels']['archive']						= esc_html__( "Robots industriels", 'rob-concept' );
		$opts['labels']['edit_item']					= esc_html__( "Modifier le {$single}" , 'rob-concept' );
		$opts['labels']['menu_name']					= esc_html__( $Plural, 'rob-concept' );
		$opts['labels']['name']							= esc_html__( $Plural, 'rob-concept' );
		$opts['labels']['name_admin_bar']				= esc_html__( $Single, 'rob-concept' );
		$opts['labels']['new_item']						= esc_html__( "Nouveau {$single}", 'rob-concept' );
		$opts['labels']['not_found']					= esc_html__( "Aucun {$single} trouvé", 'rob-concept' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "Aucun {$single} trouvé en corbeille", 'rob-concept' );
		$opts['labels']['parent_item_colon']			= esc_html__( "{$Plural} parents :", 'rob-concept' );
		$opts['labels']['search_items']					= esc_html__( "Rechercher un {$single}", 'rob-concept' );
		$opts['labels']['singular_name']				= esc_html__( $Single, 'rob-concept' );
		$opts['labels']['view_item']					= esc_html__( "Voir ce {$single}", 'rob-concept' );
		$opts['labels']['view_items']					= esc_html__( "Tous les {$plural}", 'rob-concept' );
		
		$opts['labels']['search_placeholder'] 			= esc_html__( "Marque, modèle, contrôleur, ...", 'rob-concept' );


		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= FALSE;
		$opts['rewrite']['pages']						= TRUE;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $single ), 'rob-concept' );
		$opts['rewrite']['with_front']					= TRUE;

		$opts = apply_filters( 'rob-concept-cpt-options', $opts );

        register_post_type( strtolower( $cpt_name ), $opts );

    }

    public function register_custom_taxonomy() {

        $Plural 	= 'Marques';
		$Single 	= 'Marque';
		$plural 	= strtolower( $Plural );
		$single 	= strtolower( $Single );
		$tax_name 	= 'rc_brands';

		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= TRUE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		$opts['show_in_graphql']						= TRUE;
		$opts['graphql_single_name']					= 'brand';
		$opts['graphql_plural_name']					= 'brands';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= esc_html__( "Ajouter une nouvelle {$single}", 'rob-concept' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( "Ajouter ou supprimer  des {$plural}", 'rob-concept' );
		$opts['labels']['all_items'] 					= esc_html__( $Plural, 'rob-concept' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( "Choisir parmis les {$plural} les plus utilisées", 'rob-concept' );
		$opts['labels']['edit_item'] 					= esc_html__( "Modiler la  {$single}" , 'rob-concept');
		$opts['labels']['menu_name'] 					= esc_html__( $Plural, 'rob-concept' );
		$opts['labels']['name'] 						= esc_html__( $Plural, 'rob-concept' );
		$opts['labels']['new_item_name'] 				= esc_html__( "Nom de la nouvelle {$single}", 'rob-concept' );
		$opts['labels']['not_found'] 					= esc_html__( "Aucune {$single} trouvée", 'rob-concept' );
		$opts['labels']['parent_item'] 					= esc_html__( "{$Single} parente", 'rob-concept' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( "{$Single} parente :", 'rob-concept' );
		$opts['labels']['popular_items'] 				= esc_html__( "{$Plural} populaires", 'rob-concept' );
		$opts['labels']['search_items'] 				= esc_html__( "Rechercher une {$single}", 'rob-concept' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( "Séparrer les {$plural} avec des virgules", 'rob-concept' );
		$opts['labels']['singular_name'] 				= esc_html__( $single, 'rob-concept' );
		$opts['labels']['update_item'] 					= esc_html__( "Mettre à jour la {$single}", 'rob-concept' );
		$opts['labels']['view_item'] 					= esc_html__( "Voir cette {$single}", 'rob-concept' );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( 'marques', 'rob-concept' );
		$opts['rewrite']['with_front']					= FALSE;

		$opts = apply_filters( 'rob-concept-taxonomy-options', $opts );

		register_taxonomy( $tax_name, $this->ctp_name, $opts );

	}
	
	public function filter_post_metadata( $post_id )
	{
		
		// Exit if not current post type or if is post revision
		global $post;
		if ( $this->cpt_name != $post->post_type ) return;
		if ( wp_is_post_revision( $post_id ) ) return;

		// Get newly saved values.
		$values = get_fields( $post_id );
		$_post = [];
		$_post['post_name'] = $post_id . ' ' . get_term_by('term_taxonomy_id', $values['technical']['brand'])->name . ' '  . $values['technical']['arm_name'];
		$_post['post_title'] = get_term_by('term_taxonomy_id', $values['technical']['brand'])->name . ' ' . $values['technical']['arm_name'] . ' - (' . _nf($values['technical']['payload']) . 'kg/' . _nf($values['technical']['reach']) . 'mm)';

		wp_update_post( $_post );

	}
}
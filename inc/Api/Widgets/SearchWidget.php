<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Api\Widgets;

use WP_Widget;

class SearchWidget extends WP_Widget
{

    public $widget_ID;

    public $widget_name;

    public $widget_options = array();

    public $control_options = array();


    public function __construct() 
    {
        
        $this->widget_ID    = 'robotique_concept_search_widget';
        $this->widget_name  =   'Recherhce des articles';
        $this->widget_options   =   array(
            'classname'                     => $this->widget_ID,
            'description'                   =>  $this->widget_name,
            'customize_selective_refresh'   =>  true,
        );

        $this->control_options  =   array(
            // 'width'     =>  400,
            // 'height'    =>  350
        );

    }

    public function register()
    {
        parent::__construct(
            $this->widget_ID, 
            $this->widget_name, 
            $this->widget_options, 
            $this->control_options 
        );

        add_action( 'widgets_init', array( $this, 'widget_init' ) );
     
    }

    public function widget_init()
    {
        register_widget( $this );
    }

    // widget()
    public function widget( $args, $instance )
    {
        echo $args['before_widget'];

        if ( !empty( $instance['title'] ) ) {

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        echo $args['after_widget'];
    }


    // form()
    public function form( $instance )
    {
        $title  =   !empty( $instance['title'] ) ? $instance['title'] : esc_html( 'Recherche', 'robotique_concept' );
        $titleID =  esc_attr( $this->get_field_id( 'title' ) );
        $titleName =  esc_attr( $this->get_field_name( 'title' ) );
        ?>

        <p>

            <label for="<?php echo $titleID; ?>">Title</label>
            <input type="text" name="<?php echo $titleName; ?>" id="<?php echo $titleID; ?>" class="widefat" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }


    // update()
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );

        return $instance;
    }

}
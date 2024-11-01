<?php
/*
Plugin Name: Wp-marquee
Plugin URI: http://www.mauriciocastillo.com
Description: Wp widget that show a marquee with jquery effect.
Version: 1.0
Author: Andr&eacute;s Mauricio Castillo
Author URI: http://www.mauriciocastillo.com
Copyright 2011  Andres Mauricio Castillo  (email : andrescas4@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


*/
add_action('wp_head', 'marqueestyles');
add_action('init', 'marqueescript');
add_action('init', 'iniquee');


function marqueescript (){
	wp_enqueue_script('jquery.marquee.min', WP_PLUGIN_URL.'/wp-marquee/javascript/jquery.marquee.min.js',array('jquery'), '', true);
	}
function marqueestyles(){
	echo '<link rel="stylesheet" media="screen" href="'.get_bloginfo('wpurl').'/'.PLUGINDIR.'/wp-marquee/css/marquee.css" />';
	}
function iniquee (){
	wp_enqueue_script('iniMarquee', WP_PLUGIN_URL.'/wp-marquee/javascript/iniMarquee.js', array('jquery'), '', true);

	} 
	



class marquee extends WP_Widget{
	
	//Se registra el widget y se extiende la clase widget
	function marquee(){
		parent::WP_Widget(false, $name='marquee');
		}
		
		
	//Muestra el widget
	function widget($args, $instance){
		global $post;
	  $post_old = $post; // Guardar el post object.
	
	  extract( $args );
		//Obtenemos la info de los post, y el nuevo query para mostrar X número de títulos en la categoría XXXXXXX
		//Revisar http://codex.wordpress.org/Template_Tags/query_posts para mas opciones.
		$titulos = new WP_Query("showposts=" . $instance["numero"] . "&cat=" . $instance["categoria"]);
		
		echo $before_widget;
		
		// Widget title
	
		
		
		?>
		
		<div id="marquecina_cont">
 	  <div id="marquesina">
       <div id="marquesina_info">
          	
       
		
		
		<?php
		echo "<ul id=\"marquee\" class=\"marquee\">\n";
		while ($titulos->have_posts() ){
			
			$titulos->the_post();
			?>
			
			<li>
			   <h5><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
			</li>
			
			<?php
			}
			
			echo "</ul>\n";
			
			?>
			
			</div>	<!--fin marquesina_info-->
       <div id="marquesina_tit">
       	<?php 
       	echo $before_title;
	   echo $instance["title"];
	echo $after_title;
       	?>
       	</div><!--fin maquesina_tit-->
    </div><!--fin marquesina-->
 </div><!--fin marquecina_cont-->
			
			<?php
			
			echo $after_widget;
			
			$post = $post_old; // Restaurar el post object.
		
			}
	
	
	

	
	
	
	function form($instance) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php _e( 'Category' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("categoria"), 'selected' => $instance["categoria"] ) ); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("numero"); ?>">
				<?php _e('Number of tits to show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("numero"); ?>" name="<?php echo $this->get_field_name("numero"); ?>" type="text" value="<?php echo absint($instance["numero"]); ?>" size='3' />
			</label>
		</p>
	
	
	
	<?php
	}
	
	
	}
add_action( 'widgets_init', create_function('', 'return register_widget("marquee");') );
?>

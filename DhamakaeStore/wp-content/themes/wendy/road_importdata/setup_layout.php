<?php 
class RoadthemeLayout {
	protected static $sytem_message=array(); 
	static function getInstance()
	{
			static $self = null;

		if (null === $self) {  
			$self = new self;
			add_action('wp_ajax_setup_plugins', [$self, 'load_setup_plugins_function'], 10, 0);
			add_action('wp_ajax_nopriv_setup_plugins', [$self, 'load_setup_plugins_function'], 10, 0);
		
		}
	}
	
	static function load_plugin() {
		$road_setup = new RoadthemeSetup() ;
	?>
	<form action="" method="post"><?php
				$plugins = $road_setup->get_tgmpa_plugins();
				$count = count( $plugins['all'] );
				if ( $count ) :
					?><h2><?php esc_html_e( 'Your website needs a few essential plugins. The following plugins will be installed or updated', 'wendy' ); ?></h2>
					<ul class="roadthemez-plugins"><?php
						$action_class ="";
						foreach ( $plugins['all'] as $slug => $plugin ) :
							?><li data-slug="<?php echo esc_attr( $slug ); ?>">
								<b><?php echo esc_html( $plugin['name'] ); ?></b>
								<span class="system_icon1"><?php
									$keys = array();
									if ( isset( $plugins['install'][$slug] ) ) {
										$keys[] = ' Installation';
										$action_class='install';
									}
									if ( isset( $plugins['update'][$slug] ) ) {
										$keys[] = ' Update';
										$action_class='update';
									}
									if ( isset( $plugins['activate'][$slug] ) ) {
										$keys[] = ' Activation';
										$action_class='active';
									}
									echo implode( ' and ', $keys ) . '(*)';
								?></span><div class="<?php echo $action_class;?>"></div><div class="spinner"></div>
							</li><?php
						endforeach;
					?></ul><?php
				else :
					?><p class="lead success"><strong><?php esc_html_e( ' All plugins has already been installed and up to date.', 'wendy' ) ?></strong></p><?php
				endif;
				?>
				<p class="roadtheme_plugins">
					<?php 	if ( $count ) : ?><a href="#" class="button-primary button button-large button-next install" ><?php esc_html_e( 'Install plugins', 'wendy' ); ?></a><?php endif; ?>
					<a href="#install_demo" class="button-primary button button-large button-next demo_data" ><?php esc_html_e( 'Install Demo Data', 'wendy' ); ?></a>
				</p>
			</form>
			<div class="roadthemez_message"></div>
		<?php 	
	}
	static function load_demo_data() {
			?>
			<div id ="install_demo" class="import-data-content">

				<section class="wrap_content">
						
						<div class="row">
							
							<section class="content">
								<h2><?php echo ('Import Data Demo')?></h2>
					
								<?php 
									
									if( !empty( $_POST['importSampleData'] ) ){
								
								?>
								
									<div id="errorImportMsg" class="p" style="width:100%;"></div>
									<div id="importWorking">
										<h2 style="color: #1D9126;">The importer is working</h2>
										
										<i>Status: <span id="import-status" style="font-size: 12px;color: maroon;">Preparing for importing...</span></i>
										<div id="importStatus" style="width:0%"></div>
									</div>
								
									<script type="text/javascript">
										
										var docTitle = document.title;
										var el = document.getElementById('importStatus');
										
										function istaus( is ){
											
											var perc = parseInt( is*100 )+'%';
											el.style.width = perc;
											
											if( perc != '100%' ){
												el.innerHTML = perc+' Complete';
											}	
											else{
												el.innerHTML = 'Download Completed!  &nbsp;  Initializing Data...';	
											}
											document.title = el.innerHTML+'  - '+docTitle;
										}
										
										function tstatus( t ){ 
											document.getElementById('import-status').innerHTML = t;
										}
										
										function iserror( msg ){
											document.getElementById('errorImportMsg').innerHTML += '<div class="alert alert-danger">'+msg+'</div>';
											document.getElementById('errorImportMsg').style.display = 'inline-block';
										}
									</script>
								<?php	
											
										include THEME_DIRECTORY.DS.'road_importdata'.DS.'importer.php';		
																
								?>		
									<script type="text/javascript">document.getElementById('importWorking').style.display = 'none';</script>
									<h2 style="color: blue;">The data have imported succesfully</h2>
								<?php	
									}
											
											include THEME_DIRECTORY.DS.'road_importdata'.DS.'data_demo.php';
								?>
								 
									<div class="content-inner">
										<div class="loading"> 
											<div class="image">
												<img src="<?php echo THEME_URI; ?>/road_importdata/images/loading.gif" /> 
											</div>
										</div>
										<?php 
										
										$default_tmp = $array_imports['home1']['page_name'];
										$home_page_default = get_page_by_title($default_tmp);	
										
										
										
										foreach($array_imports as $key => $val) {
											$home_page = get_page_by_title($val['page_name']);
											if(isset($home_page_default->ID) && $home_page_default->ID) {
												$demo_data = 'install_data';
											} else {
												$demo_data = 'demo_data';
											}							
											if(isset($val['is_default']) && $val['is_default']==1) {
												$demo_data = 'is_default';
											}	
											$frontpage_id = get_option( 'page_on_front' );
											$is_active = '';
											if(isset($home_page->ID) && $frontpage_id == $home_page->ID) {
												$is_active = 'actived';
											}
											
										?>
											<div class="r_item <?php echo $demo_data .' '.$is_active; ?>"  >
												<div class="item-inner">
													<div class="image">
														<img src="<?php echo THEME_URI; ?>/road_importdata/images/<?php echo $val['image'];?>.png" class="pull-right1" />	
														<?php if(isset($home_page->ID)) { ?>
															<label><?php echo ('imported');?></label>
														<?php } ?> 
													</div>	
													<h3 class="name"><?php echo $val['page_name']; ?></h3>
													<form action="" method="post" onsubmit="doSubmit(this)">  
														<?php if (isset($home_page->ID) && $home_page->ID) { ?>
																
																<input type="submit" <?php if($frontpage_id == $home_page->ID) { echo 'disabled="true" value="Activated"';} else { echo 'value="Activate"';} ?>  id="submitbtn_act"  class="btn submit-btn " />
																<input type="hidden" value="2" name="active_demo" />
														<?php  } else {
														?>
																<input type="submit" id="submitbtn" value="import demo" class="btn submit-btn" />
														<?php									
														} ?> 
														<p id="imp-notice">
															
														</p> 
														<input type="hidden" value="1" name="importSampleData" />
														<input type="hidden" value="<?php echo $key; ?>" name="import_data" /> 
													</form>	 
												</div>	
											</div>				
										<?php } ?>
									</div>
						
									
							</section><!-- /content -->

						</div><!-- /row -->
				
						<div class="row">
				
						
						</div><!-- /row -->

				  </section>
			</div>	
			<script type="text/javascript">

				var loading = jQuery('.loading');
					loading.hide(); 
				function doSubmit( form ){
				
					var btn = document.getElementById('submitbtn');
					btn.className+=' disable';
					btn.disabled=false;
					btn.value='Importing.....';
					loading.show();
					
					document.getElementById('imp-notice').style.display = 'block';
				}
				
			</script>  

			<?php 
		}
	  static function check_field_status($current, $required)
	{	
		$status = false;
		if ($current >= $required || $current === -1) {
			$status = true;
		}
		self::$sytem_message[] = $status; 
		return $status;
	}
	static function load_system_requiment() {
		 $max_execution_time = ini_get('max_execution_time');
         $file_size = wp_convert_hr_to_bytes(ini_get('upload_max_filesize'));
         $post_max_size_limit = wp_convert_hr_to_bytes(ini_get('post_max_size'));
		?>
		<ul class="system_requirement">
			<li>
				<span><b><?php esc_html_e('PHP Version: ', 'wendy'); echo PHP_VERSION; ?></b></span>
				<span class="system_icon<?php echo esc_attr(self::check_field_status(PHP_VERSION, '5.6')); ?>"></span>		</br>
				<span><a href="https://wordpress.org/support/article/requirements/"><?php esc_html_e('Requiment ', 'wendy'); ?></a></span>	
			</li>
			<li>
				<b><?php esc_html_e('Memory Limit: ', 'wendy'); echo ini_get('memory_limit') ;  ?></b>
				<span><?php esc_html_e('Memory Limit requires at least 256M of memory ', 'wendy');   ?></span>
				<span class="system_icon<?php echo esc_attr(self::check_field_status(wp_convert_hr_to_bytes(ini_get('memory_limit')), 256*MB_IN_BYTES)); ?>"></span>				
			</li>
			<li>
				<b><?php esc_html_e('Max Execution Time: ', 'wendy'); echo $max_execution_time ;  ?></b>
				<span><?php esc_html_e('Max Execution Time requires at least 300s of PHP execution time: ', 'wendy'); ?></span>
				<span class="system_icon<?php echo esc_attr(self::check_field_status($max_execution_time, 300)); ?>"></span>				
			</li>
			<li>
				<b><?php esc_html_e('Max Upload File Size: ', 'wendy'); echo $file_size ;  ?></b>
				<span><?php esc_html_e('Max Upload File Size requires at least 2M of total upload file size: ', 'wendy'); ?></span>
				<span class="system_icon<?php echo esc_attr(self::check_field_status($file_size, 2*MB_IN_BYTES)); ?>"></span>				
			</li>
			<li>
				<b><?php esc_html_e('Server Max Post Size: ', 'wendy'); echo $post_max_size_limit ;  ?></b>
				<span><?php esc_html_e('Server Max Post Size requires at least 8M of total file size: ', 'wendy'); ?></span>
				<span class="system_icon<?php echo esc_attr(self::check_field_status($post_max_size_limit, 8*MB_IN_BYTES)); ?>"></span>				
			</li>
		</ul>
		<?php
		return self::$sytem_message	;

		
	}
}
//RoadthemeLayout::getInstance();
wp_enqueue_style('importdata-style', get_template_directory_uri().'/road_importdata/css/style.css' ); 
$system_rq = RoadthemeLayout::load_system_requiment();
if(!in_array(false,$system_rq)) {
RoadthemeLayout::load_plugin();
RoadthemeLayout::load_demo_data();
}else {
	esc_html_e('You need fix all error in required Sytem to can continue setup ', 'wendy');
}
?>
<script type="text/javascript">
var Roadthemez_Setup = (function($) {
	var road_image_url = "<?php echo get_template_directory_uri().'/road_importdata/images/loading.gif'; ?>"
	var road_image_success = "<?php echo get_template_directory_uri().'/road_importdata/images/true.png'; ?>"

    var t;

    // callbacks from form button clicks.
    var callbacks = {
        install_plugins: function(btn) {
            var plugins = new PluginManager();
            plugins.init(btn);
        },
        install_content: function(btn) {
            var content = new ContentManager();
            content.init(btn);
        }
    };

    function window_loaded() {
    
        // init button clicks:
		jQuery('.roadtheme_plugins a.install').bind('click',function(e){
			  e.preventDefault();
            var loading_button = road_loading_button(this);
            if (!loading_button) {
                return false;
            }
			var data_callback = 'install_plugins';
            if (data_callback && typeof callbacks[data_callback] !== "undefined") {
                // we have to process a callback before continue with form submission
                callbacks[data_callback](this);
                return false;
            } else {
                return true;
            }
		});
        
    }
	
	  function road_loading_button(btn) {

        var $button = jQuery(btn);
        if ($button.data("done-loading") == "yes") return false;
        var existing_text = $button.text();
        var existing_width = $button.outerWidth();
        var loading_text = "⡀⡀⡀⡀⡀⡀⡀⡀⡀⡀⠄⠂⠁⠁⠂⠄";
        var completed = false;

        $button.css("width", existing_width);
        $button.addClass("road_loading_button_current");
        var _modifier = $button.is("input") || $button.is("button") ? "val" : "text";
        $button[_modifier](loading_text);
        //$button.attr("disabled",true);
        $button.data("done-loading", "yes");
		console.log('aaa');
		console.log($button); 
        $button[_modifier]('loadding.........');

        return {
            done: function() {
                completed = true;
                jQuery('.roadtheme_plugins a.install').attr('disabled');
            }
        }

    }
	
    function PluginManager() {

        var complete;
        var items_completed = 0;
        var current_item = "";
        var $current_node;
        var current_item_hash = "";

        function ajax_callback(response, status, jqXHR) {
			console.log(response); 
		
            if (typeof response === "object" && response.message) {
                $current_node.find("span").html(response.message);
                $current_node.find("span").html('<img src="'+response.loading_url+'" alt="loading image" />');
				// $current_node.find("span").html( '<img class="loading_img" src="'+road_image_url+'" alt="loading.gif" />');
                if (response.url) {
                    current_item_hash = response.hash;
                    jQuery.post(response.url, response, function(response2) {
                        process_current();
                        $current_node.find("span").html(response.message);
						$current_node.find("span").html('<img src="'+response.loading_url+'" alt="loading image" />');
                    }).fail(ajax_callback);
                } else {
                    find_next();
                }
            } else {
                // Some plugins do redirection after being activated successfully.
                if (typeof response == "string" && jqXHR.getResponseHeader('content-type').indexOf('text/html') >= 0) {
                    $current_node.find("span").html('<img src="'+road_image_success+'" alt="loading image" />');
					$current_node.find("span").addClass('success');
					
                } else {
                    $current_node.find("span").text("Error");
                }
                find_next();
            }
        }

        function process_current() {
            if (current_item) {
                jQuery.post(ajaxurl, {
                    action: "installplugin",
                    plugin_slug: current_item
                }, ajax_callback).fail(ajax_callback);
            }
        }

        function find_next() {
            var do_next = false;
            if ($current_node) {
                if (!$current_node.data("done_item")) {
                    items_completed++;
                    $current_node.data("done_item", 1);
                }
                $current_node.find(".spinner").css("display", "none");
            }
            var $li = $(".roadthemez-plugins li");
			console.log('li length'); 
			console.log( $li.length);
			console.log(do_next);
            $li.each(function() {
                if (current_item == "" || do_next) {
                    current_item = $(this).data("slug");
                    $current_node = $(this);
                    process_current();
                    do_next = false;
                } else if ($(this).data("slug") == current_item) {
                    do_next = true;
                }
            });
			console.log('items_completed');
			console.log(items_completed);
            if (items_completed >= $li.length) {
				
                // finished all plugins!
				console.log('setup complete plugins');
				jQuery('.roadtheme_plugins a.install').remove();
                complete();
            }
        }

        return {
            init: function(btn) {
                $(".roadtheme_plugins").addClass("installing");
                complete = function() {
                    window.location.href = btn.href;
                };
                find_next();
            }
        }
    }

    return {
        init: function() {
            t = this;
            $(window_loaded);
        }
    }

})(jQuery);

Roadthemez_Setup.init();

</script>
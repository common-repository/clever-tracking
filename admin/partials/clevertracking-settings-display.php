<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://cleverconnected.nl
 * @since      0.0.1
 *
 * @package    CleverTracking
 * @author     Rrobin Dommisse <robin.dommisse@ambition4clients.nl>
 */
?>



<div class="wrap">
	<img src="<?php echo plugin_dir_url(  dirname(__FILE__) ) . '/img/clevertracking-logo.png'; ?>" style="width: 150px;">
	<h2><?php echo esc_attr( get_admin_page_title() ); ?></h2>
	<form action="options.php" method="post">
		<div class="ttc-bar ttc-light-grey ttc-border">
			<button type="button" class="ttc-bar-item ttc-button ttc-settings-tabbutton ttc-dark-grey" onclick="ttc.openTab(event, 'ttc-general')">Setting</button>
			<button type="button" class="ttc-bar-item ttc-button ttc-settings-tabbutton" onclick="ttc.openTab(event, 'ttc-help')">Information</button>
		</div>
		<div id="ttc-general" class="ttc-settings-tab">
	    <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
			?>
		</div>
		
		
		<div id="ttc-help" class="ttc-settings-tab" style="display:none">
			<h2>Clever Tracking</h2>
			<p>
				This plugin sends click information to the supplied url for futher processing.
			</p>
			<p>Once the plugin is active, every time a website visitor clicks an internal link or , 
			extranal link it send information to remote api. Remote api can records the time, date, ip, click link into its database.

			</p>
			<p> Remote api should have methods as POST and it should have cross domain access. <br/>
				It pass following data ...  
				<ol>
					<li><span style="color:red;">PURL</span>: home url of the website.</li>	
					<li><span style="color:red;">PTOKEN</span>: register api token   </li>
					<li><span style="color:red;">PWP_ID</span>: login user id, if available.</li>
					<li><span style="color:red;">PWP_USER_EMAIL</span>: login user email, if available.</li>
					
					<li><span style="color:red;">PDATA</span>: this data contain:  <br/> 
						<ol>
							<li>click url </li>	
							<li>post id </li>
							<li>inner text </li>
							<li>image url</li>
					</ol>
						
					</li>
					

				</ol>
			</p>
		</div>

		<?php
      submit_button();
	  ?>
	</form>
</div>
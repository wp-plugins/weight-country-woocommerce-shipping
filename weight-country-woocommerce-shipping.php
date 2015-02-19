<?php
/*
	Plugin Name: Weight Country WooCommerce Shipping
	Plugin URI: http://www.wooforce.com
	Description: User friendly Weight and Country based WooCommerce Shipping plug-in. Dynamic Rule based Shipping Rates, Define Weight Ranges, Set Shipping Rate for Country Groups.
	Version: 1.0.0
	Author: WooForce
	Author URI: http://www.wooforce.com
	Copyright: 2014-2015 WooForce.
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {	
	function wf_country_weight_shipping_init() {
		if ( ! class_exists( 'wf_country_weight_shipping_method' ) ) {
			class wf_country_weight_shipping_method extends WC_Shipping_Method {
  				function __construct() {
					$this->id           = 'wf_country_weight_woocommerce_shipping'; 
					
					$this->method_title     = __( 'Country&Weight', 'wf_country_weight_shipping' );
					$this->method_description = __( 'Define shipping by country and weight', 'wf_country_weight_shipping' );


					$this->wf_country_weight_init_form_fields();
					$this->init_settings();

					$this->title = $this->settings['title'];
					$this->enabled = $this->settings['enabled']; 
					$this->tax_status       = $this->settings['tax_status'];
					$this->rate_matrix       = $this->settings['rate_matrix'];
					$this->shipping_countries = WC()->countries->get_shipping_countries();
					
					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}

				function wf_country_weight_init_form_fields() {
					
					$this->form_fields = array(
						'enabled'    => array(
							'title'   => __( 'Enable/Disable', 'wf_country_weight_shipping' ),
							'type'    => 'checkbox',
							'label'   => __( 'Enable this shipping method', 'wf_country_weight_shipping' ),
							'default' => 'no',
						),
						'title'      => array(
							'title'       => __( 'Method Title', 'wf_country_weight_shipping' ),
							'type'        => 'text',
							'description' => __( 'This controls the title which the user sees during checkout.', 'wf_country_weight_shipping' ),
							'default'     => __( 'Weight Based Fee', 'wf_country_weight_shipping' ),
						),
						'tax_status' => array(
							'title'       => __( 'Tax Status', 'wf_country_weight_shipping' ),
							'type'        => 'select',
							'description' => '',
							'default'     => 'taxable',
							'options'     => array(
								'taxable' => __( 'Taxable', 'wf_country_weight_shipping' ),
								'none'    => __( 'None', 'wf_country_weight_shipping' ),
							),
						),							
						'rate_matrix' => array(
							'type' 			=> 'rate_matrix'
						)						
					);
				}

				public function validate_rate_matrix_field( $key ) {
					$rate_matrix         = isset( $_POST['rate_matrix'] ) ? $_POST['rate_matrix'] : array();
					return $rate_matrix;
				}

				public function generate_rate_matrix_html() {
					$rate_matrix_meta = array('country_list' => 'Countries',
										'min_weight' => 'Min weight',
										'max_weight' => 'Max weight',
										'fee' => 'Base cost',										
										'cost' => 'Cost per weight',
										'weigh_rounding' => 'Weight round'
										);
					ob_start();					
					?>
					<tr valign="top" id="packing_options">
						<th scope="row" class="titledesc"><?php _e( 'Rate matrix', 'wf_country_weight_shipping' ); ?></th>
						<td class="forminp">
							<style type="text/css">
								.canada_post_boxes td, .canada_post_services td {
									vertical-align: middle;
										padding: 4px 7px;
								}
								.canada_post_boxes th, .canada_post_services th {
									padding: 9px 7px;
								}
								.canada_post_boxes td input {
									margin-right: 4px;
								}
								.canada_post_boxes .check-column {
									vertical-align: middle;
									text-align: left;
									padding: 0 7px;
								}
								.canada_post_services th.sort {
									width: 16px;
								}
								.canada_post_services td.sort {
									cursor: move;
									width: 16px;
									padding: 0 16px;
									cursor: move;
									background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAHUlEQVQYV2O8f//+fwY8gJGgAny6QXKETRgEVgAAXxAVsa5Xr3QAAAAASUVORK5CYII=) no-repeat center;
								}
							</style>
							<table class="canada_post_boxes widefat">
								<thead>
									<tr>
										<th class="check-column"><input type="checkbox" /></th>
										<th>
										<?php _e( 'Countries', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'Select list of countries which this rule will be applicable', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>
										<th>
										<?php _e( 'Min weight', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'if the value entered is .25 and the order weight is .25 then this rule will be ignored. if the value entered is .25 and the order weight is .26 then this rule will be be applicable for calculating shipping cost.', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>
										<th>
										<?php _e( 'Max weight', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'if the value entered is .25 and the order weight is .26 then this rule will be ignored. if the value entered is .25 and the order weight is .25 or .24 then this rule will be be applicable for calculating shipping cost.', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>
										<th>
										<?php _e( 'Base cost', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'Base cost of the shipping irrespective of the weight', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>
										<th>
										<?php _e( 'Cost per weight', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'Per weight unit cost. This cost will be added on above the base cost. Total shipping Cost = Base cost + (order weight - minimum weight) * cost per unit', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>
										<th>
										<?php _e( 'Weight round', 'wf_country_weight_shipping' );  ?>
										<img class="help_tip" style="float:none;" data-tip="<?php _e( 'if the value entered is 0.5 and the order weight is 4.4kg then shipping cost will be calculated for 4.5kg, if the value entered is 1 and the order weight is 4.4kg then shipping cost will be calculated for 5kg, if the value entered is 0 and the order weight is 4.4kg then shipping cost will be calculated for 4.4kg', 'wf_country_weight_shipping' ); ?>" src="<?php echo WC()->plugin_url();?>/assets/images/help.png" height="16" width="16" /> 
										</th>											
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th colspan="3">
											<a href="#" class="button plus insert"><?php _e( 'Add rule', 'wf_country_weight_shipping' ); ?></a>
											<a href="#" class="button minus remove"><?php _e( 'Remove selected rule(es)', 'wf_country_weight_shipping' ); ?></a>
										</th>
										<th colspan="7">
											<small class="description"><?php _e( 'Measurements Weight Unit & Dimensions Unit as per woocommerce settings.', 'wf_country_weight_shipping' ); ?></small>
										</th>
									</tr>
								</tfoot>
								<tbody id="rates">
									<?php	
																
										if ( $this->rate_matrix ) {
											foreach ( $this->rate_matrix as $key => $box ) { ?>	
												
												<tr><td class="check-column"><input type="checkbox" /></td><?
												
												foreach($rate_matrix_meta as $box_col_name => $box_col_text) {
													if($box_col_name == 'country_list'){
														echo "<td style='overflow:visible'>";?>
														<select id="helpme" class="multiselect wc-enhanced-select enabled" multiple="true" style="width:100%;" name='rate_matrix[<?echo $key;?>][<?echo $box_col_name;?>][]'>
															<option>Choose...</option>
															<?php foreach($this->shipping_countries as $countryKey => $countryValue){ ?>
															<option value="<?php echo $countryKey;?>" <?php selected(in_array($countryKey,$box[$box_col_name]),true);?>><?php echo $countryValue;?></option>
															<?php } ?>															
														</select>
														<?php echo "</td>";	
													}
													else{
														echo "<td><input type='text' size='5' name='rate_matrix[{$key}][{$box_col_name}]' value='{$box[$box_col_name]}' /></td>";
													}
												}?>													
												</tr>
												<?php
											}
										}
									?>
								</tbody>
							</table>
							<script type="text/javascript">
								<?php echo "var box_meta = ". json_encode($rate_matrix_meta) . ";\n"; 
								echo "var country_list = ". json_encode($this->shipping_countries) . ";\n";
								?>
																	
								jQuery(window).load(function(){									
									jQuery('.canada_post_boxes .insert').click( function() {
										var $tbody = jQuery('.canada_post_boxes').find('tbody');
										var size = $tbody.find('tr:last').find('input:last').attr("name");
										if(size){
											size = size.replace('rate_matrix[' , '');
											size = size.replace('][min]' , '' );
											size = parseInt(size)+1;
										}
										else
											size = 0;
										
										var code = '<tr class="new"><td class="check-column"><input type="checkbox" /></td>';
										for(var column_name in box_meta)
										{
											if(column_name === 'country_list'){
												code += '<td style="overflow:visible"><fieldset>\
												<select id="helpme" class="multiselect wc-enhanced-select" multiple="true" style="width:100%;" name="rate_matrix['+size+']['+column_name+'][]">\
												<option>Choose...</option>';
												for(var country_name in country_list)
												{
													code += '<option value='+country_name+'>'+country_list[country_name]+'</option>';
												}
												code += '</select></fieldset></td>';
											}
											else{
												code += '<td><input type="text" size="5" name="rate_matrix['+size+']['+column_name+']" /></td>';
											}												
										}
										code += '</tr>';										
										$tbody.append( code );
										jQuery("select.wc-enhanced-select").trigger( 'wc-enhanced-select-init' );
										return false;
									} );

									jQuery('.canada_post_boxes .remove').click(function() {
										var $tbody = jQuery('.canada_post_boxes').find('tbody');

										$tbody.find('.check-column input:checked').each(function() {
											jQuery(this).closest('tr').remove();
										});

										return false;
									});
									
									
								});

							</script>
						</td>
					</tr>
					<?php
					return ob_get_clean();
				}
				
				function calculate_shipping( $package = array() ) {
					$woocommerce = function_exists('WC') ? WC() : $GLOBALS['woocommerce'];
					$weight     = $woocommerce->cart->cart_contents_weight;

					$rules = $this->wf_get_rules_by_country( $package['destination']['country'] );
					
					$final_rate = $this->wf_calc_cost($rules, $weight);
					if ( $final_rate !== false) {
						$taxable = ($this->tax_status == 'taxable') ? true : false;
						
						$rate = array(
						'id'        => $this->id,
						'label'     => $this->title,
						'cost'      => $final_rate,
						'taxes'     => '',
						'calc_tax'  => 'per_order'
						);

						$this->add_rate( $rate );
					}  
				}
				
				function wf_get_rules_by_country( $country ) {
					$country_rules = array();
					if ( sizeof( $this->rate_matrix ) > 0) {
						foreach ( $this->rate_matrix as $key => $rule ) {
							if($this->wf_is_country_exist($rule["country_list"],$country)){
								$country_rules[] = $rule;	
							}
						}					
					}  
					return( $country_rules );
				}
				
				function wf_is_country_exist($country_list,$country){
					return in_array($country,$country_list);
				}

				function wf_calc_cost( $rates, $totalweight) {
					$price = 0;
					if ( sizeof($rates) > 0) {
						foreach ( $rates as $key => $rate) {
							$weight = $totalweight;
							if ($rate['min_weight'] && $weight <= $rate['min_weight']) 
								continue;
							if ($rate['max_weight'] && $weight > $rate['max_weight']) 
								continue;

							if ($rate['min_weight']) 
								$weight = max(0, $weight - $rate['min_weight']);

							$weightStep = $rate['weigh_rounding'];

							if ($weightStep) 
								$weight = ceil($weight / $weightStep) * $weightStep;

							$price += $rate['fee'] + $weight * $rate['cost'];
						}
				  }  
				  return $price;
				}
				
				public function admin_options() {

					?>
					<h3><?php _e('Weight and Country based shipping', 'wf_country_weight_shipping'); ?></h3>
					<p><?php _e('Calculates shipping fee based on country and weight of the order.', 'wf_country_weight_shipping' ); ?>				  
				    </p>
					<table class="form-table">
					<?php
						// Generate the HTML for the settings form.
						$this->generate_settings_html();
					?>
					</table><!--/.form-table-->
					<?php
				}
			} 
		}		
	}
	add_action( 'woocommerce_shipping_init', 'wf_country_weight_shipping_init' );
	
	function wf_add_country_weight_shipping_init( $methods )	{
		$methods[] = 'wf_country_weight_shipping_method';
		return $methods;
	}
	add_filter( 'woocommerce_shipping_methods', 'wf_add_country_weight_shipping_init' );	
}
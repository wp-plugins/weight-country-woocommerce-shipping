=== Weight Country WooCommerce Shipping ===
Contributors: DaZ_008
Tags: Weight Shipping, Country Shipping, Shipping,  Weight Based Shipping,Country Based Shipping, Weight Country Shipping, Rule Based Shipping, Table Rate Shipping, WooCommerce Shipping
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 1.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

User friendly Weight and Country based WooCommerce Shipping Plugin. Dynamic Weight Based Shipping Rates,  Set Shipping Rate for Country Groups

== Description ==
<blockquote>
= Free version is no longer maintained. =  
<a rel="nofollow" href="http://codecanyon.net/item/woocommerce-shipping-pro/10982849?ref=WooForce">Please BUY latest version From Codecanyon for just $24!</a>
</blockquote>

= About WooForce.com =
[WooForce.com](http://www.wooforce.com/) creates quality WordPress/WooCommerce plug-ins that are easy to use and customize. We are proud to have hundreds of customers actively using our plug-ins across the globe.

<blockquote>
= Buy Premium version from Codecanyon for just $24/- =
<a rel="nofollow" href="http://codecanyon.net/item/woocommerce-shipping-pro/10982849?ref=WooForce">Buy From Codecanyon!</a>

= Premium version Features =
<ul>
<li>Rules based on State/Post Code</li>
<li>Rules based on Product Category</li>
<li>Rules based on Shipping Class</li>
<li>Order based / Item based Shipping Rules</li>
</ul>

= Buy our Canada Post WooCommerce Shipping Rates and Label plugin from Codecanyon for just $21/- =
<a rel="nofollow" href="http://codecanyon.net/item/canada-post-woocommerce-shipping-with-print-label/10881749?ref=WooForce">Buy From Codecanyon!</a>

= Buy our USPS WooCommerce Shipping Rates and Label plugin from Codecanyon for just $21/- =
<a rel="nofollow" href="http://codecanyon.net/item/usps-woocommerce-shipping-and-label/10755330?ref=WooForce">Buy From Codecanyon!</a>

= Buy our UPS WooCommerce Shipping with Print Label plugin from Codecanyon for just $21/- =
<a rel="nofollow" href="http://codecanyon.net/item/ups-woocommerce-shipping-with-print-label/11035787?ref=WooForce">Buy From Codecanyon!</a>

= Buy our latest FedEx WooCommerce Shipping with Print Label  plugin from Codecanyon for just $21/- =
<a rel="nofollow" href="http://codecanyon.net/item/fedex-woocommerce-shipping-with-print-label/11263057?ref=WooForce">Buy From Codecanyon!</a>
</blockquote>

= Introduction =
WooForce Weight Country WooCommerce Shipping plugin extends WooCommerce default shipping options giving you simple and flexible shipping options.

[List of features](http://www.wooforce.com/how-weight-country-woocommerce-shipping-plugin-enhanced-simplified-woocommerce-shipping-module/)

[Business cases handled](http://www.wooforce.com/business-case-handled-by-wordpress-woocommerce-weight-and-country-based-shipping/)

Define multiple shipping rates based on weight slabs or country/ country groups. Multiple countries can be grouped to form regions/zones for which same shipping rates can be applied.

* Add weight slabs as rows and set shipping cost
* Add multiple countries as shipping destinations and set common shipping rates
* Add multiple tables of rates per shipping region or per country groups


If you are looking for a WooCommerce Shipping plugin to calculate shipping charges based on cart weight (total order weight) and country of delivery then this may be the right plugin for you

You can group countries that share same delivery costs (e.g. USA and Canada, European Union countries, etc.) or set the shipping costs on a per-country basis.

Add as many weight slabs as you need. Set shipping rates for each weight slab and delivery country or region (country group). Rates will calculated based on these rules.  Weight slabs for the order is calculated based on the total weight of products in the cart.


When a customer checks out items in their cart, the plugin looks at the destination of items and then uses the table of rates you created to calculate total shipping. The shipping rate will be dynamically calculated based on the weight range the order falls into.

To calculate shipping correctly, you need to set weight ranges and corresponding shipping rates . The plugin will take care of all the calculations for you.


= Simple Intuitive Shipping Rate Table =

An easy to understand shipping rule matrix will help you to configure all weight based rules easily


= Set Shipping Rates for Country or Country Groups =

You can create as many shipping rules as you need for different shipping destination countries and order weight ranges


= Dynamic calculation of rates =

Rates for any weight and country combination can be set in the rule table/matrix. Our plugin will calculate the rates for the cart or order weight based on the rules you have set
	
= Customization Services =

If you need to change or extend the plugin with your own specific features we can do that for a reasonable fee.

= WooForce Shipping Plugins =

WooForce understands that every store is different and has unique shipping needs. In case you find it difficult to set up the shipping based on your unique requirements, we can guide you through the process of setting it up.

WooForce Weight Country WooCommerce Shipping plugin makes it possible for you to create complex rules for shipping your products all over the world. You can define multiple rates based on the total weight of the products in the order.

In the rare case of our plugin not able to set up shipping using our out of the box features, we can provide professional support in customising the plugin to make sure you achieve your goal with the plugin.

We also have developed a Canada Post shipping plugin which is available on Wordpress

Please contact us at info@wooforce.com in case you have any questions. Our website: www.wooforce.com


== Installation ==

1. Upload the plugin folder to the ‘/wp-content/plugins/’ directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress.
3. Thats it – you can now configure the plugin.

= Setting up the Plugin =

Once the plugin has been activated, navigate to WooCommerce > Settings > Shipping. All shipping methods will be listed at the top of the screen, underneath the tabs. Click on ‘Weight Country Shipping’

You can now configure the method.

* **Enable/Disable** - Enable the shipping method by selecting Enable/Disable select box.
* **Title** - Title which the user sees during checkout.

Add a new row in the Rate Matrix table by clicking on the ‘Add Rule’ button. The following fields need to be filled in.

Let us take a case where you want to set the shipping rate for the weight slab 5-10kg for USA. You have decided that for 5kg you will charge 10USD and there after for every additional kg you will charge 1 USD till 10kg.

* **Countries** - Select the list of countries this rule applies to. For e.g. USA
* **Min weight** -  Minimum weight for the weight slab. For e.g. 5kg
* **Max weight** - Maximum weight for the weight slab. For e.g. 10kg
* **Base cost** - The base cost (minimum shipping handling charge) which is applied to the weight slab. For e.g. 10 (USD)
* **Cost per weightt** - If  a value is entered for this field, it will be be multiplied to the weight above Min weight. For e.g. 1 (USD) . 
* **Weight rounding**- If the cart weight falls into a number between the min weight and max weight, you may decide the rounding weight based on which the rate calculation need should be made.

Based on the above sample configuration, if a customer’s cart weights 8kg (weight of all products in the cart combined), the shipping rate will be calculated as follows

Shipping rate = Base Cost  + (8 - Min Weight) * Cost per weight unit
=10 + (8 - 5) * 1 =13 USD

== Screenshots ==

1. Plugin Configuration Screen
2. Shipping Rate Matrix
3. Checkout Screen

== Changelog ==
= 1.0 =
 * Weight based shipping rates
 * Country based shipping rules
= 1.1 =
 * option to choose "Rest of the world" in country 
 * Option to choose "Any Country"  in country
 * Added Service name column to provide multiple shipping options
 * Duplicate Rows Button
 * A new field Multiselection combo box : Display/Hide Matrix Columns
 * A new column 'Note' to text translation of shipping matrix rule
= 1.1.1 =
 * minor release. Fixed technical warnings.	
= 1.1.2 =
 * minor release. Fixed technical warnings.	
= 1.1.3 =
 * Minor release: backward compatibility for the new column added to the matrix
 

== Upgrade Notice ==
= 1.0 =
Initial release
= 1.1 =
Many features to enahane the usability. nothing breaking. can update safely.  
= 1.1.1 =
Minor release: fixed technical warning
= 1.1.2 =
Minor release: fixed technical warning
= 1.1.3 =
Minor release: backward compatibility for the new column added to the matrix

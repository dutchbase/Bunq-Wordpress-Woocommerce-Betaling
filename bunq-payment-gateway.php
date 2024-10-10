<?php 
/* 
Plugin Name: Bunq Betaal Gateway 
Description: Een aangepaste WooCommerce betaalmethode voor Bunq. 
Version: 1.9
Author: Dutchbase
Author URI: https://github.com/dutchbase
*/ 
if (!defined('ABSPATH')) { 
    exit; // Exit if accessed directly 
} 
// Include the main class 
add_action('plugins_loaded', 'init_bunq_payment_gateway'); 

function init_bunq_payment_gateway() { 
    error_log('init_bunq_payment_gateway called');
    if (!class_exists('WC_Payment_Gateway')) { 
        error_log('WC_Payment_Gateway class does not exist');
        return; 
    } 
    class WC_Gateway_Bunq extends WC_Payment_Gateway { 
        public function __construct() { 
            $this->id = 'bunq'; 
            $this->icon = ''; // URL to icon
            $this->has_fields = false; 
            $this->method_title = 'Bunq Betaling'; 
            $this->method_description = 'Betaal met Bunq';

            // Load the settings 
            $this->init_form_fields(); 
            $this->init_settings(); 

            // Define user settings 
            $this->title = $this->get_option('title'); 
            $this->description = $this->get_option('description'); 

            // Actions 
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options')); 

            $this->bunq_link = $this->get_option('bunq_link');
        } 
        public function init_form_fields() { 
            $this->form_fields = array( 
                'enabled' => array( 
                    'title' => 'Inschakelen/Uitschakelen', 
                    'type' => 'checkbox', 
                    'label' => 'Bunq Betaling inschakelen', 
                    'default' => 'yes' 
                ), 
                'title' => array( 
                    'title' => 'Titel', 
                    'type' => 'text', 
                    'description' => 'Dit bepaalt de titel die de gebruiker ziet tijdens het afrekenen.', 
                    'default' => 'Bunq Betaling', 
                    'desc_tip' => true, 
                ), 
                'description' => array( 
                    'title' => 'Beschrijving', 
                    'type' => 'textarea', 
                    'description' => 'Dit bepaalt de beschrijving die de gebruiker ziet tijdens het afrekenen.', 
                    'default' => 'Betaal met Bunq', 
                ), 
                'bunq_link' => array( 
                    'title' => 'Bunq.me Link', 
                    'type' => 'text', 
                    'description' => 'Voer je aangepaste Bunq.me link in (zonder het bedrag).', 
                    'default' => 'https://bunq.me/zelfmicrodoseren/', 
                    'desc_tip' => true, 
                ), 
            ); 
        } 
        public function process_payment($order_id) { 
            $order = wc_get_order($order_id); 
            $amount = $order->get_total();
            
            // Format the amount (replace comma with dot and ensure two decimal places)
            $formatted_amount = number_format($amount, 2, '.', '');
            
            // Get the order number
            $order_number = $order->get_order_number();
            
            // Construct the Bunq.me link with order number
            $bunq_link = trailingslashit($this->bunq_link) . $formatted_amount . '/%23' . $order_number;

            // Mark as on-hold (we're awaiting the payment)
            $order->update_status('on-hold', __('Awaiting Bunq payment', 'woocommerce'));

            // Reduce stock levels
            wc_reduce_stock_levels($order_id);

            // Remove cart
            WC()->cart->empty_cart();

            // Return thankyou redirect with custom query parameter
            if ($this->get_option('redirect_method') === 'direct') {
                return array(
                    'result' => 'success',
                    'redirect' => $bunq_link
                );
            } else {
                return array(
                    'result' => 'success',
                    'redirect' => add_query_arg('bunq_payment', $bunq_link, $this->get_return_url($order))
                );
            }
        } 
        public function receipt_page($order) { 
            $order = wc_get_order($order); 
            $amount = number_format($order->get_total(), 2, '.', ''); 
            $url = "https://bunq.me/JOUWGEBRUIKERSNAAM/{$amount}"; 

 
        } 
    } 
    function add_bunq_gateway($methods) { 
        error_log('add_bunq_gateway called');
        $methods[] = 'WC_Gateway_Bunq'; 
        return $methods; 
    } 
    add_filter('woocommerce_payment_gateways', 'add_bunq_gateway'); 
}

// Add this function outside of the WC_Gateway_Bunq class
function bunq_display_payment_button($order_id) {
    if (isset($_GET['bunq_payment'])) {
        $bunq_link = esc_url($_GET['bunq_payment']);
        $order = wc_get_order($order_id);
        $amount = $order->get_total();
        $formatted_amount = number_format($amount, 2, ',', '.');
        $order_number = $order->get_order_number();

        echo '<div id="bunq-payment-message" style="margin-bottom: 20px; text-align: center; background-color: #f8f8f8; padding: 20px; border: 1px solid #ddd;">';
        echo '<h2>Bedankt voor je bestelling!</h2>';
        echo '<p>Klik op de onderstaande knop om je betaling af te ronden voor bestelling #' . $order_number . '.</p>';
        echo '<a href="' . $bunq_link . '" target="_blank" style="display: inline-block; background-color: #3bb54a; color: white; padding: 15px 30px; text-decoration: none; font-size: 18px; font-weight: bold; border-radius: 5px;">';
        echo 'Betaal nu €' . $formatted_amount;
        echo '</a>';
        echo '<p style="margin-top: 10px; font-size: 14px;">Je wordt doorgestuurd naar een veilige betaalpagina waar je kan betalen met iDEAL, Creditcard of Bancontact.</p>';
        echo '</div>';
        
        // Updated JavaScript to insert the message below the menu
        echo '<script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                var paymentMessage = document.getElementById("bunq-payment-message");
                var contentArea = document.querySelector(".content-area") || document.querySelector(".site-content") || document.querySelector("main");
                if (paymentMessage && contentArea) {
                    contentArea.insertBefore(paymentMessage, contentArea.firstChild);
                }
            });
        </script>';
    }
}
// Wijzig de prioriteit naar een zeer lage waarde (negatief getal) om ervoor te zorgen dat het als eerste wordt uitgevoerd
add_action('woocommerce_thankyou', 'bunq_display_payment_button', 5);

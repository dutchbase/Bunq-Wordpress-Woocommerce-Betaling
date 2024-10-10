# Bunq Payment Gateway for WooCommerce

This plugin adds Bunq as a payment method to your WooCommerce shop. Customers can easily pay via a Bunq.me link.

## Installation

1. Download the plugin as a ZIP file from this GitHub repository.
2. Go to your WordPress dashboard and navigate to "Plugins" > "Add New".
3. Click on "Upload Plugin" and select the downloaded ZIP file.
4. Activate the plugin after installation.

## Configuration

Before you can use the plugin, you need to create a Bunq.me link:

1. Open the Bunq app on your smartphone.
2. Go to the account you want to use for payments.
3. Click on "Create a bunq.me link" under the total amount.
4. Follow the steps in the app to create your personal Bunq.me link.

Then configure the plugin in WooCommerce:

1. In your WordPress dashboard, go to "WooCommerce" > "Settings" > "Payments".
2. Look for "Bunq Payment" and click "Manage".
3. Fill in the following details:
   - Enable the payment method
   - Adjust the title and description if desired
   - Enter your personal Bunq.me link in the "Bunq.me Link" field (without an amount at the end and with a / at the end.)
4. Click "Save changes".

## How it works

1. When a customer chooses Bunq as the payment method and places the order, a unique payment link is generated.
2. The customer is redirected to the thank you page, where a large green "Pay now" button is displayed with the amount to be paid.
3. When the customer clicks this button, a new tab opens with the Bunq.me payment page.
4. On this page, the customer can complete the payment via iDEAL or by logging into their Bunq account.
5. After successful payment, the customer is redirected back to your webshop.

Note:
- The plugin does not process the payment automatically. You will need to update the payment status manually in your WooCommerce order overview.
- Although you can enter a payment description for a bunq.me payment, it is not linked to the payment. This makes automatic processing of the payment impossible. You will need to manually check payments and link them to the correct orders.

## Automatic Order Processing

For instructions on how to set up automatic order processing using Zapier, OpenAI, and Telegram, please refer to the [Automatic Order Processing Instructions](Automatic-order-processing-instructions.md) file in this repository.

## Support

For questions or support, please open an issue in this GitHub repository.

## Contributing

Contributions to this plugin are welcome! Feel free to submit a pull request with improvements or new features.

## Donations

If you find this plugin valuable and want to support it, donations are very welcome:

- Via Bunq: [http://bunq.me/dutchbase](http://bunq.me/dutchbase)
- With cryptocurrency: [Contact me for wallet addresses, open an issue on Github.](https://github.com/dutchbase/Bunq-Wordpress-Woocommerce-Betaling/issues)

Your support helps maintain and improve this plugin. Thank you!

## License

This plugin is released under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html) license.

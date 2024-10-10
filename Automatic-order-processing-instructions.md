# Automatically Process Payments in WooCommerce

Through a creative workaround, it is possible to automatically update the payment status to "paid" in WooCommerce. Here are the instructions:

## Requirements

1. An account on Zapier.com (I'm not sure if this can be done with a free account as I already had a paid account)
2. An API key from OpenAI (paid but inexpensive, definitely worth it)
3. Telegram bot (Optional, create one here: https://t.me/BotFather)

## Steps

1. Create a new Zap on Zapier and start with the Bunq new payment module
   
   ![image](https://github.com/user-attachments/assets/b5e5904b-5ff7-4557-ac1f-9a073e86fca3)
2. The 2nd module is WooCommerce find order, search for the payment with the status 'on-hold' (This may be a different status, depending on which status you use for orders awaiting payment)

   ![image](https://github.com/user-attachments/assets/94813e8d-1a39-4eda-baf2-486017a89d89)
3. The 3rd module is the Paths module from Zapier. The first path gets the path conditions to continue if a WooCommerce order number is found, the 2nd path gets the condition to continue if the transaction amount is greater than 0 (this is for incoming payments that didn't come through WooCommerce).

   ![image](https://github.com/user-attachments/assets/744af853-8a73-47ea-8d67-86d33f9ec8af)
   ![image](https://github.com/user-attachments/assets/35fd259d-d0bd-41bd-a3a2-68c9f600b27e)
4. Path A, 4th module: a Zapier filter, which checks if the payment amount is equal to the amount of the found order.
   
   ![image](https://github.com/user-attachments/assets/daf320f6-9270-4472-9c58-f68de236642c)
5. Path A, 5th module: The OpenAI module with the "send prompt" action, choose the gpt-3.5-turbo-instruct model and use the following prompt. Don't change any other settings in this module.

> I have two names, and I want to determine how likely they refer to the same person, even if there are small spelling variations. Please give me a similarity score between 0 and 100, where 0 means they are completely different and 100 means they are an exact match.
>
> Name 1: [the account name of the incoming payment]
>
> Name 2: [the last name of the orderer of the found order in WooCommerce]
>
> Consider factors like spelling variations, common name discrepancies, and phonetic similarities. Additionally, focus on surname similarity as it's the key indicator. If you think that the likelihood of the names matching is 80% or above, then respond with the order number, if it is less than 80% then you respond with NO.
>
> If the likelihood is 80% or more, then reply with the following order number: [order number of the found order]
> 
> Do not give any reason or explanation with your answers.
> 
> Here is an example answer if the likelihood is 80% or higher: 12345

![image](https://github.com/user-attachments/assets/94e00df1-f0fa-4740-a370-b76148296fa5)

6. Path A, 6th module: WooCommerce update order. For **Existing ID**, enter the order number of the found payment and set the status to the status you want to give when the payment is received. In my case, that's **processing**.

7. Path A, 7th module: Telegram send message, set it up so that you receive a DM from the Telegram bot yourself and fill in the desired text with the necessary fields, I did it like this:

![image](https://github.com/user-attachments/assets/e5fe6e20-bcc9-474f-832b-8512eda74dcf)

8. Path B the path conditions:
![image](https://github.com/user-attachments/assets/8c719643-f68c-4700-802d-1161163e2754)

9. Path B, the last module, Telegram send message again. This way you get a notification when a new payment has been received on your account (This is much faster than the BUNQ notifications)
    ![image](https://github.com/user-attachments/assets/959b9e9b-13f4-44d8-90ad-21cfed874675)

## Donations

If you find this plugin valuable and want to support it, donations are very welcome:

- Via Bunq: [http://bunq.me/dutchbase](http://bunq.me/dutchbase)
- With cryptocurrency: [Contact me for wallet addresses, open an issue on Github.](https://github.com/dutchbase/Bunq-Wordpress-Woocommerce-Betaling/issues)

Your support helps maintain and improve this plugin. Thank you!

## License

This plugin is released under the [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html) license.

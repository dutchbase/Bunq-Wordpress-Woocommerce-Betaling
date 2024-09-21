# De betaling automatisch verwerken in Woocommerce

Via een creatieve omweg is het toch mogelijk om betalingen automatisch de status van betaald te geven in WooCommerce, hier zijn de instructies:

## Benodigdheden

1. Een account op Zapier.com (ik weet niet of dit ook gratis kan want ik had al een betaald account zelf)
2. Een API key van OpenAPI (betaald maar goedkoop, 100% zeker de moeite waard)
3. Telegram bot (Optioneel, maak er een hier: https://t.me/BotFather)

## Stappen

1. Maak een nieuwe Zap aan op Zapier en start met de Bunq new payment module
   
   ![image](https://github.com/user-attachments/assets/b5e5904b-5ff7-4557-ac1f-9a073e86fca3)
2. De 2e module is WooCommerce find order, zoek naar de betaling met de status 'on-hold' (Dit kan een andere status zijn, afhankelijk van welke status je gebruikt voor bestellingen die wachten op betaling)

   ![image](https://github.com/user-attachments/assets/94813e8d-1a39-4eda-baf2-486017a89d89)
3. De 3e module is de Paths module van Zapier, het eerste pad krijgt de path conditions om door te gaan als er een WooCommerce ordernummer is gevonden, het 2e pad krijgt de conditie om door te gaan als het bedrag van de transactie groter is als 0 (dit is voor inkomende betalingen die niet via WooCommerce zijn gegaan).

   ![image](https://github.com/user-attachments/assets/744af853-8a73-47ea-8d67-86d33f9ec8af)
   ![image](https://github.com/user-attachments/assets/35fd259d-d0bd-41bd-a3a2-68c9f600b27e)
4. Pad A, 4e module: een Zapier filter, die controleert of het bedrag van de betaling gelijk is aan het bedrag van de gevonden bestelling.
   
   ![image](https://github.com/user-attachments/assets/daf320f6-9270-4472-9c58-f68de236642c)
5. Pad A, 5e module: De OpenAI module met de actie "send prompt", kies het model gpt-3.5-turbo-instruct en gebuik de volgende prompt, Verander verder geen instellingen in deze module.

> I have two names, and I want to determine how likely they refer to the same person, even if there are small spelling variations. Please give me a similarity score between 0 and 100, where 0 means they are completely different and 100 means they are an exact match.
>
> Name 1: [de rekening naam van de binnenkomende betaling]
>
> Name 2: [de achternaam van de besteller van de gevonden order in WooCommerce]
>
> Consider factors like spelling variations, common name discrepancies, and phonetic similarities. Additionally, focus on surname similarity as it’s the key indicator. If you think that the likelyness of the names matching is 80% or above, then respond with the order number, if it is less than 80% then you respond with NO.
>
> If the likelyness is 80% or more, then reply with following order number: [ordernummer van de gevonden bestelling]
> 
> Do not give any reasong or explanation with your answers.
> 
> Here is an example answer if the likelyness is 80% or higher: 12345

![image](https://github.com/user-attachments/assets/94e00df1-f0fa-4740-a370-b76148296fa5)

6. Pad A, 6e module: WooCommerce update order. Bij **Existing ID** zet je het ordernummer van de gevonden betaling en de status zet je op de status die je wilt geven als de betaling binnen is. In mijn geval is dat **processing**.

7. Pad A, 7e module: Telegram send message, stel het zo in dat je zelf een DM krijgt van de Telegram bot en vul de gewenste tekst in met de benodidge velden, ik heb dat zo gedaan:

![image](https://github.com/user-attachments/assets/e5fe6e20-bcc9-474f-832b-8512eda74dcf)

8. Pad B de path conditions:
![image](https://github.com/user-attachments/assets/8c719643-f68c-4700-802d-1161163e2754)

9. Pad B, de laatste module, Telegram send message wederom. Hiermee krijg je een melding als er een nieuwe betaling op je rekening is gekomen (Dit is veel sneller als de BUNQ notificaties)
    ![image](https://github.com/user-attachments/assets/959b9e9b-13f4-44d8-90ad-21cfed874675)

## Donaties

Als je deze plugin waardevol vindt en wilt ondersteunen, zijn donaties zeer welkom:

- Via Bunq: [http://bunq.me/dutchbase](http://bunq.me/dutchbase)
- Met cryptocurrency: Neem contact op voor wallet adressen

Je steun helpt bij het onderhouden en verbeteren van deze plugin. Bedankt!

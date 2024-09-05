# Bunq Betaal Gateway voor WooCommerce

Deze plugin voegt Bunq als betaalmethode toe aan je WooCommerce webshop. Klanten kunnen hiermee eenvoudig betalen via een Bunq.me link.

## Installatie

1. Download de plugin als ZIP-bestand van deze GitHub repository.
2. Ga naar je WordPress dashboard en navigeer naar "Plugins" > "Nieuwe plugin".
3. Klik op "Plugin uploaden" en selecteer het gedownloade ZIP-bestand.
4. Activeer de plugin na installatie.

## Configuratie

Voordat je de plugin kunt gebruiken, moet je eerst een Bunq.me link aanmaken:

1. Open de Bunq app op je smartphone.
2. Ga naar de rekening die je wilt gebruiken voor betalingen.
3. Klik onder het totaalbedrag op "Creëer een bunq.me link".
4. Volg de stappen in de app om je persoonlijke Bunq.me link aan te maken.

Vervolgens configureer je de plugin in WooCommerce:

1. Ga in je WordPress dashboard naar "WooCommerce" > "Instellingen" > "Betalingen".
2. Zoek naar "Bunq Betaling" en klik op "Beheren".
3. Vul de volgende gegevens in:
   - Schakel de betaalmethode in
   - Pas indien gewenst de titel en beschrijving aan
   - Vul bij "Bunq.me Link" je persoonlijke Bunq.me link in (zonder bedrag aan het einde en met een / op het einde.)
4. Klik op "Wijzigingen opslaan".

## Hoe het werkt

1. Wanneer een klant Bunq als betaalmethode kiest en de bestelling plaatst, wordt er een unieke betaallink gegenereerd.
2. De klant wordt doorgestuurd naar de bedankpagina, waar een grote groene "Betaal nu" knop wordt getoond met het te betalen bedrag.
3. Als de klant op deze knop klikt, opent er een nieuw tabblad met de Bunq.me betaalpagina.
4. Op deze pagina kan de klant de betaling voltooien via iDEAL of door in te loggen op hun Bunq account.
5. Na succesvolle betaling wordt de klant teruggestuurd naar je webshop.

Let op: 
- De plugin verwerkt de betaling niet automatisch. Je zult de betaalstatus handmatig moeten bijwerken in je WooCommerce bestellingenoverzicht.
- Ondanks dat je een betaalomschrijving kunt invullen bij een bunq.me betaling, wordt deze niet aan de betaling gekoppeld. Hierdoor is automatische verwerking van de betaling niet mogelijk. Je zult betalingen handmatig moeten controleren en koppelen aan de juiste bestellingen.

## Ondersteuning

Voor vragen of ondersteuning, open een issue in deze GitHub repository.

## Bijdragen

Bijdragen aan deze plugin zijn welkom! Voel je vrij om een pull request in te dienen met verbeteringen of nieuwe functies.

## Donaties

Als je deze plugin waardevol vindt en wilt ondersteunen, zijn donaties zeer welkom:

- Via Bunq: [http://bunq.me/dutchbase](http://bunq.me/dutchbase)
- Met cryptocurrency: Neem contact op voor wallet adressen

Je steun helpt bij het onderhouden en verbeteren van deze plugin. Bedankt!

## Licentie

Deze plugin is uitgebracht onder de [GPLv2 of latere versie](https://www.gnu.org/licenses/gpl-2.0.html) licentie.

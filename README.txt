=== Webshippy Dynamic Shipping ===
Contributors: dock3r
Donate link: http://webshippy.com
Tags: woocommerce, shipping
Requires at least: 4.0
Requires PHP: 5.6
Tested up to: 5.7.2
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

A Webshippy Prio szolgáltatás jelenleg a bevezetés szakaszában van, ezért amennyiben érdekel a szolgáltatás kérjük keresd meg kapcsolattartódat, és egyeztesd vele a csatlakozás lehetőségét. Ezen kívül a kapcsolatfelvétel bármely más módján (Chat, ügyfélszolgálati jegy, stb) is jelezheted csatlakozási szándékodat.

A Webshippy Dynamic Shipping plugin segítségével néhány kattintás után Ön is elérhetővé teheti vásárlói számára a Webshippy által nyújtott aznapi kiszállítást (Webshippy Prio), ami jelenleg a magyar webshopok számára elérhető leggyorsabb kiszállítási mód.

A **Webshippy Prio** adott napon 00:00-16:00 között leadott rendeléseket még aznap 18:00-22:00 között kiszállítja.

A **Webshippy Prio** szolgáltatás funkciói:

* aznapi kiszállítás 18-22 óra között
* élő csomagkövetés webes felületen a vásárló számára
* élő várható érkezési idő
* szállítással kapcsolatos sms értesítések a vásárló számára
* közvetlen sms és telefonos elérhetőség a vásárló és futár között

A **Webshippy Prio Next Day** adott napon 16:00-24:00 között leadott rendeléseket következő munkanap 18:00-22:00 között (munkaidő után) kiszállítja. Azaz a hétvégi rendelések, már hétfőn kiszállításra kerülnek.

A **Webshippy Prio Next Day** szolgáltatás funkciói:

*   következő munkanapi kiszállítás 18-22 óra között (munkaidő után)
*   élő csomagkövetés webes felületen a vásárló számára
*   élő várható érkezési idő
*   szállítással kapcsolatos sms értesítések a vásárló számára
*   közvetlen sms és telefonos elérhetőség a vásárló és futár között

### A plugin működése:

A checkout folyamán a WebShippy API (WS API) által meghatározott szállítási metódusok lesznek elérhetők.
Amikor a vásárló megadja a címre vonatkozó adatokat, a rendszer elküldi a WS API-nak. Ez alapján a WS API elküldi az elérhető szállítási metódusokat. (https://apidoc.webshippy.com/webaruhaz-integraciok/shipping-api)
Az API válasza alapján a WooCommerce megjeleníti az előre definiált szállítási metódusok közül azokat amik elérhetők az adott vásárláshoz.

**Telepítéskor:** A plugin bekapcsolásakor létrejönnek a Webshippy által definiált szállítási metódusok.

**Ingyenes szállítás:** A megadott cím alapján a plugin megállapítja, hogy jár-e a webshop által meghatározott ingyenes szállítás. Ha igen akkor a WS API által kapott szállítási metódusok is ingyenesek lesznek.

**Szállítási metódusok beállításai:** A WooCommerce Shipping szekciójában egyénileg beállíthatók a Webshippy által hozott metódusok "Webshippy" kezdettel

* A checkout-nál megjelenített név
* Szállítási metódus díja

**Szállítási Zónák:** A Webshippy által megadott szállítási metódusok függetlenül működnek a szállítási zónáktól. Minden egyes vásárláskor a Webshippy szabályozza azok elérhetőségét.

**Fizetési módok:** A plugin telepítése után célszerű meggyőződni arról, hogy a fizetési metódusoknál a Webshippy szállítási metódusok engedélyezve vannak.

További információ: [https://help.webshippy.com/hu/articles/5338031-webshippy-prio-rendelesteljesites-aznapi-kiszallitassal](https://help.webshippy.com/hu/articles/5338031-webshippy-prio-rendelesteljesites-aznapi-kiszallitassal)

== Követelmények ==

* WooCommerce
* Webshippy Order Sync 1.3.2

== Installation ==

1. A `webshippy-dynamic-shipping` plugin feltöltése a `/wp-content/plugins/` könyvtárba
3. [Webshippy Order Sync](https://app.webshippy.com/api/webshippy_wp_plugin.zip) legalább 1.3.2 verziójának aktiválása
2. Webshippy Dynamic Shipping plugin aktiválása a WordPress 'Plugins' menüpontban

== Screenshots ==

1. A WebShippy által definiált szállítási metódusok a WooCommerce szállítási beállításainál találhatók
2. Minden szállítási metódusnak beállítható a költsége és a neve ami a vásárlási folyamatban folyamatban megjelenik
3. A fizetési metódusoknál ne felejtsük el engedélyezni a plugin által biztosított szállítási metódusokat
4. Webshippy Prio Next Day szállítási metódus beállításai

== Changelog ==

= 1.2.1 =
* Javítás: Adószámítás ingyenes szállítás esetén

= 1.2.0 =
* Új funkció: Következő napi szállítási metódus
* Javítás: Termékvariációk támogatása

= 1.1.0 =
* Új funkció: Beállítható, hogy a szállítási metódust terhelje helyi ÁFA
* Javítás: A szállítási metódus megállapításánál a WooCommerce figyelmen kívül hagyja a transient cache-t

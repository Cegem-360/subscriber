***cégem360***  
*hello web+marketing*

**Modulonkénti jogi kitételek — V2**

**és weboldal tartalom-audit (mit vegyél ki / mit írj bele)**

cegem360.eu — SaaS-modulok, B2B

Készült: Tóth Tamás ügyvezető részére — 2026\. június

Frissítve: AI Chat törölve · Számlázó hozzáadva · e-aláírás \= képi rögzítés · SMS nincs · PLC/SCADA nincs

# **Mi változott a V1-hez képest**

* **AI Chat modul:** törölve (nem kell).

* **Számlázó:** új, fejlesztés alatti modulként hozzáadva, kiemelve, hogy a többi modullal (Értékesítés, CRM, Automatizálás, Kontrolling) összekapcsolható.

* **Digitális munkalap és elektronikus iratrendezés:** az aláírás NEM jogilag elfogadott e-aláírás — az ügyfél helyszínen aláír, a rendszer képként menti és PDF-hez csatolja.

* **CRM / Automatizálás / MarketingHub:** az e-mail-küldés él (valós funkció); SMS-küldést a cég NEM vállal.

* **Gyártásirányítás:** a PLC/SCADA integrációt NEM vállaljuk (a weboldalról is törlendő).

* **SEO / DataMind / MarketingHub AI:** külső AI (al-adatfeldolgozó) \+ Google API \+ nemzetközi adattovábbítás; eredmény/predikció nem garancia — megerősítve.

*Tájékoztató szakmai áttekintés, nem ügyvédi ellenjegyzés. A számlázást, adatvédelmet érintő részeket érdemes ügyvéddel/könyvelővel véglegesíteni. Jogszabályi állapot: 2026\. június.*

# **Tartalomjegyzék**

# **1\. Kereszt-megállapítások (minden modulra)**

*LEGFONTOSABB: a weboldalt össze kell hangolni a tényleges/vállalt funkciókkal. A hirdetett funkció a szerződés részévé válhat, és a valótlan állítás megtévesztő reklámként is támadható. Az alábbi közös elemeket egyszer kell beírni az ÁSZF-be, a modulok hivatkoznak rájuk.*

* **Adatvédelem / DPA:** ahol a modul a Megrendelő ügyfeleinek/partnereinek adatát kezeli (CRM, MarketingHub, DataMind, Digitális munkalap, Automatizálás, Számlázó), a Megrendelő az adatkezelő, te az adatfeldolgozó → GDPR 28\. cikk DPA \+ Adatkezelési tájékoztató.

* **AI és al-adatfeldolgozók:** a külső AI-t (Gemini/Claude/ChatGPT) használó modulok (SEO, DataMind, MarketingHub AI Asszisztens, Automatizálás) esetén AI-záradék \+ al-adatfeldolgozói lista \+ nemzetközi adattovábbítási garancia.

* **Kommunikáció:** e-mail-küldés él (CRM, Automatizálás, MarketingHub) — a címzettek hozzájárulásáért (Grtv. 2008\. évi XLVIII. tv) a Megrendelő felel. SMS-t a cég nem vállal — ahol a weboldal SMS-t említ, törlendő.

* **Számlázás:** a számlázást/NAV-adatszolgáltatást érintő modulok (Értékesítés; Automatizálás dokumentumgenerálás; Számlázó) az Áfa tv. és a 23/2014. NGM r. minimumát biztosítják, az adattartalomért a Megrendelő felel.

* **Eredmény-állítások:** a weboldali számok (pl. „+112% forgalom”, „100% GDPR megfelelőség”, „92% pontosság”) átlagosak/illusztratívak — mondd ki, hogy nem garantált eredmények.

* **Külső integrációk:** minden integrált rendszer (Google, NAV, Billingo, futárok, fizetési szolgáltatók, Slack/Teams) saját feltételei és rendelkezésre állása szerint működik. A PLC/SCADA integrációt nem vállaljuk.

# **2\. Áttekintő mátrix — mihez mi kell**

J \= jellemzően igen / releváns. A személyesadat-szint a DPA és az adatvédelmi kockázat súlyát jelzi.

| Modul | Szem. adat | DPA | AI | E-mail küld. | Számla/NAV | Speciális jogi pont |
| :---- | :---- | :---- | :---- | :---- | :---- | :---- |
| **Dig. munkalap \+ iratrend.** | Közép–magas | J | – | – | – | Aláírás \= képi mentés (nem jogi e-aláírás) |
| **Kontrolling** | Alacsony | – | – | – | Export | Nem könyvelő/adótanácsadás |
| **SEO Eszköz** | Alacsony | – | J | – | – | Nincs eredménygarancia; Google API |
| **CRM** | Magas | J | – | J | – | Marketing-hozzájárulás; SMS nincs |
| **Beszerzés-logiszt.** | Alacsony–közép | – | – | – | Integr. | Készletadat-pontosság kizárás |
| **Értékesítés** | Közép | J | – | – | J (kiállít) | Számlázási megfelelés; Számlázóval integr. |
| **Gyártásirányítás** | Alacsony | – | – | – | Integr. | PLC/SCADA NEM vállalt; biztonság |
| **Automatizálás** | Közép–magas | J | J | J | J (generál) | SMS nincs; workflow-konfig az ügyfélé |
| **MarketingHub** | Magas | J | J | J | – | Profilalkotás; consent; SMS nincs |
| **DataMind** | Közép–magas | J | J | – | – | Predikció nem garancia; nemzetk. transzfer |
| **Számlázó (fejl.)** | Közép | J | – | – | J (kiállít) | Számlázási megfelelés; modul-integráció |

# **3\. Modulonkénti jogi szakaszok**

## **1\. Digitális munkalap és elektronikus iratrendezés**

*Helyszíni szervizmunkák, mobil munkalapok, iratrendezés  ·  app: field.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Ügyféladatok, helyszíni fotók, ügyfél helyszíni aláírása (képként), szerelői (munkavállalói) adatok — KÖZEPES–MAGAS személyesadat-szint. |
| **Speciális jogi kérdés** | Az aláírás NEM minősül jogilag elfogadott (minősített) elektronikus aláírásnak: az ügyfél a helyszínen aláír, a rendszer az aláírást képként menti és a PDF-jegyzőkönyvhöz csatolja. Az elektronikus iratrendezés a dokumentumok életciklusát kezeli. Fotók harmadik személyt rögzíthetnek. |

**Mit vállalj (minimum):**

A munkalap-, idő- és anyagrögzítés, a helyszíni aláírás képi rögzítése és PDF-hez csatolása, valamint az iratrendezési (dokumentumkezelési) funkció elérhetősége.

**Mit zárj ki:**

Az aláírás joghatásának vagy bizonyító erejének szavatolása (nem minősített e-aláírás); a feltöltött fotók/adatok tartalma és jogszerűsége; az offline-online szinkronból eredő adatvesztés.

**BEILLESZTHETŐ ZÁRADÉK — Digitális munkalap és elektronikus iratrendezés**

A Digitális munkalap és elektronikus iratrendezés modulban az ügyfél a helyszínen aláírja a munkalapot; a rendszer az aláírást képként rögzíti és a PDF-jegyzőkönyvhöz csatolja. Ez nem minősül minősített vagy jogilag elfogadott elektronikus aláírásnak (eIDAS 910/2014/EU); annak bizonyító ereje a felek megállapodásától és a felhasználás körülményeitől függ, amit a Szolgáltató nem szavatol.

A helyszínen készített fotók és a feltöltött adatok tartalmáért, jogszerűségéért és az érintettek tájékoztatásáért a Megrendelő felel. Az offline rögzített adatok szinkronizálásának sikerességét a Szolgáltató nem szavatolja.

## **2\. Kontrolling**

*Pénzügyi áttekintés, riportok, projekt-kontrolling  ·  app: controlling.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Pénzügyi és projektadatok, költséghelyek; NAV-kompatibilis export — ALACSONY személyesadat-szint (lehet bér/projektfelelős). |
| **Speciális jogi kérdés** | Döntéstámogató eszköz: NEM könyvelőprogram és NEM minősül adótanácsadásnak. Ha bankszámla-szinkron él, a banki adat pontossága és a hozzáférés jogszerűsége kérdéses. |

**Mit vállalj (minimum):**

A feltöltött/szinkronizált adatok megjelenítése, riportálás, dashboard.

**Mit zárj ki:**

A számviteli és adózási helyesség; a könyvelés helyettesítése; a bankszinkron adatainak pontossága; a riport alapján hozott üzleti döntések következménye.

**BEILLESZTHETŐ ZÁRADÉK — Kontrolling**

A Kontrolling modul pénzügyi áttekintést és döntéstámogató riportokat nyújt; nem minősül könyvelőprogramnak, és a Szolgáltató nem nyújt könyvelési vagy adótanácsadási szolgáltatást. A megjelenített adatok helyességéért és értelmezéséért a Megrendelő felel.

A bankszámla-szinkronizáció és a külső forrásból átvett adatok pontosságát és folyamatos elérhetőségét a Szolgáltató nem szavatolja.

## **3\. SEO Eszköz**

*AI alapú keresőoptimalizálás, GA/Search Console elemzés  ·  app: seo.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Weboldal- és keresési adatok, Google Analytics/Search Console adatok — ALACSONY–KÖZEPES (a GA-adat lehet személyes). |
| **Speciális jogi kérdés** | Külső AI-szolgáltató (al-adatfeldolgozó) \+ Google API-k igénybevétele (Google API ToS és a Megrendelő fiók-jogosultsága szükséges). Eredmény nem garantálható; nemzetközi adattovábbítás lehetséges. A weboldali „92%” pontosság illusztratív. |

**Mit vállalj (minimum):**

A kulcsszó-, versenytárs- és Google-adat elemzés futtatása a megadott adatokon; javaslatok és riportok előállítása.

**Mit zárj ki:**

A keresési/AI-láthatóság vagy a forgalom javulása; a Google-adatok pontossága; az AI-kimenet helytállósága.

**BEILLESZTHETŐ ZÁRADÉK — SEO Eszköz**

Az SEO Eszköz elemzési és javaslati szolgáltatás; a Szolgáltató kifejezetten nem garantálja a Megrendelő keresőmotoros vagy AI-rendszerbeli helyezésének, forgalmának vagy láthatóságának javulását.

A modul külső AI-szolgáltatókat és a Google API-jait veszi igénybe; ezek elérhetőségét, adatainak pontosságát és az AI-kimenet helytállóságát a Szolgáltató nem szavatolja. Az adatok az EGT-n kívülre továbbításra kerülhetnek a megfelelő garanciák mellett.

## **4\. CRM**

*Ügyfélkezelés, pipeline, e-mail kampányok  ·  app: crm.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Ügyfél- és lead-adatok, kapcsolattörténet — MAGAS személyesadat-szint. E-mail küldés és tömeges kampány a CRM-ből (él); lead-scoring; webform-integráció. |
| **Speciális jogi kérdés** | Adatfeldolgozói szerződés (DPA) KÖTELEZŐ. Az e-mail-küldés él; a tömeges e-mail/kampány gazdasági reklámnak minősülhet (Grtv. 2008\. évi XLVIII. tv 6\. §; e-Privacy) → a címzettek hozzájárulásáért a Megrendelő felel. SMS-küldést a Szolgáltató nem vállal. A lead-scoring profilalkotás lehet (GDPR 22\. cikk). |

**Mit vállalj (minimum):**

Az ügyféladatok tárolása, a pipeline-, kampány- és e-mail-küldési funkció.

**Mit zárj ki:**

A címzettek marketing-hozzájárulásának megléte és az üzenetek tartalma (a Megrendelő felel); SMS-küldés (nem vállalt); a jogsértő kiküldés következményei; az integrált külső szolgáltatók működése.

**BEILLESZTHETŐ ZÁRADÉK — CRM**

A CRM modulból küldött e-mailek és kampányok tartalmáért, valamint a címzettek előzetes hozzájárulásának (Grtv., GDPR) meglétéért kizárólag a Megrendelő mint adatkezelő felel. A Szolgáltató kizárólag a küldés technikai lehetőségét biztosítja, SMS-küldést nem vállal.

Az ügyféladatok tekintetében a Megrendelő az adatkezelő, a Szolgáltató az adatfeldolgozó; a Felek a GDPR 28\. cikke szerinti DPA-t kötik. Az automatikus lead-pontozás eredményéért és felhasználásáért a Megrendelő felel.

## **5\. Beszerzés-logisztika**

*Készlet, beszállító, raktár, szállítás  ·  app: supply.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Készlet-, beszállítói és szállítási adatok, beszállítói kapcsolattartók — ALACSONY–KÖZEPES. |
| **Speciális jogi kérdés** | Készletadat-pontosság nem szavatolt; vonalkód-, futár- és számlázó-integrációk harmadik fél ToS-e. Kevés személyes adat (beszállítói kontakt). |

**Mit vállalj (minimum):**

A készlet-, beszállító- és raktárnyilvántartási funkció, a riportálás.

**Mit zárj ki:**

A készletadatok valósága és naprakészsége; a beszerzési döntések; a futár- és szállítási teljesítés; a külső integrációk működése.

**BEILLESZTHETŐ ZÁRADÉK — Beszerzés-logisztika**

A Beszerzés-logisztika modulban a készlet- és szállítási adatok rögzítése és pontossága a Megrendelő feladata; a Szolgáltató a nyilvántartási és megjelenítési funkciót biztosítja, az adatok valóságáért és a beszerzési döntésekért nem felel.

## **6\. Értékesítés**

*Ajánlat, rendelés, számlázás, fizetés  ·  app: sales.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Ajánlat-, rendelés- és vevőadatok, számlázás NAV online adatszolgáltatással, fizetési (Barion/SimplePay/OTP) és futárintegráció — KÖZEPES. |
| **Speciális jogi kérdés** | SZÁMLÁZÁSI funkció → jogszabályi megfelelési kötelezettség (Áfa tv. 2007\. évi CXXVII., 23/2014. NGM r., NAV Online Számla), amit B2B-ben sem lehet teljesen kizárni. A számlázás a fejlesztés alatt álló Számlázó modullal összekapcsolható (közös adatáramlás). Fizetési szolgáltatók és webshopok ToS-e. |

**Mit vállalj (minimum):**

A számlázó funkció jogszabályi minimum megfelelése; a NAV-adatszolgáltatás biztosítása; ajánlat-/rendeléskezelés; a Számlázó modullal való összekapcsolhatóság.

**Mit zárj ki:**

A számla adattartalmának helyessége, az áfakulcs/adózási besorolás; a NAV- és fizetési rendszerek kiesése; a fizetési szolgáltatók és futárok teljesítése; adótanácsadás.

**BEILLESZTHETŐ ZÁRADÉK — Értékesítés**

Az Értékesítés modul számlázó funkciója a kiállításkor hatályos jogszabályi minimumkövetelményeknek (Áfa tv., 23/2014. NGM r.) megfelel, és biztosítja a NAV Online Számla adatszolgáltatást. A kiállított számlák adattartalmáért, az áfakulcsokért és az adózási besorolásért a Megrendelő felel; a Szolgáltató adótanácsadást nem nyújt.

A fizetési szolgáltatók (pl. Barion, SimplePay, OTP) és a futárszolgálatok teljesítéséért, valamint a NAV-rendszer elérhetőségéért a Szolgáltató felelősségét kizárja.

## **7\. Gyártásirányítás**

*Termeléstervezés, minőség, karbantartás, BOM  ·  app: mes.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Gyártási, minőségi és karbantartási adatok, OEE, dolgozói teljesítményadatok — ALACSONY (de munkavállalói adat). |
| **Speciális jogi kérdés** | A Szolgáltató NEM vállalja a PLC/SCADA ipari vezérlés-integrációt (a weboldalról is törlendő). A Szolgáltató nem felel a termelési/biztonsági döntésekért, gépvezérlésért, üzembiztonságért. Dolgozói teljesítményadat → a munkáltató (Megrendelő) az adatkezelő. |

**Mit vállalj (minimum):**

A termeléstervezési, munkalap-, minőség- és karbantartás-nyilvántartási funkció megjelenítése.

**Mit zárj ki:**

A PLC/SCADA-integráció (nem vállalt); a termelési eredmény, gépleállások, selejt, üzembiztonság; a gyártási és biztonsági döntések következménye.

**BEILLESZTHETŐ ZÁRADÉK — Gyártásirányítás**

A Gyártásirányítás modul tervezési, nyilvántartási és megjelenítési eszköz. A Szolgáltató nem vállalja a PLC/SCADA és egyéb ipari vezérlőrendszerekkel való integrációt, és nem felel a termelési eredményekért, a gépek vezérléséért, az üzem- és munkabiztonságért; ezek felügyelete és a gyártási döntések a Megrendelő felelőssége.

A modulban kezelt dolgozói teljesítményadatok tekintetében a Megrendelő mint munkáltató az adatkezelő, és felel a munkavállalók tájékoztatásáért.

## **8\. Automatizálás**

*Workflow-k, triggerek, e-mail, dokumentumgenerálás  ·  app: workflow.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Workflow-konfiguráció és a kezelt folyamatok adatai; e-mail-küldés (él); dokumentum- (pl. számla) generálás; Slack/Teams, NAV/Számlázz/Billingo/Zapier integráció — KÖZEPES–MAGAS. |
| **Speciális jogi kérdés** | A modul ÉL (a régi „nem elérhető” kitétel törlendő). Az e-mail-küldés megoldott; SMS-küldést a Szolgáltató NEM vállal. Dokumentumgenerálás → a Számlázó modullal összekapcsolható; a generált dokumentum joghatása/helyessége nem szavatolt. Hibás workflow-konfigból eredő kár → a Megrendelő felel. Automatikus üzenetküldés → Grtv./e-Privacy hozzájárulás (Megrendelő). |

**Mit vállalj (minimum):**

A workflow-motor, a triggerek, az e-mail-küldés és a dokumentumgenerálás működése a leírtak szerint; a Számlázó és más modulokkal való összekapcsolhatóság.

**Mit zárj ki:**

SMS-küldés (nem vállalt); a Megrendelő által beállított workflow-k hibás konfigurációjából eredő károk; a generált dokumentumok (számla, szerződés) tartalma és joghatása; az e-mail küldés címzetti hozzájárulása; a külső rendszerek működése.

**BEILLESZTHETŐ ZÁRADÉK — Automatizálás**

Az Automatizálás modulban a workflow-k, triggerek és értesítések beállítása és tartalma a Megrendelő felelőssége; a Szolgáltató nem felel a Megrendelő által konfigurált automatizmusok által kiváltott műveletekből, kiküldött e-mailekből vagy generált dokumentumokból eredő károkért. A Szolgáltató SMS-küldést nem vállal.

Az automatikusan generált dokumentumok (pl. számla, szerződés) joghatásáért és tartalmi helyességéért, valamint az automatikus e-mail-küldés címzetti hozzájárulásáért (Grtv., GDPR) a Megrendelő felel.

## **9\. MarketingHub**

*Ügyfél-adatbázis, szegmentálás, kérdőív, AI Asszisztens  ·  app: marketinghub.cegem360.eu*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Ügyfél-adatbázis, szegmentálás, viselkedési és demográfiai adatok, NPS/CSAT kérdőív, publikus regisztrációs űrlapok, AI Asszisztens — MAGAS személyesadat-szint. |
| **Speciális jogi kérdés** | Adatfeldolgozói szerződés (DPA) KÖTELEZŐ. Az e-mail-küldés él; SMS-t a Szolgáltató nem vállal. Szegmentálás/viselkedési adat → profilalkotás. Publikus regisztrációs űrlap → a hozzájárulásért a Megrendelő felel. AI Asszisztens → külső AI al-adatfeldolgozó. A weboldali „100% GDPR megfelelőség” abszolút állítás kerülendő/pontosítandó. |

**Mit vállalj (minimum):**

A platform adatkezelési, szegmentálási, kérdőív-, e-mail- és riportfunkciója; GDPR-konform adatkezelési keret a Szolgáltató oldalán.

**Mit zárj ki:**

A Megrendelő adatkezelésének jogszerűsége (jogalap, hozzájárulás, tájékoztatás); SMS-küldés (nem vállalt); a szegmentálás/profilalkotás felhasználása; az AI Asszisztens kimenetének helytállósága.

**BEILLESZTHETŐ ZÁRADÉK — MarketingHub**

A MarketingHub modulban kezelt ügyféladatok tekintetében a Megrendelő az adatkezelő, a Szolgáltató az adatfeldolgozó (GDPR 28\. cikk, DPA). A jogalap, a hozzájárulás beszerzése és az érintettek tájékoztatása a Megrendelő felelőssége, ideértve a publikus regisztrációs űrlapokon gyűjtött adatokat is.

Az e-mail-küldés a Megrendelő felelősségére történik (consent, tartalom); SMS-küldést a Szolgáltató nem vállal. Az AI Asszisztens válaszainak helytállóságát a Szolgáltató nem szavatolja.

## **10\. DataMind**

*MI adatbányász, predikció, GA/Ads/SQL integráció  ·  app: datamind.cegem360.eu (jelenleg csak angolul)*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Integrált adatforrások (Google Analytics/Ads/Search Console, CSV, SQL-adatbázis, REST API), MI-elemzések, predikciók, AI-összefoglalók — KÖZEPES–MAGAS (forrástól függően). |
| **Speciális jogi kérdés** | AI al-adatfeldolgozók \+ Google API-k \+ a Megrendelő által csatlakoztatott SQL/REST források. A predikció nem garancia — az üzleti döntés a Megrendelőé. Nemzetközi adattovábbítás lehetséges (EGT-n kívül). A felület jelenleg csak angol nyelvű. |

**Mit vállalj (minimum):**

Az adatintegráció, az elemzés és a modellépítés futtatása a megadott forrásokon; AI-összefoglalók előállítása.

**Mit zárj ki:**

A predikciók és AI-kimenetek helytállósága; az ezek alapján hozott üzleti döntések következménye; a csatlakoztatott források adatainak jogszerűsége és pontossága.

**BEILLESZTHETŐ ZÁRADÉK — DataMind**

A DataMind előrejelzései és AI-elemzései döntéstámogató jellegűek; a Szolgáltató nem szavatolja azok pontosságát, és nem felel a Megrendelő ezek alapján hozott üzleti döntéseiért.

A csatlakoztatott adatforrások (Google-fiókok, SQL-adatbázis, REST API, fájlok) adatainak jogszerűségéért és pontosságáért a Megrendelő felel. Az elemzéshez az adatok külső AI-szolgáltatókhoz, esetlegesen az EGT-n kívülre továbbításra kerülhetnek a megfelelő garanciák mellett.

## **11\. Számlázó (fejlesztés alatt, modulokkal összekapcsolható)**

*Számlakiállítás, NAV adatszolgáltatás — más modulokkal integrálva  ·  app: (fejlesztés alatt)*

| Szempont | Tartalom |
| :---- | :---- |
| **Mit kezel / adatszint** | Számla-, vevő- és tételadatok, NAV online adatszolgáltatás — KÖZEPES. Az Értékesítés, CRM, Automatizálás és Kontrolling modulokkal összekapcsolható (adatáramlás). |
| **Speciális jogi kérdés** | Számlázóprogramként jogszabályi megfelelési kötelezettség (Áfa tv. 2007\. évi CXXVII., 23/2014. NGM r., NAV Online Számla), amelyet B2B-ben sem lehet teljesen kizárni. A más modulokból átvett adatok helyességéért a Megrendelő felel. Ezt érdemes ügyvéddel/könyvelővel véglegesíteni. |

**Mit vállalj (minimum):**

A jogszabályi minimumnak megfelelő számlakiállítás és NAV-adatszolgáltatás; a más modulokkal való összekapcsolhatóság technikai biztosítása.

**Mit zárj ki:**

A számla adattartalmának helyessége és adózási besorolása; a más modulból átvett adatok helyessége; a NAV-rendszer kiesése; adótanácsadás.

**BEILLESZTHETŐ ZÁRADÉK — Számlázó (fejlesztés alatt, modulokkal összekapcsolható)**

A Számlázó modul a kiállításkor hatályos jogszabályi minimumkövetelményeknek (Áfa tv., 23/2014. NGM r.) megfelel, és biztosítja a NAV Online Számla adatszolgáltatást. A modul más Cégem 360 modulokkal (pl. Értékesítés, CRM, Automatizálás, Kontrolling) összekapcsolható; az így átvett vagy a Megrendelő által rögzített adatok helyességéért, az áfakulcsokért és az adózási besorolásért a Megrendelő felel.

A Szolgáltató adótanácsadást nem nyújt, és nem felel a NAV-rendszer vagy más külső rendszer elérhetetlenségéből eredő adatszolgáltatási késedelemért.

# **4\. Weboldal tartalom-audit — mit vegyél ki / mit írj bele**

Oldalanként: a fő weboldal és minden modul landing page-e \+ a kapcsolódó alkalmazás-aldomain. A cél a weboldal és az ÁSZF/valós funkciók összehangolása.

| Oldal / URL | Mit vegyél ki / pontosíts | Mit írj bele |
| :---- | :---- | :---- |
| **Fő weboldalcegem360.eu** | AI Chat modul a menüből (nem kell). A láblécben a dupla „Szolgáltatási feltételek” link → 1 egységes URL. Bármely nem élő/nem vállalt funkció említése. | Működő linkek: Adatvédelmi tájékoztató, egységes ÁSZF, DPA-hivatkozás, Cookie. Egységes lábjegyzet: az eredmények illusztratívak. Ha hirdeted: Számlázó (fejlesztés alatt). |
| **Kontrolling/termekek/kontrollingcontrolling.cegem360.eu** | „Bankszámla-szinkronizáció” csak ha valóban él; „+40% előrejelzés pontossága” → illusztratívra. | „Nem könyvelőprogram, nem adótanácsadás” kitétel; adatkezelési \+ ÁSZF link; eredmények átlagosak. |
| **Értékesítés/termekek/ertekesitessales.cegem360.eu** | Fizetési (Barion/SimplePay/OTP), futár, webshop integrációk csak ha élnek; számszerű eredmények illusztratívra. | Számlázási megfelelés (Áfa tv., NGM r., NAV) \+ „az adattartalomért a felhasználó felel”; a Számlázó modullal való összekapcsolhatóság; adatkezelési \+ ÁSZF link. |
| **Gyártásirányítás/termekek/gyartasiranyitasmes.cegem360.eu** | „PLC és SCADA (Siemens, Allen-Bradley, Beckhoff)” integráció — TÖRLENDŐ (nem vállaljuk). CAD/CAM csak ha él; eredmény-számok illusztratívra. | Felelősségkizárás az üzem-/munkabiztonságra és gépvezérlésre; dolgozói adat: a munkáltató felel; adatkezelési \+ ÁSZF link. |
| **Dig. munkalap és elektr. iratrendezés/termekek/digitalis-munkalapfield.cegem360.eu** | „Digitális aláírás — Jogilag elfogadott formátum”: a „jogilag elfogadott” állítás TÖRLENDŐ. | Pontos megfogalmazás: az ügyfél helyszínen aláír, a rendszer képként menti és a PDF-hez csatolja (nem minősített e-aláírás); az „elektronikus iratrendezés” funkció leírása; fotók/adatok felelőssége az ügyfélé; adatkezelési \+ ÁSZF link. |
| **MarketingHub/termekek/marketinghubmarketinghub.cegem360.eu** | „100% GDPR megfelelőség” abszolút állítás TÖRLENDŐ/pontosítandó; SMS-funkció ne szerepeljen; eredmény-számok illusztratívra. | E-mail küldés él; AI Asszisztens külső AI-t használ; DPA/adatfeldolgozói viszony; a consent az ügyfélé; adatkezelési \+ ÁSZF link. |
| **CRM/termekek/crmcrm.cegem360.eu** | Ha SMS szerepel: TÖRLENDŐ (nem vállaljuk); eredmény-számok illusztratívra. | E-mail küldés él, de a hozzájárulás/tartalom az ügyfélé; DPA; lead-scoring \= profilalkotás; adatkezelési \+ ÁSZF link. |
| **Beszerzés-logisztika/termekek/beszerzes-logisztikasupply.cegem360.eu** | Integrációk (futár, webshop, számlázó) csak ha élnek; eredmény-számok illusztratívra. | Készletadat-pontosság kizárása; adatkezelési \+ ÁSZF link. |
| **Automatizálás/termekek/automatizalasworkflow.cegem360.eu** | „SMS és push értesítések” → SMS TÖRLENDŐ (nem vállaljuk). A korábbi „jelenleg nem elérhető” megszüntetése. Integrációk csak ha élnek. | E-mail küldés él; dokumentumgenerálás (számla a Számlázóval); a workflow-konfigért az ügyfél felel; DPA; AI-záradék ahol releváns. |
| **SEO Eszköz/termekek/seo-eszkozseo.cegem360.eu** | „92% pontosság”, „+112% forgalom” → illusztratívra; eredménygarancia látszata törlendő. | Nincs ranking-/forgalom-garancia; külső AI \+ Google API; nemzetközi adattovábbítás; adatkezelési \+ ÁSZF link. |
| **DataMind/termekek/dataminddatamind.cegem360.eu** | Eredmény-számok illusztratívra; jelenleg CSAK ANGOL felület. | MAGYAR nyelvű verzió elkészítése; külső AI \+ Google API \+ nemzetközi adattovábbítás; predikció nem garancia; csatlakoztatott források jogszerűsége az ügyfélé; DPA. |

**Következő lépés:** szólj, és a közös záradékokat (DPA, Adatkezelési tájékoztató, AI, kommunikáció, számlázás) önálló sablonként megírom, vagy beépítem a teljes, átírt ÁSZF V3-ba a modul- és Számlázó-szakaszokkal együtt.
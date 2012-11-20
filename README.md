# RedLettr API (BETA)

RedLettr är ett API som hämtar information om dagens datum eller ett specifikt datum om det anges.

## Varför använda det?
redLettr hämtar data från http://api.dryg.net/ som i sin tur räknar ut vilket datum helgdagar innefaller på enligt Lag (1989:253) om allmänna helgdagar.
Eftersom påsken innefaller "söndagen närmast efter den fullmåne som infaller på eller närmast efter den 21 mars" kan det vara svårt att själv hålla koll på datum då påsken är från år till år, detta löser redLettr åt dig. 


>Tryck [här][] för att se hur man gör

## Exempel på användningsområden
Ett exempel på när man vill använda redLettr kan vara om man vill ha information om specifika dagar exempelvis om man tillhandahåller en kalender.

## Datakälla och beroenden

RedLettr hämtar data från ett publikt webbapi som man kan hitta på http://api.dryg.net/ .
RedLettr har två beroenden och det krävs att man har det i sin PHP installation.

> cURL är ett bibliotek och ett kommandotolk-verktyg som används för att hämta data över HTTP-protokollet.
>> Dokumentation: http://curl.haxx.se/

> XcacheApi snabb opcode cache som tillhandahåller ett API för att spara och hämta data ur en cache.
>> Dokumentation: http://xcache.lighttpd.net/ 

## Hur använder man det?

Först och främst måste RedLettr installeras och det gör du genom att ladda ner PHP filerna och placera dom i rotkatalogen av din applikation.
När man laddat hem det kan du använda dig av redLettr.

	require_once(dirname(__FILE__) . '/redLettr.php');

	$redLettr = new redLettr();

Och för att hämta data används den publika metoden **getInfoAboutDateParamOrToday** som finns i klassen redLettr. Metoden tar ett datum i form av en sträng som ska kunna tolkas till ett datum, om inget datum skickas med hämtas information om dagens datum.
> Exempel på anrop:
	
	$redLettr->getInfoAboutDateParamOrToday('20121224');

> Exempel på svar:
	
	object(stdClass)#2 (6) 
	{ 
		["datum"]=> string(10) "2012-12-24" 
		["unixdatum"]=> int(1356303600) 
		["dag"]=> string(7) "MÃ¥ndag" 
		["veckodag"]=> string(1) "1" 
		["vecka"]=> string(2) "52" 
		["helgdag"]=> string(8) "Julafton" 
	}

## Felhantering
Fel som beror på att beroenden eller datakällan inte fungerar korrekt triggar ett exception av typen **redLettrException** som kan fångas genom att göra en try catch runt anropet:

	try{
		$redLettr->getInfoAboutDateParamOrToday('20121224');
	}catch(redLettrException $e){
		echo("Fel har skett:".$e);
	}

Fel som beror på att datumet är felformaterat hanteras genom att redLettr returnerar ett [stdObject][] med attributet errors som är en array av strängar (errors) och det kan hanteras på följande sätt:

	$dateInfo = $rl->getInfoAboutDateParamOrToday('Not a valid date');
	if(isset($dateInfo->errors)){
		...
	}

***

## Funderingar på kommande funktioner eller inte implementerade funktioner

* Cachning med hjälp av XcacheApi.
* Möjlighet för loggning av exceptions och API anrop.
* Hämta all info om dagar mellan två datum.
* Hämta all info om dagar som innefaller en viss månad/vecka.
* Använda SimpleMock för att slippa göra anrop till APIet under testning.

---

## Utvärdering av simpletest

Som sagt, simpletest var det testramverk Jag valde att utforska, jag valde det eftersom jag hört att PHPUnit är lite mer avancerat och jag kommer återkomma till att testa det i ett senare skede.
Som testramverk fungerar simpletest som många andra testramverk till PHP men även Javascript och C#, därför var det väldigt enkelt att sätta sig in i. Det hörs lite på namnet att det är lätt och det kan jag inte annat än hålla med om. 
Simpletests [dokumentation][] är lätt att läsa och som säkert många andra är det första man vill se exempel på hur man använder ramverket, och det var väldigt enkelt att hitta [dit][] .
För de tester jag skapade nu behövde jag inte besöka någon annan sida än simpletests egna dokumentation, och de är bra indexerade på google om man söker på [simpletest relaterade frågor][]. 

[stdObject]: http://php.net/manual/en/reserved.classes.php "Documentation för stdObject"
[här]: https://github.com/sjolinjohan180/redLettr#hur-anv%C3%A4nder-man-det "Tryck här"
[dokumentation]: http://simpletest.org/index.html "simpletest dokumentation"
[dit]: http://simpletest.org/en/start-testing.html "länk till kom-igång sida"
[simpletest relaterade frågor]: http://goo.gl/vF5Rw "sökning på mock"
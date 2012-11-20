# RedLettr API

RedLettr is an API that makes it possible to get information about the current day or any date if given.

## Datakälla och beroenden

RedLettr hämtar data från ett publikt webbapi som man kan hitta på http://api.dryg.net/.
RedLettr har två beroenden och det kräver att man har det i sin PHP version.

> cURL är ett bibliotek och ett kommandotolk-verktyg som används för att hämta data över HTTP-protokollet.
>> Dokumentation: http://curl.haxx.se/

> XcacheApi snabb opcode cache som tillhandahåller ett API för att spara och hämta data ur en cache.
>> Dokumentation: http://xcache.lighttpd.net/ 

## Hur använder man det?

> Installation
Först och främst måste RedLettr installeras och det gör du genom att ladda ner PHP filerna och placera dom i rotkatalogen av din applikation.
När man laddat hem det kan du använda dig av redLettr.

	require_once(dirname(__FILE__) . '/redLettr.php');

	$redLettr = new redLettr();

Och för att hämta data används den publika metoden getInfoAboutDateParamOrToday som finns i klassen redLettr. Metoden tar ett datum i form av en sträng formaterad YYYYMMDD, om inget datum skickas med hämtas information om dagens datum.
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
Felhantering sker med hjälp av exceptions som kan fångas genom att göra en try catch runt anropet:

	try{
		$redLettr->getInfoAboutDateParamOrToday('20121224');
	}catch(redLettrException $e){
		echo("Fel har skett:".$e);
	}
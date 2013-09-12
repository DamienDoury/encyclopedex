<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pok&eacute;dex - Encyclopedex</title>
		<link rel="icon" type="image/png" href="/images/icones/loupe 32x32.png" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="Encyclopedex is the best strategy Pokédex for Pokémon Black 2/White 2 thanks to its simple, intuitive and efficient search engine!" />
		<meta name="keywords" content="pokedex, encyclopedex, Pokédex, encyclopedia, Pokémon, pokemon, search engine, black, white, xy, database" />
		<link rel="stylesheet" type="text/css" href="http://encyclopedex.com/pokedex.css" />

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/libs/jquery.cookie.js"></script>
		<script src="/libs/bPopup.js"></script>
		<script type="text/javascript">
		
		critere_et = true;
		selection_auto = true;
		mode_recherche = true;
	
		nombre_selections = 0;
		numero_completion = -1;
		
		saisie_precedente = "";
		focus_saisie = false;
		
		nombre_requetes = 0;
		
		var bdd = []; // L'avantage avec ce systeme, c'est qu'on peut partager les requetes. Un parametre en GET peut pre-selectionner la liste de mots cles.
		bdd.push(["1","numero","1"]);
		bdd.push(["2","numero","2"]);
		bdd.push(["3","numero","3"]);
		bdd.push(["4","numero","4"]);
		bdd.push(["5","numero","5"]);
		bdd.push(["6","numero","6"]);
		bdd.push(["7","numero","7"]);
		bdd.push(["8","numero","8"]);
		bdd.push(["9","numero","9"]);
		bdd.push(["10","numero","10"]);
		bdd.push(["11","numero","11"]);
		bdd.push(["12","numero","12"]);
		bdd.push(["13","numero","13"]);
		bdd.push(["14","numero","14"]);
		bdd.push(["15","numero","15"]);
		bdd.push(["16","numero","16"]);
		bdd.push(["17","numero","17"]);
		bdd.push(["18","numero","18"]);
		bdd.push(["19","numero","19"]);
		bdd.push(["20","numero","20"]);
		bdd.push(["21","numero","21"]);
		bdd.push(["22","numero","22"]);
		bdd.push(["23","numero","23"]);
		bdd.push(["24","numero","24"]);
		bdd.push(["25","numero","25"]);
		bdd.push(["26","numero","26"]);
		bdd.push(["27","numero","27"]);
		bdd.push(["28","numero","28"]);
		bdd.push(["29","numero","29"]);
		bdd.push(["30","numero","30"]);
		bdd.push(["31","numero","31"]);
		bdd.push(["32","numero","32"]);
		bdd.push(["33","numero","33"]);
		bdd.push(["34","numero","34"]);
		bdd.push(["35","numero","35"]);
		bdd.push(["36","numero","36"]);
		bdd.push(["37","numero","37"]);
		bdd.push(["38","numero","38"]);
		bdd.push(["39","numero","39"]);
		bdd.push(["40","numero","40"]);
		bdd.push(["41","numero","41"]);
		bdd.push(["42","numero","42"]);
		bdd.push(["43","numero","43"]);
		bdd.push(["44","numero","44"]);
		bdd.push(["45","numero","45"]);
		bdd.push(["46","numero","46"]);
		bdd.push(["47","numero","47"]);
		bdd.push(["48","numero","48"]);
		bdd.push(["49","numero","49"]);
		bdd.push(["50","numero","50"]);
		bdd.push(["51","numero","51"]);
		bdd.push(["52","numero","52"]);
		bdd.push(["53","numero","53"]);
		bdd.push(["54","numero","54"]);
		bdd.push(["55","numero","55"]);
		bdd.push(["56","numero","56"]);
		bdd.push(["57","numero","57"]);
		bdd.push(["58","numero","58"]);
		bdd.push(["59","numero","59"]);
		bdd.push(["60","numero","60"]);
		bdd.push(["61","numero","61"]);
		bdd.push(["62","numero","62"]);
		bdd.push(["63","numero","63"]);
		bdd.push(["64","numero","64"]);
		bdd.push(["65","numero","65"]);
		bdd.push(["66","numero","66"]);
		bdd.push(["67","numero","67"]);
		bdd.push(["68","numero","68"]);
		bdd.push(["69","numero","69"]);
		bdd.push(["70","numero","70"]);
		bdd.push(["71","numero","71"]);
		bdd.push(["72","numero","72"]);
		bdd.push(["73","numero","73"]);
		bdd.push(["74","numero","74"]);
		bdd.push(["75","numero","75"]);
		bdd.push(["76","numero","76"]);
		bdd.push(["77","numero","77"]);
		bdd.push(["78","numero","78"]);
		bdd.push(["79","numero","79"]);
		bdd.push(["80","numero","80"]);
		bdd.push(["81","numero","81"]);
		bdd.push(["82","numero","82"]);
		bdd.push(["83","numero","83"]);
		bdd.push(["84","numero","84"]);
		bdd.push(["85","numero","85"]);
		bdd.push(["86","numero","86"]);
		bdd.push(["87","numero","87"]);
		bdd.push(["88","numero","88"]);
		bdd.push(["89","numero","89"]);
		bdd.push(["90","numero","90"]);
		bdd.push(["91","numero","91"]);
		bdd.push(["92","numero","92"]);
		bdd.push(["93","numero","93"]);
		bdd.push(["94","numero","94"]);
		bdd.push(["95","numero","95"]);
		bdd.push(["96","numero","96"]);
		bdd.push(["97","numero","97"]);
		bdd.push(["98","numero","98"]);
		bdd.push(["99","numero","99"]);
		bdd.push(["100","numero","100"]);
		bdd.push(["101","numero","101"]);
		bdd.push(["102","numero","102"]);
		bdd.push(["103","numero","103"]);
		bdd.push(["104","numero","104"]);
		bdd.push(["105","numero","105"]);
		bdd.push(["106","numero","106"]);
		bdd.push(["107","numero","107"]);
		bdd.push(["108","numero","108"]);
		bdd.push(["109","numero","109"]);
		bdd.push(["110","numero","110"]);
		bdd.push(["111","numero","111"]);
		bdd.push(["112","numero","112"]);
		bdd.push(["113","numero","113"]);
		bdd.push(["114","numero","114"]);
		bdd.push(["115","numero","115"]);
		bdd.push(["116","numero","116"]);
		bdd.push(["117","numero","117"]);
		bdd.push(["118","numero","118"]);
		bdd.push(["119","numero","119"]);
		bdd.push(["120","numero","120"]);
		bdd.push(["121","numero","121"]);
		bdd.push(["122","numero","122"]);
		bdd.push(["123","numero","123"]);
		bdd.push(["124","numero","124"]);
		bdd.push(["125","numero","125"]);
		bdd.push(["126","numero","126"]);
		bdd.push(["127","numero","127"]);
		bdd.push(["128","numero","128"]);
		bdd.push(["129","numero","129"]);
		bdd.push(["130","numero","130"]);
		bdd.push(["131","numero","131"]);
		bdd.push(["132","numero","132"]);
		bdd.push(["133","numero","133"]);
		bdd.push(["134","numero","134"]);
		bdd.push(["135","numero","135"]);
		bdd.push(["136","numero","136"]);
		bdd.push(["137","numero","137"]);
		bdd.push(["138","numero","138"]);
		bdd.push(["139","numero","139"]);
		bdd.push(["140","numero","140"]);
		bdd.push(["141","numero","141"]);
		bdd.push(["142","numero","142"]);
		bdd.push(["143","numero","143"]);
		bdd.push(["144","numero","144"]);
		bdd.push(["145","numero","145"]);
		bdd.push(["146","numero","146"]);
		bdd.push(["147","numero","147"]);
		bdd.push(["148","numero","148"]);
		bdd.push(["149","numero","149"]);
		bdd.push(["150","numero","150"]);
		bdd.push(["151","numero","151"]);
		bdd.push(["152","numero","152"]);
		bdd.push(["153","numero","153"]);
		bdd.push(["154","numero","154"]);
		bdd.push(["155","numero","155"]);
		bdd.push(["156","numero","156"]);
		bdd.push(["157","numero","157"]);
		bdd.push(["158","numero","158"]);
		bdd.push(["159","numero","159"]);
		bdd.push(["160","numero","160"]);
		bdd.push(["161","numero","161"]);
		bdd.push(["162","numero","162"]);
		bdd.push(["163","numero","163"]);
		bdd.push(["164","numero","164"]);
		bdd.push(["165","numero","165"]);
		bdd.push(["166","numero","166"]);
		bdd.push(["167","numero","167"]);
		bdd.push(["168","numero","168"]);
		bdd.push(["169","numero","169"]);
		bdd.push(["170","numero","170"]);
		bdd.push(["171","numero","171"]);
		bdd.push(["172","numero","172"]);
		bdd.push(["173","numero","173"]);
		bdd.push(["174","numero","174"]);
		bdd.push(["175","numero","175"]);
		bdd.push(["176","numero","176"]);
		bdd.push(["177","numero","177"]);
		bdd.push(["178","numero","178"]);
		bdd.push(["179","numero","179"]);
		bdd.push(["180","numero","180"]);
		bdd.push(["181","numero","181"]);
		bdd.push(["182","numero","182"]);
		bdd.push(["183","numero","183"]);
		bdd.push(["184","numero","184"]);
		bdd.push(["185","numero","185"]);
		bdd.push(["186","numero","186"]);
		bdd.push(["187","numero","187"]);
		bdd.push(["188","numero","188"]);
		bdd.push(["189","numero","189"]);
		bdd.push(["190","numero","190"]);
		bdd.push(["191","numero","191"]);
		bdd.push(["192","numero","192"]);
		bdd.push(["193","numero","193"]);
		bdd.push(["194","numero","194"]);
		bdd.push(["195","numero","195"]);
		bdd.push(["196","numero","196"]);
		bdd.push(["197","numero","197"]);
		bdd.push(["198","numero","198"]);
		bdd.push(["199","numero","199"]);
		bdd.push(["200","numero","200"]);
		bdd.push(["201","numero","201"]);
		bdd.push(["202","numero","202"]);
		bdd.push(["203","numero","203"]);
		bdd.push(["204","numero","204"]);
		bdd.push(["205","numero","205"]);
		bdd.push(["206","numero","206"]);
		bdd.push(["207","numero","207"]);
		bdd.push(["208","numero","208"]);
		bdd.push(["209","numero","209"]);
		bdd.push(["210","numero","210"]);
		bdd.push(["211","numero","211"]);
		bdd.push(["212","numero","212"]);
		bdd.push(["213","numero","213"]);
		bdd.push(["214","numero","214"]);
		bdd.push(["215","numero","215"]);
		bdd.push(["216","numero","216"]);
		bdd.push(["217","numero","217"]);
		bdd.push(["218","numero","218"]);
		bdd.push(["219","numero","219"]);
		bdd.push(["220","numero","220"]);
		bdd.push(["221","numero","221"]);
		bdd.push(["222","numero","222"]);
		bdd.push(["223","numero","223"]);
		bdd.push(["224","numero","224"]);
		bdd.push(["225","numero","225"]);
		bdd.push(["226","numero","226"]);
		bdd.push(["227","numero","227"]);
		bdd.push(["228","numero","228"]);
		bdd.push(["229","numero","229"]);
		bdd.push(["230","numero","230"]);
		bdd.push(["231","numero","231"]);
		bdd.push(["232","numero","232"]);
		bdd.push(["233","numero","233"]);
		bdd.push(["234","numero","234"]);
		bdd.push(["235","numero","235"]);
		bdd.push(["236","numero","236"]);
		bdd.push(["237","numero","237"]);
		bdd.push(["238","numero","238"]);
		bdd.push(["239","numero","239"]);
		bdd.push(["240","numero","240"]);
		bdd.push(["241","numero","241"]);
		bdd.push(["242","numero","242"]);
		bdd.push(["243","numero","243"]);
		bdd.push(["244","numero","244"]);
		bdd.push(["245","numero","245"]);
		bdd.push(["246","numero","246"]);
		bdd.push(["247","numero","247"]);
		bdd.push(["248","numero","248"]);
		bdd.push(["249","numero","249"]);
		bdd.push(["250","numero","250"]);
		bdd.push(["251","numero","251"]);
		bdd.push(["252","numero","252"]);
		bdd.push(["253","numero","253"]);
		bdd.push(["254","numero","254"]);
		bdd.push(["255","numero","255"]);
		bdd.push(["256","numero","256"]);
		bdd.push(["257","numero","257"]);
		bdd.push(["258","numero","258"]);
		bdd.push(["259","numero","259"]);
		bdd.push(["260","numero","260"]);
		bdd.push(["261","numero","261"]);
		bdd.push(["262","numero","262"]);
		bdd.push(["263","numero","263"]);
		bdd.push(["264","numero","264"]);
		bdd.push(["265","numero","265"]);
		bdd.push(["266","numero","266"]);
		bdd.push(["267","numero","267"]);
		bdd.push(["268","numero","268"]);
		bdd.push(["269","numero","269"]);
		bdd.push(["270","numero","270"]);
		bdd.push(["271","numero","271"]);
		bdd.push(["272","numero","272"]);
		bdd.push(["273","numero","273"]);
		bdd.push(["274","numero","274"]);
		bdd.push(["275","numero","275"]);
		bdd.push(["276","numero","276"]);
		bdd.push(["277","numero","277"]);
		bdd.push(["278","numero","278"]);
		bdd.push(["279","numero","279"]);
		bdd.push(["280","numero","280"]);
		bdd.push(["281","numero","281"]);
		bdd.push(["282","numero","282"]);
		bdd.push(["283","numero","283"]);
		bdd.push(["284","numero","284"]);
		bdd.push(["285","numero","285"]);
		bdd.push(["286","numero","286"]);
		bdd.push(["287","numero","287"]);
		bdd.push(["288","numero","288"]);
		bdd.push(["289","numero","289"]);
		bdd.push(["290","numero","290"]);
		bdd.push(["291","numero","291"]);
		bdd.push(["292","numero","292"]);
		bdd.push(["293","numero","293"]);
		bdd.push(["294","numero","294"]);
		bdd.push(["295","numero","295"]);
		bdd.push(["296","numero","296"]);
		bdd.push(["297","numero","297"]);
		bdd.push(["298","numero","298"]);
		bdd.push(["299","numero","299"]);
		bdd.push(["300","numero","300"]);
		bdd.push(["301","numero","301"]);
		bdd.push(["302","numero","302"]);
		bdd.push(["303","numero","303"]);
		bdd.push(["304","numero","304"]);
		bdd.push(["305","numero","305"]);
		bdd.push(["306","numero","306"]);
		bdd.push(["307","numero","307"]);
		bdd.push(["308","numero","308"]);
		bdd.push(["309","numero","309"]);
		bdd.push(["310","numero","310"]);
		bdd.push(["311","numero","311"]);
		bdd.push(["312","numero","312"]);
		bdd.push(["313","numero","313"]);
		bdd.push(["314","numero","314"]);
		bdd.push(["315","numero","315"]);
		bdd.push(["316","numero","316"]);
		bdd.push(["317","numero","317"]);
		bdd.push(["318","numero","318"]);
		bdd.push(["319","numero","319"]);
		bdd.push(["320","numero","320"]);
		bdd.push(["321","numero","321"]);
		bdd.push(["322","numero","322"]);
		bdd.push(["323","numero","323"]);
		bdd.push(["324","numero","324"]);
		bdd.push(["325","numero","325"]);
		bdd.push(["326","numero","326"]);
		bdd.push(["327","numero","327"]);
		bdd.push(["328","numero","328"]);
		bdd.push(["329","numero","329"]);
		bdd.push(["330","numero","330"]);
		bdd.push(["331","numero","331"]);
		bdd.push(["332","numero","332"]);
		bdd.push(["333","numero","333"]);
		bdd.push(["334","numero","334"]);
		bdd.push(["335","numero","335"]);
		bdd.push(["336","numero","336"]);
		bdd.push(["337","numero","337"]);
		bdd.push(["338","numero","338"]);
		bdd.push(["339","numero","339"]);
		bdd.push(["340","numero","340"]);
		bdd.push(["341","numero","341"]);
		bdd.push(["342","numero","342"]);
		bdd.push(["343","numero","343"]);
		bdd.push(["344","numero","344"]);
		bdd.push(["345","numero","345"]);
		bdd.push(["346","numero","346"]);
		bdd.push(["347","numero","347"]);
		bdd.push(["348","numero","348"]);
		bdd.push(["349","numero","349"]);
		bdd.push(["350","numero","350"]);
		bdd.push(["351","numero","351"]);
		bdd.push(["352","numero","352"]);
		bdd.push(["353","numero","353"]);
		bdd.push(["354","numero","354"]);
		bdd.push(["355","numero","355"]);
		bdd.push(["356","numero","356"]);
		bdd.push(["357","numero","357"]);
		bdd.push(["358","numero","358"]);
		bdd.push(["359","numero","359"]);
		bdd.push(["360","numero","360"]);
		bdd.push(["361","numero","361"]);
		bdd.push(["362","numero","362"]);
		bdd.push(["363","numero","363"]);
		bdd.push(["364","numero","364"]);
		bdd.push(["365","numero","365"]);
		bdd.push(["366","numero","366"]);
		bdd.push(["367","numero","367"]);
		bdd.push(["368","numero","368"]);
		bdd.push(["369","numero","369"]);
		bdd.push(["370","numero","370"]);
		bdd.push(["371","numero","371"]);
		bdd.push(["372","numero","372"]);
		bdd.push(["373","numero","373"]);
		bdd.push(["374","numero","374"]);
		bdd.push(["375","numero","375"]);
		bdd.push(["376","numero","376"]);
		bdd.push(["377","numero","377"]);
		bdd.push(["378","numero","378"]);
		bdd.push(["379","numero","379"]);
		bdd.push(["380","numero","380"]);
		bdd.push(["381","numero","381"]);
		bdd.push(["382","numero","382"]);
		bdd.push(["383","numero","383"]);
		bdd.push(["384","numero","384"]);
		bdd.push(["385","numero","385"]);
		bdd.push(["386","numero","386"]);
		bdd.push(["387","numero","387"]);
		bdd.push(["388","numero","388"]);
		bdd.push(["389","numero","389"]);
		bdd.push(["390","numero","390"]);
		bdd.push(["391","numero","391"]);
		bdd.push(["392","numero","392"]);
		bdd.push(["393","numero","393"]);
		bdd.push(["394","numero","394"]);
		bdd.push(["395","numero","395"]);
		bdd.push(["396","numero","396"]);
		bdd.push(["397","numero","397"]);
		bdd.push(["398","numero","398"]);
		bdd.push(["399","numero","399"]);
		bdd.push(["400","numero","400"]);
		bdd.push(["401","numero","401"]);
		bdd.push(["402","numero","402"]);
		bdd.push(["403","numero","403"]);
		bdd.push(["404","numero","404"]);
		bdd.push(["405","numero","405"]);
		bdd.push(["406","numero","406"]);
		bdd.push(["407","numero","407"]);
		bdd.push(["408","numero","408"]);
		bdd.push(["409","numero","409"]);
		bdd.push(["410","numero","410"]);
		bdd.push(["411","numero","411"]);
		bdd.push(["412","numero","412"]);
		bdd.push(["413","numero","413"]);
		bdd.push(["414","numero","414"]);
		bdd.push(["415","numero","415"]);
		bdd.push(["416","numero","416"]);
		bdd.push(["417","numero","417"]);
		bdd.push(["418","numero","418"]);
		bdd.push(["419","numero","419"]);
		bdd.push(["420","numero","420"]);
		bdd.push(["421","numero","421"]);
		bdd.push(["422","numero","422"]);
		bdd.push(["423","numero","423"]);
		bdd.push(["424","numero","424"]);
		bdd.push(["425","numero","425"]);
		bdd.push(["426","numero","426"]);
		bdd.push(["427","numero","427"]);
		bdd.push(["428","numero","428"]);
		bdd.push(["429","numero","429"]);
		bdd.push(["430","numero","430"]);
		bdd.push(["431","numero","431"]);
		bdd.push(["432","numero","432"]);
		bdd.push(["433","numero","433"]);
		bdd.push(["434","numero","434"]);
		bdd.push(["435","numero","435"]);
		bdd.push(["436","numero","436"]);
		bdd.push(["437","numero","437"]);
		bdd.push(["438","numero","438"]);
		bdd.push(["439","numero","439"]);
		bdd.push(["440","numero","440"]);
		bdd.push(["441","numero","441"]);
		bdd.push(["442","numero","442"]);
		bdd.push(["443","numero","443"]);
		bdd.push(["444","numero","444"]);
		bdd.push(["445","numero","445"]);
		bdd.push(["446","numero","446"]);
		bdd.push(["447","numero","447"]);
		bdd.push(["448","numero","448"]);
		bdd.push(["449","numero","449"]);
		bdd.push(["450","numero","450"]);
		bdd.push(["451","numero","451"]);
		bdd.push(["452","numero","452"]);
		bdd.push(["453","numero","453"]);
		bdd.push(["454","numero","454"]);
		bdd.push(["455","numero","455"]);
		bdd.push(["456","numero","456"]);
		bdd.push(["457","numero","457"]);
		bdd.push(["458","numero","458"]);
		bdd.push(["459","numero","459"]);
		bdd.push(["460","numero","460"]);
		bdd.push(["461","numero","461"]);
		bdd.push(["462","numero","462"]);
		bdd.push(["463","numero","463"]);
		bdd.push(["464","numero","464"]);
		bdd.push(["465","numero","465"]);
		bdd.push(["466","numero","466"]);
		bdd.push(["467","numero","467"]);
		bdd.push(["468","numero","468"]);
		bdd.push(["469","numero","469"]);
		bdd.push(["470","numero","470"]);
		bdd.push(["471","numero","471"]);
		bdd.push(["472","numero","472"]);
		bdd.push(["473","numero","473"]);
		bdd.push(["474","numero","474"]);
		bdd.push(["475","numero","475"]);
		bdd.push(["476","numero","476"]);
		bdd.push(["477","numero","477"]);
		bdd.push(["478","numero","478"]);
		bdd.push(["479","numero","479"]);
		bdd.push(["480","numero","480"]);
		bdd.push(["481","numero","481"]);
		bdd.push(["482","numero","482"]);
		bdd.push(["483","numero","483"]);
		bdd.push(["484","numero","484"]);
		bdd.push(["485","numero","485"]);
		bdd.push(["486","numero","486"]);
		bdd.push(["487","numero","487"]);
		bdd.push(["488","numero","488"]);
		bdd.push(["489","numero","489"]);
		bdd.push(["490","numero","490"]);
		bdd.push(["491","numero","491"]);
		bdd.push(["492","numero","492"]);
		bdd.push(["493","numero","493"]);
		bdd.push(["494","numero","494"]);
		bdd.push(["495","numero","495"]);
		bdd.push(["496","numero","496"]);
		bdd.push(["497","numero","497"]);
		bdd.push(["498","numero","498"]);
		bdd.push(["499","numero","499"]);
		bdd.push(["500","numero","500"]);
		bdd.push(["501","numero","501"]);
		bdd.push(["502","numero","502"]);
		bdd.push(["503","numero","503"]);
		bdd.push(["504","numero","504"]);
		bdd.push(["505","numero","505"]);
		bdd.push(["506","numero","506"]);
		bdd.push(["507","numero","507"]);
		bdd.push(["508","numero","508"]);
		bdd.push(["509","numero","509"]);
		bdd.push(["510","numero","510"]);
		bdd.push(["511","numero","511"]);
		bdd.push(["512","numero","512"]);
		bdd.push(["513","numero","513"]);
		bdd.push(["514","numero","514"]);
		bdd.push(["515","numero","515"]);
		bdd.push(["516","numero","516"]);
		bdd.push(["517","numero","517"]);
		bdd.push(["518","numero","518"]);
		bdd.push(["519","numero","519"]);
		bdd.push(["520","numero","520"]);
		bdd.push(["521","numero","521"]);
		bdd.push(["522","numero","522"]);
		bdd.push(["523","numero","523"]);
		bdd.push(["524","numero","524"]);
		bdd.push(["525","numero","525"]);
		bdd.push(["526","numero","526"]);
		bdd.push(["527","numero","527"]);
		bdd.push(["528","numero","528"]);
		bdd.push(["529","numero","529"]);
		bdd.push(["530","numero","530"]);
		bdd.push(["531","numero","531"]);
		bdd.push(["532","numero","532"]);
		bdd.push(["533","numero","533"]);
		bdd.push(["534","numero","534"]);
		bdd.push(["535","numero","535"]);
		bdd.push(["536","numero","536"]);
		bdd.push(["537","numero","537"]);
		bdd.push(["538","numero","538"]);
		bdd.push(["539","numero","539"]);
		bdd.push(["540","numero","540"]);
		bdd.push(["541","numero","541"]);
		bdd.push(["542","numero","542"]);
		bdd.push(["543","numero","543"]);
		bdd.push(["544","numero","544"]);
		bdd.push(["545","numero","545"]);
		bdd.push(["546","numero","546"]);
		bdd.push(["547","numero","547"]);
		bdd.push(["548","numero","548"]);
		bdd.push(["549","numero","549"]);
		bdd.push(["550","numero","550"]);
		bdd.push(["551","numero","551"]);
		bdd.push(["552","numero","552"]);
		bdd.push(["553","numero","553"]);
		bdd.push(["554","numero","554"]);
		bdd.push(["555","numero","555"]);
		bdd.push(["556","numero","556"]);
		bdd.push(["557","numero","557"]);
		bdd.push(["558","numero","558"]);
		bdd.push(["559","numero","559"]);
		bdd.push(["560","numero","560"]);
		bdd.push(["561","numero","561"]);
		bdd.push(["562","numero","562"]);
		bdd.push(["563","numero","563"]);
		bdd.push(["564","numero","564"]);
		bdd.push(["565","numero","565"]);
		bdd.push(["566","numero","566"]);
		bdd.push(["567","numero","567"]);
		bdd.push(["568","numero","568"]);
		bdd.push(["569","numero","569"]);
		bdd.push(["570","numero","570"]);
		bdd.push(["571","numero","571"]);
		bdd.push(["572","numero","572"]);
		bdd.push(["573","numero","573"]);
		bdd.push(["574","numero","574"]);
		bdd.push(["575","numero","575"]);
		bdd.push(["576","numero","576"]);
		bdd.push(["577","numero","577"]);
		bdd.push(["578","numero","578"]);
		bdd.push(["579","numero","579"]);
		bdd.push(["580","numero","580"]);
		bdd.push(["581","numero","581"]);
		bdd.push(["582","numero","582"]);
		bdd.push(["583","numero","583"]);
		bdd.push(["584","numero","584"]);
		bdd.push(["585","numero","585"]);
		bdd.push(["586","numero","586"]);
		bdd.push(["587","numero","587"]);
		bdd.push(["588","numero","588"]);
		bdd.push(["589","numero","589"]);
		bdd.push(["590","numero","590"]);
		bdd.push(["591","numero","591"]);
		bdd.push(["592","numero","592"]);
		bdd.push(["593","numero","593"]);
		bdd.push(["594","numero","594"]);
		bdd.push(["595","numero","595"]);
		bdd.push(["596","numero","596"]);
		bdd.push(["597","numero","597"]);
		bdd.push(["598","numero","598"]);
		bdd.push(["599","numero","599"]);
		bdd.push(["600","numero","600"]);
		bdd.push(["601","numero","601"]);
		bdd.push(["602","numero","602"]);
		bdd.push(["603","numero","603"]);
		bdd.push(["604","numero","604"]);
		bdd.push(["605","numero","605"]);
		bdd.push(["606","numero","606"]);
		bdd.push(["607","numero","607"]);
		bdd.push(["608","numero","608"]);
		bdd.push(["609","numero","609"]);
		bdd.push(["610","numero","610"]);
		bdd.push(["611","numero","611"]);
		bdd.push(["612","numero","612"]);
		bdd.push(["613","numero","613"]);
		bdd.push(["614","numero","614"]);
		bdd.push(["615","numero","615"]);
		bdd.push(["616","numero","616"]);
		bdd.push(["617","numero","617"]);
		bdd.push(["618","numero","618"]);
		bdd.push(["619","numero","619"]);
		bdd.push(["620","numero","620"]);
		bdd.push(["621","numero","621"]);
		bdd.push(["622","numero","622"]);
		bdd.push(["623","numero","623"]);
		bdd.push(["624","numero","624"]);
		bdd.push(["625","numero","625"]);
		bdd.push(["626","numero","626"]);
		bdd.push(["627","numero","627"]);
		bdd.push(["628","numero","628"]);
		bdd.push(["629","numero","629"]);
		bdd.push(["630","numero","630"]);
		bdd.push(["631","numero","631"]);
		bdd.push(["632","numero","632"]);
		bdd.push(["633","numero","633"]);
		bdd.push(["634","numero","634"]);
		bdd.push(["635","numero","635"]);
		bdd.push(["636","numero","636"]);
		bdd.push(["637","numero","637"]);
		bdd.push(["638","numero","638"]);
		bdd.push(["639","numero","639"]);
		bdd.push(["640","numero","640"]);
		bdd.push(["641","numero","641"]);
		bdd.push(["642","numero","642"]);
		bdd.push(["643","numero","643"]);
		bdd.push(["644","numero","644"]);
		bdd.push(["645","numero","645"]);
		bdd.push(["646","numero","646"]);
		bdd.push(["647","numero","647"]);
		bdd.push(["648","numero","648"]);
		bdd.push(["649","numero","649"]);
		bdd.push(["Bulbasaur","pokemon","1"]);
		bdd.push(["Ivysaur","pokemon","2"]);
		bdd.push(["Venusaur","pokemon","3"]);
		bdd.push(["Charmander","pokemon","4"]);
		bdd.push(["Charmeleon","pokemon","5"]);
		bdd.push(["Charizard","pokemon","6"]);
		bdd.push(["Squirtle","pokemon","7"]);
		bdd.push(["Wartortle","pokemon","8"]);
		bdd.push(["Blastoise","pokemon","9"]);
		bdd.push(["Caterpie","pokemon","10"]);
		bdd.push(["Metapod","pokemon","11"]);
		bdd.push(["Butterfree","pokemon","12"]);
		bdd.push(["Weedle","pokemon","13"]);
		bdd.push(["Kakuna","pokemon","14"]);
		bdd.push(["Beedrill","pokemon","15"]);
		bdd.push(["Pidgey","pokemon","16"]);
		bdd.push(["Pidgeotto","pokemon","17"]);
		bdd.push(["Pidgeot","pokemon","18"]);
		bdd.push(["Rattata","pokemon","19"]);
		bdd.push(["Raticate","pokemon","20"]);
		bdd.push(["Spearow","pokemon","21"]);
		bdd.push(["Fearow","pokemon","22"]);
		bdd.push(["Ekans","pokemon","23"]);
		bdd.push(["Arbok","pokemon","24"]);
		bdd.push(["Pikachu","pokemon","25"]);
		bdd.push(["Raichu","pokemon","26"]);
		bdd.push(["Sandshrew","pokemon","27"]);
		bdd.push(["Sandslash","pokemon","28"]);
		bdd.push(["Nidoran♀","pokemon","29"]);
		bdd.push(["Nidorina","pokemon","30"]);
		bdd.push(["Nidoqueen","pokemon","31"]);
		bdd.push(["Nidoran♂","pokemon","32"]);
		bdd.push(["Nidorino","pokemon","33"]);
		bdd.push(["Nidoking","pokemon","34"]);
		bdd.push(["Clefairy","pokemon","35"]);
		bdd.push(["Clefable","pokemon","36"]);
		bdd.push(["Vulpix","pokemon","37"]);
		bdd.push(["Ninetales","pokemon","38"]);
		bdd.push(["Jigglypuff","pokemon","39"]);
		bdd.push(["Wigglytuff","pokemon","40"]);
		bdd.push(["Zubat","pokemon","41"]);
		bdd.push(["Golbat","pokemon","42"]);
		bdd.push(["Oddish","pokemon","43"]);
		bdd.push(["Gloom","pokemon","44"]);
		bdd.push(["Vileplume","pokemon","45"]);
		bdd.push(["Paras","pokemon","46"]);
		bdd.push(["Parasect","pokemon","47"]);
		bdd.push(["Venonat","pokemon","48"]);
		bdd.push(["Venomoth","pokemon","49"]);
		bdd.push(["Diglett","pokemon","50"]);
		bdd.push(["Dugtrio","pokemon","51"]);
		bdd.push(["Meowth","pokemon","52"]);
		bdd.push(["Persian","pokemon","53"]);
		bdd.push(["Psyduck","pokemon","54"]);
		bdd.push(["Golduck","pokemon","55"]);
		bdd.push(["Mankey","pokemon","56"]);
		bdd.push(["Primeape","pokemon","57"]);
		bdd.push(["Growlithe","pokemon","58"]);
		bdd.push(["Arcanine","pokemon","59"]);
		bdd.push(["Poliwag","pokemon","60"]);
		bdd.push(["Poliwhirl","pokemon","61"]);
		bdd.push(["Poliwrath","pokemon","62"]);
		bdd.push(["Abra","pokemon","63"]);
		bdd.push(["Kadabra","pokemon","64"]);
		bdd.push(["Alakazam","pokemon","65"]);
		bdd.push(["Machop","pokemon","66"]);
		bdd.push(["Machoke","pokemon","67"]);
		bdd.push(["Machamp","pokemon","68"]);
		bdd.push(["Bellsprout","pokemon","69"]);
		bdd.push(["Weepinbell","pokemon","70"]);
		bdd.push(["Victreebel","pokemon","71"]);
		bdd.push(["Tentacool","pokemon","72"]);
		bdd.push(["Tentacruel","pokemon","73"]);
		bdd.push(["Geodude","pokemon","74"]);
		bdd.push(["Graveler","pokemon","75"]);
		bdd.push(["Golem","pokemon","76"]);
		bdd.push(["Ponyta","pokemon","77"]);
		bdd.push(["Rapidash","pokemon","78"]);
		bdd.push(["Slowpoke","pokemon","79"]);
		bdd.push(["Slowbro","pokemon","80"]);
		bdd.push(["Magnemite","pokemon","81"]);
		bdd.push(["Magneton","pokemon","82"]);
		bdd.push(["Farfetch'd","pokemon","83"]);
		bdd.push(["Doduo","pokemon","84"]);
		bdd.push(["Dodrio","pokemon","85"]);
		bdd.push(["Seel","pokemon","86"]);
		bdd.push(["Dewgong","pokemon","87"]);
		bdd.push(["Grimer","pokemon","88"]);
		bdd.push(["Muk","pokemon","89"]);
		bdd.push(["Shellder","pokemon","90"]);
		bdd.push(["Cloyster","pokemon","91"]);
		bdd.push(["Gastly","pokemon","92"]);
		bdd.push(["Haunter","pokemon","93"]);
		bdd.push(["Gengar","pokemon","94"]);
		bdd.push(["Onix","pokemon","95"]);
		bdd.push(["Drowzee","pokemon","96"]);
		bdd.push(["Hypno","pokemon","97"]);
		bdd.push(["Krabby","pokemon","98"]);
		bdd.push(["Kingler","pokemon","99"]);
		bdd.push(["Voltorb","pokemon","100"]);
		bdd.push(["Electrode","pokemon","101"]);
		bdd.push(["Exeggcute","pokemon","102"]);
		bdd.push(["Exeggutor","pokemon","103"]);
		bdd.push(["Cubone","pokemon","104"]);
		bdd.push(["Marowak","pokemon","105"]);
		bdd.push(["Hitmonlee","pokemon","106"]);
		bdd.push(["Hitmonchan","pokemon","107"]);
		bdd.push(["Lickitung","pokemon","108"]);
		bdd.push(["Koffing","pokemon","109"]);
		bdd.push(["Weezing","pokemon","110"]);
		bdd.push(["Rhyhorn","pokemon","111"]);
		bdd.push(["Rhydon","pokemon","112"]);
		bdd.push(["Chansey","pokemon","113"]);
		bdd.push(["Tangela","pokemon","114"]);
		bdd.push(["Kangaskhan","pokemon","115"]);
		bdd.push(["Horsea","pokemon","116"]);
		bdd.push(["Seadra","pokemon","117"]);
		bdd.push(["Goldeen","pokemon","118"]);
		bdd.push(["Seaking","pokemon","119"]);
		bdd.push(["Staryu","pokemon","120"]);
		bdd.push(["Starmie","pokemon","121"]);
		bdd.push(["Mr. Mime","pokemon","122"]);
		bdd.push(["Scyther","pokemon","123"]);
		bdd.push(["Jynx","pokemon","124"]);
		bdd.push(["Electabuzz","pokemon","125"]);
		bdd.push(["Magmar","pokemon","126"]);
		bdd.push(["Pinsir","pokemon","127"]);
		bdd.push(["Tauros","pokemon","128"]);
		bdd.push(["Magikarp","pokemon","129"]);
		bdd.push(["Gyarados","pokemon","130"]);
		bdd.push(["Lapras","pokemon","131"]);
		bdd.push(["Ditto","pokemon","132"]);
		bdd.push(["Eevee","pokemon","133"]);
		bdd.push(["Vaporeon","pokemon","134"]);
		bdd.push(["Jolteon","pokemon","135"]);
		bdd.push(["Flareon","pokemon","136"]);
		bdd.push(["Porygon","pokemon","137"]);
		bdd.push(["Omanyte","pokemon","138"]);
		bdd.push(["Omastar","pokemon","139"]);
		bdd.push(["Kabuto","pokemon","140"]);
		bdd.push(["Kabutops","pokemon","141"]);
		bdd.push(["Aerodactyl","pokemon","142"]);
		bdd.push(["Snorlax","pokemon","143"]);
		bdd.push(["Articuno","pokemon","144"]);
		bdd.push(["Zapdos","pokemon","145"]);
		bdd.push(["Moltres","pokemon","146"]);
		bdd.push(["Dratini","pokemon","147"]);
		bdd.push(["Dragonair","pokemon","148"]);
		bdd.push(["Dragonite","pokemon","149"]);
		bdd.push(["Mewtwo","pokemon","150"]);
		bdd.push(["Mew","pokemon","151"]);
		bdd.push(["Chikorita","pokemon","152"]);
		bdd.push(["Bayleef","pokemon","153"]);
		bdd.push(["Meganium","pokemon","154"]);
		bdd.push(["Cyndaquil","pokemon","155"]);
		bdd.push(["Quilava","pokemon","156"]);
		bdd.push(["Typhlosion","pokemon","157"]);
		bdd.push(["Totodile","pokemon","158"]);
		bdd.push(["Croconaw","pokemon","159"]);
		bdd.push(["Feraligatr","pokemon","160"]);
		bdd.push(["Sentret","pokemon","161"]);
		bdd.push(["Furret","pokemon","162"]);
		bdd.push(["Hoothoot","pokemon","163"]);
		bdd.push(["Noctowl","pokemon","164"]);
		bdd.push(["Ledyba","pokemon","165"]);
		bdd.push(["Ledian","pokemon","166"]);
		bdd.push(["Spinarak","pokemon","167"]);
		bdd.push(["Ariados","pokemon","168"]);
		bdd.push(["Crobat","pokemon","169"]);
		bdd.push(["Chinchou","pokemon","170"]);
		bdd.push(["Lanturn","pokemon","171"]);
		bdd.push(["Pichu","pokemon","172"]);
		bdd.push(["Cleffa","pokemon","173"]);
		bdd.push(["Igglybuff","pokemon","174"]);
		bdd.push(["Togepi","pokemon","175"]);
		bdd.push(["Togetic","pokemon","176"]);
		bdd.push(["Natu","pokemon","177"]);
		bdd.push(["Xatu","pokemon","178"]);
		bdd.push(["Mareep","pokemon","179"]);
		bdd.push(["Flaaffy","pokemon","180"]);
		bdd.push(["Ampharos","pokemon","181"]);
		bdd.push(["Bellossom","pokemon","182"]);
		bdd.push(["Marill","pokemon","183"]);
		bdd.push(["Azumarill","pokemon","184"]);
		bdd.push(["Sudowoodo","pokemon","185"]);
		bdd.push(["Politoed","pokemon","186"]);
		bdd.push(["Hoppip","pokemon","187"]);
		bdd.push(["Skiploom","pokemon","188"]);
		bdd.push(["Jumpluff","pokemon","189"]);
		bdd.push(["Aipom","pokemon","190"]);
		bdd.push(["Sunkern","pokemon","191"]);
		bdd.push(["Sunflora","pokemon","192"]);
		bdd.push(["Yanma","pokemon","193"]);
		bdd.push(["Wooper","pokemon","194"]);
		bdd.push(["Quagsire","pokemon","195"]);
		bdd.push(["Espeon","pokemon","196"]);
		bdd.push(["Umbreon","pokemon","197"]);
		bdd.push(["Murkrow","pokemon","198"]);
		bdd.push(["Slowking","pokemon","199"]);
		bdd.push(["Misdreavus","pokemon","200"]);
		bdd.push(["Unown","pokemon","201"]);
		bdd.push(["Wobbuffet","pokemon","202"]);
		bdd.push(["Girafarig","pokemon","203"]);
		bdd.push(["Pineco","pokemon","204"]);
		bdd.push(["Forretress","pokemon","205"]);
		bdd.push(["Dunsparce","pokemon","206"]);
		bdd.push(["Gligar","pokemon","207"]);
		bdd.push(["Steelix","pokemon","208"]);
		bdd.push(["Snubbull","pokemon","209"]);
		bdd.push(["Granbull","pokemon","210"]);
		bdd.push(["Qwilfish","pokemon","211"]);
		bdd.push(["Scizor","pokemon","212"]);
		bdd.push(["Shuckle","pokemon","213"]);
		bdd.push(["Heracross","pokemon","214"]);
		bdd.push(["Sneasel","pokemon","215"]);
		bdd.push(["Teddiursa","pokemon","216"]);
		bdd.push(["Ursaring","pokemon","217"]);
		bdd.push(["Slugma","pokemon","218"]);
		bdd.push(["Magcargo","pokemon","219"]);
		bdd.push(["Swinub","pokemon","220"]);
		bdd.push(["Piloswine","pokemon","221"]);
		bdd.push(["Corsola","pokemon","222"]);
		bdd.push(["Remoraid","pokemon","223"]);
		bdd.push(["Octillery","pokemon","224"]);
		bdd.push(["Delibird","pokemon","225"]);
		bdd.push(["Mantine","pokemon","226"]);
		bdd.push(["Skarmory","pokemon","227"]);
		bdd.push(["Houndour","pokemon","228"]);
		bdd.push(["Houndoom","pokemon","229"]);
		bdd.push(["Kingdra","pokemon","230"]);
		bdd.push(["Phanpy","pokemon","231"]);
		bdd.push(["Donphan","pokemon","232"]);
		bdd.push(["Porygon2","pokemon","233"]);
		bdd.push(["Stantler","pokemon","234"]);
		bdd.push(["Smeargle","pokemon","235"]);
		bdd.push(["Tyrogue","pokemon","236"]);
		bdd.push(["Hitmontop","pokemon","237"]);
		bdd.push(["Smoochum","pokemon","238"]);
		bdd.push(["Elekid","pokemon","239"]);
		bdd.push(["Magby","pokemon","240"]);
		bdd.push(["Miltank","pokemon","241"]);
		bdd.push(["Blissey","pokemon","242"]);
		bdd.push(["Raikou","pokemon","243"]);
		bdd.push(["Entei","pokemon","244"]);
		bdd.push(["Suicune","pokemon","245"]);
		bdd.push(["Larvitar","pokemon","246"]);
		bdd.push(["Pupitar","pokemon","247"]);
		bdd.push(["Tyranitar","pokemon","248"]);
		bdd.push(["Lugia","pokemon","249"]);
		bdd.push(["Ho-oh","pokemon","250"]);
		bdd.push(["Celebi","pokemon","251"]);
		bdd.push(["Treecko","pokemon","252"]);
		bdd.push(["Grovyle","pokemon","253"]);
		bdd.push(["Sceptile","pokemon","254"]);
		bdd.push(["Torchic","pokemon","255"]);
		bdd.push(["Combusken","pokemon","256"]);
		bdd.push(["Blaziken","pokemon","257"]);
		bdd.push(["Mudkip","pokemon","258"]);
		bdd.push(["Marshtomp","pokemon","259"]);
		bdd.push(["Swampert","pokemon","260"]);
		bdd.push(["Poochyena","pokemon","261"]);
		bdd.push(["Mightyena","pokemon","262"]);
		bdd.push(["Zigzagoon","pokemon","263"]);
		bdd.push(["Linoone","pokemon","264"]);
		bdd.push(["Wurmple","pokemon","265"]);
		bdd.push(["Silcoon","pokemon","266"]);
		bdd.push(["Beautifly","pokemon","267"]);
		bdd.push(["Cascoon","pokemon","268"]);
		bdd.push(["Dustox","pokemon","269"]);
		bdd.push(["Lotad","pokemon","270"]);
		bdd.push(["Lombre","pokemon","271"]);
		bdd.push(["Ludicolo","pokemon","272"]);
		bdd.push(["Seedot","pokemon","273"]);
		bdd.push(["Nuzleaf","pokemon","274"]);
		bdd.push(["Shiftry","pokemon","275"]);
		bdd.push(["Taillow","pokemon","276"]);
		bdd.push(["Swellow","pokemon","277"]);
		bdd.push(["Wingull","pokemon","278"]);
		bdd.push(["Pelipper","pokemon","279"]);
		bdd.push(["Ralts","pokemon","280"]);
		bdd.push(["Kirlia","pokemon","281"]);
		bdd.push(["Gardevoir","pokemon","282"]);
		bdd.push(["Surskit","pokemon","283"]);
		bdd.push(["Masquerain","pokemon","284"]);
		bdd.push(["Shroomish","pokemon","285"]);
		bdd.push(["Breloom","pokemon","286"]);
		bdd.push(["Slakoth","pokemon","287"]);
		bdd.push(["Vigoroth","pokemon","288"]);
		bdd.push(["Slaking","pokemon","289"]);
		bdd.push(["Nincada","pokemon","290"]);
		bdd.push(["Ninjask","pokemon","291"]);
		bdd.push(["Shedinja","pokemon","292"]);
		bdd.push(["Whismur","pokemon","293"]);
		bdd.push(["Loudred","pokemon","294"]);
		bdd.push(["Exploud","pokemon","295"]);
		bdd.push(["Makuhita","pokemon","296"]);
		bdd.push(["Hariyama","pokemon","297"]);
		bdd.push(["Azurill","pokemon","298"]);
		bdd.push(["Nosepass","pokemon","299"]);
		bdd.push(["Skitty","pokemon","300"]);
		bdd.push(["Delcatty","pokemon","301"]);
		bdd.push(["Sableye","pokemon","302"]);
		bdd.push(["Mawile","pokemon","303"]);
		bdd.push(["Aron","pokemon","304"]);
		bdd.push(["Lairon","pokemon","305"]);
		bdd.push(["Aggron","pokemon","306"]);
		bdd.push(["Meditite","pokemon","307"]);
		bdd.push(["Medicham","pokemon","308"]);
		bdd.push(["Electrike","pokemon","309"]);
		bdd.push(["Manectric","pokemon","310"]);
		bdd.push(["Plusle","pokemon","311"]);
		bdd.push(["Minun","pokemon","312"]);
		bdd.push(["Volbeat","pokemon","313"]);
		bdd.push(["Illumise","pokemon","314"]);
		bdd.push(["Roselia","pokemon","315"]);
		bdd.push(["Gulpin","pokemon","316"]);
		bdd.push(["Swalot","pokemon","317"]);
		bdd.push(["Carvanha","pokemon","318"]);
		bdd.push(["Sharpedo","pokemon","319"]);
		bdd.push(["Wailmer","pokemon","320"]);
		bdd.push(["Wailord","pokemon","321"]);
		bdd.push(["Numel","pokemon","322"]);
		bdd.push(["Camerupt","pokemon","323"]);
		bdd.push(["Torkoal","pokemon","324"]);
		bdd.push(["Spoink","pokemon","325"]);
		bdd.push(["Grumpig","pokemon","326"]);
		bdd.push(["Spinda","pokemon","327"]);
		bdd.push(["Trapinch","pokemon","328"]);
		bdd.push(["Vibrava","pokemon","329"]);
		bdd.push(["Flygon","pokemon","330"]);
		bdd.push(["Cacnea","pokemon","331"]);
		bdd.push(["Cacturne","pokemon","332"]);
		bdd.push(["Swablu","pokemon","333"]);
		bdd.push(["Altaria","pokemon","334"]);
		bdd.push(["Zangoose","pokemon","335"]);
		bdd.push(["Seviper","pokemon","336"]);
		bdd.push(["Lunatone","pokemon","337"]);
		bdd.push(["Solrock","pokemon","338"]);
		bdd.push(["Barboach","pokemon","339"]);
		bdd.push(["Whiscash","pokemon","340"]);
		bdd.push(["Corphish","pokemon","341"]);
		bdd.push(["Crawdaunt","pokemon","342"]);
		bdd.push(["Baltoy","pokemon","343"]);
		bdd.push(["Claydol","pokemon","344"]);
		bdd.push(["Lileep","pokemon","345"]);
		bdd.push(["Cradily","pokemon","346"]);
		bdd.push(["Anorith","pokemon","347"]);
		bdd.push(["Armaldo","pokemon","348"]);
		bdd.push(["Feebas","pokemon","349"]);
		bdd.push(["Milotic","pokemon","350"]);
		bdd.push(["Castform","pokemon","351"]);
		bdd.push(["Kecleon","pokemon","352"]);
		bdd.push(["Shuppet","pokemon","353"]);
		bdd.push(["Banette","pokemon","354"]);
		bdd.push(["Duskull","pokemon","355"]);
		bdd.push(["Dusclops","pokemon","356"]);
		bdd.push(["Tropius","pokemon","357"]);
		bdd.push(["Chimecho","pokemon","358"]);
		bdd.push(["Absol","pokemon","359"]);
		bdd.push(["Wynaut","pokemon","360"]);
		bdd.push(["Snorunt","pokemon","361"]);
		bdd.push(["Glalie","pokemon","362"]);
		bdd.push(["Spheal","pokemon","363"]);
		bdd.push(["Sealeo","pokemon","364"]);
		bdd.push(["Walrein","pokemon","365"]);
		bdd.push(["Clamperl","pokemon","366"]);
		bdd.push(["Huntail","pokemon","367"]);
		bdd.push(["Gorebyss","pokemon","368"]);
		bdd.push(["Relicanth","pokemon","369"]);
		bdd.push(["Luvdisc","pokemon","370"]);
		bdd.push(["Bagon","pokemon","371"]);
		bdd.push(["Shelgon","pokemon","372"]);
		bdd.push(["Salamence","pokemon","373"]);
		bdd.push(["Beldum","pokemon","374"]);
		bdd.push(["Metang","pokemon","375"]);
		bdd.push(["Metagross","pokemon","376"]);
		bdd.push(["Regirock","pokemon","377"]);
		bdd.push(["Regice","pokemon","378"]);
		bdd.push(["Registeel","pokemon","379"]);
		bdd.push(["Latias","pokemon","380"]);
		bdd.push(["Latios","pokemon","381"]);
		bdd.push(["Kyogre","pokemon","382"]);
		bdd.push(["Groudon","pokemon","383"]);
		bdd.push(["Rayquaza","pokemon","384"]);
		bdd.push(["Jirachi","pokemon","385"]);
		bdd.push(["Deoxys","pokemon","386"]);
		bdd.push(["Turtwig","pokemon","387"]);
		bdd.push(["Grotle","pokemon","388"]);
		bdd.push(["Torterra","pokemon","389"]);
		bdd.push(["Chimchar","pokemon","390"]);
		bdd.push(["Monferno","pokemon","391"]);
		bdd.push(["Infernape","pokemon","392"]);
		bdd.push(["Piplup","pokemon","393"]);
		bdd.push(["Prinplup","pokemon","394"]);
		bdd.push(["Empoleon","pokemon","395"]);
		bdd.push(["Starly","pokemon","396"]);
		bdd.push(["Staravia","pokemon","397"]);
		bdd.push(["Staraptor","pokemon","398"]);
		bdd.push(["Bidoof","pokemon","399"]);
		bdd.push(["Bibarel","pokemon","400"]);
		bdd.push(["Kricketot","pokemon","401"]);
		bdd.push(["Kricketune","pokemon","402"]);
		bdd.push(["Shinx","pokemon","403"]);
		bdd.push(["Luxio","pokemon","404"]);
		bdd.push(["Luxray","pokemon","405"]);
		bdd.push(["Budew","pokemon","406"]);
		bdd.push(["Roserade","pokemon","407"]);
		bdd.push(["Cranidos","pokemon","408"]);
		bdd.push(["Rampardos","pokemon","409"]);
		bdd.push(["Shieldon","pokemon","410"]);
		bdd.push(["Bastiodon","pokemon","411"]);
		bdd.push(["Burmy","pokemon","412"]);
		bdd.push(["Wormadam","pokemon","413"]);
		bdd.push(["Mothim","pokemon","414"]);
		bdd.push(["Combee","pokemon","415"]);
		bdd.push(["Vespiquen","pokemon","416"]);
		bdd.push(["Pachirisu","pokemon","417"]);
		bdd.push(["Buizel","pokemon","418"]);
		bdd.push(["Floatzel","pokemon","419"]);
		bdd.push(["Cherubi","pokemon","420"]);
		bdd.push(["Cherrim","pokemon","421"]);
		bdd.push(["Shellos","pokemon","422"]);
		bdd.push(["Gastrodon","pokemon","423"]);
		bdd.push(["Ambipom","pokemon","424"]);
		bdd.push(["Drifloon","pokemon","425"]);
		bdd.push(["Drifblim","pokemon","426"]);
		bdd.push(["Buneary","pokemon","427"]);
		bdd.push(["Lopunny","pokemon","428"]);
		bdd.push(["Mismagius","pokemon","429"]);
		bdd.push(["Honchkrow","pokemon","430"]);
		bdd.push(["Glameow","pokemon","431"]);
		bdd.push(["Purugly","pokemon","432"]);
		bdd.push(["Chingling","pokemon","433"]);
		bdd.push(["Stunky","pokemon","434"]);
		bdd.push(["Skuntank","pokemon","435"]);
		bdd.push(["Bronzor","pokemon","436"]);
		bdd.push(["Bronzong","pokemon","437"]);
		bdd.push(["Bonsly","pokemon","438"]);
		bdd.push(["Mime Jr.","pokemon","439"]);
		bdd.push(["Happiny","pokemon","440"]);
		bdd.push(["Chatot","pokemon","441"]);
		bdd.push(["Spiritomb","pokemon","442"]);
		bdd.push(["Gible","pokemon","443"]);
		bdd.push(["Gabite","pokemon","444"]);
		bdd.push(["Garchomp","pokemon","445"]);
		bdd.push(["Munchlax","pokemon","446"]);
		bdd.push(["Riolu","pokemon","447"]);
		bdd.push(["Lucario","pokemon","448"]);
		bdd.push(["Hippopotas","pokemon","449"]);
		bdd.push(["Hippowdon","pokemon","450"]);
		bdd.push(["Skorupi","pokemon","451"]);
		bdd.push(["Drapion","pokemon","452"]);
		bdd.push(["Croagunk","pokemon","453"]);
		bdd.push(["Toxicroak","pokemon","454"]);
		bdd.push(["Carnivine","pokemon","455"]);
		bdd.push(["Finneon","pokemon","456"]);
		bdd.push(["Lumineon","pokemon","457"]);
		bdd.push(["Mantyke","pokemon","458"]);
		bdd.push(["Snover","pokemon","459"]);
		bdd.push(["Abomasnow","pokemon","460"]);
		bdd.push(["Weavile","pokemon","461"]);
		bdd.push(["Magnezone","pokemon","462"]);
		bdd.push(["Lickilicky","pokemon","463"]);
		bdd.push(["Rhyperior","pokemon","464"]);
		bdd.push(["Tangrowth","pokemon","465"]);
		bdd.push(["Electivire","pokemon","466"]);
		bdd.push(["Magmortar","pokemon","467"]);
		bdd.push(["Togekiss","pokemon","468"]);
		bdd.push(["Yanmega","pokemon","469"]);
		bdd.push(["Leafeon","pokemon","470"]);
		bdd.push(["Glaceon","pokemon","471"]);
		bdd.push(["Gliscor","pokemon","472"]);
		bdd.push(["Mamoswine","pokemon","473"]);
		bdd.push(["Porygon-Z","pokemon","474"]);
		bdd.push(["Gallade","pokemon","475"]);
		bdd.push(["Probopass","pokemon","476"]);
		bdd.push(["Dusknoir","pokemon","477"]);
		bdd.push(["Froslass","pokemon","478"]);
		bdd.push(["Rotom","pokemon","479"]);
		bdd.push(["Uxie","pokemon","480"]);
		bdd.push(["Mesprit","pokemon","481"]);
		bdd.push(["Azelf","pokemon","482"]);
		bdd.push(["Dialga","pokemon","483"]);
		bdd.push(["Palkia","pokemon","484"]);
		bdd.push(["Heatran","pokemon","485"]);
		bdd.push(["Regigigas","pokemon","486"]);
		bdd.push(["Giratina","pokemon","487"]);
		bdd.push(["Cresselia","pokemon","488"]);
		bdd.push(["Phione","pokemon","489"]);
		bdd.push(["Manaphy","pokemon","490"]);
		bdd.push(["Darkrai","pokemon","491"]);
		bdd.push(["Shaymin","pokemon","492"]);
		bdd.push(["Arceus","pokemon","493"]);
		bdd.push(["Victini","pokemon","494"]);
		bdd.push(["Snivy","pokemon","495"]);
		bdd.push(["Servine","pokemon","496"]);
		bdd.push(["Serperior","pokemon","497"]);
		bdd.push(["Tepig","pokemon","498"]);
		bdd.push(["Pignite","pokemon","499"]);
		bdd.push(["Emboar","pokemon","500"]);
		bdd.push(["Oshawott","pokemon","501"]);
		bdd.push(["Dewott","pokemon","502"]);
		bdd.push(["Samurott","pokemon","503"]);
		bdd.push(["Patrat","pokemon","504"]);
		bdd.push(["Watchog","pokemon","505"]);
		bdd.push(["Lillipup","pokemon","506"]);
		bdd.push(["Herdier","pokemon","507"]);
		bdd.push(["Stoutland","pokemon","508"]);
		bdd.push(["Purrloin","pokemon","509"]);
		bdd.push(["Liepard","pokemon","510"]);
		bdd.push(["Pansage","pokemon","511"]);
		bdd.push(["Simisage","pokemon","512"]);
		bdd.push(["Pansear","pokemon","513"]);
		bdd.push(["Simisear","pokemon","514"]);
		bdd.push(["Panpour","pokemon","515"]);
		bdd.push(["Simipour","pokemon","516"]);
		bdd.push(["Munna","pokemon","517"]);
		bdd.push(["Musharna","pokemon","518"]);
		bdd.push(["Pidove","pokemon","519"]);
		bdd.push(["Tranquill","pokemon","520"]);
		bdd.push(["Unfezant","pokemon","521"]);
		bdd.push(["Blitzle","pokemon","522"]);
		bdd.push(["Zebstrika","pokemon","523"]);
		bdd.push(["Roggenrola","pokemon","524"]);
		bdd.push(["Boldore","pokemon","525"]);
		bdd.push(["Gigalith","pokemon","526"]);
		bdd.push(["Woobat","pokemon","527"]);
		bdd.push(["Swoobat","pokemon","528"]);
		bdd.push(["Drilbur","pokemon","529"]);
		bdd.push(["Excadrill","pokemon","530"]);
		bdd.push(["Audino","pokemon","531"]);
		bdd.push(["Timburr","pokemon","532"]);
		bdd.push(["Gurdurr","pokemon","533"]);
		bdd.push(["Conkeldurr","pokemon","534"]);
		bdd.push(["Tympole","pokemon","535"]);
		bdd.push(["Palpitoad","pokemon","536"]);
		bdd.push(["Seismitoad","pokemon","537"]);
		bdd.push(["Throh","pokemon","538"]);
		bdd.push(["Sawk","pokemon","539"]);
		bdd.push(["Sewaddle","pokemon","540"]);
		bdd.push(["Swadloon","pokemon","541"]);
		bdd.push(["Leavanny","pokemon","542"]);
		bdd.push(["Venipede","pokemon","543"]);
		bdd.push(["Whirlipede","pokemon","544"]);
		bdd.push(["Scolipede","pokemon","545"]);
		bdd.push(["Cottonee","pokemon","546"]);
		bdd.push(["Whimsicott","pokemon","547"]);
		bdd.push(["Petilil","pokemon","548"]);
		bdd.push(["Lilligant","pokemon","549"]);
		bdd.push(["Basculin","pokemon","550"]);
		bdd.push(["Sandile","pokemon","551"]);
		bdd.push(["Krokorok","pokemon","552"]);
		bdd.push(["Krookodile","pokemon","553"]);
		bdd.push(["Darumaka","pokemon","554"]);
		bdd.push(["Darmanitan","pokemon","555"]);
		bdd.push(["Maractus","pokemon","556"]);
		bdd.push(["Dwebble","pokemon","557"]);
		bdd.push(["Crustle","pokemon","558"]);
		bdd.push(["Scraggy","pokemon","559"]);
		bdd.push(["Scrafty","pokemon","560"]);
		bdd.push(["Sigilyph","pokemon","561"]);
		bdd.push(["Yamask","pokemon","562"]);
		bdd.push(["Cofagrigus","pokemon","563"]);
		bdd.push(["Tirtouga","pokemon","564"]);
		bdd.push(["Carracosta","pokemon","565"]);
		bdd.push(["Archen","pokemon","566"]);
		bdd.push(["Archeops","pokemon","567"]);
		bdd.push(["Trubbish","pokemon","568"]);
		bdd.push(["Garbodor","pokemon","569"]);
		bdd.push(["Zorua","pokemon","570"]);
		bdd.push(["Zoroark","pokemon","571"]);
		bdd.push(["Minccino","pokemon","572"]);
		bdd.push(["Cinccino","pokemon","573"]);
		bdd.push(["Gothita","pokemon","574"]);
		bdd.push(["Gothorita","pokemon","575"]);
		bdd.push(["Gothitelle","pokemon","576"]);
		bdd.push(["Solosis","pokemon","577"]);
		bdd.push(["Duosion","pokemon","578"]);
		bdd.push(["Reuniclus","pokemon","579"]);
		bdd.push(["Ducklett","pokemon","580"]);
		bdd.push(["Swanna","pokemon","581"]);
		bdd.push(["Vanillite","pokemon","582"]);
		bdd.push(["Vanillish","pokemon","583"]);
		bdd.push(["Vanilluxe","pokemon","584"]);
		bdd.push(["Deerling","pokemon","585"]);
		bdd.push(["Sawsbuck","pokemon","586"]);
		bdd.push(["Emolga","pokemon","587"]);
		bdd.push(["Karrablast","pokemon","588"]);
		bdd.push(["Escavalier","pokemon","589"]);
		bdd.push(["Foongus","pokemon","590"]);
		bdd.push(["Amoonguss","pokemon","591"]);
		bdd.push(["Frillish","pokemon","592"]);
		bdd.push(["Jellicent","pokemon","593"]);
		bdd.push(["Alomomola","pokemon","594"]);
		bdd.push(["Joltik","pokemon","595"]);
		bdd.push(["Galvantula","pokemon","596"]);
		bdd.push(["Ferroseed","pokemon","597"]);
		bdd.push(["Ferrothorn","pokemon","598"]);
		bdd.push(["Klink","pokemon","599"]);
		bdd.push(["Klang","pokemon","600"]);
		bdd.push(["Klinklang","pokemon","601"]);
		bdd.push(["Tynamo","pokemon","602"]);
		bdd.push(["Eelektrik","pokemon","603"]);
		bdd.push(["Eelektross","pokemon","604"]);
		bdd.push(["Elgyem","pokemon","605"]);
		bdd.push(["Beheeyem","pokemon","606"]);
		bdd.push(["Litwick","pokemon","607"]);
		bdd.push(["Lampent","pokemon","608"]);
		bdd.push(["Chandelure","pokemon","609"]);
		bdd.push(["Axew","pokemon","610"]);
		bdd.push(["Fraxure","pokemon","611"]);
		bdd.push(["Haxorus","pokemon","612"]);
		bdd.push(["Cubchoo","pokemon","613"]);
		bdd.push(["Beartic","pokemon","614"]);
		bdd.push(["Cryogonal","pokemon","615"]);
		bdd.push(["Shelmet","pokemon","616"]);
		bdd.push(["Accelgor","pokemon","617"]);
		bdd.push(["Stunfisk","pokemon","618"]);
		bdd.push(["Mienfoo","pokemon","619"]);
		bdd.push(["Mienshao","pokemon","620"]);
		bdd.push(["Druddigon","pokemon","621"]);
		bdd.push(["Golett","pokemon","622"]);
		bdd.push(["Golurk","pokemon","623"]);
		bdd.push(["Pawniard","pokemon","624"]);
		bdd.push(["Bisharp","pokemon","625"]);
		bdd.push(["Bouffalant","pokemon","626"]);
		bdd.push(["Rufflet","pokemon","627"]);
		bdd.push(["Braviary","pokemon","628"]);
		bdd.push(["Vullaby","pokemon","629"]);
		bdd.push(["Mandibuzz","pokemon","630"]);
		bdd.push(["Heatmor","pokemon","631"]);
		bdd.push(["Durant","pokemon","632"]);
		bdd.push(["Deino","pokemon","633"]);
		bdd.push(["Zweilous","pokemon","634"]);
		bdd.push(["Hydreigon","pokemon","635"]);
		bdd.push(["Larvesta","pokemon","636"]);
		bdd.push(["Volcarona","pokemon","637"]);
		bdd.push(["Cobalion","pokemon","638"]);
		bdd.push(["Terrakion","pokemon","639"]);
		bdd.push(["Virizion","pokemon","640"]);
		bdd.push(["Tornadus","pokemon","641"]);
		bdd.push(["Thundurus","pokemon","642"]);
		bdd.push(["Reshiram","pokemon","643"]);
		bdd.push(["Zekrom","pokemon","644"]);
		bdd.push(["Landorus","pokemon","645"]);
		bdd.push(["Kyurem","pokemon","646"]);
		bdd.push(["Keldeo","pokemon","647"]);
		bdd.push(["Meloetta","pokemon","648"]);
		bdd.push(["Genesect","pokemon","649"]);
		bdd.push(["Quash","attaque","1","3"]);
		bdd.push(["Fissure","attaque","2","1"]);
		bdd.push(["Snarl","attaque","3","2"]);
		bdd.push(["Protect","attaque","4","3"]);
		bdd.push(["Acid Armor","attaque","5","3"]);
		bdd.push(["Acid","attaque","6","2"]);
		bdd.push(["Acrobatics","attaque","7","1"]);
		bdd.push(["Acupressure","attaque","8","3"]);
		bdd.push(["Conversion","attaque","9","3"]);
		bdd.push(["Aeroblast","attaque","10","2"]);
		bdd.push(["Aerial Ace","attaque","11","1"]);
		bdd.push(["Sharpen","attaque","12","3"]);
		bdd.push(["Hone Claws","attaque","13","3"]);
		bdd.push(["Steel Wing","attaque","14","1"]);
		bdd.push(["Lucky Chant","attaque","15","3"]);
		bdd.push(["Water Pledge","attaque","16","2"]);
		bdd.push(["Grass Pledge","attaque","17","2"]);
		bdd.push(["Fire Pledge","attaque","18","2"]);
		bdd.push(["Autotomize","attaque","19","3"]);
		bdd.push(["Amnesia","attaque","20","3"]);
		bdd.push(["Magnitude","attaque","21","1"]);
		bdd.push(["Aqua Ring","attaque","22","3"]);
		bdd.push(["Smack Down","attaque","23","1"]);
		bdd.push(["Defog","attaque","24","3"]);
		bdd.push(["Heal Block","attaque","25","3"]);
		bdd.push(["Attack Order","attaque","26","1"]);
		bdd.push(["Defend Order","attaque","27","3"]);
		bdd.push(["Heal Order","attaque","28","3"]);
		bdd.push(["After You","attaque","29","3"]);
		bdd.push(["Aqua Jet","attaque","30","1"]);
		bdd.push(["Harden","attaque","31","3"]);
		bdd.push(["Aromatherapy","attaque","32","3"]);
		bdd.push(["Assist","attaque","33","3"]);
		bdd.push(["Assurance","attaque","34","1"]);
		bdd.push(["Power Trick","attaque","35","3"]);
		bdd.push(["Trump Card","attaque","36","2"]);
		bdd.push(["Roost","attaque","37","3"]);
		bdd.push(["Attract","attaque","38","3"]);
		bdd.push(["Chip Away","attaque","39","1"]);
		bdd.push(["Aura Sphere","attaque","40","2"]);
		bdd.push(["Morning Sun","attaque","41","3"]);
		bdd.push(["Avalanche","attaque","42","1"]);
		bdd.push(["Swallow","attaque","43","3"]);
		bdd.push(["Chatter","attaque","44","2"]);
		bdd.push(["Yawn","attaque","45","3"]);
		bdd.push(["Clear Smog","attaque","46","2"]);
		bdd.push(["Pain Split","attaque","47","3"]);
		bdd.push(["Low Kick","attaque","48","1"]);
		bdd.push(["Low Sweep","attaque","49","1"]);
		bdd.push(["Mist Ball","attaque","50","2"]);
		bdd.push(["Ice Ball","attaque","51","1"]);
		bdd.push(["Weather Ball","attaque","52","2"]);
		bdd.push(["Shadow Ball","attaque","53","2"]);
		bdd.push(["Bullet Seed","attaque","54","1"]);
		bdd.push(["Block","attaque","55","3"]);
		bdd.push(["Beat Up","attaque","56","1"]);
		bdd.push(["Drill Peck","attaque","57","1"]);
		bdd.push(["Take Down","attaque","58","1"]);
		bdd.push(["Sing","attaque","59","3"]);
		bdd.push(["Sleep Talk","attaque","60","3"]);
		bdd.push(["Blizzard","attaque","61","2"]);
		bdd.push(["Fake Out","attaque","62","1"]);
		bdd.push(["Egg Bomb","attaque","63","1"]);
		bdd.push(["Sludge Bomb","attaque","64","2"]);
		bdd.push(["Magnet Bomb","attaque","65","1"]);
		bdd.push(["Acid Spray","attaque","66","2"]);
		bdd.push(["Psych Up","attaque","67","3"]);
		bdd.push(["Barrier","attaque","68","3"]);
		bdd.push(["Mud Bomb","attaque","69","2"]);
		bdd.push(["Defense Curl","attaque","70","3"]);
		bdd.push(["Electro Ball","attaque","71","2"]);
		bdd.push(["Rock Blast","attaque","72","1"]);
		bdd.push(["Bug Buzz","attaque","73","2"]);
		bdd.push(["Flare Blitz","attaque","74","1"]);
		bdd.push(["Uproar","attaque","75","2"]);
		bdd.push(["Smokescreen","attaque","76","3"]);
		bdd.push(["Mist","attaque","77","3"]);
		bdd.push(["Haze","attaque","78","3"]);
		bdd.push(["Steamroller","attaque","79","1"]);
		bdd.push(["Bubblebeam","attaque","80","2"]);
		bdd.push(["Present","attaque","81","1"]);
		bdd.push(["Thunder Wave","attaque","82","3"]);
		bdd.push(["Incinerate","attaque","83","2"]);
		bdd.push(["Camouflage","attaque","84","3"]);
		bdd.push(["Heat Wave","attaque","85","2"]);
		bdd.push(["Seed Bomb","attaque","86","1"]);
		bdd.push(["Doom Desire","attaque","87","2"]);
		bdd.push(["Waterfall","attaque","88","1"]);
		bdd.push(["Brick Break","attaque","89","1"]);
		bdd.push(["Nightmare","attaque","90","3"]);
		bdd.push(["Volt Switch","attaque","91","2"]);
		bdd.push(["Round","attaque","92","2"]);
		bdd.push(["Relic Song","attaque","93","2"]);
		bdd.push(["Tackle","attaque","94","1"]);
		bdd.push(["Bone Rush","attaque","95","1"]);
		bdd.push(["Bolt Strike","attaque","96","1"]);
		bdd.push(["Charge","attaque","97","3"]);
		bdd.push(["Charm","attaque","98","3"]);
		bdd.push(["Hex","attaque","99","2"]);
		bdd.push(["Tickle","attaque","100","3"]);
		bdd.push(["Shift Gear","attaque","101","3"]);
		bdd.push(["Confusion","attaque","102","2"]);
		bdd.push(["Psyshock","attaque","103","2"]);
		bdd.push(["Venoshock","attaque","104","2"]);
		bdd.push(["Icicle Crash","attaque","105","1"]);
		bdd.push(["Sky Drop","attaque","106","1"]);
		bdd.push(["Foresight","attaque","107","3"]);
		bdd.push(["Clamp","attaque","108","1"]);
		bdd.push(["Substitute","attaque","109","3"]);
		bdd.push(["Close Combat","attaque","110","1"]);
		bdd.push(["Arm Thrust","attaque","111","1"]);
		bdd.push(["Belly Drum","attaque","112","3"]);
		bdd.push(["Outrage","attaque","113","1"]);
		bdd.push(["Fury Swipes","attaque","114","1"]);
		bdd.push(["Constrict","attaque","115","1"]);
		bdd.push(["Reversal","attaque","116","1"]);
		bdd.push(["Conversion 2","attaque","117","3"]);
		bdd.push(["Mimic","attaque","118","3"]);
		bdd.push(["Reflect Type","attaque","119","3"]);
		bdd.push(["Razor Shell","attaque","120","1"]);
		bdd.push(["Vital Throw","attaque","121","1"]);
		bdd.push(["Cotton Guard","attaque","122","3"]);
		bdd.push(["Mud-Slap","attaque","123","2"]);
		bdd.push(["Skull Bash","attaque","124","1"]);
		bdd.push(["Sucker Punch","attaque","125","1"]);
		bdd.push(["Headbutt","attaque","126","1"]);
		bdd.push(["Discharge","attaque","127","2"]);
		bdd.push(["Helping Hand","attaque","128","3"]);
		bdd.push(["Double Hit","attaque","129","1"]);
		bdd.push(["Cross Chop","attaque","130","1"]);
		bdd.push(["Cut","attaque","131","1"]);
		bdd.push(["Psycho Cut","attaque","132","1"]);
		bdd.push(["Razor Wind","attaque","133","2"]);
		bdd.push(["V-create","attaque","134","1"]);
		bdd.push(["Sludge Wave","attaque","135","2"]);
		bdd.push(["Heart Stamp","attaque","136","1"]);
		bdd.push(["Hyper Fang","attaque","137","1"]);
		bdd.push(["Super Fang","attaque","138","1"]);
		bdd.push(["Poison Fang","attaque","139","1"]);
		bdd.push(["Fake Tears","attaque","140","3"]);
		bdd.push(["Thunder Fang","attaque","141","1"]);
		bdd.push(["Fire Fang","attaque","142","1"]);
		bdd.push(["Ice Fang","attaque","143","1"]);
		bdd.push(["Growth","attaque","144","3"]);
		bdd.push(["Wing Attack","attaque","145","1"]);
		bdd.push(["Whirlwind","attaque","146","3"]);
		bdd.push(["Double-Edge","attaque","147","1"]);
		bdd.push(["Dragon Dance","attaque","148","3"]);
		bdd.push(["Fiery Dance","attaque","149","2"]);
		bdd.push(["Rain Dance","attaque","150","3"]);
		bdd.push(["Petal Dance","attaque","151","2"]);
		bdd.push(["Teeter Dance","attaque","152","3"]);
		bdd.push(["Swords Dance","attaque","153","3"]);
		bdd.push(["Lunar Dance","attaque","154","3"]);
		bdd.push(["Featherdance","attaque","155","3"]);
		bdd.push(["Fire Spin","attaque","156","2"]);
		bdd.push(["Pin Missile","attaque","157","1"]);
		bdd.push(["Poison Sting","attaque","158","1"]);
		bdd.push(["Fire Blast","attaque","159","2"]);
		bdd.push(["Fling","attaque","160","1"]);
		bdd.push(["U-turn","attaque","161","1"]);
		bdd.push(["Spite","attaque","162","3"]);
		bdd.push(["Last Resort","attaque","163","1"]);
		bdd.push(["Selfdestruct","attaque","164","1"]);
		bdd.push(["Detect","attaque","165","3"]);
		bdd.push(["Soak","attaque","166","3"]);
		bdd.push(["Gunk Shot","attaque","167","1"]);
		bdd.push(["Sludge","attaque","168","2"]);
		bdd.push(["Dream Eater","attaque","169","2"]);
		bdd.push(["Poison Jab","attaque","170","1"]);
		bdd.push(["Trick Room","attaque","171","3"]);
		bdd.push(["Natural Gift","attaque","172","1"]);
		bdd.push(["Dual Chop","attaque","173","1"]);
		bdd.push(["Double Kick","attaque","174","1"]);
		bdd.push(["Twineedle","attaque","175","1"]);
		bdd.push(["Sweet Kiss","attaque","176","3"]);
		bdd.push(["Sweet Scent","attaque","177","3"]);
		bdd.push(["Draco Meteor","attaque","178","2"]);
		bdd.push(["Dragon Tail","attaque","179","1"]);
		bdd.push(["Dragon Rage","attaque","180","2"]);
		bdd.push(["Dragon Rush","attaque","181","1"]);
		bdd.push(["Dragon Pulse","attaque","182","2"]);
		bdd.push(["Dragon Claw","attaque","183","1"]);
		bdd.push(["Dragonbreath","attaque","184","2"]);
		bdd.push(["Dynamicpunch","attaque","185","1"]);
		bdd.push(["Softboiled","attaque","186","3"]);
		bdd.push(["Rock Slide","attaque","187","1"]);
		bdd.push(["Lava Plume","attaque","188","2"]);
		bdd.push(["Scald","attaque","189","2"]);
		bdd.push(["Skill Swap","attaque","190","3"]);
		bdd.push(["Psycho Shift","attaque","191","3"]);
		bdd.push(["Echoed Voice","attaque","192","2"]);
		bdd.push(["Thundershock","attaque","193","2"]);
		bdd.push(["Fusion Bolt","attaque","194","1"]);
		bdd.push(["Wild Charge","attaque","195","1"]);
		bdd.push(["Ice Burn","attaque","196","2"]);
		bdd.push(["Rock Smash","attaque","197","1"]);
		bdd.push(["Crush Claw","attaque","198","1"]);
		bdd.push(["Ice Shard","attaque","199","1"]);
		bdd.push(["Energy Ball","attaque","200","2"]);
		bdd.push(["Pound","attaque","201","1"]);
		bdd.push(["Stomp","attaque","202","1"]);
		bdd.push(["Bubble","attaque","203","2"]);
		bdd.push(["Endeavor","attaque","204","1"]);
		bdd.push(["Zap Cannon","attaque","205","2"]);
		bdd.push(["Volt Tackle","attaque","206","1"]);
		bdd.push(["Embargo","attaque","207","3"]);
		bdd.push(["Horn Drill","attaque","208","1"]);
		bdd.push(["Encore","attaque","209","3"]);
		bdd.push(["Horn Leech","attaque","210","1"]);
		bdd.push(["Coil","attaque","211","3"]);
		bdd.push(["Disable","attaque","212","3"]);
		bdd.push(["Glaciate","attaque","213","2"]);
		bdd.push(["Eruption","attaque","214","2"]);
		bdd.push(["Rock Climb","attaque","215","1"]);
		bdd.push(["Wring Out","attaque","216","2"]);
		bdd.push(["Spark","attaque","217","1"]);
		bdd.push(["Astonish","attaque","218","1"]);
		bdd.push(["Bind","attaque","219","1"]);
		bdd.push(["Focus Blast","attaque","220","2"]);
		bdd.push(["Night Daze","attaque","221","2"]);
		bdd.push(["Explosion","attaque","222","1"]);
		bdd.push(["Extrasensory","attaque","223","2"]);
		bdd.push(["Shell Smash","attaque","224","3"]);
		bdd.push(["Facade","attaque","225","1"]);
		bdd.push(["Thunder","attaque","226","2"]);
		bdd.push(["False Swipe","attaque","227","1"]);
		bdd.push(["Faint Attack","attaque","228","1"]);
		bdd.push(["Inferno","attaque","229","2"]);
		bdd.push(["Will-O-Wisp","attaque","230","3"]);
		bdd.push(["Freeze Shock","attaque","231","1"]);
		bdd.push(["Sacred Fire","attaque","232","1"]);
		bdd.push(["Magical Leaf","attaque","233","2"]);
		bdd.push(["Odor Sleuth","attaque","234","3"]);
		bdd.push(["Blue Flare","attaque","235","2"]);
		bdd.push(["Fusion Flare","attaque","236","2"]);
		bdd.push(["Ember","attaque","237","2"]);
		bdd.push(["Flash","attaque","238","3"]);
		bdd.push(["Flatter","attaque","239","3"]);
		bdd.push(["Flail","attaque","240","1"]);
		bdd.push(["Strength","attaque","241","1"]);
		bdd.push(["Secret Power","attaque","242","1"]);
		bdd.push(["Cosmic Power","attaque","243","3"]);
		bdd.push(["Vicegrip","attaque","244","1"]);
		bdd.push(["Nature Power","attaque","245","3"]);
		bdd.push(["Stored Power","attaque","246","2"]);
		bdd.push(["Force Palm","attaque","247","1"]);
		bdd.push(["Vine Whip","attaque","248","1"]);
		bdd.push(["Head Smash","attaque","249","1"]);
		bdd.push(["Seismic Toss","attaque","250","1"]);
		bdd.push(["Psystrike","attaque","251","2"]);
		bdd.push(["Rage","attaque","252","1"]);
		bdd.push(["Frustration","attaque","253","1"]);
		bdd.push(["Metal Burst","attaque","254","1"]);
		bdd.push(["Seed Flare","attaque","255","2"]);
		bdd.push(["Fury Attack","attaque","256","1"]);
		bdd.push(["Wide Guard","attaque","257","3"]);
		bdd.push(["Poison Gas","attaque","258","3"]);
		bdd.push(["Water Spout","attaque","259","2"]);
		bdd.push(["Giga Impact","attaque","260","1"]);
		bdd.push(["Giga Drain","attaque","261","2"]);
		bdd.push(["Sheer Cold","attaque","262","2"]);
		bdd.push(["Heal Bell","attaque","263","3"]);
		bdd.push(["Bulk Up","attaque","264","3"]);
		bdd.push(["Gravity","attaque","265","3"]);
		bdd.push(["Hail","attaque","266","3"]);
		bdd.push(["Sketch","attaque","267","3"]);
		bdd.push(["Scratch","attaque","268","1"]);
		bdd.push(["Metal Claw","attaque","269","1"]);
		bdd.push(["Shadow Claw","attaque","270","1"]);
		bdd.push(["Scary Face","attaque","271","3"]);
		bdd.push(["Screech","attaque","272","3"]);
		bdd.push(["Lovely Kiss","attaque","273","3"]);
		bdd.push(["Howl","attaque","274","3"]);
		bdd.push(["Leer","attaque","275","3"]);
		bdd.push(["Guillotine","attaque","276","1"]);
		bdd.push(["Gyro Ball","attaque","277","1"]);
		bdd.push(["Agility","attaque","278","3"]);
		bdd.push(["Roar Of Time","attaque","279","2"]);
		bdd.push(["Roar","attaque","280","3"]);
		bdd.push(["Hydro Cannon","attaque","281","2"]);
		bdd.push(["Hydro Pump","attaque","282","2"]);
		bdd.push(["Aqua Tail","attaque","283","1"]);
		bdd.push(["Hypnosis","attaque","284","3"]);
		bdd.push(["Role Play","attaque","285","3"]);
		bdd.push(["Covet","attaque","286","1"]);
		bdd.push(["Searing Shot","attaque","287","2"]);
		bdd.push(["Ally Switch","attaque","288","3"]);
		bdd.push(["Glare","attaque","289","3"]);
		bdd.push(["Pay Day","attaque","290","1"]);
		bdd.push(["Sand-Attack","attaque","291","3"]);
		bdd.push(["Rock Throw","attaque","292","1"]);
		bdd.push(["Judgment","attaque","293","2"]);
		bdd.push(["Horn Attack","attaque","294","1"]);
		bdd.push(["Milk Drink","attaque","295","3"]);
		bdd.push(["Air Slash","attaque","296","2"]);
		bdd.push(["Stone Edge","attaque","297","1"]);
		bdd.push(["Secret Sword","attaque","298","2"]);
		bdd.push(["Sacred Sword","attaque","299","1"]);
		bdd.push(["Leaf Blade","attaque","300","1"]);
		bdd.push(["Mud Sport","attaque","301","3"]);
		bdd.push(["Flamethrower","attaque","302","2"]);
		bdd.push(["Solarbeam","attaque","303","2"]);
		bdd.push(["Gear Grind","attaque","304","1"]);
		bdd.push(["Thief","attaque","305","1"]);
		bdd.push(["Ice Beam","attaque","306","2"]);
		bdd.push(["Lick","attaque","307","1"]);
		bdd.push(["Telekinesis","attaque","308","3"]);
		bdd.push(["Wrap","attaque","309","1"]);
		bdd.push(["Minimize","attaque","310","3"]);
		bdd.push(["Mind Reader","attaque","311","3"]);
		bdd.push(["Luster Purge","attaque","312","2"]);
		bdd.push(["Flash Cannon","attaque","313","2"]);
		bdd.push(["Tail Glow","attaque","314","3"]);
		bdd.push(["Struggle","attaque","315","1"]);
		bdd.push(["Mach Punch","attaque","316","1"]);
		bdd.push(["Nasty Plot","attaque","317","3"]);
		bdd.push(["Crunch","attaque","318","1"]);
		bdd.push(["Curse","attaque","319","3"]);
		bdd.push(["Thrash","attaque","320","1"]);
		bdd.push(["Hammer Arm","attaque","321","1"]);
		bdd.push(["Wood Hammer","attaque","322","1"]);
		bdd.push(["Bone Club","attaque","323","1"]);
		bdd.push(["Rolling Kick","attaque","324","1"]);
		bdd.push(["Mega Drain","attaque","325","2"]);
		bdd.push(["Megahorn","attaque","326","1"]);
		bdd.push(["Power Whip","attaque","327","1"]);
		bdd.push(["Hyper Voice","attaque","328","2"]);
		bdd.push(["Swift","attaque","329","2"]);
		bdd.push(["Metronome","attaque","330","3"]);
		bdd.push(["Tail Whip","attaque","331","3"]);
		bdd.push(["Mirror Move","attaque","332","3"]);
		bdd.push(["Mirror Shot","attaque","333","2"]);
		bdd.push(["Focus Punch","attaque","334","1"]);
		bdd.push(["Me First","attaque","335","3"]);
		bdd.push(["Transform","attaque","336","3"]);
		bdd.push(["Bite","attaque","337","1"]);
		bdd.push(["Iron Defense","attaque","338","3"]);
		bdd.push(["Light Screen","attaque","339","3"]);
		bdd.push(["Flame Charge","attaque","340","1"]);
		bdd.push(["Grass Knot","attaque","341","2"]);
		bdd.push(["Muddy Water","attaque","342","2"]);
		bdd.push(["Octazooka","attaque","343","2"]);
		bdd.push(["Miracle Eye","attaque","344","3"]);
		bdd.push(["Shadow Sneak","attaque","345","1"]);
		bdd.push(["Aurora Beam","attaque","346","2"]);
		bdd.push(["Shock Wave","attaque","347","2"]);
		bdd.push(["Confuse Ray","attaque","348","3"]);
		bdd.push(["Vacuum Wave","attaque","349","2"]);
		bdd.push(["Bonemerang","attaque","350","1"]);
		bdd.push(["Twister","attaque","351","2"]);
		bdd.push(["Quiver Dance","attaque","352","3"]);
		bdd.push(["Follow Me","attaque","353","3"]);
		bdd.push(["Stun Spore","attaque","354","3"]);
		bdd.push(["Slack Off","attaque","355","3"]);
		bdd.push(["Power Split","attaque","356","3"]);
		bdd.push(["Guard Split","attaque","357","3"]);
		bdd.push(["Bestow","attaque","358","3"]);
		bdd.push(["Switcheroo","attaque","359","3"]);
		bdd.push(["Bide","attaque","360","1"]);
		bdd.push(["Head Charge","attaque","361","1"]);
		bdd.push(["Heart Swap","attaque","362","3"]);
		bdd.push(["Power Swap","attaque","363","3"]);
		bdd.push(["Guard Swap","attaque","364","3"]);
		bdd.push(["Copycat","attaque","365","3"]);
		bdd.push(["Leaf Tornado","attaque","366","2"]);
		bdd.push(["Spike Cannon","attaque","367","1"]);
		bdd.push(["Pluck","attaque","368","1"]);
		bdd.push(["Spikes","attaque","369","3"]);
		bdd.push(["Peck","attaque","370","1"]);
		bdd.push(["Toxic Spikes","attaque","371","3"]);
		bdd.push(["Blaze Kick","attaque","372","1"]);
		bdd.push(["Jump Kick","attaque","373","1"]);
		bdd.push(["Hi Jump Kick","attaque","374","1"]);
		bdd.push(["Stealth Rock","attaque","375","3"]);
		bdd.push(["Bulldoze","attaque","376","1"]);
		bdd.push(["Barrage","attaque","377","1"]);
		bdd.push(["Crabhammer","attaque","378","1"]);
		bdd.push(["Sky Attack","attaque","379","1"]);
		bdd.push(["Bug Bite","attaque","380","1"]);
		bdd.push(["Bullet Punch","attaque","381","1"]);
		bdd.push(["Water Gun","attaque","382","2"]);
		bdd.push(["X-scissor","attaque","383","1"]);
		bdd.push(["Body Slam","attaque","384","1"]);
		bdd.push(["Calm Mind","attaque","385","3"]);
		bdd.push(["Dive","attaque","386","1"]);
		bdd.push(["Tail Slap","attaque","387","1"]);
		bdd.push(["Comet Punch","attaque","388","1"]);
		bdd.push(["Needle Arm","attaque","389","1"]);
		bdd.push(["Fire Punch","attaque","390","1"]);
		bdd.push(["Meteor Mash","attaque","391","1"]);
		bdd.push(["Shadow Punch","attaque","392","1"]);
		bdd.push(["Thunderpunch","attaque","393","1"]);
		bdd.push(["Karate Chop","attaque","394","1"]);
		bdd.push(["Ice Punch","attaque","395","1"]);
		bdd.push(["Cross Poison","attaque","396","1"]);
		bdd.push(["Rock Polish","attaque","397","3"]);
		bdd.push(["Imprison","attaque","398","3"]);
		bdd.push(["Sleep Powder","attaque","399","3"]);
		bdd.push(["Poisonpowder","attaque","400","3"]);
		bdd.push(["Rage Powder","attaque","401","3"]);
		bdd.push(["Powder Snow","attaque","402","2"]);
		bdd.push(["Pursuit","attaque","403","1"]);
		bdd.push(["Ancientpower","attaque","404","2"]);
		bdd.push(["Future Sight","attaque","405","2"]);
		bdd.push(["Crush Grip","attaque","406","1"]);
		bdd.push(["Quick Guard","attaque","407","3"]);
		bdd.push(["Destiny Bond","attaque","408","3"]);
		bdd.push(["Circle Throw","attaque","409","1"]);
		bdd.push(["Reflect","attaque","410","3"]);
		bdd.push(["Taunt","attaque","411","3"]);
		bdd.push(["Psycho Boost","attaque","412","2"]);
		bdd.push(["Psychic","attaque","413","2"]);
		bdd.push(["Zen Headbutt","attaque","414","1"]);
		bdd.push(["Hidden Power","attaque","415","2"]);
		bdd.push(["Focus Energy","attaque","416","3"]);
		bdd.push(["Punishment","attaque","417","1"]);
		bdd.push(["Smog","attaque","418","2"]);
		bdd.push(["Iron Tail","attaque","419","1"]);
		bdd.push(["Poison Tail","attaque","420","1"]);
		bdd.push(["Ingrain","attaque","421","3"]);
		bdd.push(["Blast Burn","attaque","422","2"]);
		bdd.push(["Psybeam","attaque","423","2"]);
		bdd.push(["Grudge","attaque","424","3"]);
		bdd.push(["Brave Bird","attaque","425","1"]);
		bdd.push(["Charge Beam","attaque","426","2"]);
		bdd.push(["Power Gem","attaque","427","2"]);
		bdd.push(["Moonlight","attaque","428","3"]);
		bdd.push(["Signal Beam","attaque","429","2"]);
		bdd.push(["Simple Beam","attaque","430","3"]);
		bdd.push(["Bounce","attaque","431","1"]);
		bdd.push(["Flame Burst","attaque","432","2"]);
		bdd.push(["Recycle","attaque","433","3"]);
		bdd.push(["Double Team","attaque","434","3"]);
		bdd.push(["Magic Coat","attaque","435","3"]);
		bdd.push(["Mean Look","attaque","436","3"]);
		bdd.push(["Refresh","attaque","437","3"]);
		bdd.push(["Spit Up","attaque","438","2"]);
		bdd.push(["Baton Pass","attaque","439","3"]);
		bdd.push(["Work Up","attaque","440","3"]);
		bdd.push(["Withdraw","attaque","441","3"]);
		bdd.push(["Rest","attaque","442","3"]);
		bdd.push(["Payback","attaque","443","1"]);
		bdd.push(["Perish Song","attaque","444","3"]);
		bdd.push(["Return","attaque","445","1"]);
		bdd.push(["Wake-up Slap","attaque","446","1"]);
		bdd.push(["Shadow Force","attaque","447","1"]);
		bdd.push(["Counter","attaque","448","1"]);
		bdd.push(["Rock Wrecker","attaque","449","1"]);
		bdd.push(["Snore","attaque","450","2"]);
		bdd.push(["Flame Wheel","attaque","451","1"]);
		bdd.push(["Rollout","attaque","452","1"]);
		bdd.push(["Growl","attaque","453","3"]);
		bdd.push(["Safeguard","attaque","454","3"]);
		bdd.push(["Feint","attaque","455","1"]);
		bdd.push(["Knock Off","attaque","456","1"]);
		bdd.push(["Submission","attaque","457","1"]);
		bdd.push(["Snatch","attaque","458","3"]);
		bdd.push(["Brine","attaque","459","2"]);
		bdd.push(["String Shot","attaque","460","3"]);
		bdd.push(["Captivate","attaque","461","3"]);
		bdd.push(["Earthquake","attaque","462","1"]);
		bdd.push(["Grasswhistle","attaque","463","3"]);
		bdd.push(["Whirlpool","attaque","464","2"]);
		bdd.push(["Recover","attaque","465","3"]);
		bdd.push(["Sonicboom","attaque","466","2"]);
		bdd.push(["Worry Seed","attaque","467","3"]);
		bdd.push(["Frost Breath","attaque","468","2"]);
		bdd.push(["Slam","attaque","469","1"]);
		bdd.push(["Memento","attaque","470","3"]);
		bdd.push(["Spacial Rend","attaque","471","2"]);
		bdd.push(["Spore","attaque","472","3"]);
		bdd.push(["Cotton Spore","attaque","473","3"]);
		bdd.push(["Icicle Spear","attaque","474","1"]);
		bdd.push(["Smellingsalt","attaque","475","1"]);
		bdd.push(["Stockpile","attaque","476","3"]);
		bdd.push(["Sky Uppercut","attaque","477","1"]);
		bdd.push(["Metal Sound","attaque","478","3"]);
		bdd.push(["Gastro Acid","attaque","479","3"]);
		bdd.push(["Overheat","attaque","480","2"]);
		bdd.push(["Surf","attaque","481","2"]);
		bdd.push(["Superpower","attaque","482","1"]);
		bdd.push(["Struggle Bug","attaque","483","2"]);
		bdd.push(["Synchronoise","attaque","484","2"]);
		bdd.push(["Synthesis","attaque","485","3"]);
		bdd.push(["Heat Crash","attaque","486","1"]);
		bdd.push(["Heavy Slam","attaque","487","1"]);
		bdd.push(["Fury Cutter","attaque","488","1"]);
		bdd.push(["Techno Blast","attaque","489","2"]);
		bdd.push(["Kinesis","attaque","490","3"]);
		bdd.push(["Teleport","attaque","491","3"]);
		bdd.push(["Earth Power","attaque","492","2"]);
		bdd.push(["Sandstorm","attaque","493","3"]);
		bdd.push(["Leaf Storm","attaque","494","2"]);
		bdd.push(["Entrainment","attaque","495","3"]);
		bdd.push(["Endure","attaque","496","3"]);
		bdd.push(["Night Shade","attaque","497","2"]);
		bdd.push(["Iron Head","attaque","498","1"]);
		bdd.push(["Mud Shot","attaque","499","2"]);
		bdd.push(["Spider Web","attaque","500","3"]);
		bdd.push(["Electroweb","attaque","501","2"]);
		bdd.push(["Rock Tomb","attaque","502","1"]);
		bdd.push(["Thunderbolt","attaque","503","2"]);
		bdd.push(["Doubleslap","attaque","504","1"]);
		bdd.push(["Gust","attaque","505","2"]);
		bdd.push(["Rapid Spin","attaque","506","1"]);
		bdd.push(["Sand Tomb","attaque","507","1"]);
		bdd.push(["Trick","attaque","508","3"]);
		bdd.push(["Torment","attaque","509","3"]);
		bdd.push(["Water Sport","attaque","510","3"]);
		bdd.push(["Final Gambit","attaque","511","2"]);
		bdd.push(["Toxic","attaque","512","3"]);
		bdd.push(["Air Cutter","attaque","513","2"]);
		bdd.push(["Razor Leaf","attaque","514","1"]);
		bdd.push(["Slash","attaque","515","1"]);
		bdd.push(["Night Slash","attaque","516","1"]);
		bdd.push(["Splash","attaque","517","3"]);
		bdd.push(["Foul Play","attaque","518","1"]);
		bdd.push(["Tri Attack","attaque","519","2"]);
		bdd.push(["Triple Kick","attaque","520","1"]);
		bdd.push(["Dark Void","attaque","521","3"]);
		bdd.push(["Dig","attaque","522","1"]);
		bdd.push(["Drill Run","attaque","523","1"]);
		bdd.push(["Mega Punch","attaque","524","1"]);
		bdd.push(["Mega Kick","attaque","525","1"]);
		bdd.push(["Hyper Beam","attaque","526","2"]);
		bdd.push(["Supersonic","attaque","527","3"]);
		bdd.push(["Dizzy Punch","attaque","528","1"]);
		bdd.push(["Psywave","attaque","529","2"]);
		bdd.push(["Leech Seed","attaque","530","3"]);
		bdd.push(["Drain Punch","attaque","531","1"]);
		bdd.push(["Leech Life","attaque","532","1"]);
		bdd.push(["Swagger","attaque","533","3"]);
		bdd.push(["Frenzy Plant","attaque","534","2"]);
		bdd.push(["Revenge","attaque","535","1"]);
		bdd.push(["Retaliate","attaque","536","1"]);
		bdd.push(["Silver Wind","attaque","537","2"]);
		bdd.push(["Tailwind","attaque","538","3"]);
		bdd.push(["Icy Wind","attaque","539","2"]);
		bdd.push(["Ominous Wind","attaque","540","2"]);
		bdd.push(["Hurricane","attaque","541","2"]);
		bdd.push(["Lock-On","attaque","542","3"]);
		bdd.push(["Heal Pulse","attaque","543","3"]);
		bdd.push(["Water Pulse","attaque","544","2"]);
		bdd.push(["Dark Pulse","attaque","545","2"]);
		bdd.push(["Extremespeed","attaque","546","1"]);
		bdd.push(["Quick Attack","attaque","547","1"]);
		bdd.push(["Wish","attaque","548","3"]);
		bdd.push(["Healing Wish","attaque","549","3"]);
		bdd.push(["Mirror Coat","attaque","550","2"]);
		bdd.push(["Fly","attaque","551","1"]);
		bdd.push(["Magnet Rise","attaque","552","3"]);
		bdd.push(["Absorb","attaque","553","2"]);
		bdd.push(["Magma Storm","attaque","554","2"]);
		bdd.push(["Storm Throw","attaque","555","1"]);
		bdd.push(["Meditate","attaque","556","3"]);
		bdd.push(["Sunny Day","attaque","557","3"]);
		bdd.push(["Wonder Room","attaque","558","3"]);
		bdd.push(["Magic Room","attaque","559","3"]);
		bdd.push(["Truant","capspe","1"]);
		bdd.push(["Water Absorb","capspe","2"]);
		bdd.push(["Volt Absorb","capspe","3"]);
		bdd.push(["Defiant","capspe","4"]);
		bdd.push(["Adaptability","capspe","5"]);
		bdd.push(["Hustle","capspe","6"]);
		bdd.push(["Air Lock","capspe","7"]);
		bdd.push(["Snow Warning","capspe","8"]);
		bdd.push(["Analytic","capspe","9"]);
		bdd.push(["No Guard","capspe","10"]);
		bdd.push(["Soundproof","capspe","11"]);
		bdd.push(["Anticipation","capspe","12"]);
		bdd.push(["Magma Armor","capspe","13"]);
		bdd.push(["Battle Armor","capspe","14"]);
		bdd.push(["Weak Armor","capspe","15"]);
		bdd.push(["Inner Focus","capspe","16"]);
		bdd.push(["Sand Rush","capspe","17"]);
		bdd.push(["Oblivious","capspe","18"]);
		bdd.push(["Aftermath","capspe","19"]);
		bdd.push(["Blaze","capspe","20"]);
		bdd.push(["Mold Breaker","capspe","21"]);
		bdd.push(["Trace","capspe","22"]);
		bdd.push(["Super Luck","capspe","23"]);
		bdd.push(["Honey Gather","capspe","24"]);
		bdd.push(["Chlorophyll","capspe","25"]);
		bdd.push(["Cloud Nine","capspe","26"]);
		bdd.push(["Big Pecks","capspe","27"]);
		bdd.push(["Justified","capspe","28"]);
		bdd.push(["Healer","capspe","29"]);
		bdd.push(["Anger Point","capspe","30"]);
		bdd.push(["Huge Power","capspe","31"]);
		bdd.push(["Contrary","capspe","32"]);
		bdd.push(["Shell Armor","capspe","33"]);
		bdd.push(["Flame Body","capspe","34"]);
		bdd.push(["Ice Body","capspe","35"]);
		bdd.push(["Cursed Body","capspe","36"]);
		bdd.push(["Clear Body","capspe","37"]);
		bdd.push(["Drizzle","capspe","38"]);
		bdd.push(["Guts","capspe","39"]);
		bdd.push(["Rain Dish","capspe","40"]);
		bdd.push(["Slow Start","capspe","41"]);
		bdd.push(["Defeatist","capspe","42"]);
		bdd.push(["Color Change","capspe","43"]);
		bdd.push(["Unburden","capspe","44"]);
		bdd.push(["Flower Gift","capspe","45"]);
		bdd.push(["Marvel Scale","capspe","46"]);
		bdd.push(["Limber","capspe","47"]);
		bdd.push(["White Smoke","capspe","48"]);
		bdd.push(["Shield Dust","capspe","49"]);
		bdd.push(["Overgrow","capspe","50"]);
		bdd.push(["Overcoat","capspe","51"]);
		bdd.push(["Iron Barbs","capspe","52"]);
		bdd.push(["Vital Spirit","capspe","53"]);
		bdd.push(["Swarm","capspe","54"]);
		bdd.push(["Prankster","capspe","55"]);
		bdd.push(["Sturdy","capspe","56"]);
		bdd.push(["Leaf Guard","capspe","57"]);
		bdd.push(["Filter","capspe","58"]);
		bdd.push(["Pure Power","capspe","59"]);
		bdd.push(["Sand Force","capspe","60"]);
		bdd.push(["Solar Power","capspe","61"]);
		bdd.push(["Frisk","capspe","62"]);
		bdd.push(["Stall","capspe","63"]);
		bdd.push(["Run Away","capspe","64"]);
		bdd.push(["Friend Guard","capspe","65"]);
		bdd.push(["Magic Guard","capspe","66"]);
		bdd.push(["Wonder Guard","capspe","67"]);
		bdd.push(["Swift Swim","capspe","68"]);
		bdd.push(["Gluttony","capspe","69"]);
		bdd.push(["Sticky Hold","capspe","70"]);
		bdd.push(["Heavy Metal","capspe","71"]);
		bdd.push(["Sap Sipper","capspe","72"]);
		bdd.push(["Hydration","capspe","73"]);
		bdd.push(["Hyper Cutter","capspe","74"]);
		bdd.push(["Water Veil","capspe","75"]);
		bdd.push(["Heatproof","capspe","76"]);
		bdd.push(["Illusion","capspe","77"]);
		bdd.push(["Steadfast","capspe","78"]);
		bdd.push(["Imposter","capspe","79"]);
		bdd.push(["Moxie","capspe","80"]);
		bdd.push(["Unaware","capspe","81"]);
		bdd.push(["Infiltrator","capspe","82"]);
		bdd.push(["Insomnia","capspe","83"]);
		bdd.push(["Intimidate","capspe","84"]);
		bdd.push(["Thick Fat","capspe","85"]);
		bdd.push(["Cute Charm","capspe","86"]);
		bdd.push(["Storm Drain","capspe","87"]);
		bdd.push(["Tinted Lens","capspe","88"]);
		bdd.push(["Levitate","capspe","89"]);
		bdd.push(["Light Metal","capspe","90"]);
		bdd.push(["Illuminate","capspe","91"]);
		bdd.push(["Moody","capspe","92"]);
		bdd.push(["Magnet Pull","capspe","93"]);
		bdd.push(["Klutz","capspe","94"]);
		bdd.push(["Shadow Tag","capspe","95"]);
		bdd.push(["Early Bird","capspe","96"]);
		bdd.push(["Bad Dreams","capspe","97"]);
		bdd.push(["Natural Cure","capspe","98"]);
		bdd.push(["Forecast","capspe","99"]);
		bdd.push(["Minus","capspe","100"]);
		bdd.push(["Magic Bounce","capspe","101"]);
		bdd.push(["Zen Mode","capspe","102"]);
		bdd.push(["Damp","capspe","103"]);
		bdd.push(["Mummy","capspe","104"]);
		bdd.push(["Motor Drive","capspe","105"]);
		bdd.push(["Shed Skin","capspe","106"]);
		bdd.push(["Skill Link","capspe","107"]);
		bdd.push(["Multitype","capspe","108"]);
		bdd.push(["Multiscale","capspe","109"]);
		bdd.push(["Normalize","capspe","110"]);
		bdd.push(["Compoundeyes","capspe","111"]);
		bdd.push(["Lightningrod","capspe","112"]);
		bdd.push(["Rough Skin","capspe","113"]);
		bdd.push(["Wonder Skin","capspe","114"]);
		bdd.push(["Dry Skin","capspe","115"]);
		bdd.push(["Rattled","capspe","116"]);
		bdd.push(["Pickpocket","capspe","117"]);
		bdd.push(["Tangled Feet","capspe","118"]);
		bdd.push(["Quick Feet","capspe","119"]);
		bdd.push(["Arena Trap","capspe","120"]);
		bdd.push(["Plus","capspe","121"]);
		bdd.push(["Iron Fist","capspe","122"]);
		bdd.push(["Poison Point","capspe","123"]);
		bdd.push(["Effect Spore","capspe","124"]);
		bdd.push(["Forewarn","capspe","125"]);
		bdd.push(["Pressure","capspe","126"]);
		bdd.push(["Stench","capspe","127"]);
		bdd.push(["Scrappy","capspe","128"]);
		bdd.push(["Flare Boost","capspe","129"]);
		bdd.push(["Toxic Boost","capspe","130"]);
		bdd.push(["Pickup","capspe","131"]);
		bdd.push(["Harvest","capspe","132"]);
		bdd.push(["Keen Eye","capspe","133"]);
		bdd.push(["Regenerator","capspe","134"]);
		bdd.push(["Snow Cloak","capspe","135"]);
		bdd.push(["Rivalry","capspe","136"]);
		bdd.push(["Sand Stream","capspe","137"]);
		bdd.push(["Sheer Force","capspe","138"]);
		bdd.push(["Drought","capspe","139"]);
		bdd.push(["Serene Grace","capspe","140"]);
		bdd.push(["Simple","capspe","141"]);
		bdd.push(["Sniper","capspe","142"]);
		bdd.push(["Poison Heal","capspe","143"]);
		bdd.push(["Solid Rock","capspe","144"]);
		bdd.push(["Static","capspe","145"]);
		bdd.push(["Liquid Ooze","capspe","146"]);
		bdd.push(["Synchronize","capspe","147"]);
		bdd.push(["Technician","capspe","148"]);
		bdd.push(["Download","capspe","149"]);
		bdd.push(["Telepathy","capspe","150"]);
		bdd.push(["Reckless","capspe","151"]);
		bdd.push(["Own Tempo","capspe","152"]);
		bdd.push(["Unnerve","capspe","153"]);
		bdd.push(["Teravolt","capspe","154"]);
		bdd.push(["Rock Head","capspe","155"]);
		bdd.push(["Flash Fire","capspe","156"]);
		bdd.push(["Torrent","capspe","157"]);
		bdd.push(["Poison Touch","capspe","158"]);
		bdd.push(["Speed Boost","capspe","159"]);
		bdd.push(["Turboblaze","capspe","160"]);
		bdd.push(["Immunity","capspe","161"]);
		bdd.push(["Suction Cups","capspe","162"]);
		bdd.push(["Victory Star","capspe","163"]);
		bdd.push(["Sand Veil","capspe","164"]);
		bdd.push(["None","type","-1"]);
		bdd.push(["Steel","type","1"]);
		bdd.push(["Fighting","type","2"]);
		bdd.push(["Dragon","type","3"]);
		bdd.push(["Water","type","4"]);
		bdd.push(["Electric","type","5"]);
		bdd.push(["Fire","type","6"]);
		bdd.push(["Ice","type","7"]);
		bdd.push(["Bug","type","8"]);
		bdd.push(["Normal","type","9"]);
		bdd.push(["Grass","type","10"]);
		bdd.push(["Poison","type","11"]);
		bdd.push(["Psychic","type","12"]);
		bdd.push(["Rock","type","13"]);
		bdd.push(["Ground","type","14"]);
		bdd.push(["Ghost","type","15"]);
		bdd.push(["Dark","type","16"]);
		bdd.push(["Flying","type","17"]);
		bdd.push(["Fairy","type","18"]);
		bdd.push(["HP","stat","PV"]);
		bdd.push(["HP >= XXX","stat","PV >= XXX"]);
		bdd.push(["HP <= XXX","stat","PV <= XXX"]);
		bdd.push(["HP = XXX","stat","PV = XXX"]);
		bdd.push(["HP > Atk","stat","PV > Att"]);
		bdd.push(["HP > SpA","stat","PV > AttSpe"]);
		bdd.push(["HP > Def","stat","PV > Def"]);
		bdd.push(["HP > SpD","stat","PV > DefSpe"]);
		bdd.push(["HP > Spe","stat","PV > Vit"]);
		bdd.push(["HP = Atk","stat","PV = Att"]);
		bdd.push(["HP = SpA","stat","PV = AttSpe"]);
		bdd.push(["HP = Def","stat","PV = Def"]);
		bdd.push(["HP = SpD","stat","PV = DefSpe"]);
		bdd.push(["HP = Spe","stat","PV = Vit"]);
		bdd.push(["Atk","stat","Att"]);
		bdd.push(["Atk >= XXX","stat","Att >= XXX"]);
		bdd.push(["Atk <= XXX","stat","Att <= XXX"]);
		bdd.push(["Atk = XXX","stat","Att = XXX"]);
		bdd.push(["Atk > HP","stat","Att > PV"]);
		bdd.push(["Atk > SpA","stat","Att > AttSpe"]);
		bdd.push(["Atk > Def","stat","Att > Def"]);
		bdd.push(["Atk > SpD","stat","Att > DefSpe"]);
		bdd.push(["Atk > Spe","stat","Att > Vit"]);
		bdd.push(["Atk = HP","stat","Att = PV"]);
		bdd.push(["Atk = SpA","stat","Att = AttSpe"]);
		bdd.push(["Atk = Def","stat","Att = Def"]);
		bdd.push(["Atk = SpD","stat","Att = DefSpe"]);
		bdd.push(["Atk = Spe","stat","Att = Vit"]);
		bdd.push(["SpA","stat","AttSpe"]);
		bdd.push(["SpA >= XXX","stat","AttSpe >= XXX"]);
		bdd.push(["SpA <= XXX","stat","AttSpe <= XXX"]);
		bdd.push(["SpA = XXX","stat","AttSpe = XXX"]);
		bdd.push(["SpA > HP","stat","AttSpe > PV"]);
		bdd.push(["SpA > Atk","stat","AttSpe > Att"]);
		bdd.push(["SpA > Def","stat","AttSpe > Def"]);
		bdd.push(["SpA > SpD","stat","AttSpe > DefSpe"]);
		bdd.push(["SpA > Spe","stat","AttSpe > Vit"]);
		bdd.push(["SpA = HP","stat","AttSpe = PV"]);
		bdd.push(["SpA = Atk","stat","AttSpe = Att"]);
		bdd.push(["SpA = Def","stat","AttSpe = Def"]);
		bdd.push(["SpA = SpD","stat","AttSpe = DefSpe"]);
		bdd.push(["SpA = Spe","stat","AttSpe = Vit"]);
		bdd.push(["Def","stat","Def"]);
		bdd.push(["Def >= XXX","stat","Def >= XXX"]);
		bdd.push(["Def <= XXX","stat","Def <= XXX"]);
		bdd.push(["Def = XXX","stat","Def = XXX"]);
		bdd.push(["Def > HP","stat","Def > PV"]);
		bdd.push(["Def > Atk","stat","Def > Att"]);
		bdd.push(["Def > SpA","stat","Def > AttSpe"]);
		bdd.push(["Def > SpD","stat","Def > DefSpe"]);
		bdd.push(["Def > Spe","stat","Def > Vit"]);
		bdd.push(["Def = HP","stat","Def = PV"]);
		bdd.push(["Def = Atk","stat","Def = Att"]);
		bdd.push(["Def = SpA","stat","Def = AttSpe"]);
		bdd.push(["Def = SpD","stat","Def = DefSpe"]);
		bdd.push(["Def = Spe","stat","Def = Vit"]);
		bdd.push(["SpD","stat","DefSpe"]);
		bdd.push(["SpD >= XXX","stat","DefSpe >= XXX"]);
		bdd.push(["SpD <= XXX","stat","DefSpe <= XXX"]);
		bdd.push(["SpD = XXX","stat","DefSpe = XXX"]);
		bdd.push(["SpD > HP","stat","DefSpe > PV"]);
		bdd.push(["SpD > Atk","stat","DefSpe > Att"]);
		bdd.push(["SpD > SpA","stat","DefSpe > AttSpe"]);
		bdd.push(["SpD > Def","stat","DefSpe > Def"]);
		bdd.push(["SpD > Spe","stat","DefSpe > Vit"]);
		bdd.push(["SpD = HP","stat","DefSpe = PV"]);
		bdd.push(["SpD = Atk","stat","DefSpe = Att"]);
		bdd.push(["SpD = SpA","stat","DefSpe = AttSpe"]);
		bdd.push(["SpD = Def","stat","DefSpe = Def"]);
		bdd.push(["SpD = Spe","stat","DefSpe = Vit"]);
		bdd.push(["Spe","stat","Vit"]);
		bdd.push(["Spe >= XXX","stat","Vit >= XXX"]);
		bdd.push(["Spe <= XXX","stat","Vit <= XXX"]);
		bdd.push(["Spe = XXX","stat","Vit = XXX"]);
		bdd.push(["Spe > HP","stat","Vit > PV"]);
		bdd.push(["Spe > Atk","stat","Vit > Att"]);
		bdd.push(["Spe > SpA","stat","Vit > AttSpe"]);
		bdd.push(["Spe > Def","stat","Vit > Def"]);
		bdd.push(["Spe > SpD","stat","Vit > DefSpe"]);
		bdd.push(["Spe = HP","stat","Vit = PV"]);
		bdd.push(["Spe = Atk","stat","Vit = Att"]);
		bdd.push(["Spe = SpA","stat","Vit = AttSpe"]);
		bdd.push(["Spe = Def","stat","Vit = Def"]);
		bdd.push(["Spe = SpD","stat","Vit = DefSpe"]);
		bdd.push(["Total","stat","Total"]);
		bdd.push(["Total >= XXX","stat","Total >= XXX"]);
		bdd.push(["Total <= XXX","stat","Total <= XXX"]);
		bdd.push(["Total = XXX","stat","Total = XXX"]);
		bdd.push(["HP+Atk","stat","PV+Att"]);
		bdd.push(["HP+Atk >= XXX","stat","PV+Att >= XXX"]);
		bdd.push(["HP+Atk <= XXX","stat","PV+Att <= XXX"]);
		bdd.push(["HP+Atk = XXX","stat","PV+Att = XXX"]);
		bdd.push(["Atk+HP","stat","Att+PV"]);
		bdd.push(["Atk+HP >= XXX","stat","Att+PV >= XXX"]);
		bdd.push(["Atk+HP <= XXX","stat","Att+PV <= XXX"]);
		bdd.push(["Atk+HP = XXX","stat","Att+PV = XXX"]);
		bdd.push(["HP+SpA","stat","PV+AttSpe"]);
		bdd.push(["HP+SpA >= XXX","stat","PV+AttSpe >= XXX"]);
		bdd.push(["HP+SpA <= XXX","stat","PV+AttSpe <= XXX"]);
		bdd.push(["HP+SpA = XXX","stat","PV+AttSpe = XXX"]);
		bdd.push(["SpA+HP","stat","AttSpe+PV"]);
		bdd.push(["SpA+HP >= XXX","stat","AttSpe+PV >= XXX"]);
		bdd.push(["SpA+HP <= XXX","stat","AttSpe+PV <= XXX"]);
		bdd.push(["SpA+HP = XXX","stat","AttSpe+PV = XXX"]);
		bdd.push(["HP+Def","stat","PV+Def"]);
		bdd.push(["HP+Def >= XXX","stat","PV+Def >= XXX"]);
		bdd.push(["HP+Def <= XXX","stat","PV+Def <= XXX"]);
		bdd.push(["HP+Def = XXX","stat","PV+Def = XXX"]);
		bdd.push(["Def+HP","stat","Def+PV"]);
		bdd.push(["Def+HP >= XXX","stat","Def+PV >= XXX"]);
		bdd.push(["Def+HP <= XXX","stat","Def+PV <= XXX"]);
		bdd.push(["Def+HP = XXX","stat","Def+PV = XXX"]);
		bdd.push(["HP+SpD","stat","PV+DefSpe"]);
		bdd.push(["HP+SpD >= XXX","stat","PV+DefSpe >= XXX"]);
		bdd.push(["HP+SpD <= XXX","stat","PV+DefSpe <= XXX"]);
		bdd.push(["HP+SpD = XXX","stat","PV+DefSpe = XXX"]);
		bdd.push(["SpD+HP","stat","DefSpe+PV"]);
		bdd.push(["SpD+HP >= XXX","stat","DefSpe+PV >= XXX"]);
		bdd.push(["SpD+HP <= XXX","stat","DefSpe+PV <= XXX"]);
		bdd.push(["SpD+HP = XXX","stat","DefSpe+PV = XXX"]);
		bdd.push(["HP+Spe","stat","PV+Vit"]);
		bdd.push(["HP+Spe >= XXX","stat","PV+Vit >= XXX"]);
		bdd.push(["HP+Spe <= XXX","stat","PV+Vit <= XXX"]);
		bdd.push(["HP+Spe = XXX","stat","PV+Vit = XXX"]);
		bdd.push(["Spe+HP","stat","Vit+PV"]);
		bdd.push(["Spe+HP >= XXX","stat","Vit+PV >= XXX"]);
		bdd.push(["Spe+HP <= XXX","stat","Vit+PV <= XXX"]);
		bdd.push(["Spe+HP = XXX","stat","Vit+PV = XXX"]);
		bdd.push(["Atk+SpA","stat","Att+AttSpe"]);
		bdd.push(["Atk+SpA >= XXX","stat","Att+AttSpe >= XXX"]);
		bdd.push(["Atk+SpA <= XXX","stat","Att+AttSpe <= XXX"]);
		bdd.push(["Atk+SpA = XXX","stat","Att+AttSpe = XXX"]);
		bdd.push(["SpA+Atk","stat","AttSpe+Att"]);
		bdd.push(["SpA+Atk >= XXX","stat","AttSpe+Att >= XXX"]);
		bdd.push(["SpA+Atk <= XXX","stat","AttSpe+Att <= XXX"]);
		bdd.push(["SpA+Atk = XXX","stat","AttSpe+Att = XXX"]);
		bdd.push(["Atk+Def","stat","Att+Def"]);
		bdd.push(["Atk+Def >= XXX","stat","Att+Def >= XXX"]);
		bdd.push(["Atk+Def <= XXX","stat","Att+Def <= XXX"]);
		bdd.push(["Atk+Def = XXX","stat","Att+Def = XXX"]);
		bdd.push(["Def+Atk","stat","Def+Att"]);
		bdd.push(["Def+Atk >= XXX","stat","Def+Att >= XXX"]);
		bdd.push(["Def+Atk <= XXX","stat","Def+Att <= XXX"]);
		bdd.push(["Def+Atk = XXX","stat","Def+Att = XXX"]);
		bdd.push(["Atk+SpD","stat","Att+DefSpe"]);
		bdd.push(["Atk+SpD >= XXX","stat","Att+DefSpe >= XXX"]);
		bdd.push(["Atk+SpD <= XXX","stat","Att+DefSpe <= XXX"]);
		bdd.push(["Atk+SpD = XXX","stat","Att+DefSpe = XXX"]);
		bdd.push(["SpD+Atk","stat","DefSpe+Att"]);
		bdd.push(["SpD+Atk >= XXX","stat","DefSpe+Att >= XXX"]);
		bdd.push(["SpD+Atk <= XXX","stat","DefSpe+Att <= XXX"]);
		bdd.push(["SpD+Atk = XXX","stat","DefSpe+Att = XXX"]);
		bdd.push(["Atk+Spe","stat","Att+Vit"]);
		bdd.push(["Atk+Spe >= XXX","stat","Att+Vit >= XXX"]);
		bdd.push(["Atk+Spe <= XXX","stat","Att+Vit <= XXX"]);
		bdd.push(["Atk+Spe = XXX","stat","Att+Vit = XXX"]);
		bdd.push(["Spe+Atk","stat","Vit+Att"]);
		bdd.push(["Spe+Atk >= XXX","stat","Vit+Att >= XXX"]);
		bdd.push(["Spe+Atk <= XXX","stat","Vit+Att <= XXX"]);
		bdd.push(["Spe+Atk = XXX","stat","Vit+Att = XXX"]);
		bdd.push(["Def+SpD","stat","Def+DefSpe"]);
		bdd.push(["Def+SpD >= XXX","stat","Def+DefSpe >= XXX"]);
		bdd.push(["Def+SpD <= XXX","stat","Def+DefSpe <= XXX"]);
		bdd.push(["Def+SpD = XXX","stat","Def+DefSpe = XXX"]);
		bdd.push(["SpD+Def","stat","DefSpe+Def"]);
		bdd.push(["SpD+Def >= XXX","stat","DefSpe+Def >= XXX"]);
		bdd.push(["SpD+Def <= XXX","stat","DefSpe+Def <= XXX"]);
		bdd.push(["SpD+Def = XXX","stat","DefSpe+Def = XXX"]);
		bdd.push(["Def+Spe","stat","Def+Vit"]);
		bdd.push(["Def+Spe >= XXX","stat","Def+Vit >= XXX"]);
		bdd.push(["Def+Spe <= XXX","stat","Def+Vit <= XXX"]);
		bdd.push(["Def+Spe = XXX","stat","Def+Vit = XXX"]);
		bdd.push(["Spe+Def","stat","Vit+Def"]);
		bdd.push(["Spe+Def >= XXX","stat","Vit+Def >= XXX"]);
		bdd.push(["Spe+Def <= XXX","stat","Vit+Def <= XXX"]);
		bdd.push(["Spe+Def = XXX","stat","Vit+Def = XXX"]);
		bdd.push(["SpD+Spe","stat","DefSpe+Vit"]);
		bdd.push(["SpD+Spe >= XXX","stat","DefSpe+Vit >= XXX"]);
		bdd.push(["SpD+Spe <= XXX","stat","DefSpe+Vit <= XXX"]);
		bdd.push(["SpD+Spe = XXX","stat","DefSpe+Vit = XXX"]);
		bdd.push(["Spe+SpD","stat","Vit+DefSpe"]);
		bdd.push(["Spe+SpD >= XXX","stat","Vit+DefSpe >= XXX"]);
		bdd.push(["Spe+SpD <= XXX","stat","Vit+DefSpe <= XXX"]);
		bdd.push(["Spe+SpD = XXX","stat","Vit+DefSpe = XXX"]);
		bdd.push(["Atk+SpA+Spe","stat","Att+AttSpe+Vit"]);
		bdd.push(["Atk+SpA+Spe >= XXX","stat","Att+AttSpe+Vit >= XXX"]);
		bdd.push(["Atk+SpA+Spe <= XXX","stat","Att+AttSpe+Vit <= XXX"]);
		bdd.push(["Atk+SpA+Spe = XXX","stat","Att+AttSpe+Vit = XXX"]);
		bdd.push(["Def+SpD+Spe","stat","Def+DefSpe+Vit"]);
		bdd.push(["Def+SpD+Spe >= XXX","stat","Def+DefSpe+Vit >= XXX"]);
		bdd.push(["Def+SpD+Spe <= XXX","stat","Def+DefSpe+Vit <= XXX"]);
		bdd.push(["Def+SpD+Spe = XXX","stat","Def+DefSpe+Vit = XXX"]);
		bdd.push(["HP+Atk+SpA","stat","PV+Att+AttSpe"]);
		bdd.push(["HP+Atk+SpA >= XXX","stat","PV+Att+AttSpe >= XXX"]);
		bdd.push(["HP+Atk+SpA <= XXX","stat","PV+Att+AttSpe <= XXX"]);
		bdd.push(["HP+Atk+SpA = XXX","stat","PV+Att+AttSpe = XXX"]);
		bdd.push(["HP+Def+SpD","stat","PV+Def+DefSpe"]);
		bdd.push(["HP+Def+SpD >= XXX","stat","PV+Def+DefSpe >= XXX"]);
		bdd.push(["HP+Def+SpD <= XXX","stat","PV+Def+DefSpe <= XXX"]);
		bdd.push(["HP+Def+SpD = XXX","stat","PV+Def+DefSpe = XXX"]);
		bdd.push(["HP*Def","stat","PV*Def"]);
		bdd.push(["HP*Def >= XXX","stat","PV*Def >= XXX"]);
		bdd.push(["HP*Def <= XXX","stat","PV*Def <= XXX"]);
		bdd.push(["HP*Def = XXX","stat","PV*Def = XXX"]);
		bdd.push(["Def*HP","stat","Def*PV"]);
		bdd.push(["Def*HP >= XXX","stat","Def*PV >= XXX"]);
		bdd.push(["Def*HP <= XXX","stat","Def*PV <= XXX"]);
		bdd.push(["Def*HP = XXX","stat","Def*PV = XXX"]);
		bdd.push(["HP*SpD","stat","PV*DefSpe"]);
		bdd.push(["HP*SpD >= XXX","stat","PV*DefSpe >= XXX"]);
		bdd.push(["HP*SpD <= XXX","stat","PV*DefSpe <= XXX"]);
		bdd.push(["HP*SpD = XXX","stat","PV*DefSpe = XXX"]);
		bdd.push(["SpD*HP","stat","DefSpe*PV"]);
		bdd.push(["SpD*HP >= XXX","stat","DefSpe*PV >= XXX"]);
		bdd.push(["SpD*HP <= XXX","stat","DefSpe*PV <= XXX"]);
		bdd.push(["SpD*HP = XXX","stat","DefSpe*PV = XXX"]);
		bdd.push(["Power >= XXX","carac_attaque","Puissance >= XXX"]);
		bdd.push(["Power <= XXX","carac_attaque","Puissance <= XXX"]);
		bdd.push(["Power = XXX","carac_attaque","Puissance = XXX"]);
		bdd.push(["Accuracy >= XXX","carac_attaque","Probabilite >= XXX"]);
		bdd.push(["Accuracy <= XXX","carac_attaque","Probabilite <= XXX"]);
		bdd.push(["Accuracy = XXX","carac_attaque","Probabilite = XXX"]);
		bdd.push(["PP >= XXX","carac_attaque","PP >= XXX"]);
		bdd.push(["PP <= XXX","carac_attaque","PP <= XXX"]);
		bdd.push(["PP = XXX","carac_attaque","PP = XXX"]);
		bdd.push(["Priority >= XXX","carac_attaque","Priorite >= XXX"]);
		bdd.push(["Priority <= XXX","carac_attaque","Priorite <= XXX"]);
		bdd.push(["Priority = XXX","carac_attaque","Priorite = XXX"]);
				
		$(document).ready(
			function()
			{
				$("#langs").on("click", "img",
					function() 
					{
						$.cookie("lang", $(this).attr("alt").toLowerCase(), { expires : 365, path: "/", domain: ".encyclopedex.com" });
						document.location.reload(true);
					}
				);

				$("#filtre").on("mouseover", "div",
					function() 
					{
						$(this).children("a").css("text-decoration", "line-through");
					}
				);
				
				$("#filtre").on("mouseout", "div",
					function() 
					{
						$(this).children("a").css("text-decoration", "none");
					}
				);
				
				$("#filtre").on("click", "div",
					function() 
					{
						effacer_critere($(this));
					}
				);
				
				$("#saisie").focus(
					function()
					{
						auto_completer();
					}
				);
				
				$("#saisie").blur(
					function()
					{
						focus_saisie = false; 
						setTimeout(
							function()
							{
								if(!focus_saisie)
								{
									$('#menu').slideUp('fast', 
										function()
										{
											$("#saisie").css("border-bottom-left-radius", "10px");
											$("#saisie").css("border-bottom-right-radius", "10px");			
										}
									);						
								}
							}, 
							100
						);
					}
				);
				
				$("#menu").on("mouseover", "div",
					function() 
					{
						$(this).css("color", "blue");
						$(this).css("z-index", "3");
						$(this).css("font-weight", "bold");
						$(this).css("border", "1px solid blue");
						$(this).css("box-shadow", "1px 1px 5px black");
					}
				);
				
				$("#menu").on("mouseout", "div",
					function() 
					{
						$(this).css("color", "#792400");
						$(this).css("z-index", "1");
						$(this).css("font-weight", "normal");
						$(this).css("border", "1px solid brown");
						$(this).css("box-shadow", "none");
					}
				);
				
				$("#menu").on("click", "div",
					function() 
					{
						click_completion($(this).attr("id").replace(/completion_/, ""));
					}
				);
				
				var debut_clic = -1;
				
				$("#pokedex").on("click", ".resultat",
					function() 
					{
						id = $(this).attr("data-id");
						zeros = "";
						if(id < 10)
							zeros = "00";
						else if(id < 100)
							zeros = "0";
						
						window.open("http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" + zeros + id + "&submit=Go+%21");	
					}
				);
				
				$("#pokedex").on("contextmenu", ".resultat",
					function() 
					{
						elem = "<div id='equipe_" + $("#equipe > .resultat").length + "' class='resultat'><img src='" + $(this).find("img").attr("src") + "' style='display: none;' /></div>";
						position_top = 0;
						
						if($("#equipe > .resultat").length == 0)
						{
							$("#equipe").append(elem);
							$("#footer").slideDown(400);

							position_top -= 106;
						}
						else
						{
							$("#equipe > .resultat").last().after(elem);
						}
						
						img = $(this).find("img").clone();
						
						img.css("z-index", "10");
						img.css("position", "absolute");
						img.css("top", $(this).offset().top);
						img.css("left", $(this).offset().left);
						
						$("body").append(img);
						
						position_top += $("#equipe > .resultat").last().offset().top;
						img.animate({top: position_top, left: $("#equipe > .resultat").last().offset().left}, 400);
						img.promise().done(
							function(obj)
							{
								$("#equipe_" + ($("#equipe > .resultat").length - 1)).find("img").show(); // Probleme : ne doit que focus qu'une seule div a la fois.
								$(this).remove();
							}
						);
						
						return false;
					}
				);
				
				$("#equipe").on("click", ".resultat",
					function() 
					{
						img = $(this).find("img").clone();
						
						img.css("z-index", "10");
						img.css("position", "absolute");
						img.css("top", $(this).offset().top);
						img.css("left", $(this).offset().left);
						
						$("body").append(img);						

						img.animate({opacity: 0, top: $(this).offset().top - 100}, 400, 
							function()
							{
								$(this).remove();
							}
						);
						
						$(this).remove();
												
						if($("#equipe > .resultat").length == 0)
						{
							$("#footer").slideUp(400);
						}
					}
				);

				$("#footer").on("click", "input",
					function()
					{
						alert("Coming soon...");
						return false;
					}
				);
				
				$("#pokedex").on("mousemove", ".resultat",
					function(event) 
					{
						afficher_infos_survol($(this).attr("data-id"), event);
					}
				);
				
				$("#pokedex").on("mouseover", ".resultat",
					function() 
					{
						$("#info_bulle_survol").css("display", "block");
						remplir_info_bulle($(this).attr("data-id"), $(this).attr("data-forme"));
						
						////////////////////////////////////////////
						/*id = $(this).attr("id");
						zeros = "";
						if(id < 10)
							zeros = "00";
						else if(id < 100)
							zeros = "0";
		
						$(this).find("img").attr("src", "http://www.pokebip.com/pokemon/pokedex/images/bw_animes/" + zeros + id + ".gif");
						
						//$(this).find("img").css("position", "absolute");
						$(this).find("img").css("margin-top", ((96 - $(this).css("height")) / 2) + "px");
						$(this).find("img").css("margin-left", ((96 - $(this).css("width")) / 2) + "px");*/
					}
				);
				
				$("#pokedex").on("mouseout", ".resultat",
					function() 
					{
						$("#info_bulle_survol").css("display", "none");
						
						////////////////////////////////////////////
						/*id = $(this).attr("id");
						$(this).find("img").attr("src", "http://www.pokebip.com/pokemon/pokedex/images/bw_front_m/" + id + ".png");
						$(this).find("img").css("margin-top", "0");
						$(this).find("img").css("margin-left", "0");*/
					}
				);
				
				$("#filtre").on("click", "#effacer_recherche",
					function() 
					{
						reinitilialiser_filtre();
					}
				);
				
				$("#filtre").on("click", "#partager_recherche", 
					function() 
					{
						$("html").scrollTop(0);
						
						$('#pop').bPopup(
							{
								speed: 300,
								transition: 'slideIn'
							}
						);
						
						liste_index = get_filtre_index();
												
						$.ajax({
							type: "POST",
							url: "/ajax/share_url.php",
							data: "toconvert=" + liste_index.join(","),
							success: function(data)
							{
								if(data != "" && !data.match(/#Erreur/))
								{
									$("#url_share").val("http://encyclopedex.com/pokedex/" + data);
									$("#url_share").select();
								}
								else
								{
									$("#url_share").val(data);
								}
							}
						});
			
						
					}
				);

				/*$(window).scroll(
					function()
					{
						if($(window).scrollTop() == 0)
							$("#header").css("position", "absolute");
						else
							$("#header").css("position", "fixed");
					}
				);*/
				
				<?php
				global $welcome;
				if($welcome)
				{
				?>
					$("#tuto > div:first").show();
					
					$("#tuto").bPopup(
						{
							speed: 300,
							transition: "slideIn",
							follow: [false, false],
							scrollBar: false,
							modalClose: false,
							closeClass: "close_popup"
						}
					);
				
					$(".close_popup").on("click",
						function() 
						{
							introduce_obj();
						}
					);
					
					etape_tuto = 0;
					url_arrivee = location.href;
					$(".avancer_tuto").on("click",
						function() 
						{
							if($("#tuto > div").length - 2 >= etape_tuto) // On passe a l'etape suivante. Si on est arrive au bout, on ferme le tuto.
								etape_tuto++;
							else
							{
								$(".close_popup").trigger("click");
								return location.href = url_arrivee;
							}
							
							$("#tuto > div:visible").hide("fast");
							$("#tuto > div:eq(" + etape_tuto + ")").show("fast", function()
								{
									if(etape_tuto == 1)
									{
										reinitilialiser_filtre();
										introduce_obj($("#saisie"));
										$("#tuto").animate({top: $("#saisie").offset().top + $("#saisie").height() + 25, left: $(window).width() / 2 - $("#tuto > div:eq(" + etape_tuto + ")").width() / 2}, 750, function(){$("#tuto > div:eq(" + etape_tuto + ")").show("fast");});
									}
									else if(etape_tuto == 3)
									{
										$("#saisie").val("d");
										auto_completer();
										introduce_obj($("#espace_recherche > div[id!=filtre] > div"));
										$("#tuto").animate({left: $("#saisie").offset().left + $("#saisie").width() + 15}, 750, function(){$("#tuto > div:eq(" + etape_tuto + ")").show("fast");});
									}
									else if(etape_tuto == 4)
									{
										selectionner_completion_fleches($("#menu > div.type:last").index("#menu > div"));
										introduce_obj($("#menu div.type:last"));								
									}
									else if(etape_tuto == 5)
									{
										valider_completion(0);
										introduce_obj($("#filtre div").first());
										$("#tuto").animate({top: $("#filtre div:first").offset().top + $("#filtre div:first").height() + 25, left: $(window).width() / 2 - $("#tuto > div:eq(" + etape_tuto + ")").width() / 2}, 750, function(){$("#tuto > div:eq(" + etape_tuto + ")").show("fast");});
									}
									else if(etape_tuto == 6)
									{
										introduce_obj($("#pokedex > .resultat"));
										$("#tuto").animate({top: 0, left: 0}, 750);
									}
									else if(etape_tuto == 7)
									{
										$("#saisie").val("Blizzard");
										auto_completer();
										valider_completion(0);
										introduce_obj($("#filtre > div:last"));
										$("#tuto").animate({top: $("#filtre div:last").offset().top + $("#filtre div:last").height() + 25, left: $("#filtre div:last").offset().left - $("#tuto > div:eq(" + etape_tuto + ")").width() / 2}, 750, function(){$("#tuto > div:eq(" + etape_tuto + ")").show("fast");});
									}
									else if(etape_tuto == 8)
									{
										introduce_obj($("#pokedex > .resultat"));
										$("#tuto").animate({top: 0, left: 0}, 750);
									}
									else if(etape_tuto == 9)
									{
										$("#saisie").val("SpA");
										auto_completer();
										selectionner_completion_fleches(0);
										valider_completion(0);
										introduce_obj($("#filtre > div:last"));
										$("#tuto").animate({top: $("#filtre div:last").offset().top + $("#filtre div:last").height() + 25, left: $(window).width() / 2 - $("#tuto > div:eq(" + etape_tuto + ")").width() / 2}, 750, function(){$("#tuto > div:eq(" + etape_tuto + ")").show("fast");});
									}
									else if(etape_tuto == 10)
									{
										introduce_obj($("#pokedex > .resultat"));
										$("#tuto").animate({top: $("#pokedex > .resultat:last").offset().top + $("#pokedex > .resultat:last").height() + 15, left: $(window).width / 2 - $("#tuto > div:eq(" + etape_tuto + ")").width() / 2}, 750);
									}
									else if(etape_tuto == 11)
									{
										introduce_obj($("#social"));
										$("#tuto").animate({top: $("#social").height() + $("#social").offset().top + 25, left: $(window).width() - $("#tuto").width()}, 750);
									}
									
									
									$(".b-modal").css("opacity", "0"); // Durant le tutoriel, on ne veut pas que le site soit cache.
								}
							);
						}
					);
				<?php
				}
				?>
				
				$("#url_share").on("click",
					function() 
					{
						if(!$("#pop input").val().match(/#Erreur/)) // On ne selectionne pas le texte s'il est survenu une erreur.
							$(this).select();
					}
				);
				
				var r_values = [];
				
				<?php
				$r = $_GET["r"];
				
				for($i = 1; $i < strlen($r); $i += 3) // Recuperation de la liste des criteres pre-renseignes par get.
				{
					echo "r_values.push(" . (strpos($alphabet, $r[$i]) * pow(strlen($alphabet), 2) + strpos($alphabet, $r[$i + 1]) * strlen($alphabet) + strpos($alphabet, $r[$i + 2])) . ");";
				}
				?>

				r_index = 0;
				for(r_index = 0; r_index < r_values.length; r_index++)
				{
					offset = 0;

					if(r_values[r_index] >= bdd.length)
						reinitilialiser_filtre("Erreur : code " + r_values[r_index] + " trop grand.");

					critere = bdd[r_values[r_index]][0];
					if(critere.match(/XXX/i)) // Gestion d'un cas particulier s'il s'agit d'un critere de statistique avec valeur.
					{
						if(++r_index >= r_values.length)
							reinitilialiser_filtre("Erreur : code erron\351.");

						critere = critere.replace(/XXX/i, r_values[r_index]);
						offset = -1;
					}

					$("#saisie").val(critere);
					auto_completer();

					select = 0;
					while($("#completion_" + select).attr("class") != bdd[r_values[r_index + offset]][1])
						select++;

					numero_completion = select; // Ici, a cause de l'attaque/type Vol, il faut chercher l'index du premier data-val.
					valider_completion(0);
				}
				
				actualiser_pokedex();
				
				modifier_bordure_saisie();
			}
		);
		
		function get_filtre_index()
		{			
			liste_index = new Array();
						
			$.each($("#filtre > div"),
				function()
				{
					for(var index in bdd)
					{
						if(bdd[index][1] == $(this).attr("class"))
						{
							if(bdd[index][2].match(/XXX/))
							{
								if(bdd[index][2].replace(/XXX/, "") == $(this).attr("data-val").replace(/[+-]?[0-9]+/, ""))
								{
									liste_index.push(index);
									
									if($(this).attr("data-val").match(/[0-9]/)) // S'il s'agit d'une stat personnalisable, on enregistre aussi la valeur entree par l'utilisateur.
										liste_index.push($(this).attr("data-val").match(/[+-]?[0-9]+/)); 
								}
							}

							if(bdd[index][2] == $(this).attr("data-val"))
							{
								liste_index.push(index);
							}
						}
					}
				}
			);
			
			return liste_index;
		}
		
		function reinitilialiser_filtre(txt)
		{
			$("#filtre").html("");
			$("#saisie").focus();
			$("#saisie").css("border-bottom-left-radius", "10px");
			$("#saisie").css("border-bottom-right-radius", "10px");	
			actualiser_pokedex();
			
			if(txt != "" && txt != undefined)
			{
				$("#saisie").val("");
				alert(txt);
				exit(0);
			}
		}
		
		function effacer_critere(obj)
		{
			$(obj).remove();
					
			if($("#filtre > div").length == 0)
				reinitilialiser_filtre();
			
			actualiser_pokedex();
		}

		function effacer_accents(str)
		{
			var r=str.toLowerCase();
            r = r.replace(new RegExp(/[àáâÉäå]/g),"a");
            r = r.replace(new RegExp(/æ/g),"ae");
            r = r.replace(new RegExp(/ç/g),"c");
            r = r.replace(new RegExp(/[èéêë]/g),"e");
            r = r.replace(new RegExp(/[ìíîï]/g),"i");
            r = r.replace(new RegExp(/ñ/g),"n");                
            r = r.replace(new RegExp(/[òóôõö]/g),"o");
            r = r.replace(new RegExp(/o/g),"oe");
            r = r.replace(new RegExp(/[ùúûü]/g),"u");
            r = r.replace(new RegExp(/[ýÿ]/g),"y");
            return r;
		}
		
		function htmlSpecialChars(str)
		{
			return str
					.replace(/&/, "&amp;")
					.replace(/</, "&lt;")
					.replace(/>/, "&gt;")
					.replace(/"/, "&quot;")
					.replace(/'/, "&#039;");
					//.replace(/ /, "&nbsp;");
		}
   
		function recherche(e)
		{
			key = 0;
			if(e.keyCode)
				key = e.keyCode;
			else
				key = e.which;

			if(key == 8) // || key == 46) // KEY_BACK_TAB ou KEY_DEL
			{
				if($("#saisie").val() == "" && saisie_precedente == "")
				{
					effacer_critere($("#filtre div").last());
				}
			}
			
			if(key == 40) // KEY_DOWN
			{
				selectionner_completion_fleches(numero_completion + 1);
			}
			else if(key == 38) // KEY_UP
			{
				selectionner_completion_fleches(numero_completion - 1);
			}
			else if(key == 32 && numero_completion == -1)
			{
				auto_completer();
			}
			else if(key == 13 || key == 32) // KEY_ENTER ou KEY_SPACE
			{
				// 1) Si completion selectionnee, on la choisi.
				// 2) Sinon, si on a plusieurs resultats, on regarde s'il y en a un qui match a 100%.
				// 3) Si oui, on la choisi. Sinon on ne choisi rien.
				
				if(numero_completion > -1)
				{
					valider_completion(key);
				}
				else if(key == 13 && $("#menu > *").length > 0)
				{
					numero_completion = 0;
					valider_completion(0);
				}
				else if(key == 13 && $("#saisie").val() == "" && $("#pokedex > .resultat").length > 0) // Si le menu d'aide a la selection est vide quand on appuie sur Entree, alors on ouvre la page du premier resultat.
				{
					$("#pokedex > .resultat:first").trigger("click");
				}
			}
			else
			{
				auto_completer();
			}
			
			modifier_bordure_saisie();
			
			saisie_precedente = $("#saisie").val();
		}
		
		function selectionner_completion_fleches(number)
		{
			$("#completion_" + numero_completion).trigger("mouseout");
			
			numero_completion = number;
			
			if(numero_completion > $("#menu > *").length - 1)
					numero_completion = 0;
			
			if(numero_completion < 0)
				numero_completion = $("#menu > *").length - 1;
			
			$("#completion_" + numero_completion).trigger("mouseover");
		}
		
		function valider_completion(key)
		{
			if(numero_completion > -1)
			{				
				if($("#completion_" + numero_completion).text().match(/XXX/) == "XXX") // On interdit la validation d'une stat incomplete.
				{
					$("#saisie").val($("#completion_" + numero_completion).text().trim().replace(/XXX/, ""));
					$("#saisie").focus();
					return;
				}
				
				contenu = $("#completion_" + numero_completion).clone().removeAttr("id");
				contenu.html(contenu.html().replace(/<b>/, "").replace(/<\/b>/, ""));
				contenu.css("color", "#792400");
				contenu.css("font-weight", "normal");
				contenu.css("border", "1px solid brown");
				
				if($("#filtre > div").length == 0)
				{
					$("#filtre").append('<img id="partager_recherche" src="/images/icones/share 24x24.png" alt="Partager" />');
					$("#filtre").append(contenu);
					$("#filtre").append('<img id="effacer_recherche" src="/images/icones/cancel 24x24.png" alt="Tout effacer" />');
				}
				else
				{
					$("#filtre div").last().after(contenu);
				}

				$("#filtre").sortable(
					{
						scroll: false,
						helper: 'clone',
						revert: true,
						cursor: 'move',
						delay: 150,
						stop: function()
						{
							actualiser_pokedex();
						}	
					}
				);
				
				$("#saisie").val("");
				$("#saisie").focus();
				
				if(!r_index)
					actualiser_pokedex();
			}
		}
		
		var xhr = "";
		
		function actualiser_pokedex()
		{
			r_index = ""; // Fin de l'auto_selection.
			
			$("#pokedex").html("<img class='loading' src='/images/icones/pokeball.png' alt='Attente' />");
			afficher_nombre_resultats();
			
			// On actualise l'URL pour qu'elle corresponde a la recherche.
			$.ajax({ 
				type: "POST",
				url: "/ajax/share_url.php",
				data: "toconvert=" + get_filtre_index().join(","),
				success: function(data)
				{
					if(data != "" && !data.match(/#Erreur/))
						window.history.replaceState("", "Pokédex - Encyclopedex", "/pokedex/" + data);
					else
						window.history.replaceState("", "Pokédex - Encyclopedex", "/pokedex/");
				}
			});
						
			liste_cat = new Array;
			liste_val = new Array;
			$("#filtre > div").each(
				function()
				{
					liste_cat.push(encodeURIComponent($(this).attr("class")));
					liste_val.push(encodeURIComponent($(this).attr("data-val")));
				}
			);
						
			numero_requete = ++nombre_requetes; // Ce chiffre permet de connaitre la requete en cours pour n'afficher que les resultats de cette derniere.
			
			if(xhr != "")
				xhr.abort();
			else
			{
				xhr = $.ajax({
					type: "POST",
					url: "/ajax/filtrer_json.php",
					data: "cat=" + liste_cat.join(",") + "&val=" + liste_val.join(","),
					success: function(data)
					{
						if(numero_requete == nombre_requetes)
						{
							var j = JSON && JSON.parse(data) || $.parseJSON(data);

							$("#pokedex").html("");
							for(var pkmn_nb = 0; pkmn_nb < j.length; pkmn_nb++) // On parcourt la liste des Pokemon.
							{
								var temp = "";
								var pkmn = j[pkmn_nb];
								var img = "/images/pkmn/fixe/" + pkmn.id + (pkmn.form ? "-" + pkmn.form : "") + ".png";
								
								var regexp = new RegExp("id='" + pkmn.id + "'", "g");
								temp += "<div data-id='" + pkmn.id + "' class='resultat'" + (pkmn.form ? " data-forme='" + pkmn.form + "'" : "") + "><img src='" + img + "' alt='#" + pkmn.id + "' />";
								
								if(pkmn.s) // Si le l'objet pokemon contient des informations autres que l'id et la forme, on les affiche.
								{
									temp += "<div><a>&nbsp;</a>";
									
									for(var i = 0; i < pkmn.s.length; i++)
									{
										var stat_val = pkmn.s[i];
										var stat_name = $("#filtre .stat:eq(" + i + ")").text().trim().match("^[^ ]+");
										temp += "<a>" + stat_name + "&nbsp;" + stat_val + "</a>";
									}

									temp += "</div>";
								}
								
								temp += "</div>";
								$("#pokedex").append(temp);
							}

							afficher_nombre_resultats();

							$("#pokedex > .resultat div").css("marginTop", ($("#pokedex > .resultat:first").height() - $("#pokedex > .resultat:first div > a").length * $("#pokedex > .resultat:first div > a:first").height()) + "px"); // Colle le texte au bas de l'image.
							
							$("#pokedex > .resultat").draggable(
								{
									cursor: 'move',
									stack: "#pokedex > .resultat",
									delay: 150

								}
							);
						}
					}
				});
				
				xhr = "";
			}

			/*$.post("ajax/filtrer.php", { cat: liste_cat.join(","), val: liste_val.join(",") }, 
				function(data)
				{
					$("#pokedex").html("").html(data);
					$(".resultat div").css("marginTop", ($(".resultat:first").height() - $(".resultat:first div > a").length * $(".resultat:first div > a:first").height()) + "px"); // Colle le texte au bas de l'image.
					afficher_nombre_resultats();
				}
			);*/
			
			$("#saisie").val("");
			saisie_precedente = "";
			auto_completer();
		}
		
		function surligner_correspondance(resultat, saisie)
		{
			texte = resultat[1];
			len = $.trim(saisie).length;
			pos = resultat[0];
			
			if(pos < 0)
				pos = 0;
			
			substr1 = (pos == 0 ? "" : texte.substr(0, pos));
			substr2 = texte.substr(pos, len);
			substr3 = (pos + len >= texte.length ? "" : texte.substr(pos + len));
			
			return htmlSpecialChars(substr1) + "<b>" + htmlSpecialChars(substr2) + "</b>" + htmlSpecialChars(substr3);
		}

		function auto_completer()
		{
			// Initialisation et securites.
			numero_completion = -1;
			$("#menu").html("");

			saisie = effacer_accents($("#saisie").val().toLowerCase());
			
			if($.trim(saisie) == "")
				return;
			
			focus_saisie = true;
			$("#menu").show();
			
			tab = [];
			
			// Recherche.
			for(var index in bdd)
			{
				var mot  = bdd[index][0];
				var stat = bdd[index][2];
				
				if(val = saisie.match(/[+-]?[0-9]+$/)) // L'autocompletion s'adapte aux stats.
				{
					mot = mot.replace(/XXX$/, val);
					stat = stat.replace(/XXX$/, val);
				}
				
				pos = effacer_accents(mot.toLowerCase()).indexOf(saisie);
				
				if(pos !== -1)
				{
					if(effacer_accents(mot.toLowerCase()) == saisie)
					{
						pos = -2;
					}
					else if(effacer_accents(mot.toLowerCase()).indexOf(saisie + " ") === 0)
					{
						pos = -1;
					}
					
					if(bdd[index][1] == "attaque")
						tab.push([pos, mot, bdd[index][1], bdd[index][2], bdd[index][3]]); // index 3 sert a afficher si l'attaque est physique, speciale ou autre.
					else if(bdd[index][1] == "stat" || mot.match(/[<>=]/))
						tab.push([pos, mot, bdd[index][1], stat]);
					else
						tab.push([pos, mot, bdd[index][1], bdd[index][2]]);
				}
			}
			
			// Auto-selection automatique si espace a la fin du mot.
			if(tab.length <= 0 && saisie.match(/[^ ] $/))
			{
				saisie_bis = saisie.slice(0, -1);
				for(var index in bdd)
				{
					pos = effacer_accents(bdd[index][0].toLowerCase()).indexOf(saisie_bis);
					
					if(pos !== -1)
					{						
						if(bdd[index][1] == "attaque")
							tab.push([pos, bdd[index][0], bdd[index][1], bdd[index][2], bdd[index][3]]);
						else
							tab.push([pos, bdd[index][0], bdd[index][1], bdd[index][2]]);
					}
				}
			}
			
			// Tri des resultats.
			tab.sort(
				function(a, b)
				{
					if(a[0] < b[0])
						return -1;	
					
					if(a[0] == b[0])
						if(a[1].length < b[1].length)
							return -1;
					
					return 1;
				}
			);
			
			// Affichage des resultats.
			for(i = 0; i < tab.length && i < 15; i++)
			{
				affichage = "<a>" + surligner_correspondance(tab[i], saisie) + "</a>";
				
				if(tab[i][2] == "type")
				{
					affichage = "<img src='/images/pkmn/type/" + tab[i][3] + ".png' alt='#" + tab[i][1] + "' />&nbsp;" + affichage;
				}
				else if(tab[i][2] == "pokemon" || tab[i][2] == "numero")
				{
					affichage = "<img src='/images/pkmn/mini/" + tab[i][3] + ".png' alt='#" + tab[i][3] + "' />&nbsp;" + affichage;
				}
				else if(tab[i][2] == "attaque")
				{
					if(tab[i][4] == 1)
						cat = "Physique";
					else if(tab[i][4] == 2)
						cat = "Spéciale";
					else
						cat = "Statut"; // Status actually...
					
					affichage = "<img src='/images/pkmn/cat/" + tab[i][4] + ".png' alt='" + cat + "' />&nbsp;" + affichage;
				}

				$("#menu").html($("#menu").html() + "<div id='completion_" + i + "' class='" + tab[i][2] + "' data-val='" + tab[i][3] + "'>&nbsp;" + affichage + "&nbsp;</div>");
			}
			
			// Auto-selection si resultat pertinent.
			if(tab.length == 1)
			{
				selectionner_completion_fleches(0);
				
				if(saisie.match(/[^ ] $/)) // Permet de valider le mot avec un espace pour les gens qui tapent trop vite ou sur smartphone.
				{
					if(!saisie.match(/[<>=]/)) // Permet d'eviter les boucles infinies (la validation d'une stat change la saisie avec un espace a la fin, ce qui entraine l'auto_completion qui entraine la validation ...).
						valider_completion(0);
				}
			}
			else if(tab.length > 1)
			{
				if($.trim(effacer_accents(tab[0][1].toLowerCase().replace(/&nbsp;/, " "))) == saisie)
				{
					if(tab[1][0] >= 0)
					{
						selectionner_completion_fleches(0);
					}
				}
			}
			
			modifier_bordure_saisie();
		}
		
		function modifier_bordure_saisie()
		{
			if($("#menu div").length > 0)
			{
				$("#saisie").css("border-bottom-left-radius", "0px");
				$("#saisie").css("border-bottom-right-radius", "0px");
			}
			else
			{
				$("#saisie").css("border-bottom-left-radius", "10px");
				$("#saisie").css("border-bottom-right-radius", "10px");
			}
		}

		function afficher_nombre_resultats()
		{
			var nombre_affiches = 0;
			var nombre_pokemons = 0;
			var liste = [];

			$("#pokedex > .resultat").each(
				function() 
				{
					var id = $(this).attr("data-id");
					
					if(liste.indexOf(id) == -1)
					{
						nombre_pokemons++;
						liste.push(id);
					}

					nombre_affiches++;
				}
			);

			var nombre_formes_supplementaires = nombre_affiches - nombre_pokemons;
			
			liste_cat = new Array;
			liste_val = new Array;
			$("#filtre > div").each(
				function()
				{
					liste_cat.push(encodeURIComponent($(this).attr("class")));
					liste_val.push(encodeURIComponent($(this).attr("data-val")));
				}
			);




			//////////////////////////////////////////////////////////////
			if($.inArray("attaque", liste_cat) != -1)
			{
				if($.inArray("attaque", liste_cat, $.inArray("attaque", liste_cat) + 1) != -1) // S'il y a plusieurs elements de cette categorie.
				{
					//alert("competence");
				}
			}
			//////////////////////////////////////////////////////////////




			// On adapte l'affichage des resultats.
			if($("#pokedex").css("width").replace(/px/, "") > nombre_affiches * 96)
				$("#pokedex > .resultat").css("float", "none");
			else
				$("#pokedex > .resultat").css("float", "left");
			
			// Affichage du nombre de resultats.
			if($("#pokedex > img").length > 0) // Si on charge les resultats.
			{
				$("#nombre_resultats_recherche").html("<i>Search in progress...</i>");
			}
			else
			{
				texte = "";
				if(nombre_affiches == 0)
				{
					texte = "No result";
				}
				else if(nombre_affiches == 1)
				{
					texte = "1 single result";
				}
				else
				{
					texte = nombre_affiches + " results";
					
					if(nombre_formes_supplementaires > 0)
					{
						if(nombre_pokemons == 1)
							texte += " (1 Pok&eacute;mon";
						else
							texte += " (" + nombre_pokemons + " Pok&eacute;mon(s)";
						
						if(nombre_formes_supplementaires == 1)
							texte += " + 1 form)";
						else
							texte += " + " + nombre_formes_supplementaires + " forms)";
					}
					/*else if(nombre_formes > 0) // A ce point, on a trouve que des "first".
					{
						if(nombre_formes == 1)
							texte += " (Dont 1 forme particuli&egrave;re)";
						else
							texte += " (Dont " + nombre_formes + " formes particuli&egrave;res)";
					}*/
				}
				
				$("#nombre_resultats_recherche").html(texte);
			}
		}
		
		function afficher_infos_survol(id, event)
		{
			if(navigator.appName.match(/Microsoft/))
			{
				cursor = getCursor(event);
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + document.body.scrollTop + 15) + "px");
				$("#info_bulle_survol").css("display", "block");	
			}
			else
			{
				cursor = getCursor(event);
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + 15) + "px");
				$("#info_bulle_survol").css("display", "block");	
			}
		}
		
		function remplir_info_bulle(id, forme)
		{
			$.get("/ajax/get_info_bulle.php", { id: id, forme: forme, lang: $.cookie("lang") }, 
				function(data) 
				{
					$("#info_bulle_survol").html("").html(data);
				}
			);
		}
		
		function cacher_infos_survol(event)
		{
			//$("#info_bulle_survol").style.display = "none";
			$("#info_bulle_survol_img1").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
			$("#info_bulle_survol_img2").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
		}
		
		function getCursor(e) //Cette fonction n'est pas de moi.
		{
			e = e || window.event;
			return {'x': e.clientX, 'y': e.clientY};
		}
		
		function click_completion(id)
		{
			numero_completion = id;
			valider_completion(0);
		}
		
		function introduce_obj(obj)
		{
			// Gestion de la transparence des elements.
			$("body *").css("opacity", "1");
			
			// Gestion de l'animation de halo lumineux.
			$("body *").css("animation", "");
			$("body *").css("-webkit-animation", "");

			if(obj != undefined && obj != null)
			{
				// Gestion de la transparence des elements.
				$("body *").css("opacity", "0.5");
				$("#tuto").css("opacity", "1");
				$("#tuto *").css("opacity", "1");
				
				obj.css("opacity", "1");
				obj.find("*").css("opacity", "1");
				obj.parents().css("opacity", "1");
			
				// Gestion de l'animation de halo lumineux.
				obj.css("animation", "Glowing .6s infinite alternate");
				obj.css("-webkit-animation", "Glowing .6s infinite alternate");
			}
		}
		</script>
    </head>
	
    <body>			
		<div id="fond"></div>
		<!-- Debut Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-39929226-1', 'encyclopedex.com');
			ga('send', 'pageview');
		</script>
		<!-- Fin Google Analytics -->
		
		<!-- Debut SDK JS Facebook -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=183420345139463";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- Fin SDK JS Facebook -->
		
		<div id="pop" class="popup">
			<div>Save or share your search with this link:</div>
			<input type="text" id="url_share" />
		</div>
		
		<div id="tuto" class="popup">
			<div>
				Welcome to Encyclopedex!<br />
				Do to want to learn to use the Pok&eacute;dex?<br />
				It takes about a minute.<br />
				<input class="avancer_tuto" type="button" value="Yes please!" /><br />
				<input class="close_popup" type="button" value="No thank you." />
			</div>
			
			<div>
				Here is the search bar.<br />
				You select the search filters from it.<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				You can pick a filter from the following categories:<br />
				<br />
				<div class="pokemon">Pokémon</div>
				<div class="numero">National ID</div>
				<div class="type">Type</div>
				<div class="capspe">Ability</div>
				<div class="attaque">Move</div>
				<div class="stat">Statitics</div>
				<br />
				... more categories coming soon!<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				Demonstration:<br />
				Let's type in the letter "D" in the search bar.<br />
				A dropdown menu appears. It displays the most relevant filter matches.<br />
				The background color represents the category of a filter.<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				When a filter is selected it appears blue.<br />
				There are several ways to select a filter:<br />
				
				<p>
					1) Clicking it.<br />
					2) Using the up and down arrows then pressing Enter.<br />
					3) Otherwise pressing Enter selects the first result.<br />
					4) When there is a single result in the dropdown menu, press Space to select it.<br />
				</p>
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				Once you validated the filter, it is displayed on the top on the search bar.<br />
				This area is called the search filter.<br />
				Here are the 3 ways to erase a search filter:<br />
				
				<p>
					1) Clicking it.<br />
					2) Pressing Backspace when the search bar is empty.<br />
					3) Clicking the red cross resets the search filter area.
				</p>
				
				Tip: you can save or share your search with the share button on the left.<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				The Pok&eacute;mon list is refreshed automatically.<br />
				Here is the list of the Dragon type Pokémons!<br />
				Click on a result to go to its information page.<br />
				<br />
				Tip: when the search bar is empty, press Enter to go to the first result's information page.<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>

			<div>
				You can mix several filters.<br />
				For example, let's add the filter "Blizzard".<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>

			<div>
				The list of the Dragon type Pok&eacute;mons learning the move Blizzard is now displayed!<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>

			<div>
				Let's add the filter "SpA" to sort the results by their base Special Attack value.<br />
				<input class="avancer_tuto" type="button" value="Next" />
			</div>

			<div>
				We can notice several facts:<br />
				<p>
					1) The Special Attack stat is now displayed.<br />
					2) The results are sorted.<br />
					3) The different Pok&eacute;mon forms are treated as individual results<br />
					(Here we can see Kyurem and his 2 others forms).<br />
				</p>
				<input class="avancer_tuto" type="button" value="Next" />
			</div>
			
			<div>
				This is the end of this tutorial.<br />
				If you like this Pokédex please tell your friends!<br />
				Feel free to email me for any reason.<br />
				<br />
				Enjoy :)<br />
				<input class="avancer_tuto" type="button" value="Finish" />
			</div>
		</div>
		
		
				
		<div id="info_bulle_survol">
			<p id="info_bulle_survol_txt" style="padding-bottom: 3px; margin: 0px;"></p>
			<img id="info_bulle_survol_img1" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
			<img id="info_bulle_survol_img2" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
		</div>
		
		<div id="header">
			<div id="logo">
				<a href="http://encyclopedex.com"><img src="/images/logos/encyclopedex_logo7.png" alt="Encyclopedex" /></a>
			</div>
			
			<div id="social">
				<!-- Debut medias sociaux -->
				<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.encyclopedex.com%2F&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=183420345139463" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
				
				<div class="social_button">
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr">Tweeter</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				
				<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" class="social_button" data-size="medium"></div>

				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				  window.___gcfg = {lang: 'fr'};

				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
				<!-- Fin medias sociaux -->
				
				<br />
				
				<div>
					Contact : <a href="mailto:contact@encyclopedex.com">contact@encyclopedex.com</a>
				</div>

				<div id="langs">
					<img src="/images/flags/flag_en.png" title="Let's speak English" alt="en" />
					<img src="/images/flags/flag_fr.png" title="Parlons Fran&ccedil;ais" alt="fr" />
				</div>
			</div>
			
			
			<div id="espace_recherche">
				<div id="filtre">
				</div>
						
				<div style="margin: 0.5em auto; width: 15em;">
						<div>
							<input id="saisie" type="text" onkeyup="recherche(event);" placeholder="Search by type, attack, stat..." autocomplete="off" autofocus />
						</div>

						<div id="menu">
						</div>
				</div>
				
				<script type="text/javascript">
					$("#saisie").val("");
					$("#saisie").focus();
				</script>
			</div>
		</div>
		
		<div id="total" style="margin: auto; text-align: center;">
			<div id="nombre_resultats_recherche" style="padding-top: 100px; "></div>
			
			<div id="pokedex" style="max-width: 960px; margin: auto;"></div>
		</div>
		
		<div id="footer">
			<div id="equipe">
			</div>
			
			<div>
				<input type='button' value='Compare' /><br />
				<input type='button' value='Battle' /><br />
				<input type='button' value='Analyze' />
			</div>
		</div>
	</body>
	
</html>
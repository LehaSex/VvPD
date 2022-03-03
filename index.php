<html>
    <head>
        <title>reshetnikov.sh</title>
        <link rel="stylesheet" media="all" type="text/css" href="css/style.css">
        <link rel="stylesheet" media="all" type="text/css" href="css/rain.css">
		<audio loop id="music">
		<source src="files/music.mp3" type="audio/mpeg">
	</audio>
    </head>
    <body>
	<?PHP
date_default_timezone_set('Europe/Moscow');

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

$user_ip = getUserIP();

$file = file("count");
$count = implode("", $file);
$count++;
$myfile = fopen("count","w");
fputs($myfile,$count);
fclose($myfile);

$filename = 'js/script.js'; 
$creation_date = date_create(date("F d Y H:i", filectime($filename)));
$now = date_create(date("F d Y H:i"));
$diff = date_diff($creation_date, $now);
?>
	<div class="rain front-row"><div class="drop" style="left: 2%; bottom: 103%; animation-delay: 0.72s; animation-duration: 0.572s;"><div class="stem" style="animation-delay: 0.72s; animation-duration: 0.572s;"></div><div class="splat" style="animation-delay: 0.72s; animation-duration: 0.572s;"></div></div><div class="drop" style="left: 6%; bottom: 107%; animation-delay: 0.66s; animation-duration: 0.566s;"><div class="stem" style="animation-delay: 0.66s; animation-duration: 0.566s;"></div><div class="splat" style="animation-delay: 0.66s; animation-duration: 0.566s;"></div></div><div class="drop" style="left: 9%; bottom: 105%; animation-delay: 0.6s; animation-duration: 0.56s;"><div class="stem" style="animation-delay: 0.6s; animation-duration: 0.56s;"></div><div class="splat" style="animation-delay: 0.6s; animation-duration: 0.56s;"></div></div><div class="drop" style="left: 13%; bottom: 107%; animation-delay: 0.92s; animation-duration: 0.592s;"><div class="stem" style="animation-delay: 0.92s; animation-duration: 0.592s;"></div><div class="splat" style="animation-delay: 0.92s; animation-duration: 0.592s;"></div></div><div class="drop" style="left: 18%; bottom: 109%; animation-delay: 0.97s; animation-duration: 0.597s;"><div class="stem" style="animation-delay: 0.97s; animation-duration: 0.597s;"></div><div class="splat" style="animation-delay: 0.97s; animation-duration: 0.597s;"></div></div><div class="drop" style="left: 23%; bottom: 109%; animation-delay: 0.30s; animation-duration: 0.530s;"><div class="stem" style="animation-delay: 0.30s; animation-duration: 0.530s;"></div><div class="splat" style="animation-delay: 0.30s; animation-duration: 0.530s;"></div></div><div class="drop" style="left: 27%; bottom: 107%; animation-delay: 0.79s; animation-duration: 0.579s;"><div class="stem" style="animation-delay: 0.79s; animation-duration: 0.579s;"></div><div class="splat" style="animation-delay: 0.79s; animation-duration: 0.579s;"></div></div><div class="drop" style="left: 30%; bottom: 105%; animation-delay: 0.40s; animation-duration: 0.540s;"><div class="stem" style="animation-delay: 0.40s; animation-duration: 0.540s;"></div><div class="splat" style="animation-delay: 0.40s; animation-duration: 0.540s;"></div></div><div class="drop" style="left: 32%; bottom: 103%; animation-delay: 0.74s; animation-duration: 0.574s;"><div class="stem" style="animation-delay: 0.74s; animation-duration: 0.574s;"></div><div class="splat" style="animation-delay: 0.74s; animation-duration: 0.574s;"></div></div><div class="drop" style="left: 35%; bottom: 105%; animation-delay: 0.65s; animation-duration: 0.565s;"><div class="stem" style="animation-delay: 0.65s; animation-duration: 0.565s;"></div><div class="splat" style="animation-delay: 0.65s; animation-duration: 0.565s;"></div></div><div class="drop" style="left: 38%; bottom: 105%; animation-delay: 0.26s; animation-duration: 0.526s;"><div class="stem" style="animation-delay: 0.26s; animation-duration: 0.526s;"></div><div class="splat" style="animation-delay: 0.26s; animation-duration: 0.526s;"></div></div><div class="drop" style="left: 41%; bottom: 105%; animation-delay: 0.74s; animation-duration: 0.574s;"><div class="stem" style="animation-delay: 0.74s; animation-duration: 0.574s;"></div><div class="splat" style="animation-delay: 0.74s; animation-duration: 0.574s;"></div></div><div class="drop" style="left: 44%; bottom: 105%; animation-delay: 0.83s; animation-duration: 0.583s;"><div class="stem" style="animation-delay: 0.83s; animation-duration: 0.583s;"></div><div class="splat" style="animation-delay: 0.83s; animation-duration: 0.583s;"></div></div><div class="drop" style="left: 47%; bottom: 105%; animation-delay: 0.87s; animation-duration: 0.587s;"><div class="stem" style="animation-delay: 0.87s; animation-duration: 0.587s;"></div><div class="splat" style="animation-delay: 0.87s; animation-duration: 0.587s;"></div></div><div class="drop" style="left: 49%; bottom: 103%; animation-delay: 0.62s; animation-duration: 0.562s;"><div class="stem" style="animation-delay: 0.62s; animation-duration: 0.562s;"></div><div class="splat" style="animation-delay: 0.62s; animation-duration: 0.562s;"></div></div><div class="drop" style="left: 54%; bottom: 109%; animation-delay: 0.67s; animation-duration: 0.567s;"><div class="stem" style="animation-delay: 0.67s; animation-duration: 0.567s;"></div><div class="splat" style="animation-delay: 0.67s; animation-duration: 0.567s;"></div></div><div class="drop" style="left: 59%; bottom: 109%; animation-delay: 0.60s; animation-duration: 0.560s;"><div class="stem" style="animation-delay: 0.60s; animation-duration: 0.560s;"></div><div class="splat" style="animation-delay: 0.60s; animation-duration: 0.560s;"></div></div><div class="drop" style="left: 63%; bottom: 107%; animation-delay: 0.71s; animation-duration: 0.571s;"><div class="stem" style="animation-delay: 0.71s; animation-duration: 0.571s;"></div><div class="splat" style="animation-delay: 0.71s; animation-duration: 0.571s;"></div></div><div class="drop" style="left: 66%; bottom: 105%; animation-delay: 0.50s; animation-duration: 0.550s;"><div class="stem" style="animation-delay: 0.50s; animation-duration: 0.550s;"></div><div class="splat" style="animation-delay: 0.50s; animation-duration: 0.550s;"></div></div><div class="drop" style="left: 71%; bottom: 109%; animation-delay: 0.76s; animation-duration: 0.576s;"><div class="stem" style="animation-delay: 0.76s; animation-duration: 0.576s;"></div><div class="splat" style="animation-delay: 0.76s; animation-duration: 0.576s;"></div></div><div class="drop" style="left: 74%; bottom: 105%; animation-delay: 0.35s; animation-duration: 0.535s;"><div class="stem" style="animation-delay: 0.35s; animation-duration: 0.535s;"></div><div class="splat" style="animation-delay: 0.35s; animation-duration: 0.535s;"></div></div><div class="drop" style="left: 76%; bottom: 103%; animation-delay: 0.65s; animation-duration: 0.565s;"><div class="stem" style="animation-delay: 0.65s; animation-duration: 0.565s;"></div><div class="splat" style="animation-delay: 0.65s; animation-duration: 0.565s;"></div></div><div class="drop" style="left: 78%; bottom: 103%; animation-delay: 0.68s; animation-duration: 0.568s;"><div class="stem" style="animation-delay: 0.68s; animation-duration: 0.568s;"></div><div class="splat" style="animation-delay: 0.68s; animation-duration: 0.568s;"></div></div><div class="drop" style="left: 81%; bottom: 105%; animation-delay: 0.86s; animation-duration: 0.586s;"><div class="stem" style="animation-delay: 0.86s; animation-duration: 0.586s;"></div><div class="splat" style="animation-delay: 0.86s; animation-duration: 0.586s;"></div></div><div class="drop" style="left: 84%; bottom: 105%; animation-delay: 0.47s; animation-duration: 0.547s;"><div class="stem" style="animation-delay: 0.47s; animation-duration: 0.547s;"></div><div class="splat" style="animation-delay: 0.47s; animation-duration: 0.547s;"></div></div><div class="drop" style="left: 87%; bottom: 105%; animation-delay: 0.71s; animation-duration: 0.571s;"><div class="stem" style="animation-delay: 0.71s; animation-duration: 0.571s;"></div><div class="splat" style="animation-delay: 0.71s; animation-duration: 0.571s;"></div></div><div class="drop" style="left: 89%; bottom: 103%; animation-delay: 0.60s; animation-duration: 0.560s;"><div class="stem" style="animation-delay: 0.60s; animation-duration: 0.560s;"></div><div class="splat" style="animation-delay: 0.60s; animation-duration: 0.560s;"></div></div><div class="drop" style="left: 92%; bottom: 105%; animation-delay: 0.27s; animation-duration: 0.527s;"><div class="stem" style="animation-delay: 0.27s; animation-duration: 0.527s;"></div><div class="splat" style="animation-delay: 0.27s; animation-duration: 0.527s;"></div></div><div class="drop" style="left: 95%; bottom: 105%; animation-delay: 0.19s; animation-duration: 0.519s;"><div class="stem" style="animation-delay: 0.19s; animation-duration: 0.519s;"></div><div class="splat" style="animation-delay: 0.19s; animation-duration: 0.519s;"></div></div><div class="drop" style="left: 97%; bottom: 103%; animation-delay: 0.87s; animation-duration: 0.587s;"><div class="stem" style="animation-delay: 0.87s; animation-duration: 0.587s;"></div><div class="splat" style="animation-delay: 0.87s; animation-duration: 0.587s;"></div></div><div class="drop" style="left: 101%; bottom: 107%; animation-delay: 0.39s; animation-duration: 0.539s;"><div class="stem" style="animation-delay: 0.39s; animation-duration: 0.539s;"></div><div class="splat" style="animation-delay: 0.39s; animation-duration: 0.539s;"></div></div></div>
    <div id="homepage" class="middle">
      <div id="terminal">
        <div id="terminal-header">
          <div>
            <div id="controls">
              <i class="fa fa-window-minimize" style="font-size: 8px;"></i>
              <i class="fa fa-window-restore" style="font-size: 10px;"></i>
              <i class="fa fa-times" style="font-size: 14px;"></i>
            </div>
			<div style="margin: 0 auto; width: 100px;">reshetnikov.sh</div>
          </div>
        </div>
<div id="content">
			<noscript>
				</br>
				<div>
				<span class="red">root@reshetnikov.sh</span>:<span class="blue">~</span># ./nojs.sh
					<p>Please enable JavaScript to use this site.</p>
				</div>
			</noscript>
		</div>
      </div>
      <span class="taille"></span>
    </div>
	<script>var visits = <?php echo $count?>;var visitorIP = "<?php echo $user_ip; ?>";var visitorCountry = "<?php echo ip_info('$user_ip', 'Country');?>";var visitorCountryCode = "<?php echo ip_info('$user_ip', 'Country Code');?>";var lastCountry0 = "RU";var lastCountry1 = "RU";var lastCountry2 = "RU";var lastCountry3 = "RU";var lastCountry4 = "RU";var lastUpdate = "<?php echo date_format($creation_date, 'F d Y H:i'); ?>";var upTime = "<?php echo $diff->format('%ad %hh %im') ?>";</script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script>
  $(document).ready(function() {    
	$("body").niceScroll();
	$("#divexample1").niceScroll();
  });
</script>
	<script src="js/script.js?1273455236"></script>
	<script src="js/rain.js"></script>
	
	
	</body>
</html>
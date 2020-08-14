<?php
  header("Access-Control-Allow-Origin: *");
  
  // List of the servers
  $servers = array (
    array("country"=>"Melbourne, Australia","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/au.svg","ip"=>"103.19.173.140","provider"=>"Wireline","found"=>"false","result"=>""),
    array("country"=>"São Paulo, Brazil","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/br.svg","ip"=>"201.28.69.243","provider"=>"Telefonica Brasil Govt.","found"=>"false","result"=>""),
    array("country"=>"Shenzhen, China","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/cn.svg","ip"=>"202.46.34.75","provider"=>"ShenZhen Sunrise LTD.","found"=>"false","result"=>""),
    array("country"=>"Cairo, Egypt","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/eg.svg","ip"=>"41.65.107.18","provider"=>"Etisalat Misr","found"=>"false","result"=>""),
    array("country"=>"Paris, France","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/fr.svg","ip"=>"92.222.80.47","provider"=>"OVH SAS","found"=>"false","result"=>""),
    array("country"=>"Berlin, Germany","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/ge.svg","ip"=>"195.202.52.30","provider"=>"1&1 Versatel Deutschland GmbH","found"=>"false","result"=>""),
    array("country"=>"Gurgaon, India","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/in.svg","ip"=>"182.71.213.139","provider"=>"Airtel International","found"=>"false","result"=>""),
    array("country"=>"Tel Aviv, Israel","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/is.svg","ip"=>"62.219.165.91","provider"=>"Bezeq International","found"=>"false","result"=>""),
    array("country"=>"Tehran, Iran","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/ir.svg","ip"=>"212.16.81.14","provider"=>"Farhang Communications","found"=>"false","result"=>""),
    array("country"=>"Tokyo, Japan","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/jp.svg","ip"=>"182.171.247.189","provider"=>"So-Net Corp.","found"=>"false","result"=>""),
    array("country"=>"Mexico City, Mexico","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/me.svg","ip"=>"148.243.227.67","provider"=>"Mea Cable S.A","found"=>"false","result"=>""),
    array("country"=>"Rotterdam, Netherlands","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/ne.svg","ip"=>"92.111.212.210","provider"=>"Liberty Global B.V.","found"=>"false","result"=>""),
    array("country"=>"Abuja, Nigeria","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/ni.svg","ip"=>"41.217.204.165","provider"=>"Layer3","found"=>"false","result"=>""),
    array("country"=>"Islamabad, Pakistan","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/pa.svg","ip"=>"111.68.99.194","provider"=>"PERN","found"=>"false","result"=>""),
    array("country"=>"Kochchikade, Sri Lanka","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/sr.svg","ip"=>"203.143.22.209","provider"=>"Lanka Communication Services","found"=>"false","result"=>""),
    array("country"=>"Stockholm, Sweden","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/sw.svg","ip"=>"5.35.191.124","provider"=>"Unknown","found"=>"false","result"=>""),
    array("country"=>"Singapore, Singapore","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/si.svg","ip"=>"103.2.182.68","provider"=>"Pacific Internet Pte Ltd","found"=>"false","result"=>""),
    array("country"=>"Taipei, Taiwan","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/ta.svg","ip"=>"210.59.147.53","provider"=>"Data Communication Business Group","found"=>"false","result"=>""),
    array("country"=>"Istanbul, Turkey","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/tk.svg","ip"=>"176.33.142.139","provider"=>"Tellcom Iletisim Hizmetleri A.S","found"=>"false","result"=>""),
    array("country"=>"Edinburgh, United Kingdom","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/uk.svg","ip"=>"84.19.224.204","provider"=>"Pulsant","found"=>"false","result"=>""),
    array("country"=>"Bangkok, Thailand","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/th.svg","ip"=>"180.180.241.2","provider"=>"TOT Public Company Limited","found"=>"false","result"=>""),
    array("country"=>"San Francisco,	United States","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/us.svg","ip"=>"157.245.161.252","provider"=>"DigitalOcean ASN","found"=>"false","result"=>""),
    array("country"=>"Hanoi, Viet Nam","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/vi.svg","ip"=>"14.232.154.7","provider"=>"VNTP Corp","found"=>"false","result"=>""),
    array("country"=>"Central, Zimbabwe","flag"=>"https://storage.googleapis.com/bhau-tk.appspot.com/flags/zi.svg","ip"=>"196.43.199.60","provider"=>"ZOU","found"=>"false","result"=>"")
  );

  //print_r(json_encode($servers));
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $domain = $_GET['domain'];
    $record = $_GET['record'];
    
    for ($i=0; $i<count($servers) ; $i++) { 
      $ip = $servers[$i]['ip'];
      $str = "dig @{$ip} {$domain} {$record} +short";
      //echo $str."<br>";
      $output = shell_exec($str);
      //echo "<pre>$output</pre><hr>";
      if(!is_null($output)){
        $servers[$i]['found'] = "true";
        $output_array = preg_split ("/\r\n|\n|\r/", rtrim($output));
        //print_r($output_array);
        $servers[$i]['result'] = $output_array;
      }
    }

    print_r(json_encode($servers));
  }

 ?>

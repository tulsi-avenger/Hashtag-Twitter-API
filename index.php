<?
	require_once('include/twitteroauth.php');
	require_once('include/OAuth.php');
	require_once('include/TwitterAPIExchange.php');

		$settings = array(
		    'oauth_access_token' => '1063029996011155456-CcmPREIoYLqce9FwvpLWkLWAEiWQ4s',
		    'oauth_access_token_secret' => 'xkjvBMozrLmUniyEHbFUusfXv5HqJT23lZOUZGWtAt5a5',
		    'consumer_key' => '2Iv3usoHNT60gopvZAwGELKvf',
		    'consumer_secret' => 'zIy7YOpKaFOfiCJ5NnZex5ziXFe5xKMIJQ7A8iHzOeORwcPH2q'
				);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';

	
	$getfield = '?q=#baseball&result_type=recent&count=100';
	$twitter = new TwitterAPIExchange($settings);
	$string2 = json_decode($twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
        	     ->performRequest(),$assoc = TRUE);


	
	echo "<br/>";
	echo "Twitter Handle"."<br/>";
	$c=1;
	foreach($string2['statuses'] as $items)
	{
		if($c>10)
		{
		break;
		}
		echo "@".$items['user']['screen_name']."<br/>";
		$c=$c+1;
		
	}
?>

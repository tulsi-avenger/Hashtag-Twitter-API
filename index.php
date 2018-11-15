<?

	
	$hashtag="#baseball"; 
	//Store hashtag in variable
		
	require_once('include/twitteroauth.php');
	require_once('include/OAuth.php');
	require_once('include/TwitterAPIExchange.php');
	//Importing libraries which are stores in Include folder

		$settings = array(
		    'oauth_access_token' => '1063029996011155456-CcmPREIoYLqce9FwvpLWkLWAEiWQ4s',
		    'oauth_access_token_secret' => 'xkjvBMozrLmUniyEHbFUusfXv5HqJT23lZOUZGWtAt5a5',
		    'consumer_key' => '2Iv3usoHNT60gopvZAwGELKvf',
		    'consumer_secret' => 'zIy7YOpKaFOfiCJ5NnZex5ziXFe5xKMIJQ7A8iHzOeORwcPH2q'
				);
		//Authentication

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	//Reference for above url = Twitter API Documentation
	$requestMethod = 'GET';
	
	
	$getfield = '?q='.$hashtag.'&result_type=recent&count=100';
	//To make query
	$twitter = new TwitterAPIExchange($settings);
	$string2 = json_decode($twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
        	     ->performRequest(),$assoc = TRUE);
	//Performing request and decoding in JSON 


	
	echo "<br/>";
	echo "Twitter Handle"."<br/>";

	$count=1;// To provide 10 recent twitter_handle & hence to keep count in variable
	foreach($string2['statuses'] as $items)
	{
		if($count>10)
		{
		break;
		}
		echo "@".$items['user']['screen_name']."<br/>";
		//Screen name is basically Twitter Handle.
		
		$count=$count+1;
		
	}
?>

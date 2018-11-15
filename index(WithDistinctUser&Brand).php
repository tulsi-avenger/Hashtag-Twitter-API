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
	$getfield = '?q=#Brand&result_type=recent&count=200';
	$twitter = new TwitterAPIExchange($settings);
	$string2 = json_decode($twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
        	     ->performRequest(),$assoc = TRUE);


	$brands_handle=array("NULL");
	array_pop($brands_handle);

	$users_handle=array("NULL");
	array_pop($users_handle);

	$threshold=10;
	foreach($string2['statuses'] as $items)
	{
	
		
		$sum=0;
		$follower_count=$items['user']['followers_count'];
		if($follower_count>3000)
		{
			$sum=$sum+5;
		}
		$friends_count=$items['user']['friends_count'];
		if($friends_count!=0&& $follower_count/$friends_count>3)
		{
			$sum=$sum+5;
		}
		$verified=$items['user']['verified'];
		if($verified==true)
		{
			$sum=$sum+10;
		}
		$is_default_profile=$items['user']['default_profile_image'];
		
		$bio = $items['user']['description'];
		if ((strpos($bio, 'official') !== false)&&(strpos($bio, 'Official') !== false)) 
  		{
		$sum=$sum+10;

		}else if((strpos($bio, 'Official handle') !== false)&&(strpos($bio, 'Official handle') !== false))
		{


		$sum=$sum+15;

		}else if(strpos($bio, 'brand') !== false && strpos($bio, 'company') !== false && strpos($bio, 'Brand') !== false)
		{


		$sum=$sum+20;
		}else if(strpos($bio, 'user') !== false&&(strpos($bio, 'personal') !== false))
		{
			$sum-=20;
		}


		if($is_default_profile==true)
		{
			array_push($users_handle,$items['user']['screen_name']);
		}else
		{
			if($sum>=$threshold)
			{
				array_push($brands_handle,$items['user']['screen_name']);
			}else
			{
				array_push($users_handle,$items['user']['screen_name']);
			}
		}
	}
	echo "Users"."<br/>";
	$c=1;
	foreach($users_handle as $items)
	{
		if($c>5)
		{
		break;
		}
		echo "@".$items."<br/>";
		
		$c=$c+1;
	}
	echo "<br/>";
	echo "Brands"."<br/>";
	$c=1;
	foreach($brands_handle as $items)
	{
		if($c>5)
		{
		break;
		}
		echo "@".$items."<br/>";
	}

?>

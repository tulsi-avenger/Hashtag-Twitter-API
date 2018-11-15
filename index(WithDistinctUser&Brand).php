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
	$getfield = '?q=#Brand&result_type=recent&count=200';
	//To make query
	$twitter = new TwitterAPIExchange($settings);
	$string2 = json_decode($twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
        	     ->performRequest(),$assoc = TRUE);
	//Performing request and decoding in JSON 


	$brands_handle=array("NULL");
	array_pop($brands_handle);
	//Array to store Brand_Handles

	$users_handle=array("NULL");
	array_pop($users_handle);
	//Array to store User_handles

	$threshold=10;
	//Thresholdto distinguish  between User and brand.
	foreach($string2['statuses'] as $items)
	{
	
		
		$sum=0;
		//Score is getting stored in sum.
		$follower_count=$items['user']['followers_count'];
		if($follower_count>3000)
		{
			$sum=$sum+3; //if followers>3000 , Increase sum by 5
		}
		$friends_count=$items['user']['friends_count'];
		if($friends_count!=0&& $follower_count/$friends_count>3)
		{
			$sum=$sum+5;	//If followers/friends ration is thrice, Increase sum by 5
		}
		$verified=$items['user']['verified'];
		if($verified==true)
		{
			$sum=$sum+6;   //If handle is verified , Increase sum by 6
		}
		$is_default_profile=$items['user']['default_profile_image'];
		// If profile pic is default then it's sure that it's not a brand
		

		// If bio/description contains words like "official handle" , "company" , ....then 			Increase sum by high value and if it contain words like "personal" then decrease 			the score
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
			// No default pic , push in user_array
		}else
		{
			if($sum>=$threshold)
			{
				array_push($brands_handle,$items['user']['screen_name']);
				 //push in brand_array
			}else
			{
				array_push($users_handle,$items['user']['screen_name']);
				// push in user_array
			}
		}
	}
	echo "Users"."<br/>";
	$c=1;  //To provide 5 recent twitter_handle & hence to keep count in variable
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

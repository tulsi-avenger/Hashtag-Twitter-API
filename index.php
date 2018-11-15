<?
require_once('include/twitteroauth.php');
require_once('include/OAuth.php');
require_once('include/TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => '1063029996011155456-CcmPREIoYLqce9FwvpLWkLWAEiWQ4s',
    'oauth_access_token_secret' => 'xkjvBMozrLmUniyEHbFUusfXv5HqJT23lZOUZGWtAt5a5',
    'consumer_key' => '2Iv3usoHNT60gopvZAwGELKvf',
    'consumer_secret' => 'zIy7YOpKaFOfiCJ5NnZex5ziXFe5xKMIJQ7A8iHzOeORwcPH2q'

);

$url = 'https://api.twitter.com/1.1/search/tweets.json';

$requestMethod = 'GET';
$getfield = '?q=#baseball&result_type=recent';

$twitter = new TwitterAPIExchange($settings);
//$string = $twitter->setGetfield($getfield)
  //           ->buildOauth($url, $requestMethod)
    //         ->performRequest();
//echo $string;

$string2 = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);




$brands_handle=array("p");
array_pop($brands_handle);


$users_handle=array("p");
array_pop($users_handle);




foreach($string2['statuses'] as $items)
    {

        echo "@". $items['user']['entities']['followers_count']."<br />";
$threshold=10;
$sum=0;
$follower_count=$items['user']['entities']['followers_count'];
if($follower_count>3000)
{
$sum=$sum+5;
}
$friends_count=$items['user']['entities']['friends_count'];
if($follower_count/$follower_count>3)
{
$sum=$sum+5;
}
$verified=$items['user']['entities']['verified'];
if($verified>3)
{
$sum=$sum+5;
}
$is_default_profile=$items['user']['entities']['default_profile_image'];
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
		array_push($brands_handle,$items['user']['screen_name']);
	}
}


      
        
  }


?>

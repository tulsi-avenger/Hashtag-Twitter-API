# Hashtag-Twitter-API
## Implementation of Twitter Api in php
### index.php
Given a hashtag, It will pull the tweets from Twitter which has the given hashtag, then list the 10 unique users/brands who created those posts recently.<br>
index.php imports 3 files which provide many functionality like Authorisation,  API Exchange to interact with Twitter API, are stored in include folder.<br>
index.php list all twitter handdle of user/brands having ### recent tweets with the given hashtag. 

### index(WithDistinctUser&Brand).php
Given a hashtag, It will pull the tweets from Twitter which has the given hashtag, then list the 5 unique users and 5 brands(If exists recently) who created those posts recently.<br>
index.php imports 3 files which provide many functionality like Authorisation,  API Exchange to interact with Twitter API, are stored in include folder.<br>
index.php list all twitter handdle of user and brands having ### recent tweets with the given hashtag. 

### Rules used to distinguish between Users and Brands
1. Checking the no of follower(s).<br>
2. Checking the no of followings(friends).<br>
3. Checking the ratio of followers and followings.<br>
4. Is the account verified? <br>
5. Checking the profile pic whether it's default or not<br>
6. Checking for description(Bio) on twitter handle.

<?php
/**
 * authorize class
 */
class controller_oauth
{
	public function callback()
	{
		/**
	 	 * @file
		 * Take the user when they return from Twitter. Get access tokens.
		 * Verify credentials and redirect to based on response from Twitter.
		 */

		/* Start session and load lib */
		session_start();
		require_once '3rd/oauth_twitter.php';

		/* If the oauth_token is old redirect to the connect page. */
		if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token'])
		{
			$_SESSION['oauth_status'] = 'oldtoken';
			$this->signout();
			$this->signin();
		}

		/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

		/* Request access tokens from twitter */
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

		/* Save the access tokens. Normally these would be saved in a database for future use. */
		$_SESSION['access_token'] = $access_token;

		/* Remove no longer needed request tokens */
		unset($_SESSION['oauth_token']);
		unset($_SESSION['oauth_token_secret']);

		/* If HTTP response is 200 continue otherwise send to connect page to retry */
		if (200 == $connection->http_code)
		{
			/* The user has been verified and the access tokens can be saved for future use */
			$_SESSION['status'] = 'verified';
			header('Location: ./logined.php');
		}
		else
		{
			/* Save HTTP status for error dialog on connnect page.*/
			$this->signout();
		}
	}
	
	public function signin()
	{
		require_once '3rd/oauth_twitter.php';
		/* Create TwitterOAuth object and get request token */
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

		/* Get request token */
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

		/* Save request token to session */
		$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		/* If last connection fails don't display authorization link */
		switch ($connection->http_code)
		{
			case 200:
				/* Build authorize URL */
				$url = $connection->getAuthorizeURL($token);
				header('Location: ' . $url); 
				break;
			default:
				echo 'Could not connect to Twitter. Refresh the page or try again later.';
				break;
		}
	}
	
	public function signout()
	{
		session_start();
		session_destroy();
	}
}

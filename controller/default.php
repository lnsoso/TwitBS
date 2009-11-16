<?php
class controller_default
{
	public function index()
	{
		echo 'in controller_default->index';
	}
	
	public function update()
	{
		echo '[GIT] pulling ...<br />';
		exec('/home/vtwoexpc/bin/git pull', $result);
		foreach($result as $r)
		{
			echo '[GIT] ' . $r . '<br />';
		}
		echo '[GIT] pulling finish<br />';
	}
	
	public function test()
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
		switch ($connection->http_code) {
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

	/**
	 * do twitter oauth authorize
	 */
	public function logintest()
	{
		// do oauth init
		require_once '3rd/oauth.php';
		require_once '3rd/oauth_testserver.php';
		
		/*
		 * Config Section
		 */
		$domain = $_SERVER['HTTP_HOST'];
		$base = "/oauth/example/";
		$base_url = "http://$domain$base";

		/**
		 * Some default objects
		 */
		$test_server = new TestOAuthServer(new MockOAuthDataStore());
		$hmac_method = new OAuthSignatureMethod_HMAC_SHA1();
		$plaintext_method = new OAuthSignatureMethod_PLAINTEXT();
		$rsa_method = new TestOAuthSignatureMethod_RSA_SHA1();

		$test_server->add_signature_method($hmac_method);
		$test_server->add_signature_method($plaintext_method);
		$test_server->add_signature_method($rsa_method);

		$sig_methods = $test_server->get_signature_methods();
		
		// do oauth
		$key = @$_REQUEST['key'];
		$secret = @$_REQUEST['secret'];
		$token = @$_REQUEST['token'];
		$token_secret = @$_REQUEST['token_secret'];
		$endpoint = @$_REQUEST['endpoint'];
		$action = @$_REQUEST['action'];
		$dump_request = @$_REQUEST['dump_request'];
		$user_sig_method = @$_REQUEST['sig_method'];
		$sig_method = $hmac_method;
		if ($user_sig_method)
		{
			$sig_method = $sig_methods[$user_sig_method];
		}

		$test_consumer = new OAuthConsumer($key, $secret, NULL);

		$test_token = NULL;
		if ($token)
		{
			$test_token = new OAuthConsumer($token, $token_secret);
		}


		if ($action == "request_token")
		{
			$parsed = parse_url($endpoint);
			$params = array();
			parse_str($parsed['query'], $params);

			$req_req = OAuthRequest::from_consumer_and_token($test_consumer, NULL, "GET", $endpoint, $params);
			$req_req->sign_request($sig_method, $test_consumer, NULL);
			if ($dump_request)
			{
				Header('Content-type: text/plain');
				print "request url: " . $req_req->to_url(). "\n";
				print_r($req_req);
				exit;
			}
			Header("Location: $req_req");
		} 
		else if ($action == "authorize")
		{
			$callback_url = "$base_url/client.php?key=$key&secret=$secret&token=$token&token_secret=$token_secret&endpoint=" . urlencode($endpoint);
			$auth_url = $endpoint . "?oauth_token=$token&oauth_callback=".urlencode($callback_url);
			if ($dump_request)
			{
				Header('Content-type: text/plain');
				print("auth_url: " . $auth_url);
				exit;
			}
			Header("Location: $auth_url");
		}
		else if ($action == "access_token")
		{
			$parsed = parse_url($endpoint);
			$params = array();
			parse_str($parsed['query'], $params);

			$acc_req = OAuthRequest::from_consumer_and_token($test_consumer, $test_token, "GET", $endpoint, $params);
			$acc_req->sign_request($sig_method, $test_consumer, $test_token);
			if ($dump_request)
			{
				Header('Content-type: text/plain');
				print "request url: " . $acc_req->to_url() . "\n";
				print_r($acc_req);
				exit;
			}
			Header("Location: $acc_req");
		}
	}
	
	public function logout()
	{
		echo "do logout";
		session_start();
		session_destroy();
	}
}
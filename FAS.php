<?php

/**
 * This class contains methods for trying to authenticate with FAS.
 *
 * @group fas
 */
class FAS {
  protected $curl;
  protected $fas_url = 'https://admin.fedoraproject.org/accounts';
  protected $debug = 0;
  protected $strict_ssl = true;
  protected $user_agent = 'php-fas v1.0.0';

  /**
   * Construct an instance of FAS.
   *
   * Mostly, initialize a curl instance, because according to PHP:
   *
   *     lang=php
   *     class Foo {
   *       protected $a = 123; // This is fine.
   *       protected $b = curl_init(); // This is not, it contains parentheses.
   *     }
   */
  public function __construct() {
    if (!extension_loaded('curl')) {
      throw new Exception('The curl extension must be loaded.');
    }
    $this->curl = curl_init();
    $this->debug_log('Initialized curl.');
    return $this;
  }

  /**
   * Set the URL to the FAS instance being authed against.
   * Strip any ending slashes.
   *
   * @param string The URL to authenticate against.
   */
  public function setFasUrl($url) {
    $url = rtrim($url, '/');
    $this->fas_url = $url;
    return $this;
  }

  /**
   * Change whether or not SSL certificates are checked for validity and
   *   authenticity.
   *
   * @param boolean Whether or not we should be strict with SSL checks.
   */
  public function setStrictSsl($strictness) {
    $this->strict_ssl = $strictness;
    return $this;
  }

  /**
   * Set the user agent to identify to FAS as.
   *
   * @param string The User-Agent to use.
   */
  public function setUserAgent($user_agent) {
    $this->user_agent = $user_agent;
    return $this;
  }

  /**
   * Set debug, which enables debug messages to be written to the error log or
   *   echoed out.
   *
   * **WARNING:** There is a potential for sensitive information to be logged.
   *   This should **never** //ever// be enabled in production.
   *
   * @param integer The debug level. 0=off, 1=error log, 2=echo.
   */
  public function setDebug($debug_level) {
    if (gettype($debug_level) != 'integer' || $debug_level < 0 ||
      $debug_level > 2) {
      throw new Exception('Debug level should be an integer, 0 thru 2.');
    }
    $this->debug = $debug_level;
    return $this;
  }

  /**
   * Try to authenticate with the FAS server.
   *
   * We internally run the password through urlencode, so **do not** do that
   * before calling `authenticate()`.p
   *
   * @param string The username **or email address** of the person
   *   authenticating.
   * @param string The password of the person authenticating.
   * @return wild Returns false if authentication was unsuccessful, or
   *   a FASUser instance, if the user successfully authenticated.
   */
  public function authenticate($username, $password) {
    $username = urlencode(strtolower($username));
    $password = urlencode($password);
    curl_setopt(
      $this->curl,
      CURLOPT_URL,
      $this->fas_url.'/user/view?tg_format=json');
    curl_setopt($this->curl, CURLOPT_POST, true);
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->curl, CURLOPT_USERAGENT, $this->user_agent);
    curl_setopt(
      $this->curl,
      CURLOPT_POSTFIELDS,
      'user_name='.$username.'&password='.$password.'&login=Login');

    if ($this->debug != 0) {
      curl_setopt($this->curl, CURLOPT_VERBOSE, true);

      if ($this->debug == 2 && php_sapi_name() != 'cli') {
        $this->debug_log(
          'Curl verbosity is set, see your error log for its output.');
      }
    }

    $result = curl_exec($this->curl);
    if ($result === false) {
      throw new Exception(
        'A problem occurred while trying to communicate with FAS.');
    }

    if ($this->validate_authentication($result)) {
      // Spawn a new FASUser.
    } else {
      return false;
    }
  }

  /**
   * Determine if authentication was successful, given curl's result.
   *
   * @param string The output from Curl's POST to FAS.
   * @return boolean Whether or not authentication was a success.
   */
  private function validate_authentication($curl_result) {
    echo $curl_result;
  }

  /**
   * Print a timestampped debug message, if we're in debug mode.
   *
   * @param string The message to be logged.
   */
  private function debug_log($message) {
    $log_entry = date('[h:m:s a] ').$message."\n";
    switch ($this->debug) {
      case 1:
        error_log($log_entry);
      case 2:
        echo $log_entry;
    }
    return;
  }
}
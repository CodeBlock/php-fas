<?php

/**
 * A representation of a FAS user.
 *
 * This is constructed by `FAS->authenticate()` after successful authentication.
 *
 * @group fas
 */
class FASUser {
  protected $username;
  protected $real_name;
  protected $groups = array();
  protected $ssh_key;
  protected $gpg_key;

  /**
   * Set the username of the representation of the FAS user.
   *
   * @task setter
   */
  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  /**
   * Set the real name of the representation of the FAS user.
   *
   * @task setter
   */
  public function setRealName($real_name) {
    $this->real_name = $real_name;
    return $this;
  }

  /**
   * Appends a group to the `groups` array of arrays.
   *
   * @task setter
   */
  public function appendGroup($group) {
    $this->groups[] = $group;
    return $this;
  }

  /**
   * Set the ssh key of the representation of the FAS user.
   *
   * @task setter
   */
  public function setSshKey($ssh_key) {
    $this->ssh_key = $ssh_key;
    return $this;
  }

  /**
   * Set the gpg key id of the representation of the FAS user.
   *
   * @task setter
   */
  public function setGpgKey($gpg_key) {
    $this->gpg_key = $gpg_key;
    return $this;
  }
}
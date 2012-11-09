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
  protected $human_name;
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
   * Get the username of the representation of the FAS user.
   *
   * @task getter
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Set the real/human name of the representation of the FAS user.
   *
   * @task setter
   */
  public function setHumanName($human_name) {
    $this->human_name = $human_name;
    return $this;
  }

  /**
   * Get the human name of the representation of the FAS user.
   *
   * @task getter
   */
  public function getHumanName() {
    return $this->human_name;
  }

  /**
   * Appends a group to the `groups` array of arrays.
   *
   * @task setter
   */
  public function appendGroup($group) {
    $this->groups[$group->name] = $group;
    return $this;
  }

  /**
   * Get the list of groups that the user is in.
   *
   * @task getter
   */
  public function getGroups() {
    return $this->groups;
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
   * Get the ssh of the representation of the FAS user.
   *
   * @task getter
   */
  public function getsshKey() {
    return $this->ssh_key;
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

  /**
   * Get the gpg key id of the representation of the FAS user.
   *
   * @task getter
   */
  public function getGpgKey() {
    return $this->gpg_key;
  }
}
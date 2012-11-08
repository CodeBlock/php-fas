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
  protected $password;
}
<?php
/**
 * Return the identity of a parameter to work around PHP bugs.
 *
 * @task util
 * @param wild Any object we want to return the identity of.
 */
function id($obj) {
  return $obj;
}
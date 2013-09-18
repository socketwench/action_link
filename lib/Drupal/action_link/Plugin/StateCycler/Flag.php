<?php

/**
 * @file
 * Contains \Drupal\action_link\Plugin\StateCycler\Flag.
 */

namespace Drupal\action_link\Plugin\StateCycler;

use Drupal\action_link\StateCyclerInterface;

/**
 * TODO. This is the Flag cycler. It should work with a Flag config entity.
 */
class Flag implements StateCyclerInterface {

  /**
   * Constructor.
   *
   * @param $target_entity
   *  The target entity we act on.
   * @param $parameters
   *  An array of parameters. The format is specific to this plugin:
   *  - 'property': The name of the property that is to be toggled.
   */
  function __construct($target_entity, $parameters) {
    // TODO! this should be passed in by the config entity.
    // For now, cheat!
    $parameters['flag_name'] = 'bookmarks';

    $this->target_entity = $target_entity;
    $this->toggle_property = $parameters['flag_name'];
  }

  function actionIsValid() {
    // Does the action actually make sense?
    // eg.
    return TRUE;
  }

  function userHasAccess() {
    return TRUE;
  }

  function changeState($entity_id, $entity, $parameters) {
    // TODO.
    // Load the flag, load or create a flagging entity, etc etc.
  }

}
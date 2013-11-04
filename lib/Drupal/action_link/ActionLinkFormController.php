<?php

/**
 * @file
 * Definition of Drupal\action_link\ActionLinkFormController.
 */

namespace Drupal\action_link;

use Drupal\Core\Entity\EntityFormController;

/**
 * Base form controller for robot edit forms.
 */
class ActionLinkFormController extends EntityFormController {

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::form().
   */
  public function form(array $form, array &$form_state) {
    $form = parent::form($form, $form_state);

    $action_link = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => t('Label'),
      '#maxlength' => 255,
      '#default_value' => $action_link->label(),
      '#required' => TRUE,
    );
    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $action_link->id(),
      '#machine_name' => array(
        'exists' => 'contact_category_load',
      ),
      '#disabled' => !$action_link->isNew(),
    );

    return $form;
  }

  public function actions(array $form, array &$form_state) {
    //@todo figure out why the delete button appears here!?!?!
    $actions = parent::actions($form, $form_state);
    $actions['submit']['#value'] = t('Save Action Link');
    return $actions;
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::validate().
   */
  public function validate(array $form, array &$form_state) {
    parent::validate($form, $form_state);

    // Add code here to validate your config entity's form elements.
    // Nothing to do here.
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::save().
   *
   * Saves the entity. This is called after submit() has built the entity from
   * the form values.
   */
  public function save(array $form, array &$form_state) {
    $action_link = $this->entity;
    $status = $action_link->save();

    $uri = $action_link->uri();
    if ($status == SAVED_UPDATED) {
      drupal_set_message(t('Robot %label has been updated.', array('%label' => $action_link->label())));
      watchdog('contact', 'Robot %label has been updated.', array('%label' => $action_link->label()), WATCHDOG_NOTICE, l(t('Edit'), $uri['path'] . '/edit'));
    }
    else {
      drupal_set_message(t('Robot %label has been added.', array('%label' => $action_link->label())));
      watchdog('contact', 'Robot %label has been added.', array('%label' => $action_link->label()), WATCHDOG_NOTICE, l(t('Edit'), $uri['path'] . '/edit'));
    }

    $form_state['redirect'] = 'admin/structure/action_link';
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::delete().
   */
  public function delete(array $form, array &$form_state) {
    $form_state['redirect'] = 'admin/structure/action_link';
  }
}

<?php
/**
 * Created by PhpStorm.
 * User: tess
 * Date: 11/4/13
 * Time: 8:08 PM
 */

namespace Drupal\action_link\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;

class ActionLinkDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'action_link_confirm_delete';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete action link %title?',
                    array('%title' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelRoute() {
    return array(
      'route_name' => 'action_link_list',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('Deletes an action link. This action cannot be undone.');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array $form, array &$form_state) {
    $this->entity->delete();
    drupal_set_message($this->t('Deleted action link %name.', array('%name' => $this->entity->label())));
    watchdog('taxonomy', 'Deleted action link %name.', array('%name' => $this->entity->label()), WATCHDOG_NOTICE);
    $form_state['redirect'] = 'admin/structure/action_link';
  }
} 
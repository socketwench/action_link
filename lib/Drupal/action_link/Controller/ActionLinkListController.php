<?php
/**
 * Created by PhpStorm.
 * User: tess
 * Date: 11/3/13
 * Time: 8:52 PM
 */

namespace Drupal\action_link\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListController;
use Drupal\Core\Entity\EntityInterface;

class ActionLinkListController extends ConfigEntityListController {

  public function buildHeader() {
    $header['label'] = t('Action Link');
    return $header + parent::buildHeader();
  }

  /**
   * Overrides Drupal\Core\Entity\EntityListController::buildRow().
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    return $row + parent::buildRow($entity);
  }

}
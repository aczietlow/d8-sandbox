<?php

namespace Drupal\sandbox_entities\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Recipe entities.
 */
class RecipeViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['recipe']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Recipe'),
      'help' => $this->t('The Recipe ID.'),
    );

    return $data;
  }

}

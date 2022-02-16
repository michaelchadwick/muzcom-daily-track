<?php

namespace Drupal\daily_track\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;


// require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Class DailyTrackController.
 */
class DailyTrackController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
    );
  }
}

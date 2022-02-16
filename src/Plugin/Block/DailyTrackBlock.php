<?php

namespace Drupal\daily_track\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a 'Daily Track' Block.
 *
 * @Block(
 *   id = "daily_track_block",
 *   admin_label = @Translation("Daily Track block"),
 *   category = @Translation("Songs"),
 * )
 */
class DailyTrackBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $storage = \Drupal::service('entity_type.manager')->getStorage('node');

    // get all published Songs
    $song_entities = $storage->getQuery()
      ->condition('type', 'song')
      ->condition('status', 1)
      ->range(0, 10)
      ->execute();

    $song_entity_nid = $song_entities[array_rand($song_entities)];

    $node = $storage->load($song_entity_nid);

    $track_name = $node->field_short_name[0]->value;
    $track_id = str_replace(' ', '-', strtolower($track_name));
    $track_album = $node->field_album_id->entity->get('field_album_title')->value;
    $track_url = $node->field_local_link[0]->getUrl()->toString();
    $track_description = strip_tags($node->get('body')->value);

    return array(
      '#theme' => 'daily_track',
      '#title' => 'Daily Track',
      '#description' => 'Display random track, changing daily.',
      '#cache' => [
        'max-age' => 26400
      ],
      '#track_name' => $track_name,
      '#track_id' => $track_id,
      '#track_album' => $track_album,
      '#track_url' => $track_url,
      '#track_description' => $track_description
    );

    // return [
    //   '#type' => 'markup',
    //   '#markup' => t('Hello world')
    // ];
  }

}
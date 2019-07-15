<?php

function gen_cron_data($content) {
  $uploads_path = wp_upload_dir();
  $save_path = $uploads_path['basedir'];
  $prod_data_file = fopen($save_path . '/crong_log.txt', "a");
  fwrite($prod_data_file, $content);
  fwrite($prod_data_file, "\n");
  fclose($prod_data_file);
}


function thistle_release_customer_videos() {

gen_cron_data("RAN EMAIL TRIGGER");
gen_cron_data(date('l jS \of F Y h:i:s A'));
gen_cron_data("--------------------------");
$args = array(
  'status' => 'processing',
);
$orders = wc_get_orders($args);
foreach ($orders as $order) {
  foreach ($order->get_items() as $item_id => $item_data) {
    $wedding_date = $order->get_item_meta($item_id, 'Wedding Date', true);
      if ($wedding_date) {
        $date = DateTime::createFromFormat('m/d/Y', $wedding_date);
        if (!$date) {
          $date = DateTime::createFromFormat('m-dY', $wedding_date);
        }
        $date = $date->format('Y-m-d');

        $event_date       = new DateTime($date);
        $now              = new DateTime('now');
        $interval         = date_diff($now, $event_date);
        $days_till_event  = intval($interval->format('%r%a'));
        $days_till_videos = $days_till_event - get_field('field_days_before_videos', 'option');
        if ($days_till_event < get_field('field_days_before_videos', 'option') && $days_till_event > -1) {
          $order->update_status('videos-released');
        }
      }

  }

}

$args = array(
  'status' => 'videos-released',
);
$orders = wc_get_orders($args);
// PC::debug($orders);
foreach ($orders as $order) {
  foreach ($order->get_items() as $item_id => $item_data) {
    $wedding_date = $order->get_item_meta($item_id, 'Wedding Date', true);
    // PC::debug($wedding_date);
    if ($wedding_date) {
        $date = DateTime::createFromFormat('m/d/Y', $wedding_date);
      if (!$date) {
        $date = DateTime::createFromFormat('m-d-Y', $wedding_date);
      }
      $date = $date->format('Y-m-d');

      $event_date       = new DateTime($date);
      $now              = new DateTime('now');
      $interval         = date_diff($now, $event_date);
      $days_till_event  = intval($interval->format('%r%a'));
      // PC::debug($days_till_event);
      if ($days_till_event < 0) {
        $order->update_status('event-passed');
      }
    }
  }
}

return ['order-status' => "should have run and modified txt file"];

}


add_action( 'rest_api_init', function () {
  register_rest_route( 'thistle/v1', '/order-status', array(
    'methods' => 'GET',
    'callback' => 'thistle_release_customer_videos'
  ));
});
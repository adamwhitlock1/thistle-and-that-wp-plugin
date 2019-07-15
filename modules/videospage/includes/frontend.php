<?php
echo '<h2>Videos</h2>';

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $uid = get_current_user_id();
    $args = array(
        'customer' => $uid,
    );
    $orders = wc_get_orders( $args );
    foreach ($orders as $order) {
        echo $order->get_order_number();
        echo '<br>';
        echo $order->get_status();
        echo '<hr>';
        // var_dump($order);
        $order_items = $order->get_items();
        foreach ($order->get_items() as $item_id => $item_data) {
            $product = $item_data->get_product();
            $product_name = $product->get_name();
             echo 'Product name: ' . $product_name . "<hr>";
            $additional_details = $order->get_item_meta($item_id, 'Additional Details', true);
            $wedding_date = $order->get_item_meta($item_id, 'Wedding Date', true);
            if ($additional_details) {
                 var_dump( $additional_details );
                if ($wedding_date) {
                     var_dump( $wedding_date );
                    $date = DateTime::createFromFormat('m/d/Y', $wedding_date);
                    if (!$date) {
                      $date = DateTime::createFromFormat('m-d-Y', $wedding_date);
                    }
                    $date = $date->format('Y-m-d');
                     echo $date;
                    $event_date = new DateTime($date);
                    $now = new DateTime('now');
                    $interval = date_diff($now, $event_date);
                    $days_till_event = intval($interval->format('%r%a') );
                    $days_till_videos = $days_till_event - get_field('field_days_before_videos', 'option');

                    if ($order->get_status() == 'videos-released') {
                        echo "<h1>Your video tutorials are unlocked!</h1>";
                        echo $settings->videos_page_shortcode;
                    } else {
                        echo "<h2>Your event is " . $interval->format('%r%a') . " days away.</h2>";
                        echo "<p>Your videos will be unlocked for viewing " . get_field('field_days_before_videos', 'option') . " days before your event.";
                        echo "<p>In " . $days_till_videos . " days you may access your videos.</p>";
                    }
                }
                echo "<hr>";
            }

        }


    }
    // var_dump($orders);


} else {
    echo "You must be logged in to view this page";
}
?>

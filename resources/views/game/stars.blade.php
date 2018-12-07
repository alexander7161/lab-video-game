<?php
// Round to nearest half
        $rating = round($rating * 2) / 2;
        $output = array();

        // Append all the filled whole stars
        for ($i = $rating; $i >= 1; $i--) {
            array_push($output, '<i class="fa fa-star" aria-hidden="true" style="color: gold;" /></i>');
        }

        // If there is a half a star, append it
         if ($i == .10) array_push($output, '<<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"/></i>');

        // Fill the empty stars
        for ($i = (10 - $rating); $i >= 1; $i--)
        array_push($output, '<i class="fa fa-star-o" aria-hidden="true" style="color: gold;" ></i>');

    echo join(' ', $output);

?>
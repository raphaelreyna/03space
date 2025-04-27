<?php
    $featureFlagKeys = [
        'enableMusic',
    ];

    $featureFlagQueryString = $_GET['featureFlags'] ?? '';
    $featureFlagArray = explode(',', $featureFlagQueryString);
    
    $featureFlags = [];
    foreach ($featureFlagKeys as $key) {
        if (in_array($key, $featureFlagArray)) {
            $featureFlags[$key] = true;
        } else {
            $featureFlags[$key] = false;
        }
    }
?>
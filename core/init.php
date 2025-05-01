<?php
// This file is intended to hold all code that needs to only be run once at
// the start of the site.

// check if $mediaPath/pfp and $mediaPath/mus exist, if not create them
if (!file_exists($mediaPath . "/pfp")) {
    mkdir($mediaPath . "/pfp", 0777, true);
}
if (!file_exists($mediaPath . "/mus")) {
    mkdir($mediaPath . "/mus", 0777, true);
}
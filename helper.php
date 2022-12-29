<?php
function alertMessage($alertType = 'alert-success', $message = '')
{
    $output = "";
    $output .= "<div class='alert {$alertType}'>";
    foreach ($message as $item) {
        $output .= $item;
        $output .= '<br />';
    }

    $output .= "</div>";
    return $output;
}

function Status($status)
{
    $data = "draft";
    if ($status == 1) {
        $data = "published";
    }

    return $data;
}

function TrimText($text)
{
    if (strlen($text) >= 100) {
        return substr($text, 0, 120) . '...';
    } else {
        return $text;
    }
}
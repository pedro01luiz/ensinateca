<?php

class NotifyException {
    static function render(\Exception $exception)
    {
        $message = $exception->getMessage();
        $stack = $exception->getTraceAsString();

        $containerStyle = "
            display: flex;
            flex-direction: column;

        ";

        $divStyle = "
            color: #fff;
            background-color: #22292f;
            padding: 2rem;
            margin: 0.25rem;
        ";

        $messageDiv = "<div style='$divStyle'>$message</div>";
        $stackDiv = "<div style='$divStyle'>$stack</div>";

        $container = "<div style='$containerStyle'>{$messageDiv}{$stackDiv}</div>";
        return $container;
    }
}
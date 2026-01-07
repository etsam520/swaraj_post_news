<?php

namespace App\CentralLogics;

use Illuminate\Support\Str;

class Helper
{
    public static function stringToFormattedDate($dateString)
    {
        $timestamp = strtotime($dateString);
        return date('M j, Y', $timestamp);
    }

    public static function generateYoutubeEmbedUrl(string $videoId): ?string
    {
        if($videoId == null){
            return null;
        }
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return "https://www.youtube.com/embed/" . $videoId;
        }

        return null;
    }

    public static function getYoutubeVideoId(string $url): ?string
    {
        if($url == null){
            return null;
        }
        // Regular expression to match YouTube video links
        $pattern = '/(?:https?:\\/\\/)?(?:www\\.|m\\.|music\\.)?(?:youtube\.com|youtu\.be)(?:\\/embed\\/|\\/v\\/|\\/watch\\?v=|\\/|\\?.*?v=)?([a-zA-Z0-9_-]{11})/';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public static function timeAgo($timestamp) {
        if($timestamp ==  null){
            return '' ;
        }
        $timeDifference = time() - strtotime($timestamp);

        if ($timeDifference < 60) {
            return $timeDifference === 1 ? 'a second ago' : "$timeDifference seconds ago";
        }

        $minutes = floor($timeDifference / 60);
        if ($minutes < 60) {
            return $minutes === 1 ? 'a minute ago' : "$minutes minutes ago";
        }

        $hours = floor($timeDifference / 3600);
        if ($hours < 24) {
            return $hours === 1 ? 'an hour ago' : "$hours hours ago";
        }

        $days = floor($timeDifference / 86400);
        if ($days < 30) {
            return $days === 1 ? 'a day ago' : "$days days ago";
        }

        $months = floor($timeDifference / 2592000); // Approximate month
        return $months === 1 ? 'a month ago' : "$months months ago";
    }

    public static function getCloudImageUrl(string $filePath) : string {
        return 'https://givni.sgp1.digitaloceanspaces.com/'.$filePath;
    }

    

}  

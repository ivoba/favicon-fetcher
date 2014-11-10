<!DOCTYPE html>
<html>
<head>
</head>
<body>
<strong>Favicon Fetcher</strong>
<p>
    try like <i>?favicon=facebook.com;twitter.com</i>
</p>
<?php
require(__DIR__ . '/vendor/autoload.php');
if (isset($_GET['favicon'])) {
    $favicon = $_GET['favicon'];
    $urls    = explode(';', $favicon);
    if ($urls) {
        $fetcher = \Ivoba\FaviconFetcher\FaviconFetcher::create(__DIR__.'/');
        $fetched = $fetcher->fetch($urls);
        foreach ($fetched as $url => $fav) {
            echo '<img src="'.substr($fav, strrpos($fav, '/')).'" alt="'.$url.'"/>';
        }
    }
}
?>

</body>
</html>
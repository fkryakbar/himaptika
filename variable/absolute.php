<?php
define("BASEURL", "http://localhost/himaptika/public");
define("BASELINK", "http://localhost/himaptika/");
$conn = mysqli_connect("localhost", "root", "", "himaptika");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// link Sosial media
$instagram = "https://instagram.com/himaptika.ulm?utm_medium=copy_link";
$youtubelink = "https://youtube.com/channel/UCyH0YbfXsGONS1qxVLnkUMA";
$tiktok = "https://vt.tiktok.com/ZSdedXNCY/";
$website = "";
$aspirasi = '';
// pengumuman
$judulpengumuman = "-";
$linkpengumuman = "";
$query = "SELECT * FROM sosial";

function query($query)
{
    global $conn;
    $datas = mysqli_query($conn, $query);
    return $datas;
}

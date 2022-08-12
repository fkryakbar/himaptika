<?php
require_once "../../variable/absolute.php";
$datas = query('SELECT * FROM blog');
$body = '';
$head = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$body .= $head;
while ($data = mysqli_fetch_assoc($datas)) {
  $body .= '<url>
    <loc>' . BASELINK . 'blog/' . $data['url'] . '</loc>
    <changefreq>daily</changefreq>
    <lastmod>2022-06-08T16:30:13+00:00</lastmod>
  </url>';
}

$body .= '</urlset>';
$file = fopen('../../sitemap-blog.xml', 'w');
fwrite($file, $body);

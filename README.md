# ganool-api

<p>PHP Class untuk grabbing data dari website Ganool dengan output berbentuk array dan atau JSON menggunakan cURL dan Simple HTML Dom.</p>
<br>
<h4>Usage:</h4>

<pre>&lt;?php

// Include class ganool.php
require("ganool.php");

// Create objek
$ganool = new ganool();</pre>
<br>

<h4>Grab Data:</h4>
<pre>$data = $ganool->grabGanool($_GET['url']);</pre>
<br>

<h4>Return JSON:</h4>
<pre>// Convert ARRAY to JSON<br>
header('Content-Type: application/json');<br>
echo json_encode($data, JSON_PRETTY_PRINT);</pre>

<a href="http://dev.mastomi.web.id/ganool-api/api/?url=http://ganool.ph/the-legend-of-tarzan-2016-cam-450mb-ganool-ph/"><h2>DEMO</h2></a>

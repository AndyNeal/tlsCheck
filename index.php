<?php
$error="unknown";
$scanType="unknown";
if (isset($_POST['submit'])) {
    $host = escapeshellcmd($_POST['host']);
    $port = (int)escapeshellcmd($_POST['port']);
    //$hosts = $_POST['hosts'];
    $scanType = $_POST['scanType'];
    $error = "false";
}
?>
<h2>NMAP scan a port for allowed ciphers</h2>
<form action="" method="post">
    port: <input name="port" type="text" value="443" size="10"/>
    <input type="hidden" name="scanType" value="single" />
    hostname/IP: <input name="host" type="text" size="60"/>
    <input name="submit" type="submit" />
</form>
</br>
<!--
<h2>NMAP scan 443 for SSLv3 given a comma-delimited list of hosts</h2>
<textarea name="hosts" form="bulk" rows="6" cols="60" placeholder="Enter comma-delimted list here..."></textarea>
<form action="" method="post" id="bulk">
    <input type="hidden" name="scanType" value="bulk" />
    <input name="submit" type="submit" />
</form>
-->

<?php if($error == 'true') : ?>
    Something went wrong on the scan.
<?php endif; ?>

<?php if($error == 'false') : ?>
    <?php if($scanType == 'single') : ?>
        Single Scan results
        <?php
        exec('nmap --script ssl-enum-ciphers -p ' . $port . ' ' . $host, $output);
        echo "<pre>";
        foreach ($output as $line) {
            echo $line . "\r\n";
        }
        echo "</pre>";

        ?>
    <?php endif; ?>

    <?php if($scanType == 'bulk') : ?>
        Bulk Scan results
        <?php echo $hosts ?>
    <?php endif; ?>
<?php endif; ?>


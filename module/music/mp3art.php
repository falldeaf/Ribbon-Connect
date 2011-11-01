<?

require_once('../../lib/getid3/getid3.php');

$filename = $_REQUEST["file"];

$getID3 = new getID3;
$fileinfo = $getID3->analyze($filename);
$picture = @$fileinfo['id3v2']['APIC'][0]['data']; // binary image data 

header('Content-type: image/jpeg');
echo $picture;

/*
$getID3 = new getID3;
#$getID3->option_tag_id3v2 = true; # Don't know what this does yet
$getID3->analyze($filename);
if (isset($getID3->info['id3v2']['APIC'][0]['data'])) {
    $cover = $getID3->info['id3v2']['APIC'][0]['data'];
} elseif (isset($getID3->info['id3v2']['PIC'][0]['data'])) {
    $cover = $getID3->info['id3v2']['PIC'][0]['data'];
} else {
    $cover = null;
}
if (isset($getID3->info['id3v2']['APIC'][0]['image_mime'])) {
    $mimetype = $getID3->info['id3v2']['APIC'][0]['image_mime'];
} else {
    $mimetype = 'image/jpeg'; // or null; depends on your needs
}

if (!is_null($cover)) {
    // Send file
    //header("Content-Type: " . $mimetype);
    if (isset($getID3->info['id3v2']['APIC'][0]['image_bytes'])) {
        header("Content-Length: " . $getID3->info['id3v2']['APIC'][0]['image_bytes']);
    }
    //#header("Content-Transfer-Encoding: binary"); # Possibly unnecessary
    //imagejpeg($cover);
    echo $cover;
}
*/
?>

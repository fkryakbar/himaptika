<?php
require_once "../../variable/absolute.php";
require_once 'vendor/autoload.php';
// header("Location:" . BASELINK . "dashboard/main");
if (isset($_GET["hapus"])) {
    $id = (int) $_GET["hapus"];
    $gambar = query("SELECT * FROM blog WHERE id = $id");
    $gambar = mysqli_fetch_assoc($gambar)["gambar"];
    query("DELETE FROM blog WHERE id = $id ");
    unlink("../../public/img/" . $gambar);
}

if (isset($_GET["hapuskomen"])) {
    $id = (int) $_GET["hapuskomen"];
    query("DELETE FROM komentar WHERE id = $id ");
}

if (isset($_GET["getkomen"])) {
    $id = (int) $_GET["getkomen"];
    $datas = query("SELECT * FROM komentar WHERE id = $id ");
    while ($data = mysqli_fetch_assoc($datas)) {
        echo '<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Komentar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="email" id="nama" class="form-control" value="' . $data["nama"] . '" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Link</label>
            <input type="email" id="link" class="form-control" value="' . $data["link"] . '" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
            <textarea class="form-control" id="komen"id="exampleFormControlTextarea1" rows="3">' . $data["komen"] . '</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" onclick="simpan(' . $data["id"] . ')" class="btn btn-primary">Save changes</a>
    </div>';
    }
}

if (isset($_GET["id"]) && isset($_GET["nama"]) && isset($_GET["link"]) && isset($_GET["komen"])) {
    $nama = $_GET["nama"];
    $link = $_GET["link"];
    $komen = $_GET["komen"];
    $id = (int)$_GET["id"];
    query("UPDATE komentar SET nama='$nama', link = '$link', komen = '$komen' WHERE id = $id");
}

if (isset($_GET["judul"]) && isset($_GET["link"]) && isset($_GET["kategori"])) {
    $judul = $_GET["judul"];
    $link = $_GET["link"];
    $kategori = $_GET["kategori"];
    query("INSERT INTO sosial VALUES (0, '$judul', '$link', '$kategori')");
}
if (isset($_GET["hapuspengumuman"])) {
    $id = (int) $_GET["hapuspengumuman"];
    query("DELETE FROM sosial WHERE id = $id ");
}


if (isset($_GET["getpengumuman"])) {
    $id = (int) $_GET["getpengumuman"];
    $datas = query("SELECT * FROM sosial WHERE id = $id ");
    while ($data = mysqli_fetch_assoc($datas)) {
        echo '<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Judul</label>
            <input type="email" id="editjudul" class="form-control" value="' . $data["judul"] . '" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Link</label>
            <input type="email" id="editlink" class="form-control" value="' . $data["link"] . '" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Kategori</label>
            <input class="form-control" id="editkategori" value="' . $data["kategori"] . '" id="exampleFormControlTextarea1" rows="3"></input>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" onclick="simpan(' . $data["id"] . ')" class="btn btn-primary">Save changes</a>
    </div>';
    }
}

if (isset($_GET["id"]) && isset($_GET["editjudul"]) && isset($_GET["editlink"]) && isset($_GET["editkategori"])) {
    $id = (int) $_GET["id"];
    $editjudul = $_GET["editjudul"];
    $editlink = $_GET["editlink"];
    $editkategori = $_GET["editkategori"];
    query("UPDATE sosial SET judul='$editjudul', link = '$editlink', kategori = '$editkategori' WHERE id = $id");
}

if (isset($_GET['index'])) {
    // echo 'indexing' . $_GET['index'];
    $client = new Google_Client();

    // service_account_file.json is the private key that you created for your service account.
    $client->setAuthConfig('indexapi-354302-5c0e4f9867a3.json');
    $client->addScope('https://www.googleapis.com/auth/indexing');

    // Get a Guzzle HTTP Client
    $httpClient = $client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    // Define contents here. The structure of the content is described in the next step.
    $content = '{
        "url": "https://himaptika-fkip-ulm.epizy.com/blog/' . $_GET['index'] . '",
        "type": "URL_UPDATED"
    }';

    $response = $httpClient->post($endpoint, ['body' => $content]);
    $status_code = $response->getStatusCode();
    echo $status_code;
}

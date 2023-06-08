<h1><?= $title ?></h1>

<form action="/upload" method="post" enctype="multipart/form-data">
    Upload File: <input type="file" name="file">
    <input type="submit" value="Upload">
</form>
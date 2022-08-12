<nav class="navbar navshadow navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASELINK ?>">
            <img src="<?= BASEURL ?>/Weblogo.png" class="me-3" width="150px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= BASELINK . "home" ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= BASELINK . "gebyar-matematika-2022" ?>">Gebyar Matematika 2022</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASELINK . "blog" ?>">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASELINK . "sosial" ?>">Media Sosial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" target="_blank" href="https://drive.google.com/drive/folders/1v9QQYfMVERVHPPdUO_BnUpp8ihhs-ie6?usp=sharing">Galeri</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item disabled" href="">Sejarah</a></li>
                        <li><a class="dropdown-item" href="<?= BASELINK . "blog/susunan-kepengurusan-himaptika-fkip-ulm-2022-2023" ?>">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="<?= BASELINK . "blog/divisi-divisi-himaptika-fkip-ulm-2022-2023" ?>">Divisi-divisi</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
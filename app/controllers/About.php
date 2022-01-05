<?php

class About {
    public function index($nama = "Your name", $pekerjaan = "Your job") {
        echo "Halo, nama saya $nama, saya adalah seorang $pekerjaan";
    }

    public function page() {
        echo "About/page";
    }
}
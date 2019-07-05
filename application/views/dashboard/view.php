<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 clearfix mb-5">
    <div>
        <?php
        $image_properties = array(
            'src'   => 'assets/images/' . $book['imgfile'],
            // 'alt'   => 'Me, demonstrating how to eat 4 slices of pizza at one time',
            // 'class' => 'float-center',
            'width' => '200',
            'height' => '300',
            'title' => 'That was quite a night',
            // 'rel'   => 'lightbox'
        );
        echo img($image_properties); ?>
    </div>
    <div class="float-left table-responsive">
        <table class="table table-sm">
            <tr>
                <th>ID Buku</th>
                <td><?php echo $book['idbuku'] ?></td>
            </tr>
            <tr>
                <th>Judul Buku</th>
                <td><?php echo $book['judul'] ?></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td><?php 
                $kat = $this->cat_model->namaKategori($book['idkategori']); 
                echo $kat['kategori'];
                ?></td>
            </tr>
            <tr>
                <th>Pengarang</th>
                <td><?php echo $book['pengarang'] ?></td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td><?php echo $book['penerbit'] ?></td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <td><?php echo $book['thnterbit'] ?></td>
            </tr>
        </table>
    </div>
    <div>
        <h3>Sinopsis</h3>
        <?php echo $book['sinopsis']; ?>
    </div>
</main>
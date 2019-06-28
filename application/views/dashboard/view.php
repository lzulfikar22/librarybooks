<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $book['judul']; ?></h1>
    </div>
    <div>
    <?php echo img('assets/images/'. $book['imgfile']);?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $book['idbuku'] ?></td>
                    <td><?php echo $book['judul'] ?></td>
                    <td><?php echo $book['idkategori'] ?></td>
                    <td><?php echo $book['pengarang'] ?></td>
                    <td><?php echo $book['penerbit'] ?></td>
                    <td><?php echo $book['thnterbit'] ?></td>
                </tr>
            </tbody>
        </table>
        <div>
            <h3>Sinopsis</h3>
            <?php echo $book['sinopsis'];?>
        </div>
    </div>
</main>
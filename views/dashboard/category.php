
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Kategori</h1>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data kategori
            foreach ($cat as $cat_item): 

            ?>
            <tr>
              <td><?php echo $cat_item['kategori']?></td>
              <td>0</td>
              <td>View | <?php echo anchor('dashboard/editcat/'.$cat_item['idkategori'], 'Edit', 'Edit Kategori'); ?> | <?php echo anchor('category/delete/'.$cat_item['idkategori'], 'Del', 'Hapus Kategori'); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  
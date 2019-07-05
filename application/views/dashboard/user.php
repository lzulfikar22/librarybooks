
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar User</h1>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Username</th>
              <th>Fullname</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // menampilkan data user
            foreach ($user as $user_item): 

            ?>
            <tr>
              <td><?php echo $user_item['username']?></td>
              <td><?php echo $user_item['fullname']?></td>
              <td><?php echo $user_item['role']?></td>
              <td><?php echo anchor('dashboard/edituser/'.$user_item['username'], 'Edit', 'Edit User'); ?> | <?php echo anchor('user/delete/'.$user_item['username'], 'Del', 'Hapus User'); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a class="nav-link collapsed" href="../dashboard/dashboard.php">
            <i class="bi bi-grid"></i>
            <span>Data Jadwal</span>
          </a>
        <?php endif; ?>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Edit Data</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="../mapel/mapel.php">
                  <i class="bi bi-circle"></i><span>edit mapel</span>
                </a>
              </li>
              <li>
                <a href="../guru/guru.php">
                  <i class="bi bi-circle"></i><span>edit guru</span>
                </a>
              </li>
              <li>
                <a href="../kelas/class.php">
                  <i class="bi bi-circle"></i><span>edit kelas</span>
                </a>
              </li>
              <li>
                <a href="../ruang/room.php">
                  <i class="bi bi-circle"></i><span>edit ruangan</span>
                </a>
              </li>
              <li>
                <a href="../komputer/computer.php">
                  <i class="bi bi-circle"></i><span>edit komputer</span>
                </a>
              </li>
            </ul>
        <?php endif; ?>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <?php if ($_SESSION['role'] === 'super admin'): ?>
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../users/datauser.php">
                        <i class="bi bi-circle"></i><span>Data Users</span>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
      </li>

      <!-- End Tables Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../history/history.php">
          <i class="bi bi-grid"></i>
          <span>History</span>
        </a>
      </li><!-- End Dashboard Nav -->



      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../profile/profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
          <a class="nav-link collapsed" href="../../../index.php?action=logout">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Logout</span>
          </a>
      </li><!-- End Logout Nav -->


    </ul>

  </aside><!-- End Sidebar-->
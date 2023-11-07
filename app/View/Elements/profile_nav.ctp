<ul id="sidebarLink" class="nav flex-column">
        <li class="nav-item">
            <?php echo $this->Custom->activeLink('My Profile', 'Users', 'profile'); ?>
        </li>
        <li class="nav-item">
            <?php echo $this->Custom->activeLink('Update Profile', 'Users', 'updateProfile'); ?>
        </li>
        <li class="nav-item">
            <?php echo $this->Custom->activeLink('Account Settings', 'Users', 'accountSettings'); ?>
        </li>
    </ul>
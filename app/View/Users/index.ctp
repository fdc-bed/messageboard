<!-- <table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Password</th>
  </tr>
  <?php foreach($users as $user): ?>
  <tr>
    <td><?php echo $this->HTML->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?> </td>
    <td><?php echo $user["User"]["email"]; ?></td>
    <td><?php echo $user["User"]["password"]; ?></td>
  </tr>
<?php endforeach; ?>
</table> -->
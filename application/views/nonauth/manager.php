<table class="manager-list">
	<thead>
		<tr id="ct_sort">
			<th>Имя</th>
			<th>Адрес</th>
			<th>Логин/Пароль</th>
			<th>Выбрать</th>
			<th>Отправить</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($users as $user) { ?>
		<tr id="user_<?php echo $user->guid; ?>">
			<td><?php echo $user->fulle_name; ?></td>
			<td><?php echo $user->ur_address; ?></td>
			<td><?php echo $user->ulogin.'/'.$user->upassword; ?></td>
			<td><a href="#" onclick="select_user('<?php echo $user->guid; ?>', '<?php echo $user->manager_guid; ?>');">Выбрать</a></td>
			<td><a class="sendmail" href="#" onclick="send_remind('<?php echo $user->guid; ?>');"><img src="/img/sendmail.png" /></a></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<script>
 function select_user(guid,manager) {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('main/select_user'); ?>",
        data: { user: guid, manager: manager},
        success: function(msg)
        {
                $("#ajax").html(msg); 
        }

    });

 }
 
  function send_remind(guid) {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('main/send_remind'); ?>",
        data: { user: guid},
        success: function(msg)
        {
                $("#ajax").html(msg); 
        }

    });

 }
</script>


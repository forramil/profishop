<?php if($added): ?>
	<?php include(dirname(__FILE__).'/modal-window.php'); ?>
<?php endif; ?>

			<?php if($this->Authmodel->settings('show_char') == 1): ?>
			<th width="50">Характеристика</th>
			<?php endif; ?>
						<?php if($this->Authmodel->settings('show_char') == 1): ?>
						<td width="50" id="char_<?php echo $two->orderid;?>"><?php echo $this->Cart_model->get_char($two->char_guid); ?></td>
						<?php endif; ?>
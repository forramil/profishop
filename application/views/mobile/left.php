<div id="left">
    <div class="category-list">
        <ul class="leftnav_h">
            <?php foreach($cats_main as $mane_cat): ?>
				<li class="first_li">
					<div class="button">
						<a title="<?php echo $mane_cat->name;?>" <?php if($this->uri->segment(1) == 'category' AND $this->uri->segment(2) ==  $mane_cat->id) echo 'class="selected"';?>" href="/mobile/category/<?php echo $mane_cat->id;?>/" class="toplink"><span><?php echo $mane_cat->name;?></span></a>
						<?php if($cats_sub[$mane_cat->guid]): ?>
							<div class="ul_line"></div>
						<?php endif; ?>
					</div>
					<?php if($cats_sub[$mane_cat->guid]): ?>
						<ul class="hidden">
							<?php $i1 = 0; ?>
							<?php $all1 = count($cats_sub[$mane_cat->guid]); ?>
							<?php foreach($cats_sub[$mane_cat->guid] as $level2): ?>
								<?php $i1++;?>
								<li<?php print($cats_sub[$level2->guid] ? ' class="has-children"' : '');?>>
									<?php if($cats_sub[$level2->guid]): ?>
										<div class="button">
											<div class="ul_line"></div>
											<a title="<?php echo $level2->name;?>" <?php if($this->uri->segment(1) == 'category' AND $this->uri->segment(2) == $level2->id) echo 'class="selected"';?> href="/mobile/category/<?php echo $level2->id;?>/"><span><?php echo $level2->name;?></span></a>
										</div>
									<?php else: ?>
									<div class="button">
										<a style="margin-left:20px;" title="<?php echo $level2->name;?>" <?php if($this->uri->segment(1) == 'category' AND $this->uri->segment(2) == $level2->id) echo 'class="selected"';?> href="/mobile/category/<?php echo $level2->id;?>/"><?php echo $level2->name;?></a>
									</div>
									<?php endif; ?>
									<?php if($cats_sub[$level2->guid]): ?>
										<ul  class="hidden">
											<?php $i2 = 0; ?>
											<?php $all2 = count($cats_sub[$level2->guid]); ?>
											<?php foreach($cats_sub[$level2->guid] as $level3): ?>
												<?php $i2++; ?>
												<li <?php if($i2 == $all2)echo 'class="ul_line_last"';?>>
													<div class="button">
													<a style="margin-left:20px;" title="<?php echo $level3->name;?>" <?php if($this->uri->segment(1) == 'category' AND $this->uri->segment(2) ==  $level3->id) echo 'class="selected"';?> href="/mobile/category/<?php echo $level3->id;?>/"><span><?php echo $level3->name;?></span></a>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
            <?php endforeach; ?>
        </ul>
    </div>
	<div class="clear"></div>
</div>
<div id="left-bg">
</div>
            <div class="rigth_part">
                <div class="cart">
                    <div class="goods">Товары: <span id="allgoods"><?php echo number_format($cat['allgoods'],0);?></span></div>
                    <div class="summ">Сумма: <span id="allsumm"><?php echo number_format($cat['allsumm'],0);?></span> руб.</div>
                </div>
                <div class="cathegory">
                    <div class="cat_header">Категории</div>
                    <div id="accordion">
						<?php foreach($cats_main as $mane_cat){?>
						<h3 <?php if($cat == $mane_cat->id) echo 'class="selected"';?>><a href="/category/<?php echo $mane_cat->id;?>/" class="toplink"><?php echo $mane_cat->name;?></a></h3>
						<div>
							<?php if($cats_sub[$mane_cat->id]){
                                foreach($cats_sub[$mane_cat->id] as $level2){?>
                                    <a <?php if($cat == $level2->id) echo 'class="selected"';?> href="/category/<?php echo $level2->id;?>/"><?php echo $level2->name;?></a>
							<?php } }?>
						</div>
						<?php }?>
                    </div>
                </div>
            </div>
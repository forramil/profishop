			
				</div><!--END CONTENT-->
				
				<?php if($this->uri->segment(1) == 'cart'): ?>
					<div class="table_buttons clearfix">
						<form class="print button" method="post" target="_blank" action="/report_html/">
							<input type="submit" value="Печать"/>
						</form>

						<form class="submittable button" method="post" action="/cart/">
							<input onclick="comment();" type="submit" value="Отправить заказ"/>
							<input type="hidden" name="order" value="all" />
							<input type="hidden" class="comment" name="comment" value="" />
						</form>
						<form class="cleartable button" method="post" action="/cart/">
							<input type="submit" value="Очистить"/>
							<input type="hidden" name="clear" value="all" />
						</form>
					</div>
				<?php endif; ?>	
				
			</div><!--END RIGHT COLUMN-->

			<?php include('sidebar.php');?>
	
			
			<div class="clear"></div>
			
			<div class="footer clearfix">
				<div style="float:left;"><a style="display:block;" target="_blank" href="<?php echo $this->Authmodel->settings('link_for_client_logo'); ?>"><img height="50px" src="/img/logoclient.png"></a></div>
				<div style="float:right;"><span style="display:inline-block; padding:14px 0 0; vertical-align:top;"></span>  <a  style="display:inline-block;" target="_blank" href="http://profishop.us"><img src="/img/logo.png"/></a></div>
			</div>
			
		</div><!--END MAIN FRAME-->
	</div><!--END WRAPPER-->

	</body>
</html>
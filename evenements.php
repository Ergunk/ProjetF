
<?php
	

	
	
	require('date.php');
	$date = new Date();
	$year = date('Y');
	$events = $date->getEvents($year);
	$dates = $date->getAll($year);
	
?>

<div class="periods">
	<div class="year"><?php echo $year; ?></div>
	<div class="months">
		<ul>
		
			<?php foreach($date->months as $id=>$m): ?>
			
				<li><a href="" id="linkMonth<?php echo $id+1; ?>" ><?php echo utf8_encode(substr(utf8_decode($m),0,3));?></a></li>
			
			<?php endforeach; ?>
		</ul>
	</div>
	<?php $dates = current($dates); ?>
	
	<?php foreach ($dates as $m => $days): ?>
	
		<div class="month relative" id="month<?php echo $m; ?>">
			<table>
				<thead>
					<tr>
						<?php foreach($date->days as $d): ?>
							
							<th><?php echo substr($d,0,3); ?></th>
						
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php $end = end($days); foreach($days as $d=>$w): ?>
						
						<?php $time = strtotime("$year-$m-$d"); ?>
						
						<?php if($d == 1 && $w > 1): ?>	
						
							
							<td colspan="<?php echo $w-1; ?>" class="padding"></td>
						<?php endif; ?>
						
						<td class="block <?php if($time == strtotime(date('Y-m-d'))){ echo 'today'; } ?>">
						
							<div class="relative">
								<div class="day"><?php echo $d; ?></div>
							</div>
							<div class="daytitle" style="display:none">
								<?php echo $date->days[$w-1]; ?> <?php echo $d; ?> <?php echo $date->months[$m-1]; ?>
							</div>
								
							<?php
								
								if(isset($_SESSION['user'])) {
							
							?>
								<form method="post" action="" class="addevent" >
										
									<div class="control-groupe">
										<input type="text" name="title" placeholder="titre"/>
									</div> 
									
									<div class="control-groupe">
										<textarea name="desc" placeholder="Description" ></textarea>
									</div>	
										<input type="hidden" name="date" value="<?php echo $year.'/'.$m.'/'.$d; ?>" />
										
										<input type="hidden" name="action" value="addevent" />
										
										<input type="submit" value="Ajouter Event" ></input>	
										
								</form>
								
							
								<ul class="events">
									<?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
										
										<li class="event" ><?php  

											$event = explode('.-.',$e);	
											
											echo '<button class="delete" onclick="DeleteEvent('.$event[0].')">X</button>';
											
											echo '<h3>'.$event[1].'</h3>';
											
											echo '<p class="description"  >'.$event[2].'</p>';


											
											
											?>
										</li>
									<?php endforeach; endif;?>
									
									<div class="clear"></div>
								</ul>
							
							<?php
							
								}
							
							?>
							
							
							
						
							</div>
						</td>
							
						<?php if($w == 7): ?>
							
							</tr>
							
							<tr>
							
						<?php endif; ?>
					<?php endforeach; ?>
					<?php if($end != 7): ?>
						
						<td colspan="<?php echo 7-$end; ?>" class="padding"></td>
					<?php endif ?>
					
					</tr>
				</tbody>
			</table>
		</div>
	
	<?php endforeach; ?>
</div>





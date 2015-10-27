<?php
	
	/* Fichier avec la class Date */
	require('date.php');
	
	/* Crée un nouvelle element Date */
	$date = new Date();
	
	/* récupère l'année actuelle */
	$year = date('Y');

	/* Récupère les événements */
	$events = $date->getEvents($year);
	
	/* Récupère le calendrier */
	$dates = $date->getAll($year);
	
?>

<div class="periods">
	<!-- Affiche l'année -->
	<div class="year"><?php echo $year; ?></div>
	<div class="months">
		<ul>
			<!-- Genère les mois selon le tableau -->
			<?php foreach($date->months as $id=>$m): ?>
			
				<!-- Affiche les 3 premières lettres du mois -->
				<li><a href="" id="linkMonth<?php echo $id+1; ?>" ><?php echo utf8_encode(substr(utf8_decode($m),0,3));?></a></li>
			
			<?php endforeach; ?>
			<!-- Fin -->
		</ul>
	</div>
	<?php $dates = current($dates); ?>
	
	<?php foreach ($dates as $m => $days): ?>
		
		<!-- Met l'id du mois -->
		<div class="month relative" id="month<?php echo $m; ?>">
			<table>
				<thead>
					<tr>
						<!-- Genère les jours selon le tableau -->
						<?php foreach($date->days as $d): ?>
							
							<!-- Affiche les 3 premières lettres du jours -->
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
								
									<!-- Regarde si il existe des événements pour la date -->
									<?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
										
										<li class="event" ><?php  

											$event = explode('.-.',$e);	
											
											if($_SESSION["user"] == $event[3]) {
											
												echo '<button class="delete" onclick="DeleteEvent('.$event[0].',\''.$_SESSION['user'].'\')">x</button>';
											}
											
											echo '<a href="?page=description&amp;id='.$event[0].'"><button class="more">+</button></a>';
											
											echo '<h3>'.$event[1].'</h3>';
											
											echo '<div class="description"  >';
											
											echo '<p>'.$event[2].'</p>';
											
											echo '<p> Par '.$event[3].'</p>';
											
											echo '</div>';
					
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



<div class="clear"></div>


<div id="chat_area">

<div >

	<div style="display:table;width:100%;height:100%">
		<div id="message_area" class="text-area">
			
			<!-- Permet de metre à jour le chat !-->
			<script> updateChat(); </script>
		
		</div>
		
		
		
		<div class="input-area">
		
			<div class="input-wrapper">
					<input id="message" name="message" value="" type="text" />
			</div>
			
			<!-- Les variables de sessions permettent de savoir de qui provient le message !-->
			<input id="iduser" type="hidden" name="iduser" value="<?php echo $_SESSION['id']; ?>" />
			<input id="pseudo" type="hidden" name="pseudo" value="<?php echo $_SESSION['user']; ?>" />
			<input type="submit" name="submit" value="Envoyer" id="submit_chat">
		
		</div>
		
	</div>
			
</div> 

<div>
	
	<div id="users-online">
		<!-- Permet de metre à jour les utilisateurs connectés !-->
		<script> updateUsers(); </script>
		
	</div>

</div>


</div>


<script>
		
	//refresh le chat chaque seconde 
	setInterval("updateChat()",1000);
	
	//refresh les utilisateurs online
	setInterval("updateUsers()",5000);
			
</script>

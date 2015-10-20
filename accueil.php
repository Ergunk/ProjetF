
<div id="chat_area">

<div >

	<div style="display:table;width:100%;height:100%">
		<div id="message_area" class="text-area">
			
			<script> updateChat(); </script>
		
		</div>
		
		
		
		<div class="input-area">
		
			<div class="input-wrapper">
					<input id="message" name="message" value="" type="text" />
			</div>
			<input id="iduser" type="hidden" name="iduser" value="<?php echo $_SESSION['id']; ?>" />
			<input id="pseudo" type="hidden" name="pseudo" value="<?php echo $_SESSION['user']; ?>" />
			<input type="submit" name="submit" value="Envoyer" id="submit_chat">
		
		</div>
		
	</div>
			
</div> 

<div>
	
	<div id="users-online">
		
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

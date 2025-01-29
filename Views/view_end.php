


<!-- Pied de page -->

<!-- 
<footer>
    <p><?php echo date("Y"); ?> ©  SAS Perform Vision. Tous droits réservés.</p>
	<div class="social-icons">
			<img src="/Content/images/instagramme.png"  alt="Instagram">
			<img src="/Content/images/facebook.png"  alt="facebook">
		</div>
</footer> -->

<style>
        .alertify-logs {
            top:10px;
            left:10px;
        }
    </style>

<script type="text/javascript" src="../Content/js/alertify.js-0.3.10/lib/alertify.js"></script>

<script>
	<?php

		extract($_GET);

		if (isset($notificationMessage) && ($notificationMessage != null))
		{
			echo "alertify.set({ delay : 3000 });"; //3 seconds
			echo "alertify.".($error ? "error" : "success")."(\"$notificationMessage\");";	
		}
	?>			
</script>

</body>
</html>
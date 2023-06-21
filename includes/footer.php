<?php  
echo '<footer class="footer footer-sticky-bottom text-center"><strong>&copy Taskmanager, 2023</strong></footer>
<script type="text/javascript" src="/taskmanager/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="/taskmanager/js/bootstrap.min.js">
$("#navbarNav").collapse("collapse");
</script>
<script type="text/javascript" src="/taskmanager/js/taskman.js">

$(document).on("submit", function(){
			var formdata = $("comment_data").serialize()+"&submit=submit";

			$.ajax({
				type: "post",
				url:"controller.php",
				data: formdata,

				success: function(){
					alert("Success!);
				}
			})
		})
</script>
</body>
</html>
';
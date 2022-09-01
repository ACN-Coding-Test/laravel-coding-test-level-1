<footer id="footer">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="footer-bottom row">
			<div class="col-md-6 col-md-push-6">
				<ul class="footer-nav">
					<li><a href="{{ url('home') }} ">Home</a></li>
					<li><a href="{{ url('sources')}}">Source List</a></li>
					<li><a href="#">Language</a></li>
					<li><a href="{{ url('register')}}">Register</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-md-pull-6">
				<div class="footer-copyright">
					Copyright &copy; <?php echo  date('Y')?> All rights reserved | Test Blog 
				</div>
			</div>
		</div>
	</div>
</footer>
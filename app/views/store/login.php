<?php
  $this->view("store/header");
  ?>
		<!--=============================================
    =            Login Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row justify-content-center">
					
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
						<form action="./">
							<div class="login-form">
								<h4 class="login-title">Returning Customer</h4>
								<p><span class="font-weight-bold">I am a returning customer</span></p>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Enter your email address here...</label>
										<input class="mb-0 form-control" type="email" id="email1"
											placeholder="Enter you email address here...">
									</div>
									<div class="col-12 mb--20">
										<label for="password">Password</label>
										<input class="mb-0 form-control" type="password" id="login-password" placeholder="Enter your password">
									</div>
									<div class="col-md-12">
										<a href="#" class="btn btn-outlined">Login</a>
									</div>
									<div class="col-md-12 pd-10">
										Dont' have an account? <a href="<?=ROOT?>register">Register</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
<?php
  $this->view("store/footer");
  ?>

<?php
  $this->view("store/header");
  ?>
  <main class="page-section inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0 justify-content-center">
                <!-- Registeration Form s-->
                <form method="post">
                    <div class="login-form">
                        <h4 class="login-title">New Customer</h4>
                        <p><span class="font-weight-bold">I am a new customer</span></p>
                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Full Name</label>
                                <input name="name" class="mb-0 form-control" type="text" id="name"
                                    placeholder="Enter your full name">
                            </div>
                            <div class="col-12 mb--20">
                                <label for="email">Email</label>
                                <input name="email" class="mb-0 form-control" type="email" id="email" placeholder="Enter Your Email Address Here..">
                            </div>
                            <div class="col-lg-6 mb--20">
                                <label for="password">Password</label>
                                <input name="password" class="mb-0 form-control" type="password" id="password" placeholder="Enter your password">
                            </div>
                            <div class="col-lg-6 mb--20">
                                <label for="password">Repeat Password</label>
                                <input name="confirm-password" class="mb-0 form-control" type="password" id="repeat-password" placeholder="Repeat your password">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Register</button>
                            </div>
                            <div class="col-md-12 pd-10">
								Already have an account? <a href="<?=ROOT?>login">Login</a>
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
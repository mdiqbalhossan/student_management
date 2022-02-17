<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-center wrapper" style="height: 100vh;">
        <div class="col-lg-12 my-auto">
            <div class="card-group my_shadow">
                <div class="card border-info rounded-left p-4" style="flex-grow: 1.4;">
                    <h1 class="text-center font-weight-bold text-primary">Contact With Us</h1>
                    <hr class="my-3">
                    <div id="log_alert"></div>
                    <form action="#" method="post" class="p-3" id="contact_form">
                        <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-user fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="fname" id="fname" class="form-control rounded-0" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-lg form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0">
                                            <i class="far fa-user fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="lname" id="lname" class="form-control rounded-0" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted my-1">
                            Please Give your correct email. We will contact your given email address.
                        </small>
                        <div class="input-group input-group-lg form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="far fa-envelope fa-lg"></i>
                                </span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Write Your Message Here..." id="message" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" id="msg_btn" class="btn btn-primary btn-lg btn-block my_btn">
                        </div>
                    </form>
                </div>
                <div class="card border-success justify-content-center rounded-right p-4">
                    <div class="card my-2">
                      <div class="card-body">
                        <h4 class="card-title text-center"><i class="fa fa-street-view"></i></h4>
                        <p class="card-text text-center"><strong>Zigathola, Dhanmondi<br>Dhaka-1209<br>Bangladesh</strong></p>
                      </div>
                    </div>
                    <div class="card my-2">
                      <div class="card-body">
                        <h4 class="card-title text-center"><i class="fa fa-square-phone"></i></h4>
                        <p class="card-text text-center"><strong>+8801679487265</strong></p>
                      </div>
                    </div>
                    <div class="card my-2">
                      <div class="card-body">
                        <h4 class="card-title text-center"><i class="fa fa-envelope"></i></h4>
                        <p class="card-text text-center"><strong>jmiqbal2019@gmail.com</strong></p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
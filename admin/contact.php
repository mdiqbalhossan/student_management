<?php include 'inc/header.php'; ?>

    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title align-self-center">All Contact Message</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="contact_body">

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


        </div>
    </div>



    <!-- Reply Contact Modal -->
    <div class="modal fade" id="replyMsgModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-light">Reply Message</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="reply_msg_form" class="px-3">
                        <input type="hidden" id="msg_id" name="msg_id">
                        <input type="hidden" id="msg_email" name="email">
                        <div class="form-group">
                            <label for="grade">Subject <span class="text-danger">*</span></label>
                            <input type="text" id="subject" name="subject" class="form-control form-control-lg" placeholder="Enter Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="msg">Message</label>
                            <textarea name="message" id="message" class="form-control form-control-lg" placeholder="Write your Message here..." rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="reply_msg" id="reply_msg" value="Reply Message" class="btn btn-success btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Reply Contact Modal End -->


<?php include 'inc/footer.php'; ?>
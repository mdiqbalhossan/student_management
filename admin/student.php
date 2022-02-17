<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title align-self-center">All Student</h3>
                        <a href="admit-student.php" class="btn btn-info float-right">Admit Student</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="student">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
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

<!-- Show USer Details Modal -->
<div class="modal fade" id="detailsStudentModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header border-info bg-info text-white">
                <h4 class="modal-title" id="getIdNum"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <h5 class="card-header bg-primary d-flex justify-content-between">
                            <span class="text-light lead align-self-center"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;Personal Details</span>
                        </h5>
                        <div class="card-body">
                            <div id="image">

                            </div>
                            <hr>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="name"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="email"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="gender"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="dob"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="phone"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="religion"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="address"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="city"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="country"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="bg"></p>
                            <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="verified"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-info">
                                <h5 class="card-header bg-info d-flex justify-content-between">
                                    <span class="text-light lead align-self-center"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;Admission Details</span>
                                </h5>
                                <div class="card-body">
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="date"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="number"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="roll"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="class"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="sec"></p>
                                </div>
                            </div>
                            <div class="card border-danger mt-3">
                                <h5 class="card-header bg-danger d-flex justify-content-between">
                                    <span class="text-light lead align-self-center"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;Parent Details</span>
                                </h5>
                                <div class="card-body">
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="fname"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="fphone"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="foccupation"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="mname"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="mphone"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="moccupation"></p>
                                </div>
                            </div>
                            <div class="card border-info mt-3">
                                <h5 class="card-header bg-info d-flex justify-content-between">
                                    <span class="text-light lead align-self-center"><i class="fas fa-user-tag"></i>&nbsp;&nbsp;Login Details</span>
                                </h5>
                                <div class="card-body">
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="login_email"></p>
                                    <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;" id="password"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
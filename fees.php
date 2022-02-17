<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-center wrapper mt-5">
        <div class="col-md-10 my-auto">
            <div class="card rounded border-info">
                <h5 class="card-header bg-info d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Payable Fees</span>
                </h5>
                <div class="card-body">
                    <table class="table table-striped text-center table-bordered">
                        <thead>
                        <?php if($unpaid_fees): ?>
                            <tr>
                                <th>Title</th>
                                <th>description</th>
                                <th>Total Amount</th>
                                <th>Issued Date</th>
                                <th>Due Date</th>
                                <th>Fine</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unpaid_fees as $value): ?>
                                <tr>
                                    <td><?= $value['title']; ?></td>
                                    <td><?= $value['description']; ?></td>
                                    <td><?= $value['total_amount']; ?></td>
                                    <td><?= date('d M Y', strtotime($value['issued_date'])); ?></td>
                                    <td><?= date('d M Y', strtotime($value['due_date'])); ?></td>
                                    <td>
                                        <?php if($value['due_date'] < date('Y-m-d')){ echo $value['fine']; }else{echo '<span class="badge badge-success">No Fine</span>';} ?>
                                    </td>
                                    <td>
                                        <a href="#" id="<?= $value['id']; ?>" class="btn btn-info btn-sm pay" data-toggle="modal" data-target="#pay">Pay Now</a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <h3 class="text-center text-danger font-width-bold">You have no Payable fees.</h3>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card rounded border-success mt-3">
                <h5 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Paid Fees</span>
                </h5>
                <div class="card-body">
                    <table class="table table-striped text-center table-bordered">
                        <thead>
                            <?php if($paid_fees): ?>
                            <tr>
                                <th>Title</th>
                                <th>Paid Amount</th>
                                <th>Payment Method</th>
                                <th>Payment Date</th>
                                <th>Tr.Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php foreach ($paid_fees as $value): ?>
                                <tr>
                                    <td><?= $value['title']; ?></td>
                                    <td><?= $value['paid_amount']; ?></td>
                                    <td><?= $value['payment_method']; ?></td>
                                    <td><?= date('d M Y', strtotime($value['payment_date'])); ?></td>
                                    <td><?= $value['transaction_id'] ?></td>
                                    <td><?= $value['status'] ?></td>
                                    <td>
                                        <a href="invoice.php?id=<?= $value['id']; ?>" class="btn btn-success btn-sm">Download Reciept</a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <h3 class="text-center text-danger font-width-bold">You have no paid fees.</h3>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pay Form -->
<?php require_once 'inc/fees_modal.php'; ?>
<!-- Pay Form -->

<?php include 'inc/footer.php'; ?>
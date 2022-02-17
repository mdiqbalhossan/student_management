<?php include 'inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-center wrapper mt-5">
        <div class="col-md-10 my-auto">

            <div class="card rounded border-success mt-3">
                <h5 class="card-header bg-success d-flex justify-content-between">
                    <span class="text-light lead align-self-center"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Result</span>
                </h5>
                <div class="card-body">
                    <table class="table table-striped text-center table-bordered">
                        <thead>
                            <?php if($result): ?>
                            <tr>
                                <th>Title</th>
                                <th>Teacher Note</th>
                                <th>Obtained Marks</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php foreach ($result as $value): ?>
                                <tr>
                                    <td><?= $value['title']; ?></td>
                                    <td><?= $value['teacher_note']; ?></td>
                                    <td><?= $value['obtained_marks']; ?></td>
                                    <td><?= date('d M Y', strtotime($value['crated_at'])); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm">Download Certificate</a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <h3 class="text-center text-danger font-width-bold">You have no result yet.</h3>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
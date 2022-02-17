<div class="modal fade" id="pay">
	<div class="modal-dialog modal-dialog-centered mw-100 w-50">
		<div class="modal-content">
			<div class="modal-header border-info bg-info text-white">
				<h4 class="modal-title">Pay Bill</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <form action="" method="post" id="fees_form">
			<div class="modal-body">
				<div class="card-deck">
					<div class="card">
						<div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="id" value="<?= $student['id_num']; ?>">
                                    <label for="paid_amount">Paid Amount<strong class="text-danger">*</strong></label>
                                    <input type="number" name="paid_amount" class="form-control" placeholder="1000" id="paid_amount">
                                    <strong class="form-text text-danger" id="paid_amountErr"></strong>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="payment_date">Payment Date<strong class="text-danger">*</strong></label>
                                    <input type="date" name="payment_date" class="form-control" id="payment_date">
                                    <strong class="form-text text-danger" id="payment_dateErr"></strong>
                                </div>
						    </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="payment_method">Payment Method<strong class="text-danger">*</strong></label>
                                    <select id="payment_method" name="payment_method" class="form-control" required>
                                        <option selected value="">Choose..</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Rocked">Rocket</option>
                                    </select>
                                    <strong class="form-text text-danger" id="payment_methodErr"></strong>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tr_id">Transaction ID<strong class="text-danger">*</strong></label>
                                    <input type="text" name="tr_id" class="form-control" placeholder="FB25YUIO96" id="tr_id">
                                    <strong class="form-text text-danger" id="tr_idErr"></strong>
                                </div>
						    </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" name="notes" id="notes" rows="4"></textarea>
                            </div>
						</div>                       
					</div>
				</div>
			</div>
            <div class="modal-footer">
                <div class="form-group float-left">
                    <input type="submit" name="submit" value="Submit" id="pay_submit" class="btn btn-success float-right">
                </div>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
            </form>
		</div>
	</div>
</div>
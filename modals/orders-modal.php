
<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
            </div>

            <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

                <div class="paymentOrderMessages"></div>


                <div class="form-group">
                    <label for="due" class="col-sm-3 control-label">Due Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="due" name="due" disabled="true" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="payAmount" name="payAmount"/>
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="paymentType" id="paymentType" >
                            <option value="">~~SELECT~~</option>
                            <option value="1">Cheque</option>
                            <option value="2">Cash</option>
                            <option value="3">Credit Card</option>
                        </select>
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="paymentStatus" id="paymentStatus">
                            <option value="">~~SELECT~~</option>
                            <option value="1">Full Payment</option>
                            <option value="2">Advance Payment</option>
                            <option value="3">No Payment</option>
                        </select>
                    </div>
                </div> <!--/form-group-->

            </div> <!--/modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
            </div>
            <div class="modal-body">

                <div class="removeOrderMessages"></div>

                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->
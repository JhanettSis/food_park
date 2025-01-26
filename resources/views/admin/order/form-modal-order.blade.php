<!-- Modal -->
<div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="order_modal"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" class="order_status_form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Payment Status</label>
                    <select class="form-control payment_status" name="payment_status" id="">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="">Order Status</label>
                    <select class="form-control order_status" name="order_status" id="">
                        <option value="pending">Pending</option>
                        <option value="in_process">In Process</option>
                        <option value="delivered">Delivered</option>
                        <option value="declined">Declined</option>

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit_btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

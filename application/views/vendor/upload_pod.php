<div class="section-full dez-we-find bg-img-fix m-t50 p-b50" style="margin-top: 70px;">
    <div class="container">
        <div class="section-content">
        <?php if (!empty($this->session->flashdata('msg'))) { ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php } ?>
            <?php //print_r($update_driver);?>
            <form action="<?php echo base_url('upload-pod/'.$id);?>" method="POST" enctype="multipart/form-data">
                <div class="row mt-2">

                    <div class="form-group col-md-3">
                        <div class="form-group">
                        <input type="hidden" value="<?php echo $id;?>" name="ftl_request_id">
                            <label class="control-label">Exit Date<span style="color:red;"><i class="fa fa-star" aria-hidden="true"></i></span></label>
                            <input type="date" name="exit_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Exit Time<span style="color:red;"><i class="fa fa-star" aria-hidden="true"></i></span></label>
                            <input type="time" name="exit_time"  class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">POD Upload<span style="color:red;"><i class="fa fa-star" aria-hidden="true"></i></label>
                            <input type="File" class="form-control" name="after_reach_pod" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Payment<span style="color:red;"><i class="fa fa-star" aria-hidden="true"></i></label><br>
                            <input type="radio"  name="payment_confirm" value="yes">Yes
                            <input type="radio"  name="payment_confirm" value="No">No
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <button type="submit" name="submit" class="btn  btn-lg btn-primary mt-2">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
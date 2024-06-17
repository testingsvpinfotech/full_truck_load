<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                        </div>
                        <div class="box-body">
                            <div class="alert_msg"></div>
                                <form id="general_ledger_form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="col-4 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" onkeyup="getMailingName()">
                                                    <input type="hidden" class="form-control" name="ledger_code" id="ledger_code" value="<?= $max_no; ?>" readonly>
                                                </div>
                                                 <div class="col-4 mb-3">
                                                    <label>Alias</label>
                                                    <input type="text" class="form-control" name="alias" id="alias"
                                                        placeholder="Enter Alias">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Under</label>
                                                    <select class="form-control" name="under_group" id="under_group">
                                                        <option value="">Please Select</option>
                                                        <?php if(!empty($grp)): foreach ($grp as $value):
                                                            echo '<option value="'.$value->name.'">'.$value->name.' -('.$value->alias_name.')</option>';
                                                        endforeach; endif;  ?>
                                                    </select>

                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Date </label>
                                                    <input class="form-control" name="date" id="date" value="<?= date('d-m-Y'); ?>" readonly>
                                                </div>
                                               <!--  <div class="col-4 mb-3">
                                                    <label>Type of Ledger </label>
                                                    <input class="form-control" name="ledger_type" id="ledger_type" placeholder="Enter type of Ledger">
                                                </div> -->
                                                <div class="col-4 mb-3">
                                                    <label>Maintain balances bill by bill</label>
                                                    <select class="form-control" name="billbybill_balance" id="billbybill_balance">
                                                        <option value="">Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                 <div id="section_billbybill" class="col-4 mb-3" style="display: none;">
                                                     <label>Default credit period </label>
                                                    <input class="form-control" name="default_cr_period" id="default_cr_period" placeholder="Enter default credit period">
                                                 </div>
                                                 <div id="section1_billbybill" class="col-4 mb-3" style="display: none;">
                                                     <label>Check credit days during voucher entry </label>
                                                    <input class="form-control" name="chk_creditdays" id="chk_creditdays" placeholder="Enter credit days">
                                                 </div>

                                                <div class=" col-12">
                                                    <h5> Statutory Details </h5>
                                                </div>
                                                
                                                <div class="col-4 mb-3">
                                                    <label>Is TDS  Deductable</label>
                                                    <select class="form-control" name="is_tds_deductable" id="is_tds_deductable" required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                </div>
                                                <div id="tds_section" class="col-4 mb-3" style="display: none;">
                                                    <label>Deductee Type</label>
                                                    <input class="form-control" name="deductee_type" id="deductee_type" placeholder="Enter Deductee Type" />
                                                </div>
                                                <div id="tds_section1" class="col-4 mb-3" style="display: none;">
                                                    <label>Deduct TDS in Same Voucher</label>
                                                    <select class="form-control" name="deduct_tds_same_voucher" id="deduct_tds_same_voucher">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                </div>
                                                <div id="tds_section2" class="col-4 mb-3" style="display: none;">
                                                    <label>Use Advanced TDS Entries</label>
                                                    <select class="form-control" name="advanced_tds" id="advanced_tds" required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                </div>

                                    </div>
                                </form>
                        </div>

                                <div class="col-md-6 row">

                                                <div class=" col-12">
                                                    <h5> Mailing details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="mailing_name" id="mailing_name" placeholder="name">
                                                </div>
                                                <div class="col-8 mb-3">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="mailing_address" id="mailing_address" placeholder="Address">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="mailing_pincode" id="mailing_pincode" placeholder="pincode">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="mailing_state" id="mailing_state" placeholder="State">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="mailing_country" id="mailing_country" placeholder="country">
                                                </div>
                                                

                                                <div class="col-4 mb-3">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" name="mailing_mobileno" id="mailing_mobileno" placeholder="country">
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <label>Provide Contact Details</label>
                                                    <input type="text" class="form-control" name="mailing_provide_contact_details" id="mailing_provide_contact_details" placeholder="Provide Contact Details">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Set/Alter multiple mailing details</label>
                                                    <input type="text" class="form-control" name="mailing_multi_mail_details" id="mailing_multi_mail_details" placeholder="Set/Alter multiple mailing details">
                                                </div>


                                                <div class=" col-12">
                                                    <h5> Banking details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Provide Bank Details</label>
                                                    <select type="text" class="form-control" name="is_bank_details" id="is_bank_details">
                                                        <option value="">Please Select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                </div>
                                                <div id="bank_section" class="col-4 mb-3" style="display: none">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name">
                                                </div>
                                                <div id="bank_section1" class="col-4 mb-3" style="display: none">
                                                    <label>Branch Name</label>
                                                    <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                                                </div>
                                                <div id="bank_section2" class="col-4 mb-3" style="display: none">
                                                    <label>IFSC Code</label>
                                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code">
                                                </div>
                                                <div id="bank_section3" class="col-4 mb-3" style="display: none">
                                                    <label>Transaction Type</label>
                                                    <input type="text" class="form-control" name="transaction_type" id="transaction_type" placeholder="Enter Transaction type">
                                                </div>

                                                <div class=" col-12">
                                                    <h5> Tax Registration details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>PAN/IT No.</label>
                                                    <input type="text" class="form-control" name="pan_it_no" id="pan_it_no" placeholder="Enter PAN/IT No" required>
                                                    <small>(PAN is mandatory for e-TDS.)</small>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Provide PAN Details</label>
                                                     <select type="text" class="form-control" name="is_bank_details" id="is_bank_details">
                                                        <option value="">Please Select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                    <!-- <input type="text" class="form-control" name="ks_provide_pan_details" id="ks_provide_pan_details" placeholder="Enter PAN/IT No"> -->
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <label>Registration type</label>
                                                    <input type="text" class="form-control" name="reg_type" id="reg_type" placeholder="Enter Registration type">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>GSTIN/UIN</label>
                                                    <input type="text" class="form-control" name="gstin" id="gstin" placeholder="Enter GSTIN/UIN">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Set/Alter GST Details</label>
                                                    <input type="text" class="form-control" name="gst_details" id="gst_details" placeholder="Enter GST Details">
                                                </div>
                                                

                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary" onclick="general_ledger_submit()">Submit</button>
                                                </div>
                                            </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function getMailingName(){
        var dInput = $('#name').val();
        $("#mailing_name").val(dInput);
    }

    $('#billbybill_balance').on('change', function() {
        if( this.value == 'Yes' ){
            $("#section_billbybill").show();
            $("#section1_billbybill").show();
        }else{
            $("#section_billbybill").hide();
            $("#section1_billbybill").hide();
        }
    });

    $('#is_bank_details').on('change', function() {
        if( this.value == 'Yes' ){
            $("#bank_section").show();
            $("#bank_section1").show();
            $("#bank_section2").show();
            $("#bank_section3").show();
            // $("#bank_section4").show();
            
        }else{
            $("#bank_section").hide();
            $("#bank_section1").hide();
            $("#bank_section2").hide();
            $("#bank_section3").hide();
            // $("#bank_section4").hide();
        }
    });

    $("#is_tds_deductable").on('change', function() {
        if( this.value == 'Yes' ){
            $("#tds_section").show();
            $("#tds_section1").show();
            $("#tds_section2").show();
            
        }else{
            $("#tds_section").hide();
            $("#tds_section1").hide();
            $("#tds_section2").hide();
        }
    });

    function submit_ledger_gst_details(){
        $("#ledger_gst_form").validate({
        rules: {
            hsn_code: {  required: true }
        },
        messages: {
            hsn_code: {  required: "HSN/SAC is required." }
        },
        submitHandler: function(form) {
            // if(id == null){
                var url = baseURL+'submitLedgerGst';
            // }else{
                // var url = baseURL+'submitGst/'+id;
            // }
            $.ajax({
                url: url,
                type: 'POST',
                data: $(form).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        $("#masterModal").hide();
                    }
                }
            });
        }
    });
    }
</script>




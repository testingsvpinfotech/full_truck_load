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
                            <form id="voucher_form">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label>Voucher No</label>
                                        <input class="form-control" name="voucher_no" id="voucher_no" placeholder="Enter voucher number" value="<?= (!empty($data['master']))?$data['master']->voucher_no:""; ?>" readonly>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label>Voucher Date</label>
                                        <input class="form-control" type="date" name="voucher_date" id="voucher_date" placeholder="Enter voucher date" value="<?= (!empty($data['master']))?$data['master']->voucher_date:date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label>Voucher Type</label>
                                        <select class="form-control" name="voucher_type" id="voucher_type">
                                            <option value="">Please Select</option>
                                            <option value="Sale" <?= ('Sale' == $data['master']->voucher_type)?'selected':''; ?>>Sales</option>
                                            <option value="Purchase" <?= ('Purchase' == $data['master']->voucher_type)?'selected':''; ?>>Purchase</option>
                                            <option value="Contra" <?= ('Contra' == $data['master']->voucher_type)?'selected':''; ?>>Contra</option>
                                            <option value="Payment" <?= ('Payment' == $data['master']->voucher_type)?'selected':''; ?>>Payment</option>
                                            <option value="Receipt" <?= ('Receipt' == $data['master']->voucher_type)?'selected':''; ?>>Receipt</option>
                                            <option value="Journal" <?= ('Journal' == $data['master']->voucher_type)?'selected':''; ?>>Journal</option>
                                            <option value="Other" <?= ('Other' == $data['master']->voucher_type)?'selected':''; ?>>Other</option>
                                           
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label>Supplier Invoice No</label>
                                        <input class="form-control" name="inv_no" id="inv_no" placeholder="Enter supplier invoice number" value="<?= (!empty($data['master']))?$data['master']->inv_no:""; ?>">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label>Party A/C Name</label>
                                        <select class="form-control" name="party_id" id="party_id">
                                            <option value="">Please Select</option>
                                            <?php if(!empty($ledger)): foreach ($ledger as $value): ?>
                                                <option value="<?= $value->id ?>" <?= ($value->id == $data['master']->party_id)?'selected':''; ?>><?= $value->name ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label>Center</label>
                                        <select class="form-control" name="center" id="center">
                                            <option value="">Please Select</option>
                                            <?php if(!empty($branch)): foreach ($branch as $value): ?>
                                                <option value="<?= $value->branch_id ?>" <?= ($value->branch_id == $data['master']->branch_id)?'selected':''; ?>><?= $value->branch_name ?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label>Remark</label>
                                        <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"><?= (!empty($data['master']))?$data['master']->remark:""; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="50%">Particular</th>
                                                <th>Rate per</th>
                                                <th>Amount</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control" id="particular1">
                                                        <option value="">Please Select</option>
                                                        <?php if(!empty($particular)): foreach ($particular as $value): ?>
                                                        <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                                        <?php endforeach; endif; ?>
                                                </select>
                                                </td>
                                                <td><input id="rate1" class="form-control" placeholder="Enter Rate"></td>
                                                <td><input id="amount1" class="form-control" placeholder="Enter Amount"></td>
                                                <td><a onclick="add_particular_row()" class="btn btn-xs btn-success">ADD</a></td>
                                            </tr>
                                            <tbody id="voucher_wrapper">
                                                <?php if(!empty($data['trans'])): foreach ($data['trans'] as $tv): ?>
                                                <tr>
                                                    <td><input name="" value="<?= $tv->particular_name; ?>" class="form-control" readonly></td>
                                                    <td><input name="" value="<?= $tv->rate; ?>" class="form-control" readonly></td>
                                                    <td><input name="" value="<?= $tv->amount; ?>" class="form-control" readonly></td>
                                                    <td><a href="#"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>

                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">Total amount : <input name="total_amount" id="total_amount" class="form-control" placeholder="Total amount" value="<?= (!empty($data['master']))?$data['master']->total_amount:0; ?>" readonly></td>
                                            </tr>
                                        </table>
                                        <!-- <a onclick="saveVoucherRecord();" class="btn btn-xs btn-primary text-white">SAVE VOUCHER</a> -->
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
<!-- <script type="text/javascript">
    var vr_cnt = 1;
    function add_particular_row(){
        var amount = $("#amount1").val();
        var rate = $("#rate1").val();
        var par_id = $("#particular1 :selected").val();
        var par_name = $("#particular1 :selected").text();
        var data = '';
        data += '<tr id="vrow_id_'+vr_cnt+'">';
            data += '<td>';
                data += '<input type="hidden" id="par_id_'+vr_cnt+'" name="par_id[]" class="form-control" value="'+par_id+'" readonly><input type="hidden" name="vtrans_id[]" id="vtrans_id_'+vr_cnt+'" class="form-control" value="0">';
                data +='<input id="par_name_'+vr_cnt+'" name="par_name[]" class="form-control" value="'+par_name+'" readonly>';
            data += '</td>';
            data += '<td><input id="rate_'+vr_cnt+'" name="rate[]" class="form-control" value="'+rate+'" readonly></td>';
            data += '<td><input id="amount_'+vr_cnt+'" name="amount[]" class="form-control" value="'+amount+'" readonly></td>';
            data += '<td><a onclick="remove_voucher_row('+vr_cnt+')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>';
        data += '</tr>';
        $('#voucher_wrapper').append(data);
        vr_cnt++;
        calculate_total_amount();
        $("#amount1").val('');
        $("#rate1").val('');
        $("#particular1").val('');
    }

    function remove_voucher_row(cnt){
        $("#vrow_id_"+cnt).remove();
    }

    function calculate_total_amount(){
        var tot_amount = $("#amount1").val();
        var total = $("#total_amount").val();
        var final = 0;
        final = parseFloat(tot_amount) + parseFloat(total);
        $("#total_amount").val(final);
    }

    function saveVoucherRecord(){
        $.ajax({
            url:'<?=base_url().'insert_voucher/' ?>',
            method: 'post',
            data:$('#voucher_form').serialize(),
            // dataType: 'json',
            success: function(resp){
              if (resp == 1) {
                    display_alert('succ','successfully inserted !');
                    $("body, html").animate({'scrollTop':0},500);
                    setTimeout(function() { window.location.reload() }, 1000);
                }else if(resp == 2){
                    display_alert('err','Already Exist !');
                    $("body, html").animate({'scrollTop':0},500);
                }
            }
        });
    }
</script> -->
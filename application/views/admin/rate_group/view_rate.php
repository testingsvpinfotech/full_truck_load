<?php include(dirname(__FILE__) . '/../admin_shared/admin_header.php'); ?>
<!-- END Head-->
<style>
    .buttons-copy {
        display: none;
    }

    .buttons-csv {
        display: none;
    }

    /*.buttons-excel{display: none;}*/
    .buttons-pdf {
        display: none;
    }

    .buttons-print {
        display: none;
    }

    .form-control {
        color: black !important;
        border: 1px solid var(--sidebarcolor) !important;
        height: 27px;
        font-size: 10px;
    }
</style>
<!-- START: Body-->

<body id="main-container" class="default">


    <!-- END: Main Menu-->

    <?php include(dirname(__FILE__) . '/../admin_shared/admin_sidebar.php'); ?>
    <!-- END: Main Menu-->

    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">


            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h4 class="card-title">Franchise Rate : <?php echo $domestic_rate_list[0]['customer_name']; ?></h4>
                        </div>
                        <div class="card-body">
                        <?php if ($this->session->flashdata('notify') != '') { ?>
										<div class="alert <?php echo $this->session->flashdata('class'); ?> alert-colored"><?php echo $this->session->flashdata('notify'); ?></div>
									<?php unset($_SESSION['class']);
										unset($_SESSION['notify']);
									} ?>
                            <div class="table-responsive">
                                <table id="example" class="display table dataTable table-striped layout-primary table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>from zone</th>
                                            <th>to zone</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Mode</th>
                                            <th>TAT</th>
                                            <th>Applicable From</th>
                                            <th>Weight From</th>
                                            <th>Weight To</th>
                                            <th>Rate</th>
                                            <th>Rate Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($domestic_rate_list)) {
                                            $cnt = 0;
                                            foreach ($domestic_rate_list as $value) {
                                                $cnt++;
                                        ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <?php if (!empty($value['from_zone_id'])) {
                                                        $whr = array('region_id' => $value['from_zone_id']);
                                                        $res2s = $this->basic_operation_m->get_table_row('region_master', $whr);
                                                    } ?>
                                                    <?php if (!empty($value['to_zone_id'])) {
                                                        $whr = array('region_id' => $value['to_zone_id']);
                                                        $res3s = $this->basic_operation_m->get_table_row('region_master', $whr);
                                                    } ?>
                                                    <td><?php echo $res2s->region_name; ?></td>
                                                    <td><?php echo $res3s->region_name; ?></td>
                                                    <td><?php
                                                        if (!empty($value['state_id'])) {
                                                            $res1 = $this->basic_operation_m->get_query_row("select * from state where id = '" . $value['state_id'] . "'");
                                                            echo $res1->state;
                                                        } ?></td>
                                                    <td><?php if (!empty($value['city_id'])) {
                                                            $res1s = $this->basic_operation_m->get_query_row("select * from city where id = '" . $value['city_id'] . "'");
                                                            echo $res1s->city;
                                                        } ?></td>
                                                    <?php if (!empty($value['mode_id'])) {
                                                        $whr = array('transfer_mode_id' => $value['mode_id']);
                                                        $res2s = $this->basic_operation_m->get_table_row('transfer_mode', $whr);
                                                    } ?>
                                                    <td><?php echo $res2s->mode_name; ?></td>
                                                    <td><?php echo $value['tat']; ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($value['applicable_from'])); ?></td>
                                                    <td><?php echo $value['weight_range_from']; ?></td>
                                                    <td><?php echo $value['weight_range_to']; ?></td>
                                                    <td><?php echo $value['rate']; ?></td>
                                                    <td><?php if ($value['fixed_perkg'] == 0) {
                                                            echo "Fixed";
                                                        } else if ($value['fixed_perkg'] == 1) {
                                                            echo "Addtion 250GM";
                                                        } else if ($value['fixed_perkg'] == 2) {
                                                            echo "Addtion 500GM";
                                                        } else if ($value['fixed_perkg'] == 3) {
                                                            echo "Addtion 1000GM";
                                                        } else if ($value['fixed_perkg'] == 4) {
                                                            echo "Per Kg";
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <a href="admin/edit-franchise-rate/<?php echo $value['rate_id']; ?>"><i class="ion-edit" style="color:var(--primarycolor);"></i></a>
                                                        <!-- |
                                             <a href="admin/delete-domestic-rate/<?php echo $value['rate_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="icon-trash"></i></a> -->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        <?php    }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->

    <?php include(dirname(__FILE__) . '/../admin_shared/admin_footer.php'); ?>
    <!-- START: Footer-->
</body>
<!-- END: Body-->

</html>
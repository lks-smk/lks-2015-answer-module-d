<section class="content-header">
    <h1>
        Transaction History
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">

                            <div class="row">

                                <div class="col-xs-4">
                                    <label>Date Range</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservation"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="col-xs-3">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control">
                                        <option>All</option>
                                        <option>Accepted</option>
                                        <option>Rejected</option>
                                    </select>
                                </div>
                                <div class="col-xs-5">
                                    <label>Sort By</label>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <select class="form-control">
                                                <option>Request ID</option>
                                                <option>Monthly Payment</option>
                                                <option>Principal Date</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <select class="form-control">
                                                <option>ASC</option>
                                                <option>DESC</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">View</button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->

    </div>   <!-- /.row -->

    <div class="row">

        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Loan Simulation</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Monthly Payment</th>
                                <th>Principal Debt</th>
                                <th>Interest Rate</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="detail.html">OR9842</a></td>
                                <td>IDR 150.000</td>
                                <td>IDR 3.000.000</td>
                                <td>2%</td>
                                <td><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr>
                                <td><a href="detail.html">OR9842</a></td>
                                <td>IDR 150.000</td>
                                <td>IDR 3.000.000</td>
                                <td>2%</td>
                                <td><span class="label label-danger">Rejected</span></td>
                            </tr>

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
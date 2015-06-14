<section class="content-header">
    <h1>
        Simulation + Credit Apply
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Simulation</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                <input id="loan-amount" type="text" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="row">

                                <div class="col-xs-8">
                                    <label for="tenor">Tenor</label>
                                    <select id="tenor" class="form-control">
                                        <option>6 month</option>
                                        <option>12 month</option>
                                        <option>24 month</option>
                                        <option>36 month</option>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <label for="interest-rate">Interest Rate</label>
                                    <input id="interest-rate" type="text" class="form-control" value="2%" disabled/>
                                </div>

                            </div>

                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simulate</button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Apply Credit Simulation</h3>
                </div><!-- /.box-header -->
                <form role="form">
                    <div class="box-body">

                        <!-- text input -->
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" placeholder="Enter ..."/>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group has-error">
                                    <label class="control-label" for="email"><i class="fa fa-times-circle-o"></i> Email must be filled</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="email" class="form-control" placeholder="Enter ..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" >Mobile Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter ..." />
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!--/.col (right) -->
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
                                <th>Date</th>
                                <th>Monthly Payment</th>
                                <th>Principal Debt</th>
                                <th>Interest</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>March 2015</td>
                                <td>IDR 150.000</td>
                                <td>IDR 3.000.000</td>
                                <td>IDR 4.000.000</td>
                                <td>IDR 4.000.000</td>
                            </tr>

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
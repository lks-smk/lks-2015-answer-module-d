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
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form ng-submit="history.view(history.setting)">
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
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="col-xs-3">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" ng-model="history.setting.filter.status">
                                        <option value="">All</option>
                                        <option value="1">Accepted</option>
                                        <option value="0">Rejected</option>
                                    </select>
                                </div>
                                <div class="col-xs-5">
                                    <label>Sort By</label>

                                    <div class="row">
                                        <div class="col-xs-5">
                                            <select class="form-control" ng-model="history.setting.sort.field">
                                                <option value="request_id">Request ID</option>
                                                <option value="monthly_payment">Monthly Payment</option>
                                                <option value="request_date">Request Date</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-5">
                                            <select class="form-control" ng-model="history.setting.sort.direction">
                                                <option value="asc">ASC</option>
                                                <option value="desc">DESC</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">View</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->


        </div>
        <!--/.col (left) -->

    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-md-12">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Loan Simulation</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Request Date</th>
                                <th>Monthly Payment</th>
                                <th>Principal Debt</th>
                                <th>Interest Rate</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in history.histories">
                                <td><a href="#/history/{{ item.requestId  }}">{{ item.requestId  }}</a></td>
                                <td>{{ item.requestDate | date: 'dd/MM/yyyy' }}</td>
                                <td>{{ item.monthlyPayment | currency: 'IDR  ' }}</td>
                                <td>{{ item.loanAmount | currency: 'IDR  ' }}</td>
                                <td>{{ item.interestRate }}%</td>
                                <td>
                                    <span ng-show="item.isApproved==1" class="label label-success">Approved</span>
                                    <span ng-show="item.isApproved==0" class="label label-danger">Rejected</span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
<section class="content-header">
    <h1>
        Dashboard
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-check-circle-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approved</span>
                    <span class="info-box-number">{{ application.stats.approved|number:0 }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-trash"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Rejected</span>
                    <span class="info-box-number">{{ application.stats.rejected|number:0 }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending</span>
                    <span class="info-box-number">{{ application.stats.pending|number:0 }}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pending Requested Credit</h3>
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
                                <th>Rate</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr ng-repeat="item in application.pending">
                                <td>{{ item.requestId }}</td>
                                <td>{{ item.monthlyPayment | currency: 'IDR  ' }}</td>
                                <td>{{ item.loanAmount | currency: 'IDR  ' }}</td>
                                <td>{{ item.interestRate }}%</td>
                                <td align="right">
                                    <div class="btn-group">
                                        <button type="button" ng-click="application.accept(item.requestId)" class="btn btn-success"><i class='fa fa-check-circle-o'></i></button>
                                        <button type="button" ng-click="application.reject(item.requestId)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-4">
            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Approved Credit</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Monthly</th>
                            <th>Debt</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="item in application.top">
                            <td>
                                <a href="#/history/{{ item.requestId  }}">{{ item.requestId  }}</a>
                            </td>
                            <td>{{ item.monthlyPayment | currency: 'IDR  ' }}</td>
                            <td>{{ item.loanAmount | currency: 'IDR  ' }}</td>
                            <td>

                                <span ng-show="item.isApproved==1" class="label label-success">Approved</span>
                                <span ng-show="item.isApproved==0" class="label label-danger">Rejected</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
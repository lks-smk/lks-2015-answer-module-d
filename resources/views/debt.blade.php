<section class="content-header">
    <h1>
        Detail Credit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#/history"><i class="fa fa-dashboard"></i> Transaction History</a></li>
        <li class="active">Detail</li>
    </ol>
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
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="loan-amount">Loan Amount</label>

                            <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                <input id="loan-amount" value="{{credit.loanAmount|number:2}}" type="text"
                                       class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="row">

                                <div class="col-xs-8">
                                    <label for="tenor">Tenor</label>
                                    <input id="tenor" value="{{credit.tenor+' month'}}" type="text" class="form-control"
                                           disabled>
                                </div>
                                <div class="col-xs-4">
                                    <label for="interest-rate">Interest Rate</label>
                                    <input id="interest-rate" type="text" class="form-control" value="2%" disabled/>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->


        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Apply Credit Simulation</h3>
                </div>
                <!-- /.box-header -->
                <form role="form">
                    <div class="box-body">

                        <!-- text input -->
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control" ng-model="credit.fullName" disabled/>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="email" class="form-control" value="{{ credit.email }}"
                                               disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile Phone</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" value="{{ credit.phone }}" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
                                <th>Date</th>
                                <th>Monthly Payment</th>
                                <th>Principal Debt</th>
                                <th>Interest</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in credit.debts">
                                <td>{{ item.paymentDate|date:'MMMM yyyy'  }}</td>
                                <td>{{ item.paymentAmount | currency: 'IDR  ' }}</td>
                                <td>{{ item.principalDebt | currency: 'IDR  ' }}</td>
                                <td>{{ item.interest | currency: 'IDR  ' }}</td>
                                <td>{{ item.balance | currency: 'IDR  ' }}</td>
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

</section><!-- /.content -->
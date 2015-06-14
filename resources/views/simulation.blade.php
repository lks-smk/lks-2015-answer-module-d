<section class="content-header">
    <h1>
        Simulation + Credit Apply
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="alert alert-success alert-dismissable" ng-show="simulation.success">
        <button type="button" class="close" ng-click="simulation.success=false">×</button>
        <h4><i class="icon fa fa-check"></i> Credit has been submitted!</h4>
        We will mail you when your credit has been accepted.
    </div>
    <div class="alert alert-danger alert-dismissable" ng-show="simulation.error">
        <button type="button" class="close" ng-click="simulation.error=false">×</button>
        <h4><i class="icon fa fa-ban"></i> Ops something error!</h4>
        Server request return error
    </div>
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
                <form name="calculatorForm" ng-submit="simulation.calc(simulation.credit)" novalidate>
                    <div class="box-body">
                        <div class="form-group"
                             ng-class="{ 'has-error' : calculatorForm.loanAmount.$invalid && !calculatorForm.loanAmount.$pristine }">
                            <label class="control-label" for="loan-amount">

                                <span ng-show="!calculatorForm.loanAmount.$invalid || calculatorForm.loanAmount.$pristine">
                                    Loan Amount
                                </span>
                                <span ng-show="calculatorForm.loanAmount.$error.required && !calculatorForm.loanAmount.$pristine">
                                    Loan amount required
                                </span>
                                <span ng-show="calculatorForm.loanAmount.$error.min && !calculatorForm.loanAmount.$pristine">
                                    Loan amount minimum 1.000.000
                                </span>
                                <span ng-show="
                                    !calculatorForm.loanAmount.$error.required
                                    && !calculatorForm.loanAmount.$error.min
                                    && calculatorForm.loanAmount.$invalid
                                    && !calculatorForm.loanAmount.$pristine">
                                    Loan amount must be numeric
                                </span>
                            </label>

                            <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                <input ng-disabled="simulation.saving" ng-model="simulation.credit.loanAmount" required
                                       min="1000000" id="loan-amount" name="loanAmount" type="number"
                                       class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="row">

                                <div class="col-xs-8">
                                    <label for="tenor">Tenor</label>
                                    <select ng-disabled="simulation.saving" ng-model="simulation.credit.tenor"
                                            id="tenor" class="form-control">
                                        <option value="6">6 month</option>
                                        <option value="12">12 month</option>
                                        <option value="24">24 month</option>
                                        <option value="36">36 month</option>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <label for="interest-rate">Interest Rate</label>
                                    <input id="interest-rate" type="text" class="form-control" value="2%" disabled/>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" ng-disabled="simulation.saving || calculatorForm.$invalid"
                                class="btn btn-primary">Simulate
                        </button>
                    </div>
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
                <form name="creditForm" ng-submit="simulation.save(simulation.credit)" novalidate>
                    <div class="box-body">

                        <!-- text input -->
                        <div class="form-group"
                             ng-class="{ 'has-error' : creditForm.fullName.$invalid && !creditForm.fullName.$pristine }">
                            <label class="control-label" for="full-name">

                                <span ng-show="!creditForm.fullName.$invalid || creditForm.fullName.$pristine">
                                    Full name
                                </span>
                                <span ng-show="creditForm.fullName.$error.required && !creditForm.fullName.$pristine">
                                    Full name required
                                </span>
                            </label>
                            <input type="text" ng-disabled="simulation.saving || !simulation.simulated"
                                   class="form-control" ng-model="simulation.credit.fullName" id="full-name"
                                   name="fullName" required placeholder="Enter your full name..."/>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group"
                                     ng-class="{ 'has-error' : creditForm.email.$invalid && !creditForm.email.$pristine }">
                                    <label class="control-label" for="email">

                                        <span ng-show="!creditForm.email.$invalid || creditForm.email.$pristine">
                                            Email
                                        </span>
                                        <span ng-show="creditForm.email.$error.required && !creditForm.email.$pristine">
                                            Email required
                                        </span>
                                        <span ng-show="creditForm.email.$error.email && !creditForm.email.$pristine">
                                            Wrong email format
                                        </span>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input ng-disabled="simulation.saving || !simulation.simulated" type="email"
                                               id="email" ng-model="simulation.credit.email" name="email" required
                                               class="form-control" placeholder="e.g name@domain.com"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group" class="form-group"
                                     ng-class="{ 'has-error' : creditForm.phone.$invalid && !creditForm.phone.$pristine }">

                                    <label class="control-label" for="phone">

                                        <span ng-show="!creditForm.phone.$invalid || creditForm.phone.$pristine">
                                            Phone
                                        </span>
                                        <span ng-show="creditForm.phone.$error.required && !creditForm.phone.$pristine">
                                            Phone required
                                        </span>
                                        <span ng-show="!creditForm.phone.$error.required && creditForm.phone.$invalid && !creditForm.phone.$pristine">
                                            Phone minimum 10 and 15 maximum
                                        </span>
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input ng-disabled="simulation.saving || !simulation.simulated" type="text"
                                               ng-model="simulation.credit.phone" name="phone" id="phone" required
                                               ng-pattern="/[0-9]{10,15}/" class="form-control"
                                               placeholder="e.g 081288489954"/>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit"
                                ng-disabled="simulation.saving || !simulation.simulated || creditForm.$invalid"
                                class="btn btn-success">{{ simulation.submitText  }}</button>
                    </div>
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
                            <tr ng-repeat="item in simulation.schedule">
                                <td>{{ item.paymentDate | date: 'MMMM yyyy'  }}</td>
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

</section>
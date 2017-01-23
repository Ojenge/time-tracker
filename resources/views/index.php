<!doctype html>
<html>
<head>
    <title>Time Tracker</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
</head>
<body ng-app="timeTracker" ng-controller="TimeEntry as vm">

<nav class="navbar navbar-default" style="min-height: 180px">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Time Tracker</a>
        </div>
    </div>
    <div class="container-fluid time-entry">
<!--        <div class="timepicker"></div>-->
<!--        <table class="uib-timepicker">-->
<!--            <tbody>-->
<!--            <tr class="text-center" ng-show="::showSpinners">-->
<!--                <td class="uib-increment hours"><a ng-click="incrementHours()" ng-class="{disabled: noIncrementHours()}" class="btn btn-link" ng-disabled="noIncrementHours()" tabindex="-1"><span class="glyphicon glyphicon-chevron-up"></span></a></td>-->
<!--                <td>&nbsp;</td>-->
<!--                <td class="uib-increment minutes"><a ng-click="incrementMinutes()" ng-class="{disabled: noIncrementMinutes()}" class="btn btn-link" ng-disabled="noIncrementMinutes()" tabindex="-1"><span class="glyphicon glyphicon-chevron-up"></span></a></td>-->
<!--                <td class="ng-hide">&nbsp;</td>-->
<!--                <td class="uib-increment seconds ng-hide"><a ng-click="incrementSeconds()" ng-class="{disabled: noIncrementSeconds()}" class="btn btn-link" ng-disabled="noIncrementSeconds()" tabindex="-1"><span class="glyphicon glyphicon-chevron-up"></span></a></td>-->
<!--                <td class=""></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="form-group uib-time hours" ng-class="{'has-error': invalidHours}">-->
<!--                    <input type="text" placeholder="HH" ng-model="hours" ng-change="updateHours()" class="form-control text-center ng-pristine ng-untouched ng-valid ng-valid-hours ng-not-empty ng-valid-maxlength" ng-readonly="::readonlyInput" maxlength="2" tabindex="0" ng-disabled="noIncrementHours()" ng-blur="blur()">-->
<!--                </td>-->
<!--                <td class="uib-separator">:</td>-->
<!--                <td class="form-group uib-time minutes" ng-class="{'has-error': invalidMinutes}">-->
<!--                    <input type="text" placeholder="MM" ng-model="minutes" ng-change="updateMinutes()" class="form-control text-center ng-pristine ng-valid ng-valid-minutes ng-not-empty ng-valid-maxlength ng-touched" ng-readonly="::readonlyInput" maxlength="2" tabindex="0" ng-disabled="noIncrementMinutes()" ng-blur="blur()">-->
<!--                </td>-->
<!--                <td ng-show="showSeconds" class="uib-separator ng-hide">:</td>-->
<!--                <td class="form-group uib-time seconds ng-hide" ng-class="{'has-error': invalidSeconds}" ng-show="showSeconds">-->
<!--                    <input type="text" placeholder="SS" ng-model="seconds" ng-change="updateSeconds()" class="form-control text-center ng-pristine ng-untouched ng-valid ng-valid-seconds ng-not-empty ng-valid-maxlength" ng-readonly="readonlyInput" maxlength="2" tabindex="0" ng-disabled="noIncrementSeconds()" ng-blur="blur()">-->
<!--                </td>-->
<!--                <td ng-show="showMeridian" class="uib-time am-pm"><button type="button" ng-class="{disabled: noToggleMeridian()}" class="btn btn-default text-center ng-binding" ng-click="toggleMeridian()" ng-disabled="noToggleMeridian()" tabindex="0">PM</button></td>-->
<!--            </tr>-->
<!--            <tr class="text-center" ng-show="::showSpinners">-->
<!--                <td class="uib-decrement hours"><a ng-click="decrementHours()" ng-class="{disabled: noDecrementHours()}" class="btn btn-link" ng-disabled="noDecrementHours()" tabindex="-1"><span class="glyphicon glyphicon-chevron-down"></span></a></td>-->
<!--                <td>&nbsp;</td>-->
<!--                <td class="uib-decrement minutes"><a ng-click="decrementMinutes()" ng-class="{disabled: noDecrementMinutes()}" class="btn btn-link" ng-disabled="noDecrementMinutes()" tabindex="-1"><span class="glyphicon glyphicon-chevron-down"></span></a></td>-->
<!--                <td ng-show="showSeconds" class="ng-hide">&nbsp;</td>-->
<!--                <td ng-show="showSeconds" class="uib-decrement seconds ng-hide"><a ng-click="decrementSeconds()" ng-class="{disabled: noDecrementSeconds()}" class="btn btn-link" ng-disabled="noDecrementSeconds()" tabindex="-1"><span class="glyphicon glyphicon-chevron-down"></span></a></td>-->
<!--                <td ng-show="showMeridian" class=""></td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->
<!--        </div>-->
        <div class="timepicker">
            <span class="timepicker-title label label-primary">Clock In</span>
            <timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true">
            </timepicker>
        </div>
        <div class="timepicker">
            <span class="timepicker-title label label-primary">Clock Out</span>
            <timepicker ng-model="vm.clockOut" hour-step="1" minute-step="1" show-meridian="true">
            </timepicker>

        </div>
        <div class="time-entry-comment">
            <form class="navbar-form">
                <select name="user" class="form-control" ng-model="vm.timeEntryUser" ng-options="user.first_name + ' ' + user.last_name for user in vm.users">
                    <option value="">-- Select a user --</option>
                </select>
                <input class="form-control" ng-model="vm.comment" placeholder="Enter a comment"></input>
                <button class="btn btn-primary" ng-click="vm.logNewTime()">Log Time</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <div class="col-sm-8">

        <div class="well vm" ng-repeat="time in vm.timeentries">
            <div class="row">
                <div class="col-sm-8">
                    <h4><i class="glyphicon glyphicon-user"></i> {{time.user.first_name}} {{time.user.last_name}}</h4>
                    <p><i class="glyphicon glyphicon-pencil"></i> {{time.comment}}</p>
                </div>
                <div class="col-sm-4 time-numbers">
                    <h4><i class="glyphicon glyphicon-calendar"></i> {{time.end_time | date:'mediumDate'}}</h4>
                    <h2><span class="label label-primary" ng-show="time.loggedTime.duration._data.hours > 0">{{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span></span></h2>
                    <h4><span class="label label-default">{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-3">
                    <button class="btn btn-primary btn-xs" ng-click="showEditDialog = true">Edit</button>
                    <button class="btn btn-danger btn-xs" ng-click="vm.deleteTimeEntry(time)">Delete</button>
                </div>
            </div>

            <div class="row edit-time-entry" ng-show="showEditDialog === true">
                <h4>Edit Time Entry</h4>
                <div class="time-entry">
                    <div class="timepicker">
                        <span class="timepicker-title label label-primary">Clock In</span><timepicker ng-model="time.start_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
                    </div>
                    <div class="timepicker">
                        <span class="timepicker-title label label-primary">Clock Out</span><timepicker ng-model="time.end_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h5>User</h5>
                    <select name="user" class="form-control" ng-model="time.user" ng-options="user.first_name + ' ' + user.last_name for user in vm.users track by user.id">
                        <option value="user.id"></option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <h5>Comment</h5>
                    <textarea ng-model="time.comment" class="form-control">{{time.comment}}</textarea>
                </div>
                <div class="edit-controls">
                    <button class="btn btn-primary btn-sm" ng-click="vm.updateTimeEntry(time)">Save</button>
                    <button class="btn btn-danger btn-sm" ng-click="showEditDialog = false">Close</button>
                </div>
            </div>

        </div>

    </div>

</body>

<!-- Application Dependencies -->
<script type="text/javascript" src="bower_components/angular/angular.js"></script>
<script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
<script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
<script type="text/javascript" src="bower_components/moment/moment.js"></script>

<!-- Application Scripts -->
<script type="text/javascript" src="scripts/app.js"></script>
<script type="text/javascript" src="scripts/controllers/TimeEntry.js"></script>
<script type="text/javascript" src="scripts/services/time.js"></script>
<script type="text/javascript" src="scripts/services/user.js"></script>
</html>

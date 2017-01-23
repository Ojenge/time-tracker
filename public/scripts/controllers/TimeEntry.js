// main controller for the time entries
(function() {

    'use strict';

    angular
        .module('timeTracker')
        .controller('TimeEntry', TimeEntry);

        function TimeEntry(time, user, $scope) {

            // vm is our capture variable
            var vm = this;

            vm.timeentries = [];
            vm.totalTime = {};
            vm.user = [];

            // Initialize the clockIn and clockOut times to the current time.
            vm.clockIn = moment();
            vm.clockOut = moment();

            //grab all the times saved in the database
            getTimeEntries();


            function getUsers() {
                user.getUsers().then(function(result) {
                    vm.users = result;
                }, function(error) {
                    console.log(error);
                });
            }

            // Fetches the time entries and puts the results
            // on the vm.timeentries array
            function getTimeEntries() {
                time.getTime().then(function(results) {
                    vm.timeentries = results;
                    updateTotalTime(vm.timeentries);
                    //console.log(vm.timeentries);
                }, function(error) {
                    console.log(error);
                });
            }

            // Fetches the time entries from the static JSON file
            //// and puts the results on the vm.timeentries array
            //time.getTime().then(function(results) {
            //    vm.timeentries = results;
            //    updateTotalTime(vm.timeentries);
            //}, function(error) { // Check for errors
            //    console.log(error);
            //});

            // Updates the values in the total time box by calling the
            // getTotalTime method on the time service
            function updateTotalTime(timeentries) {
                vm.totalTime = time.getTotalTime(timeentries);
            }

            // Submit the time entry that will be called
            // when we click the "Log Time" button
            vm.logNewTime = function() {
                // Make sure that the clock-in time isn't after
                // the clock-out time!
                if(vm.clockOut < vm.clockIn) {
                    alert("You can't clock out before you clock in!");
                    return;
                }

                // Make sure the time entry is greater than zero
                if(vm.clockOut - vm.clockIn === 0) {
                    alert("Your time entry has to be greater than zero!");
                    return;
                }

                // Call to the saveTime method on the time service
                // to save the new time entry to the database
                time.saveTime({
                    "user_id":vm.timeEntryUser.id,
                    "start_time":vm.clockIn,
                    "end_time":vm.clockOut,
                    "comment":vm.comment
                }).then(function(success) {
                    getTimeEntries();
                    console.log(success);
                }, function(error) {
                    console.log(error);
                });

                getTimeEntries();

                // Reset clockIn and clockOut times to the current time
                vm.clockIn = moment();
                vm.clockOut = moment();

                // Clear the comment field
                vm.comment = "";

                // Deselect the user
                vm.timeEntryUser = "";

            }
            vm.updateTimeEntry = function(timeentry) {

                // Collect the data that will be passed to the updateTime method
                var updatedTimeEntry = {
                    "id":timeentry.id,
                    "user_id":timeentry.user.id,
                    "start_time":timeentry.start_time,
                    "end_time":timeentry.end_time,
                    "comment":timeentry.comment
                }

                // Update the time entry and then refresh the list
                time.updateTime(updatedTimeEntry).then(function(success) {
                    getTimeEntries();
                    $scope.showEditDialog = false;
                    console.log(success);
                }, function(error) {
                    console.log(error);
                });

            }
            // Specify the time entry to be deleted and pass it to the deleteTime method on the time service
            vm.deleteTimeEntry = function(timeentry) {

                var id = timeentry.id;

                time.deleteTime(id).then(function(success) {
                    getTimeEntries();
                    console.log(success);
                }, function(error) {
                    console.log(error);
                });

            }
        }

})();

(function(){
var app = angular.module('purchaseorder', ['ngSanitize']);
app.controller('TdController', ['$scope','$sce', function($scope, $sce) {
 	$scope.quantity = $sce.trustAsHtml('<input type="text" class="quantity"/>');
   $scope.item = $sce.trustAsHtml('<input type="text" class="item"/>');
   	$scope.desc = $sce.trustAsHtml('<input type="text" class="desc"/>');
   $scope.account = $sce.trustAsHtml('<option>Please Select</option><option>01 - President</option><option>02 - Finance</option><option>03 - Main and Security</option><option>04 - Career Services</option><option>05 - Academic Administration</option><option>06 - Student Financial Services</option><option>07 - Registar and Retention</option><option>08 - Credentials</option><option>09 - IS Administrative Computing</option><option>10 - IS Academic Computing</option><option>13 - Student Activities</option><option>14 - Admissions</option><option>15 - Student Affairs</option><option>18 - Learning Center</option><option>19 - Library</option><option>21 - Business News Media</option><option>22 - Facilities Technologies</option><option>23 - Engineering Information</option><option>24 - Arts & Sciences</option><option>27 - Provost</option><option>28 - Federal Work Study</option><option>29 - Student Workers</option><option>18 - Exec VP and HR</option><option>32 - Health Services</option><option>33 - Institutional Research</option><option>34 - Harlem </option><option>36 - Baccalaureate</option><option>37 - Brooklyn</option><option>45 - EVCI</option>');
   $scope.uPrice = $sce.trustAsHtml('<input type="text" class="uprice"/>');
   $scope.amount = $sce.trustAsHtml('<input type="text" class="amount"/>');
   $scope.aDesc = $sce.trustAsHtml('<option>Please Select</option><option>Academic Dues And Memberships</option><option>Academic Professional Development And Seminars</option><option>Administrative Professional Development And Seminars</option><option>Athletics/Other Costs - Including Stipends</option><option>Building Supplies</option><option>Computer Service/Supplies</option><option>Computer Testing Costs</option><option>DMA Expense (For Web Site, Design)</option><option>Equipment And Building Repair/Maintenance</option><option>Equipment Rentals (Copiers)</option><option>Equipment Rentals (Other)</option><option>Grad/Job Expo/Alumni Expo</option><option>Instructional Supplies</option><option>License/Permits/Membership Fees</option><option>Miscellaneous</option><option>Moving Expense</option><option>Open House Costs</option><option>Ophthalmic Expenses</option><option>Postage</option><option>Printing</option><option>Rent Expense</option><option>Software Licensing</option><option>Student Inoculations</option><option>Student Orientation Costs/Student Activity Fees</option><option>Supplies</option><option>Telephone</option><option>Testing (Admissions)</option><option>Textbooks</option><option>Travel and Entertainment</option><option>Utilities</option><option>Electronics Lab Equipment</option><option>Network Equipment</option><option>Computer Parts</option>');
}]);
})();



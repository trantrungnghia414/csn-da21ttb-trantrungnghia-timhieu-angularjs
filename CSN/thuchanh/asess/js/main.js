var app = angular.module("productApp", []);

app.controller("ProductController", async function ($scope, $http) {
    $http.get("http://localhost/csn/thuchanh/php/laydulieu.php").then((res) => {
        console.log(res);
        $scope.phones = res.data;
    });

    $http.get("http://localhost/csn/thuchanh/php/laydshang.php").then((res) => {
        console.log(res);
        $scope.dshang = res.data;
    });
});


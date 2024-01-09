var app = angular.module("productApp", []);

app.controller("ProductController", async function ($scope, $http) {
    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    const productId = searchParams.get("id");

    $http.get("http://localhost/csn/thuchanh/php/laydshang.php").then((res) => {
        // console.log(res);
        $scope.dshang = res.data;
        $scope.hangdangchon = $scope.dshang.find(
            (hang) => hang.id == productId
        );

        console.log($scope.hangdangchon);
    });

    $http
        .get(
            "http://localhost/csn/thuchanh/php/hienthitheohang.php?id=" +
                productId
        )
        .then((res) => {
            console.log(res);
            $scope.products = res.data;
        });
});

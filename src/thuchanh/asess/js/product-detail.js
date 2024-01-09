var app = angular.module("productApp", []);

app.controller("ProductController", async function ($scope, $http, $sce) {
    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    const productId = searchParams.get("id");

    $http.get("http://localhost/csn/thuchanh/php/laydulieu.php").then((res) => {
        // console.log(res);
        $scope.dienthoai = res.data;
        $scope.dienthoaidangchon = $scope.dienthoai.find(
            (dienthoai) => dienthoai.id == productId
        );

        $scope.htmlContent = $sce.trustAsHtml(
            $scope.dienthoaidangchon.thongsokythuat
        );

        $http
            .get("http://localhost/csn/thuchanh/php/laydshang.php")
            .then((res) => {
                // console.log(res);
                $scope.dshang = res.data;
                $scope.hangdangchon = $scope.dshang.find(
                    (hang) => hang.id == $scope.dienthoaidangchon.thuonghieu_id
                );
            });
    });
});

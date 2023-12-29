var app = angular.module("productApp", []);

app.controller("ProductController", function ($scope, $http) {
    $http.get("http://localhost/csn/thuchanh/php/laydshang.php").then((res) => {
        console.log(res);
        $scope.dshang = res.data;
        $scope.hangdangchon = $scope.dshang.find(
            (hang) => hang.id == productId
        );
    });

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    const key = searchParams.get("key");

    if (!key) {
        window.location.href = "index.html?message=Hãy nhập nội dung tìm kiếm";
    }

    $http.get(`http://localhost/csn/thuchanh/php/timkiem.php?key=${key}`).then(
        function (response) {
            console.log(response);
            // Lấy dữ liệu lọc được từ server
            $scope.products = response.data;
            if (response.data.length == 0) {
                window.location.href =
                    "index.html?message=Không có sản phẩm trong cửa hàng";
            }

            // In ra console để kiểm tra
            console.log("$scope.filteredPhones:", $scope.filteredPhones);
        },
        function (error) {
            // Xử lý lỗi khi gửi yêu cầu
            console.error("Error:", error);
        }
    );
});

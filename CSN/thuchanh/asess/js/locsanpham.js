var app = angular.module("productApp", []);

function chuuyenSoThanhTien(number) {
    const suffixes = ["", " ngàn", " triệu", " tỉ"]; // Tiền tố số
    let index = 0;

    while (number >= 1000) {
        number /= 1000;
        index++;
    }

    return Math.round(number, 2) + suffixes[index];
}

app.controller("LocsanphamController", function ($scope, $http) {
    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    const min = searchParams.get("min");
    const max = searchParams.get("max");

    if (min == 0) {
        $scope.breadcrumbGia = "Dưới " + chuuyenSoThanhTien(max);
    } else if (max == 999999999) {
        $scope.breadcrumbGia = "Trên " + chuuyenSoThanhTien(min);
    } else {
        $scope.breadcrumbGia =
            "Từ " + chuuyenSoThanhTien(min) + " - " + chuuyenSoThanhTien(max);
    }

    $http.get("http://localhost/csn/thuchanh/php/laydshang.php").then((res) => {
        console.log(res);
        $scope.dshang = res.data;
    });

    $http
        .get(
            `http://localhost/csn/thuchanh/php/locsanpham.php?giaMin=${min}&giaMax=${max}`
        )
        .then(
            function (response) {
                console.log(response);
                // Lấy dữ liệu lọc được từ server
                $scope.filteredPhones = response.data;

                console.log("$scope.filteredPhones:", $scope.filteredPhones);
            },
            function (error) {
                // Xử lý lỗi khi gửi yêu cầu
                console.error("Error:", error);
            }
        );
});

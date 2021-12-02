<?php
require_once ("../db-connect.php");
$sqlTotal="SELECT * FROM products WHERE valid=1";
$resultTotal=$conn->query($sqlTotal);
$totalProductCount=$resultTotal->num_rows; //總共筆數

$sqlCategory="SELECT * FROM category";
$resultCategory=$conn->query($sqlCategory);
$categoryArr=[];
while($row=$resultCategory->fetch_assoc()){
    $categoryArr[$row["id"]]=$row["name"];
}

if(isset($_GET["minPrice"]) && isset($_GET["maxPrice"])){
    $minPrice=$_GET["minPrice"];
    $maxPrice=$_GET["maxPrice"];
    if($maxPrice==="")$maxPrice=9999;
    $sql="SELECT * FROM products WHERE price >= '$minPrice' AND price <= '$maxPrice' AND valid=1";
}else if(isset($_GET["order"])){
    $order=$_GET["order"];
    if($order==="nameDesc"){
        $sql="SELECT * FROM products WHERE valid=1 ORDER BY name DESC";
    }else if($order==="nameAsc"){
        $sql="SELECT * FROM products WHERE valid=1 ORDER BY name ASC";
    }
    else if($order==="priceAsc"){
        $sql="SELECT * FROM products WHERE valid=1 ORDER BY price ASC";
    }
    else if($order==="priceDesc"){
        $sql="SELECT * FROM products WHERE valid=1 ORDER BY price DESC";
    }
}else if(isset($_GET["s"])){
    $search=$_GET["s"];
    $sql="SELECT * FROM products WHERE name LIKE '%$search%'";
}else if(isset($_GET["cate"])){
    $cate=$_GET["cate"];
    $sql="SELECT * FROM products WHERE category_id = '$cate'";

}else{
    $minPrice=0;
    $maxPrice=9999;
    if(isset($_GET["p"])){
        $p=$_GET["p"];
    }else{
        $p=1;
    }
    $pageItems=6;
    $startItem=($p-1)*$pageItems;
    $pageCount=$totalProductCount/$pageItems; //頁數
    $pageR=$totalProductCount%$pageItems;
    $startNo=($p-1)*$pageItems+1;
    $endNo=$p*$pageItems;
    if($pageR!=0){
        $pageCount=ceil($pageCount); //如果餘數不為0,則無條件進位
        if($pageCount==$p){
            $endNo=$endNo-($pageItems-$pageR);
        }
    }
    $sql="SELECT * FROM products WHERE valid=1 ORDER BY id LIMIT $startItem, $pageItems";
}


$result=$conn->query($sql);
$productCount=$result->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
    <title>Product list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("css.php") ?>
</head>
<body>
<?php require_once ("header.php"); ?>
<div class="container">
    <div class="row">
        <aside class="col-lg-3">
            <div class="sticky-top">
                <div class="mb-2">
                    <a role="button" class="btn btn-primary" href="product-list.php">回列表</a>
                </div>
                <div class="mb-2">
                    <h3>產品分類</h3>
                    <ul class="list-unstyled category-list">
                        <?php foreach ($categoryArr as $key => $value): ?>
                            <li class="<?php if(isset($cate) && $key==$cate)echo "active" ?>"><a href="product-list.php?cate=<?=$key?>"><?=$value?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-2">
                    <label for="">價錢篩選</label>
                    <form action="product-list.php" method="get">
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control me-2 text-end" name="minPrice" value="<?=$minPrice?>">
                            <div class="me-2">~</div>
                            <input type="number" class="form-control me-2 text-end" name="maxPrice" value="<?=$maxPrice?>">
                            <button type="submit" class="btn btn-primary text-nowrap">篩選</button>
                        </div>
                    </form>
                </div>
                <div class="mb-2">
                    <label for="">搜尋</label>
                    <form action="product-list.php" method="get">
                        <div class="d-flex align-items-center">
                            <input type="search" class="form-control me-2" name="s" value="<?php if(isset($search))echo $search; ?>">
                            <button type="submit" class="btn btn-primary text-nowrap">搜尋</button>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
        <main class="col-lg-9">
            <?php if($productCount>0): ?>
                <div class="py-2 d-flex justify-content-end order-block">
                    <div>排序
                        <a class="<?php if(isset($order) && $order==="nameDesc")echo "active" ?>" href="product-list.php?order=nameDesc">名稱 ↓</a>
                        <a class="<?php if(isset($order) && $order==="nameAsc")echo "active" ?>" href="product-list.php?order=nameAsc">名稱 ↑</a>
                        <a class="<?php if(isset($order) && $order==="priceDesc")echo "active" ?>" href="product-list.php?order=priceDesc">價錢 ↓</a>
                        <a class="<?php if(isset($order) && $order==="priceAsc")echo "active" ?>" href="product-list.php?order=priceAsc">價錢 ↑</a>
                    </div>
                </div><!--order-block-->
                <?php if(isset($p)): ?>
                    <div class="py-2">第 <?=$startNo?>~<?=$endNo?> 筆, 共 <?=$totalProductCount?> 筆</div>
                <?php else: ?>
                    <div class="py-2">共 <?=$productCount?> 筆</div>
                <?php endif; ?>
                <div class="row product-list">
                    <?php while($row=$result->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4 mb-3">

                            <div class="card">
                                <a href="product.php?id=<?=$row["id"]?>">
                                    <figure class="m-0 ratio ratio-4x3">
                                        <div>
                                            <img class="cover-fit" src="images/<?=$row["img"]?>" alt="<?=$row["name"]?>">
                                        </div>
                                    </figure>
                                </a>
                                <div class="py-2 px-3">
                                    <div class="pb-2">
                                        <a class="badge bg-info text-white" href="product-list.php?cate=<?=$row["category_id"]?>"><?=$categoryArr[$row["category_id"]]?></a>
                                    </div>
                                    <h3 class="" title="<?=$row["name"]?>"><a href="product.php?id=<?=$row["id"]?>"><?=$row["name"]?></a></h3>
                                    <div>$<?=$row["price"]?></div>
                                </div>
                            </div><!--card-->

                        </div>
                    <?php endwhile; ?>
                    <?php if(isset($p)): ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <?php for($i=1; $i<=$pageCount; $i++): ?>
                                    <li class="page-item <?php if($p==$i)echo "active" ?>"><a class="page-link" href="product-list.php?p=<?=$i?>"><?=$i?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                沒有資料
            <?php endif; ?>
        </main>
    </div>

</div>

</body>
</html>
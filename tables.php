<!-- 表格區塊 含user-list.php的php語法 -->
<div class="card-body">
    <table id="datatablesSimple">
        <!-- 標題欄 -->
        <thead>
        <tr>
            <!-- 表格註腳 thead -->
            <th>全選</th>
            <th>訂單編號</th>
            <th>訂單日期</th>
            <th>客戶姓名</th>
            <th>付款狀態</th>
            <th>出貨狀態</th>
            <th>總金額</th>
        </tr>
        </thead>
        <!-- 總結資訊 tfoot -->
        <tfoot>
        <tr>
            <th>全選</th>
            <th>訂單編號</th>
            <th>訂單日期</th>
            <th>客戶姓名</th>
            <th>付款狀態</th>
            <th>出貨狀態</th>
            <th>總金額</th>
        </tr>
        </tfoot>
        <!-- 資料欄 tbody -->
        <tbody>
        <?php if($orderCount>0):
            foreach ($rowOrderList as $value):
                ?>
                <tr>
                    <td><a href="order-detail.php?id=<?=$value["id"]?>"><?=$value["id"]?></a></td>
                    <td><?=$value["order_time"]?></td>
                    <td><?=$value["status"]?></td>
                </tr>
            <?php
            endforeach;
        else: ?>
            <tr>
                <td colspan="3">尚未有訂單</td>
            </tr>

        <?php endif; ?>
        </tbody>
    </table>
</div><!-- 表格區塊 end -->




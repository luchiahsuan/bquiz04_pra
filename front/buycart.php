<?php
if (isset($_GET['id'])) {
    $_SESSION['cart'][$_GET['id']] = $_GET['qt'];
}

if (isset($_SESSION['mem'])) {
} else {
    to("index.php?do=login");
}

// dd($_SESSION['cart']);
?>
<h2 class="ct"><?= $_SESSION['mem']; ?>的購物車</h2>
<?php
if (!isset($_SESSION['cart'])) {
    echo "<h2 class='ct'> 目前購物車沒有商品 </h2>";
} else {
?>
    <table class="all">
        <tr class="tt ct">
            <td class="pp">編號</td>
            <td class="pp">商品名稱</td>
            <td class="pp">數量</td>
            <td class="pp">庫存量</td>
            <td class="pp">單價</td>
            <td class="pp">小計</td>
            <td class="pp">刪除</td>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $id => $qt) {
            $row = $Goods->find($id);
        ?>
            <tr class="pp">
                <td class="pp"><?= $row['no']; ?></td>
                <td class="pp"><?= $row['name']; ?></td>
                <td class="pp"><?= $qt; ?></td>
                <td class="pp"><?= $row['stock']; ?></td>
                <td class="pp"><?= $row['price']; ?></td>
                <td class="pp"><?= $row['price'] * $qt; ?></td>
                <td class="pp">
                    <img src="./icon/0415.jpg" onclick="removeItem(<?=$row['id'];?>)">
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <img src="./icon/0411.jpg" onclick="location.href='index.php'">
        <img src="./icon/0412.jpg" onclick="location.href='?do=order'">
    </div>
<?php
}
?>

<script>
function removeItem(id,dom){
    $.post("./api/remove_item.php",{id},()=>{
        // location.href="?do=buycart";
        $(dom).parents('tr').remove()
        history.pushState(null,null,'?do=buycart')
    })
}

</script>
<?php
/**
 * Created by PhpStorm.
 * User: HP 840 G3
 * Date: 3/12/2018
 * Time: 12:42 AM
 */
?>
<script>
    alert("Xuất file thành công.");
    window.location.href = "?sk=orders&m=index&type="+ <?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>;
</script>

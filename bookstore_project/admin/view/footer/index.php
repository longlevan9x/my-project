<?php
/**
 * Created by PhpStorm.
 * User: HP 840 G3
 * Date: 3/12/2018
 * Time: 12:50 AM
 */
?>
<div class="content-wrapper right_col">

    <div class="row">
        <h2 class="text-center">Cập nhật footer</h2>
    </div>
    <div class=" col-md-6 style="">
        <form action="?sk=footer&m=update" id="form-order" method="post" accept-charset="utf-8">
            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Nội dung:</label>
                <div class="col-sm-6">
                        <textarea name="meta_value" class="form-control" id="" cols="30" rows="10"><?= $data['meta_value'];?></textarea>
                </div>
                <div class=" search col-sm-2" style="">
                    <button type="submit" name="btnSubmit" class="btn btn-primary pull-right">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
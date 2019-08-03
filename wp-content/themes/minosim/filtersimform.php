<form id="form-loc-sim" role="search" method="get" class="loc-sim-form" action="">
    <div class="row">
        <?php
            $class = (get_post_meta(get_the_ID(), 'nhamang', true)
                || get_post_meta(get_the_ID(), 'giatu', true)
                || get_post_meta(get_the_ID(), 'giaden', true))
                ? 'col-md-6' 
                : 'col-md-4';
        ?>
        <?php if (!get_post_meta(get_the_ID(), 'nhamang', true)):?>
            <div class="<?=$class?> pr-md-1 mb-1 mb-md-0">
                <select class="form-control" name="nhamang">
                    <option value="">Tất các mạng</option>
                    <option value="viettel"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'viettel'): echo ' selected'; endif;?>>Viettel</option>
                    <option value="vinaphone"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'vinaphone'): echo ' selected'; endif;?>>Vinaphone</option>
                    <option value="mobifone"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'mobifone'): echo ' selected'; endif;?>>Mobifone</option>
                    <option value="vietnamobile"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'vietnamobile'): echo ' selected'; endif;?>>Vietnamobile</option>
                    <option value="gmobile"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'gmobile'): echo ' selected'; endif;?>>Gmobile</option>
                    <option value="itelecom"<?php if (isset($_GET['nhamang']) && $_GET['nhamang'] == 'itelecom'): echo ' selected'; endif;?>>iTelecom</option>
                </select>
            </div>
        <?php endif;?>
        <?php if (!get_post_meta(get_the_ID(), 'giatu', true) && !get_post_meta(get_the_ID(), 'giaden', true)):?>
            <div class="<?=$class?> <?php if (get_post_meta(get_the_ID(), 'nhamang', true)):?>pr-md-1<?php else: ?>px-md-1<?php endif?> mb-1 mb-md-0">
                <select class="form-control" id="gia">
                    <option value="">Tất cả mức giá</option>
                    <option value=",1000000"<?php if (isset($_GET['giaden']) && $_GET['giaden'] == '1000000'): echo ' selected'; endif;?>>Dưới 1 triệu</option>
                    <option value="1000000,3000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '1000000' && $_GET['giaden'] == '3000000'): echo ' selected'; endif;?>>1 - 3 triệu</option>
                    <option value="3000000,5000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '3000000' && $_GET['giaden'] == '5000000'): echo ' selected'; endif;?>>3 - 5 triệu</option>
                    <option value="5000000,10000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '5000000' && $_GET['giaden'] == '10000000'): echo ' selected'; endif;?>>5 - 10 triệu</option>
                    <option value="10000000,20000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '10000000' && $_GET['giaden'] == '20000000'): echo ' selected'; endif;?>>10 - 20 triệu</option>
                    <option value="20000000,50000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '20000000' && $_GET['giaden'] == '50000000'): echo ' selected'; endif;?>>20 - 50 triệu</option>
                    <option value="50000000,100000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '50000000' && $_GET['giaden'] == '100000000'): echo ' selected'; endif;?>>50 - 100 triệu</option>
                    <option value="100000000,200000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '100000000' && $_GET['giaden'] == '200000000'): echo ' selected'; endif;?>>100 - 200 triệu</option>
                    <option value="200000000,500000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '200000000' && $_GET['giaden'] == '500000000'): echo ' selected'; endif;?>>200 - 500 triệu</option>
                    <option value="500000000,1000000000"<?php if (isset($_GET['giatu']) && isset($_GET['giaden']) && $_GET['giatu'] == '500000000' && $_GET['giaden'] == '1000000000'): echo ' selected'; endif;?>>500 triệu - 1 tỷ</option>
                    <option value="1000000000,"<?php if (isset($_GET['giatu']) && $_GET['giatu'] == '1000000000'): echo ' selected'; endif;?>>Trên 1 tỷ</option>
                </select>
            </div>
        <?php endif;?>
        <div class="<?=$class?> pl-md-1">
            <select class="form-control" name="sapxep">
                <option value="">Sắp xếp ngẫu nhiên</option>
                <option value="1"<?php if (isset($_GET['sapxep']) && $_GET['sapxep'] == 1): echo ' selected'; endif;?>>Giá thấp đến cao</option>
                <option value="2" <?php if (isset($_GET['sapxep']) && $_GET['sapxep'] == 2): echo ' selected'; endif;?>>Giá cao đến thấp</option>
            </select>
        </div>
    </div>
</form>
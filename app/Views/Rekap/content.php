<?php $currentDay = date('d'); ?>
<?php $currentMonth = date('m'); ?>
<?php $currentYear = date('Y'); ?>

<?php
$modal = 0;
foreach ($data as $s) {
    if ($s['stok'] > 0) {
        $modal += ($s['stok'] * $s['harga']);
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <form action="<?= $this->BASE_URL ?>Rekap/profit" method="post">
            <div class="row">
                <div class="col-auto pr-0">
                    <label>Date</label>
                    <select name="d" class="form-control form-control-sm" style="width: auto;">
                        <option class="text-right" value="01" <?php if ($currentDay == '01') {
                                                                    echo 'selected';
                                                                } ?>>01</option>
                        <option class="text-right" value="02" <?php if ($currentDay == '02') {
                                                                    echo 'selected';
                                                                } ?>>02</option>
                        <option class="text-right" value="03" <?php if ($currentDay == '03') {
                                                                    echo 'selected';
                                                                } ?>>03</option>
                        <option class="text-right" value="04" <?php if ($currentDay == '04') {
                                                                    echo 'selected';
                                                                } ?>>04</option>
                        <option class="text-right" value="05" <?php if ($currentDay == '05') {
                                                                    echo 'selected';
                                                                } ?>>05</option>
                        <option class="text-right" value="06" <?php if ($currentDay == '06') {
                                                                    echo 'selected';
                                                                } ?>>06</option>
                        <option class="text-right" value="07" <?php if ($currentDay == '07') {
                                                                    echo 'selected';
                                                                } ?>>07</option>
                        <option class="text-right" value="08" <?php if ($currentDay == '08') {
                                                                    echo 'selected';
                                                                } ?>>08</option>
                        <option class="text-right" value="09" <?php if ($currentDay == '09') {
                                                                    echo 'selected';
                                                                } ?>>09</option>
                        <option class="text-right" value="10" <?php if ($currentDay == '10') {
                                                                    echo 'selected';
                                                                } ?>>10</option>
                        <option class="text-right" value="11" <?php if ($currentDay == '11') {
                                                                    echo 'selected';
                                                                } ?>>11</option>
                        <option class="text-right" value="12" <?php if ($currentDay == '12') {
                                                                    echo 'selected';
                                                                } ?>>12</option>
                        <option class="text-right" value="13" <?php if ($currentDay == '13') {
                                                                    echo 'selected';
                                                                } ?>>13</option>
                        <option class="text-right" value="14" <?php if ($currentDay == '14') {
                                                                    echo 'selected';
                                                                } ?>>14</option>
                        <option class="text-right" value="15" <?php if ($currentDay == '15') {
                                                                    echo 'selected';
                                                                } ?>>15</option>
                        <option class="text-right" value="16" <?php if ($currentDay == '16') {
                                                                    echo 'selected';
                                                                } ?>>16</option>
                        <option class="text-right" value="17" <?php if ($currentDay == '17') {
                                                                    echo 'selected';
                                                                } ?>>17</option>
                        <option class="text-right" value="18" <?php if ($currentDay == '18') {
                                                                    echo 'selected';
                                                                } ?>>18</option>
                        <option class="text-right" value="19" <?php if ($currentDay == '19') {
                                                                    echo 'selected';
                                                                } ?>>19</option>
                        <option class="text-right" value="20" <?php if ($currentDay == '20') {
                                                                    echo 'selected';
                                                                } ?>>20</option>
                        <option class="text-right" value="21" <?php if ($currentDay == '21') {
                                                                    echo 'selected';
                                                                } ?>>21</option>
                        <option class="text-right" value="22" <?php if ($currentDay == '22') {
                                                                    echo 'selected';
                                                                } ?>>22</option>
                        <option class="text-right" value="23" <?php if ($currentDay == '23') {
                                                                    echo 'selected';
                                                                } ?>>23</option>
                        <option class="text-right" value="24" <?php if ($currentDay == '24') {
                                                                    echo 'selected';
                                                                } ?>>24</option>
                        <option class="text-right" value="25" <?php if ($currentDay == '25') {
                                                                    echo 'selected';
                                                                } ?>>25</option>
                        <option class="text-right" value="26" <?php if ($currentDay == '26') {
                                                                    echo 'selected';
                                                                } ?>>26</option>
                        <option class="text-right" value="27" <?php if ($currentDay == '27') {
                                                                    echo 'selected';
                                                                } ?>>27</option>
                        <option class="text-right" value="28" <?php if ($currentDay == '28') {
                                                                    echo 'selected';
                                                                } ?>>28</option>
                        <option class="text-right" value="29" <?php if ($currentDay == '29') {
                                                                    echo 'selected';
                                                                } ?>>29</option>
                        <option class="text-right" value="30" <?php if ($currentDay == '30') {
                                                                    echo 'selected';
                                                                } ?>>30</option>
                        <option class="text-right" value="31" <?php if ($currentDay == '31') {
                                                                    echo 'selected';
                                                                } ?>>31</option>
                    </select>
                </div>
                <div class="col-auto pr-0 pl-1">
                    <label>Month</label>
                    <select name="m" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                        <option class="text-right" value="01" <?php if ($currentMonth == '01') {
                                                                    echo 'selected';
                                                                } ?>>01</option>
                        <option class="text-right" value="02" <?php if ($currentMonth == '02') {
                                                                    echo 'selected';
                                                                } ?>>02</option>
                        <option class="text-right" value="03" <?php if ($currentMonth == '03') {
                                                                    echo 'selected';
                                                                } ?>>03</option>
                        <option class="text-right" value="04" <?php if ($currentMonth == '04') {
                                                                    echo 'selected';
                                                                } ?>>04</option>
                        <option class="text-right" value="05" <?php if ($currentMonth == '05') {
                                                                    echo 'selected';
                                                                } ?>>05</option>
                        <option class="text-right" value="06" <?php if ($currentMonth == '06') {
                                                                    echo 'selected';
                                                                } ?>>06</option>
                        <option class="text-right" value="07" <?php if ($currentMonth == '07') {
                                                                    echo 'selected';
                                                                } ?>>07</option>
                        <option class="text-right" value="08" <?php if ($currentMonth == '08') {
                                                                    echo 'selected';
                                                                } ?>>08</option>
                        <option class="text-right" value="09" <?php if ($currentMonth == '09') {
                                                                    echo 'selected';
                                                                } ?>>09</option>
                        <option class="text-right" value="10" <?php if ($currentMonth == '10') {
                                                                    echo 'selected';
                                                                } ?>>10</option>
                        <option class="text-right" value="11" <?php if ($currentMonth == '11') {
                                                                    echo 'selected';
                                                                } ?>>11</option>
                        <option class="text-right" value="12" <?php if ($currentMonth == '12') {
                                                                    echo 'selected';
                                                                } ?>>12</option>
                    </select>
                </div>
                <div class="col-auto pr-0 pl-1">
                    <label>Year</label>
                    <select name="y" class="form-control form-control-sm" onchange="hideAll()" style="width: auto;">
                        <?php

                        $yearStart = 2022;
                        while ($yearStart <= $currentYear) { ?>
                            <option class="text-right" value="<?= $yearStart ?>" <?php if ($currentYear == $yearStart) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $yearStart ?></option>
                        <?php $yearStart++;
                        }
                        ?>
                    </select>
                </div>
                <div class="col pr-0 pl-1 mr-auto">
                    <button type="submit" class="btn btn-sm btn-primary position-absolute" style="bottom:0">Cek</button>
                </div>
                <div class="col">
                    <span class="float-right"> <label class="float-right">Modal</label><br><b>Rp<?= number_format($modal) ?></b></span>
                </div>
        </form>
    </div>
</div>

<hr>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-auto mr-auto">

            </div>
        </div>
    </div>
</div>
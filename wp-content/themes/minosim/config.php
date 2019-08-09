<?php
define("S1","MID(post_name,-1,1)");
define("S2","MID(post_name,-2,1)");
define("S3","MID(post_name,-3,1)");
define("S4","MID(post_name,-4,1)");
define("S5","MID(post_name,-5,1)");
define("S6","MID(post_name,-6,1)");
define("S7","MID(post_name,-7,1)");
define("S8","MID(post_name,-8,1)");
define("S9","MID(post_name,-9,1)");

define("S22","MID(post_name,-2,2)");
define("S32","MID(post_name,-3,2)");
define("S42","MID(post_name,-4,2)");
define("S52","MID(post_name,-5,2)");
define("S62","MID(post_name,-6,2)");
define("S72","MID(post_name,-7,2)");
define("S82","MID(post_name,-8,2)");
define("S92","MID(post_name,-9,2)");

define("S33","MID(post_name,-3,3)");
define("S43","MID(post_name,-4,3)");
define("S53","MID(post_name,-5,3)");
define("S63","MID(post_name,-6,3)");
define("S73","MID(post_name,-7,3)");
define("S83","MID(post_name,-8,3)");
define("S93","MID(post_name,-9,3)");

define("S44","MID(post_name,-4,4)");
define("S54","MID(post_name,-5,4)");
define("S64","MID(post_name,-6,4)");
define("S74","MID(post_name,-7,4)");
define("S84","MID(post_name,-8,4)");
define("S94","MID(post_name,-9,4)");

define("R1","RIGHT(post_name,1)");
define("R2","RIGHT(post_name,2)");
define("R3","RIGHT(post_name,3)");
define("R4","RIGHT(post_name,4)");
define("R5","RIGHT(post_name,5)");
define("R6","RIGHT(post_name,6)");
define("R7","RIGHT(post_name,7)");
define("R8","RIGHT(post_name,8)");
define("R9","RIGHT(post_name,9)");
define("R10","RIGHT(post_name,10)");
define("L1","LEFT(post_name,1)");
define("L2","LEFT(post_name,2)");
define("L3","LEFT(post_name,3)");
define("L4","LEFT(post_name,4)");
define("L5","LEFT(post_name,5)");
define("L6","LEFT(post_name,6)");
define("L7","LEFT(post_name,7)");
define("L8","LEFT(post_name,8)");
define("L9","LEFT(post_name,9)");


$sub="MID(post_name";

//------------------------------------------------------------//
$loaiSim = array();

// 1. Đặc biệt
$loaiSim['sim-dac-biet']=R4." IN('1102','1368','4078','8910','8386','8683') || ".R6." IN('049053','151618')";

// 2. Lục Quý
$loaiSim['sim-luc-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) = ".$sub.",-5,1)", $sub.",-5,1) = ".$sub.",-6,1)");

// 3. Ngũ Quý
$loaiSim['sim-ngu-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) = ".$sub.",-5,1)", $sub.",-5,1) != ".$sub.",-6,1)");

// 4. Tứ Quý
$loaiSim['sim-tu-quy']=array($sub.",-1,1) = ".$sub.",-2,1)", $sub.",-3,1) =".$sub.",-4,1)", $sub.",-2,1) = ".$sub.",-3,1)", $sub.",-4,1) != ".$sub.",-5,1)");

// 5. Tam Hoa Đơn
$loaiSim['tam-hoa-don']=S1."=".S2." and ".S2."=".S3." AND ".S3."!=".S4." AND (".S6."!=".S5." || ".S6."!=".S4.")";

// 6. Tam Hoa kép
$loaiSim['tam-hoa-kep']=array($sub.",-4,1)!=".$sub.",-3,1)",$sub.",-6,2)=".$sub.",-5,2)",$sub.",-3,2)=".$sub.",-2,2)");

// 7. Taxi lặp 2
$loaiSim['sim-taxi-hai']=S62."=".S42." AND ".S62."=".S22." AND ".S6."!=".S5;

// 8. Taxi lap 3 No Sup
$loaiSim['sim-taxi-ba']="(".S6."!=".S5." || ".S6."!=".S4.") AND ".S63."=".S33;

// 9. Taxi lap 4 No Sup
$loaiSim['sim-taxi-bon']=array($sub.",-4,4)=".$sub.",-8,4)","(".$sub.",-1,1)!=".$sub.",-2,1) || ".$sub.",-1,1)!=".$sub.",-3,1) || ".$sub.",-1,1)!=".$sub.",-4,1))",$sub.",-2,2)!=".$sub.",-4,2)");

// 10. Số kép
$loaiSim['sim-kep']=S4."=".S3." AND ".S4."!=".S2." AND ".S2."=".S1;

// 11. Số lặp
$loaiSim['sim-lap']=array($sub.",-1,1) = ".$sub.",-3,1)",$sub.",-2,1) = ".$sub.",-4,1)",$sub.",-1,1)!=".$sub.",-2,1)",$sub.",-4,2) != ".$sub.",-6,2)");

// 12.Sim dao
$loaiSim['sim-dao']=array($sub.",-1,1)!=".$sub.",-2,1)",$sub.",-4,1)=".$sub.",-1,1)",$sub.",-2,1)=".$sub.",-3,1)");

 //13. Sim doi
 $loaiSim['sim-doi']="(".S6."!=".S5." AND ".S6."!=".S4." AND ".S5."!=".S4." AND ".S6."=".S1." AND ".S5."=".S2." AND ".S4."=".S3.")";

 // 14 .sim tien don
$loaiSim['sim-tien-don']="(".S1."-1 =".S2." AND ".S2." -1 =".S3." AND ".S3." -1 != ".S4.") || (".S1." -1 =".S2." AND ".S2." -1 =".S3." AND ".S3." -1 =".S4." AND ".S4." -1 !=".S5.") || (".S1." -1 =".S2." AND ".S2." -1 =".S3." AND ".S3." -1 =".S4." AND ".S4." -1 =".S5.")";

// 15 .Tien doi
$loaiSim['sim-tien-doi']="((".S5."=".S3." AND ".S3."=".S1.") || (".S6."=".S4." AND ".S4."=".S2.")) AND (".S22." > ".S42." AND ".S42." > ".S62." AND ".S1."!=".S2.")";

// 16. Sim lộc phát
$loaiSim['sim-loc-phat']=array($sub.",-2,2) = 68 OR ".$sub.",-2,2 = 86)");

// 17. Sim Thần tài
$loaiSim['sim-than-tai']=array($sub.",-2,2) = 39 OR ".$sub.",-2,2) = 79");

// 18 Sim ông địa
$loaiSim['sim-ong-dia']=$sub.",-2,2) IN('78','38')";

// 19. Số gánh
$loaiSim['sim-ganh']="(".S1."=".S3." AND ".S1."!=".S2." AND ".S33."!=".S63." AND ".S73."!=".S33." AND ".S22."!=".S42." AND ".S5."!=".S3.")";

// 20. Sim năm sinh
$loaiSim['sim-nam-sinh']=array($sub.",-4,4) > ".(date('Y')-50),$sub.",-4,4) < ".date('Y'));

// 21. Sim đầu số cổ
$loaiSim['dau-so-co']="(left(post_name,3) IN(091,090,098,097))";

// Nhà mạng
$nhaMang = array();

$nhaMang['viettel'] = "(LEFT(`post_name`,3) IN ('086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039'))";

$nhaMang['mobifone'] = "(LEFT(`post_name`,3) IN ('089', '090', '093', '070', '079', '077', '076', '078'))";

$nhaMang['vinaphone'] = "(LEFT(`post_name`,3) IN ('091', '094', '083', '084', '085', '081', '082', '088'))";

$nhaMang['vietnamobile'] = "(LEFT(`post_name`,3) IN ('092', '056', '058', '052'))";

$nhaMang['gmobile'] = "(LEFT(`post_name`,3) IN ('099', '059'))";

$nhaMang['itelecom'] = "(LEFT(`post_name`,3) = '087')";


function remove_character($so) {
    return preg_replace('/\D/', '', $so);
}

function getTenNhaMang($so = '', $lowercase = false) {
    $mang = array(
        '086' => 'Viettel',
        '096' => 'Viettel',
        '097' => 'Viettel',
        '098' => 'Viettel',
        '032' => 'Viettel',
        '033' => 'Viettel',
        '034' => 'Viettel',
        '035' => 'Viettel',
        '036' => 'Viettel',
        '037' => 'Viettel',
        '038' => 'Viettel',
        '039' => 'Viettel',
		'089' => 'Mobifone',
        '090' => 'Mobifone',
        '093' => 'Mobifone',
        '070' => 'Mobifone',
        '079' => 'Mobifone',
        '077' => 'Mobifone',
        '076' => 'Mobifone',
        '078' => 'Mobifone',
        '091' => 'Vinaphone',
        '094' => 'Vinaphone',
        '083' => 'Vinaphone',
        '084' => 'Vinaphone',
        '085' => 'Vinaphone',
        '081' => 'Vinaphone',
        '082' => 'Vinaphone',
        '088' => 'Vinaphone',
        '092' => 'Vietnamobile',
        '056' => 'Vietnamobile',
        '058' => 'Vietnamobile',
        '052' => 'Vietnamobile',
        '099' => 'Gmobile',
        '059' => 'Gmobile',
        '087' => 'iTelecom'
    );
    $so = remove_character($so);
    $dauSo = substr($so, 0, 3);
    $dauSo = (string)$dauSo;
    $tenMang = 'Không xác định';
    if (isset($mang[$dauSo])) {
        $tenMang = $mang[$dauSo];
    }
    return $lowercase ? strtolower($tenMang) : $tenMang;
}

function getLoaiSim($so = '') {
    $sosim = str_replace(' ', '', str_replace('.', '', $so));

    $r1 = substr($sosim, -1, 1);
    $r2 = substr($sosim, -2, 1);
    $r3 = substr($sosim, -3, 1);
    $r4 = substr($sosim, -4, 1);
    $r5 = substr($sosim, -5, 1);
    $r6 = substr($sosim, -6, 1);
    $r7 = substr($sosim, -7, 1);
    $r8 = substr($sosim, -8, 1);
    $r22 = substr($sosim, -2, 2);
    $r33 = substr($sosim, -3, 3);
    $r63 = substr($sosim, -6, 3);
    $r22 = substr($sosim, -2, 2);
    $r42 = substr($sosim, -4, 2);
    $r62 = substr($sosim, -6, 2);

    if ($r1 == $r2 and $r2 == $r3 and $r3 == $r4 and $r4 == $r5 and $r5 == $r6 and $r6 ==
        $r7 and $r7 == $r8) {
        return "Sim bát quý";
    }

    if ($r1 == $r2 and $r2 == $r3 and $r3 == $r4 and $r4 == $r5 and $r5 == $r6 and $r6 ==
        $r7) {
        return "Sim thất quý";
    }


    if ($r1 == $r2 and $r2 == $r3 and $r3 == $r4 and $r4 == $r5 and $r5 == $r6) {
        return "Sim lục quý";
    }

    if ($r1 == $r2 and $r2 == $r3 and $r3 == $r4 and $r4 == $r5) {
        return "Sim ngũ quý";
    }

    if ($r1 == $r2 and $r2 == $r3 and $r3 == $r4) {
        return "Sim tứ quý";
    }

    if ($r1 == $r2 and $r2 == $r3) {
        return "Sim tam hoa";
    }

    if ($r22 == 86 || $r22 == 68) {
        return "Sim lộc phát";
    }

    if ($r22 == 39 || $r22 == 79) {
        return "Sim thần tài";
    }


    if ($r22 == 38 || $r22 == 78) {
        return "Sim ông địa";
    }

    if ($r33 == $r63 and $r3 != $r4) {
        return "Sim taxi";
    }

    if ($r22 == $r42 and $r42 == $r63 and $r1 != $r2) {
        return "Sim taxi";
    }

    if (in_array(substr($sosim, 0, 3), array(
        '091',
        '090',
        '098',
        '097'))) {
        return "Sim đầu cổ";
    }

    if ($r1 == $r2 and $r3 == $r4) {
        return "Sim kép";
    }

    if (substr($sosim, -4, 4) > (date('Y')-50) and substr($sosim, -4, 4) < date('Y')) {
        return "Sim năm sinh";
    }

    if ($r1 == $r6 and $r2 == $r5 and $r3 == $r4) {
        return "Sim đối";
    }

    if ($r1 == $r3 and $r2 == $r3) {
        return "Sim đảo";
    }

    if ($r1 == $r3) {
        return "Sim gánh";
    }

    if ($r42 == $r22 and $r1 != $r2) {
        return "Sim lặp";
    }

    if ($r1 > $r2 and $r2 > $r3) {
        return "Sim tiến đơn";
    }

    if (in_array(substr($sosim, -4, 4), ['1102', '4078', '8683', '8910', '1368'])) {
        return "Sim đặt biệt";
    }

    return "Sim giá rẻ";
}


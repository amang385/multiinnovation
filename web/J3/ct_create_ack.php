<?php
include ('connect.php');

$ACK_ID = $_POST['ACK_ID'];
$ACK_NAME = $_POST['ACK_NAME'];
$UNIT_CODE = $_POST['UNIT_CODE'];
if ($UNIT_CODE == ''){
    $UNIT_CODE = $_POST['UNIT_CODE2'];
}
$UNIT_NAME = $_POST['UNIT_NAME'];
if ($UNIT_NAME == ''){
    $UNIT_NAME = $_POST['UNIT_NAME2'];
}
$UNIT_NAME2 = $_POST['UNIT_NAME2'];
$UNIT_NAME_ACK = $_POST['UNIT_NAME_ACK'];
$UNIT_CODE_PARENT = $_POST['UNIT_CODE_PARENT'];
$ACK_TIMESTAMP = $_POST['ACK_TIMESTAMP'];
$ACK_ESSENCE = $_POST['ACK_ESSENCE'];
$ACK_USER = $_POST['ACK_USER'];
$ACK_MISSION = $_POST['ACK_MISSION'];
$ACK_DISTRIBUTION = $_POST['ACK_DISTRIBUTION'];
$ACK_SCOPE = $_POST['ACK_SCOPE'];
$ACK_DIVISION = $_POST['ACK_DIVISION'];
$ACK_EXPLANATION = $_POST['ACK_EXPLANATION'];
$ACK_SUMMARY = $_POST['ACK_SUMMARY'];
$ACK_VERSION = $_POST['ACK_VERSION'];
$UNIT_ACM_ID = $_POST['UNIT_ACM_ID'];
$UNIT_ACM_CREATE = $_POST['UNIT_ACM_CREATE'];

$check = "SELECT UNIT_CODE FROM j3_nrpt WHERE UNIT_CODE = '".$UNIT_NAME2."'";
$result = mysqli_query($conn, $check) or die(mysqli_error());
$num=mysqli_num_rows($result);

if($num > 0){
    echo "<script>";
    echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
    echo "window.location = 'create_ack.php?id=$UNIT_CODE_PARENT&name=$UNIT_CODE_PARENT&nickname=$UNIT_CODE_PARENT&lastname=$UNIT_CODE_PARENT';";
    echo "</script>";
}else{

    $sql1 = "INSERT INTO  j3_ack(ACK_NUM_ID,ACK_ID,ACK_NAME,UNIT_CODE,UNIT_NAME,UNIT_NAME_ACK,UNIT_CODE_PARENT,ACK_TIMESTAMP,ACK_ESSENCE,ACK_USER,ACK_MISSION,ACK_DISTRIBUTION,ACK_SCOPE,ACK_DIVISION,ACK_EXPLANATION,ACK_SUMMARY,ACK_VERSION,UNIT_ACM_CREATE,UNIT_ACM_ID) 
    VALUES (NULL,'$ACK_ID','$ACK_NAME','$UNIT_NAME2','$UNIT_NAME','$UNIT_NAME_ACK','$UNIT_CODE_PARENT',
    current_timestamp(),'$ACK_ESSENCE','$ACK_USER','$ACK_MISSION','$ACK_DISTRIBUTION','$ACK_SCOPE',
    '$ACK_DIVISION','$ACK_EXPLANATION','$ACK_SUMMARY','$ACK_VERSION', '$UNIT_ACM_CREATE' , ".$_POST["UNIT_ACM"].")";
    $result2 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error()); 

    $ACK_NUM_ID = mysqli_insert_id($conn);
   

    // $sql2 = "INSERT INTO j3_nrpt_approve(UNIT_CODE,NRPT_NAME,NRPT_ACM,NRPT_NUNIT,NRPT_NPAGE,NRPT_DMYUPD,NRPT_UNIT_PARENT,NRPT_USER,UNIT_ACM_ID)
    // VALUES ('$UNIT_NAME2','$UNIT_NAME','$UNIT_NAME_ACK','$UNIT_NAME2','12434',current_timestamp(),'$UNIT_CODE_PARENT','$ACK_USER','$UNIT_ACM_ID')";
    // $result3 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error()); 
    
    $result = mysqli_query($conn, "TRUNCATE j3_nrpt_approve") or die(mysqli_error());
    $result = mysqli_query($conn, "TRUNCATE j3_rost_approve") or die(mysqli_error());

    switch ($_POST["UNIT_ACM_CREATE"]) {
        
        case 'กรม':
            
            $sql_insert_j3_nrpt = "INSERT INTO `j3_nrpt_approve` 
            SELECT * FROM `j3_nrpt` WHERE UNIT_ACM_ID LIKE '".$_POST["UNIT_ACM"]."'  ";
            $result = mysqli_query($conn, $sql_insert_j3_nrpt) or die(mysqli_error());

             $sql_select_j3_rost = "SELECT * FROM `j3_rost` WHERE ROST_PARENT LIKE '".$_POST["UNIT_ACM"]."' ";
             $res = mysqli_query($conn , $sql_select_j3_rost);
                $c = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $ROST_UNIT =  substr( $_POST["UNIT_NAME2"] , 0 , 5). substr($row["ROST_UNIT"], 5 , 9);
                    $ROST_CPOS = $row["ROST_CPOS"];
                    $ROST_POSNAME = $row["ROST_POSNAME"];
                    $ROST_POSNAME_ACM = $row["ROST_POSNAME_ACM"];
                    $ROST_RANK = $row["ROST_RANK"];
                    $ROST_RANKNAME = $row["ROST_RANKNAME"];
                    $ROST_LAO_MAJ = $row["ROST_LAO_MAJ"];
                    $ROST_NCPOS12 = $row["ROST_NCPOS12"];
                    $ROST_ID = $row["ROST_ID"];
                    $ROST_PARENT = $row["ROST_PARENT"];
                    $ROST_NUNIT = $row["ROST_NUNIT"];
                    $ROST_NPARENT = $row["ROST_NPARENT"];
                    $STATUS = $row["STATUS"];
                    $sql_insert_j3_rost = "INSERT INTO `j3_rost_approve` 
                    (`ROST_UNIT`, `ROST_CPOS`, `ROST_POSNAME`, `ROST_POSNAME_ACM`, `ROST_RANK`, `ROST_RANKNAME`, `ROST_LAO_MAJ`, `ROST_NCPOS12`, `ROST_ID`, `ROST_PARENT`, `ROST_NUNIT`, `ROST_NPARENT`, `STATUS` , `VERSION` , `ACK_NUM_ID`) 
                    VALUES ('".$ROST_UNIT."', '".$ROST_CPOS."', '".$ROST_POSNAME."', '".$ROST_POSNAME_ACM."', '".$ROST_RANK."', '".$ROST_RANKNAME."', '".$ROST_LAO_MAJ."', '".$ROST_NCPOS12."', $ROST_ID, '".$ROST_PARENT."', '".$ROST_NUNIT."', '".$ROST_NPARENT."', '".$STATUS."' , '$ACK_VERSION' , '$ACK_NUM_ID')";
                    $result = mysqli_query($conn, $sql_insert_j3_rost)  or die(mysqli_error());
                }


             $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_UNIT_PARENT = Replace(NRPT_UNIT_PARENT , Substring(NRPT_UNIT_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE  UNIT_ACM_ID LIKE '".$_POST["UNIT_ACM"]."' AND UNIT_CODE != '".$_POST["UNIT_ACM"]."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());

            $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)."  ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE   UNIT_CODE LIKE '".$_POST["UNIT_ACM"]."'
               ";
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());


            $sql_update_j3_rost_approve = "UPDATE `j3_rost_approve` SET 
             ROST_UNIT = Replace(ROST_UNIT , Substring(ROST_UNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_PARENT = Replace(ROST_PARENT , Substring(ROST_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NUNIT = Replace(ROST_NUNIT , Substring(ROST_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NPARENT = Replace(ROST_NPARENT , Substring(ROST_NPARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." ) ,
             ROST_POSNAME = REPLACE(ROST_POSNAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             ROST_POSNAME_ACM = REPLACE(ROST_POSNAME_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE ROST_PARENT LIKE '".$_POST["UNIT_ACM"]."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());
            echo 'กรม';
        break;

        case 'สำนัก':

            $sql_insert_j3_nrpt = "INSERT INTO `j3_nrpt_approve` 
            SELECT * FROM `j3_nrpt` WHERE UNIT_ACM_ID LIKE '".$_POST["UNIT_CODE_PARENT"]."'  ";
            $result = mysqli_query($conn, $sql_insert_j3_nrpt) or die(mysqli_error());


             $sql_select_j3_rost = "SELECT * FROM `j3_rost` WHERE ROST_PARENT LIKE '".$_POST["UNIT_CODE_PARENT"]."' ";
             $res = mysqli_query($conn , $sql_select_j3_rost);
                $c = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $ROST_UNIT =  substr( $_POST["UNIT_NAME2"] , 0 , 5). substr($row["ROST_UNIT"], 5 , 9);
                    $ROST_CPOS = $row["ROST_CPOS"];
                    $ROST_POSNAME = $row["ROST_POSNAME"];
                    $ROST_POSNAME_ACM = $row["ROST_POSNAME_ACM"];
                    $ROST_RANK = $row["ROST_RANK"];
                    $ROST_RANKNAME = $row["ROST_RANKNAME"];
                    $ROST_LAO_MAJ = $row["ROST_LAO_MAJ"];
                    $ROST_NCPOS12 = $row["ROST_NCPOS12"];
                    $ROST_ID = $row["ROST_ID"];
                    $ROST_PARENT = $row["ROST_PARENT"];
                    $ROST_NUNIT = $row["ROST_NUNIT"];
                    $ROST_NPARENT = $row["ROST_NPARENT"];
                    $STATUS = $row["STATUS"];
                    $sql_insert_j3_rost = "INSERT INTO `j3_rost_approve` 
                    (`ROST_UNIT`, `ROST_CPOS`, `ROST_POSNAME`, `ROST_POSNAME_ACM`, `ROST_RANK`, `ROST_RANKNAME`, `ROST_LAO_MAJ`, `ROST_NCPOS12`, `ROST_ID`, `ROST_PARENT`, `ROST_NUNIT`, `ROST_NPARENT`, `STATUS`, `VERSION`, `ACK_NUM_ID`) 
                    VALUES ('".$ROST_UNIT."', '".$ROST_CPOS."', '".$ROST_POSNAME."', '".$ROST_POSNAME_ACM."', '".$ROST_RANK."', '".$ROST_RANKNAME."', '".$ROST_LAO_MAJ."', '".$ROST_NCPOS12."', $ROST_ID, '".$ROST_PARENT."', '".$ROST_NUNIT."', '".$ROST_NPARENT."', '".$STATUS."' , '$ACK_VERSION', '$ACK_NUM_ID')";
                    $result = mysqli_query($conn, $sql_insert_j3_rost)  or die(mysqli_error());
                }


             $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_UNIT_PARENT = Replace(NRPT_UNIT_PARENT , Substring(NRPT_UNIT_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE  UNIT_ACM_ID LIKE '".$_POST["UNIT_CODE_PARENT"]."' AND UNIT_CODE != '".$_POST["UNIT_CODE_PARENT"]."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());

            $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)."  ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE   UNIT_CODE LIKE '".$_POST["UNIT_CODE_PARENT"]."'
               ";
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());


            $sql_update_j3_rost_approve = "UPDATE `j3_rost_approve` SET 
             ROST_UNIT = Replace(ROST_UNIT , Substring(ROST_UNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_PARENT = Replace(ROST_PARENT , Substring(ROST_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NUNIT = Replace(ROST_NUNIT , Substring(ROST_NUNIT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NPARENT = Replace(ROST_NPARENT , Substring(ROST_NPARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." ) ,
             ROST_POSNAME = REPLACE(ROST_POSNAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             ROST_POSNAME_ACM = REPLACE(ROST_POSNAME_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE ROST_PARENT LIKE '".$_POST["UNIT_CODE_PARENT"]."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());
            echo 'สำนัก';
        break;

        case 'ศูนย์':
        
            $sql_insert_j3_nrpt = "INSERT INTO `j3_nrpt_approve` 
            SELECT * FROM `j3_nrpt` WHERE  SUBSTRING(UNIT_CODE, 1, 5) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 5)."'  ";
            $result = mysqli_query($conn, $sql_insert_j3_nrpt) or die(mysqli_error());
            

             $sql_select_j3_rost = "SELECT * FROM `j3_rost` WHERE SUBSTRING(ROST_NUNIT, 1, 5) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 5)."' ";
             $res = mysqli_query($conn , $sql_select_j3_rost);
                $c = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $ROST_UNIT =  $row["ROST_UNIT"];
                    $ROST_CPOS = $row["ROST_CPOS"];
                    $ROST_POSNAME = $row["ROST_POSNAME"];
                    $ROST_POSNAME_ACM = $row["ROST_POSNAME_ACM"];
                    $ROST_RANK = $row["ROST_RANK"];
                    $ROST_RANKNAME = $row["ROST_RANKNAME"];
                    $ROST_LAO_MAJ = $row["ROST_LAO_MAJ"];
                    $ROST_NCPOS12 = $row["ROST_NCPOS12"];
                    $ROST_ID = $row["ROST_ID"];
                    $ROST_PARENT = $row["ROST_PARENT"];
                    $ROST_NUNIT = $row["ROST_NUNIT"];
                    $ROST_NPARENT = $row["ROST_NPARENT"];
                    $STATUS = $row["STATUS"];
                    $sql_insert_j3_rost = "INSERT INTO `j3_rost_approve` 
                    (`ROST_UNIT`, `ROST_CPOS`, `ROST_POSNAME`, `ROST_POSNAME_ACM`, `ROST_RANK`, `ROST_RANKNAME`, `ROST_LAO_MAJ`, `ROST_NCPOS12`, `ROST_ID`, `ROST_PARENT`, `ROST_NUNIT`, `ROST_NPARENT`, `STATUS` , `VERSION`, `ACK_NUM_ID`) 
                    VALUES ('".$ROST_UNIT."', '".$ROST_CPOS."', '".$ROST_POSNAME."', '".$ROST_POSNAME_ACM."', '".$ROST_RANK."', '".$ROST_RANKNAME."', '".$ROST_LAO_MAJ."', '".$ROST_NCPOS12."', $ROST_ID, '".$ROST_PARENT."', '".$ROST_NUNIT."', '".$ROST_NPARENT."', '".$STATUS."', '$ACK_VERSION', '$ACK_NUM_ID')";
                    $result = mysqli_query($conn, $sql_insert_j3_rost)  or die(mysqli_error());
                }


             $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             NRPT_UNIT_PARENT = Replace(NRPT_UNIT_PARENT , Substring(NRPT_UNIT_PARENT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 3), ".substr( $_POST["UNIT_NAME2"] , 0 , 3)." ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE  SUBSTRING(UNIT_CODE, 1, 5) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 5)."' AND NRPT_UNIT_PARENT != '".substr($_POST["UNIT_CODE_PARENT"],0,4)."".'000000'."'
               ";
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());

            $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 3), ".substr( $_POST["UNIT_NAME2"] , 0 , 3)."  ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE   NRPT_UNIT_PARENT LIKE '".substr($_POST["UNIT_CODE_PARENT"],0,4)."".'000000'."'
               ";
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());


            $sql_update_j3_rost_approve = "UPDATE `j3_rost_approve` SET 
             ROST_UNIT = Replace(ROST_UNIT , Substring(ROST_UNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             ROST_PARENT = Replace(ROST_PARENT , Substring(ROST_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NUNIT = Replace(ROST_NUNIT , Substring(ROST_NUNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             ROST_NPARENT = Replace(ROST_NPARENT , Substring(ROST_NPARENT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." ) ,
             ROST_POSNAME = REPLACE(ROST_POSNAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             ROST_POSNAME_ACM = REPLACE(ROST_POSNAME_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE SUBSTRING(ROST_NUNIT, 1, 5) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 5)."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());
            echo 'ศูนย์';
        break;

        case 'กอง':
            
            $sql_insert_j3_nrpt = "INSERT INTO `j3_nrpt_approve` 
            SELECT * FROM `j3_nrpt` WHERE  SUBSTRING(UNIT_CODE, 1, 8) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 8)."'  ";
            $result = mysqli_query($conn, $sql_insert_j3_nrpt) or die(mysqli_error());
            

             $sql_select_j3_rost = "SELECT * FROM `j3_rost` WHERE SUBSTRING(ROST_UNIT, 1, 8) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 8)."' ";
             $res = mysqli_query($conn , $sql_select_j3_rost);
                $c = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $ROST_UNIT =  $row["ROST_UNIT"];
                    $ROST_CPOS = $row["ROST_CPOS"];
                    $ROST_POSNAME = $row["ROST_POSNAME"];
                    $ROST_POSNAME_ACM = $row["ROST_POSNAME_ACM"];
                    $ROST_RANK = $row["ROST_RANK"];
                    $ROST_RANKNAME = $row["ROST_RANKNAME"];
                    $ROST_LAO_MAJ = $row["ROST_LAO_MAJ"];
                    $ROST_NCPOS12 = $row["ROST_NCPOS12"];
                    $ROST_ID = $row["ROST_ID"];
                    $ROST_PARENT = $row["ROST_PARENT"];
                    $ROST_NUNIT = $row["ROST_NUNIT"];
                    $ROST_NPARENT = $row["ROST_NPARENT"];
                    $STATUS = $row["STATUS"];
                    $sql_insert_j3_rost = "INSERT INTO `j3_rost_approve` 
                    (`ROST_UNIT`, `ROST_CPOS`, `ROST_POSNAME`, `ROST_POSNAME_ACM`, `ROST_RANK`, `ROST_RANKNAME`, `ROST_LAO_MAJ`, `ROST_NCPOS12`, `ROST_ID`, `ROST_PARENT`, `ROST_NUNIT`, `ROST_NPARENT`, `STATUS`, `VERSION`, `ACK_NUM_ID`) 
                    VALUES ('".$ROST_UNIT."', '".$ROST_CPOS."', '".$ROST_POSNAME."', '".$ROST_POSNAME_ACM."', '".$ROST_RANK."', '".$ROST_RANKNAME."', '".$ROST_LAO_MAJ."', '".$ROST_NCPOS12."', $ROST_ID, '".$ROST_PARENT."', '".$ROST_NUNIT."', '".$ROST_NPARENT."', '".$STATUS."' , '$ACK_VERSION' , '$ACK_NUM_ID')";
                    $result = mysqli_query($conn, $sql_insert_j3_rost)  or die(mysqli_error());
                }


             $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  ,
             NRPT_UNIT_PARENT = Replace(NRPT_UNIT_PARENT , Substring(NRPT_UNIT_PARENT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 3), ".substr( $_POST["UNIT_NAME2"] , 0 , 3)." ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE  SUBSTRING(UNIT_CODE, 1, 8) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 8)."' AND NRPT_UNIT_PARENT NOT LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 5)."".'00000'."'
               ";
            //    echo $sql_update_j3_nrpt_approve;
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());

            $sql_update_j3_rost_approve = "UPDATE `j3_nrpt_approve` SET 
              UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  ,
              NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  
              WHERE  UNIT_CODE LIKE '".substr($_POST["UNIT_CODE_PARENT"],0,8)."".'00'."'
               ";

               echo $sql_update_j3_rost_approve;
            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());



            $sql_update_j3_rost_approve = "UPDATE `j3_rost_approve` SET 
             ROST_UNIT = Replace(ROST_UNIT , Substring(ROST_UNIT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." )  ,
             ROST_PARENT = Replace(ROST_PARENT , Substring(ROST_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NUNIT = Replace(ROST_NUNIT , Substring(ROST_NUNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             ROST_NPARENT = Replace(ROST_NPARENT , Substring(ROST_NPARENT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." ) ,
             ROST_POSNAME = REPLACE(ROST_POSNAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             ROST_POSNAME_ACM = REPLACE(ROST_POSNAME_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE SUBSTRING(ROST_UNIT, 1, 8) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 8)."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());
            echo 'กอง';
        break;
        case 'แผนก':
            
            $sql_insert_j3_nrpt = "INSERT INTO `j3_nrpt_approve` 
            SELECT * FROM `j3_nrpt` WHERE  SUBSTRING(UNIT_CODE, 1, 10) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 10)."'  ";
            $result = mysqli_query($conn, $sql_insert_j3_nrpt) or die(mysqli_error());
            

             $sql_select_j3_rost = "SELECT * FROM `j3_rost` WHERE SUBSTRING(ROST_UNIT, 1, 10) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 10)."' ";
             $res = mysqli_query($conn , $sql_select_j3_rost);
                $c = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $ROST_UNIT =  $row["ROST_UNIT"];
                    $ROST_CPOS = $row["ROST_CPOS"];
                    $ROST_POSNAME = $row["ROST_POSNAME"];
                    $ROST_POSNAME_ACM = $row["ROST_POSNAME_ACM"];
                    $ROST_RANK = $row["ROST_RANK"];
                    $ROST_RANKNAME = $row["ROST_RANKNAME"];
                    $ROST_LAO_MAJ = $row["ROST_LAO_MAJ"];
                    $ROST_NCPOS12 = $row["ROST_NCPOS12"];
                    $ROST_ID = $row["ROST_ID"];
                    $ROST_PARENT = $row["ROST_PARENT"];
                    $ROST_NUNIT = $row["ROST_NUNIT"];
                    $ROST_NPARENT = $row["ROST_NPARENT"];
                    $STATUS = $row["STATUS"];
                    $sql_insert_j3_rost = "INSERT INTO `j3_rost_approve` 
                    (`ROST_UNIT`, `ROST_CPOS`, `ROST_POSNAME`, `ROST_POSNAME_ACM`, `ROST_RANK`, `ROST_RANKNAME`, `ROST_LAO_MAJ`, `ROST_NCPOS12`, `ROST_ID`, `ROST_PARENT`, `ROST_NUNIT`, `ROST_NPARENT`, `STATUS`, `VERSION`, `ACK_NUM_ID`) 
                    VALUES ('".$ROST_UNIT."', '".$ROST_CPOS."', '".$ROST_POSNAME."', '".$ROST_POSNAME_ACM."', '".$ROST_RANK."', '".$ROST_RANKNAME."', '".$ROST_LAO_MAJ."', '".$ROST_NCPOS12."', $ROST_ID, '".$ROST_PARENT."', '".$ROST_NUNIT."', '".$ROST_NPARENT."', '".$STATUS."', '$ACK_VERSION' , '$ACK_NUM_ID')";
                    $result = mysqli_query($conn, $sql_insert_j3_rost)  or die(mysqli_error());
                }


             $sql_update_j3_nrpt_approve = "UPDATE `j3_nrpt_approve` SET 
             UNIT_CODE = Replace(UNIT_CODE , Substring(UNIT_CODE, 1, 9), ".substr( $_POST["UNIT_NAME2"] , 0 , 9)." )  ,
             NRPT_NUNIT = Replace(NRPT_NUNIT , Substring(NRPT_NUNIT, 1, 9), ".substr( $_POST["UNIT_NAME2"] , 0 , 9)." )  ,
             NRPT_UNIT_PARENT = Replace(NRPT_UNIT_PARENT , Substring(NRPT_UNIT_PARENT, 1, 7), ".substr( $_POST["UNIT_NAME2"] , 0 , 7)." )  ,
             UNIT_ACM_ID = Replace(UNIT_ACM_ID , Substring(UNIT_ACM_ID, 1, 3), ".substr( $_POST["UNIT_NAME2"] , 0 , 3)." ) ,
             NRPT_NAME = REPLACE(NRPT_NAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             NRPT_ACM = REPLACE(NRPT_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE  SUBSTRING(UNIT_CODE, 1, 10) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 10)."' 
               ";
            //    echo $sql_update_j3_nrpt_approve;
            $result = mysqli_query($conn, $sql_update_j3_nrpt_approve) or die(mysqli_error());


            $sql_update_j3_rost_approve = "UPDATE `j3_rost_approve` SET 
             ROST_UNIT = Replace(ROST_UNIT , Substring(ROST_UNIT, 1, 10), ".substr( $_POST["UNIT_NAME2"] , 0 , 10)." )  ,
             ROST_PARENT = Replace(ROST_PARENT , Substring(ROST_PARENT, 1, 4), ".substr( $_POST["UNIT_NAME2"] , 0 , 4)." )  ,
             ROST_NUNIT = Replace(ROST_NUNIT , Substring(ROST_NUNIT, 1, 5), ".substr( $_POST["UNIT_NAME2"] , 0 , 5)." )  ,
             ROST_NPARENT = Replace(ROST_NPARENT , Substring(ROST_NPARENT, 1, 8), ".substr( $_POST["UNIT_NAME2"] , 0 , 8)." ) ,
             ROST_POSNAME = REPLACE(ROST_POSNAME, '".$_POST["UNIT_NAME_OLD"]."', '".$_POST["UNIT_NAME"]."') ,
             ROST_POSNAME_ACM = REPLACE(ROST_POSNAME_ACM, '".$_POST["UNIT_NAME_ACK_OLD"]."', '".$_POST["UNIT_NAME_ACK"]."') 
             WHERE SUBSTRING(ROST_UNIT, 1, 8) LIKE '".substr($_POST["UNIT_CODE_PARENT"] , 0, 8)."'
               ";

            $result = mysqli_query($conn, $sql_update_j3_rost_approve) or die(mysqli_error());
            echo 'แผนก';
        break;
    }


    
    die();




}    

mysqli_close($conn);
if($result2 && $result3){
    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข้อมูลสำเร็จ');";
    echo "window.location = 'read_ack.php'; ";
    echo "</script>";
}else{
    echo "<script type='text/javascript'>";
    echo "window.location = 'read_ack.php'; ";
    echo "</script>";

} 

?>
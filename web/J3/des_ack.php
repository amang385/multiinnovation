<?php
include ('connectpdo.php');
$ACK_NUM_ID = $_GET['id'];
$UNIT_CODE_4 = $_GET['id2'];
$UNIT_CODE_5 = $_GET['id3'];
$UNIT_CODE_6 = $_GET['id4'];

$dd;

$sql ="SELECT * FROM j3_ack WHERE ACK_NUM_ID = :ACK_NUM_ID";
$stmt=$db->prepare($sql);
$stmt->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$ACK_NUM_ID = $row['ACK_NUM_ID'];
$ACK_ID = $row['ACK_ID'];
$ACK_MISSION = $row['ACK_MISSION'];
$ACK_DISTRIBUTION = $row['ACK_DISTRIBUTION'];
$ACK_ESSENCE = $row['ACK_ESSENCE'];
$ACK_SCOPE = $row['ACK_SCOPE'];
$ACK_DIVISION = $row['ACK_DIVISION'];
$ACK_EXPLANATION = $row['ACK_EXPLANATION'];
$ACK_SUMMARY = $row['ACK_SUMMARY'];
$ACK_USER = $row['ACK_USER'];
$ACK_NAME = $row['ACK_NAME'];
$UNIT_CODE_2 = $row['UNIT_CODE'];
$UNIT_ACM_ID = $row['UNIT_ACM_ID'];
$UNIT_NAME = $row['UNIT_NAME'];
$UNIT_NAME_ACK = $row['UNIT_NAME_ACK'];
$UNIT_CODE_PARENT = $row['UNIT_CODE_PARENT'];
$ACK_TIMESTAMP = $row['ACK_TIMESTAMP'];
$ACK_STS = $row['ACK_STS'];
$ACK_VERSION = $row['ACK_VERSION'];

$sql1 = "SELECT NRPT_ACM FROM j3_nrpt WHERE UNIT_CODE = :UNIT_CODE_PARENT";
$stmt1=$db->prepare($sql1);
$stmt1->bindparam(':UNIT_CODE_PARENT',$UNIT_CODE_PARENT);
$stmt1->execute();
$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
$ACM_PARENT = $row1['NRPT_ACM'];

$sql2 = "SELECT * FROM j3_nrpt_transaction WHERE UNIT_CODE = :UNIT_CODE_2";
$stmt2=$db->prepare($sql2);
$stmt2->bindparam(':UNIT_CODE_2',$UNIT_CODE_2);
$stmt2->execute();
$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
$NRPT_UNIT_PARENT_1 = $row2['NRPT_UNIT_PARENT'];
$NRPT_NAME_1 = $row2['NRPT_NAME'];
$NRPT_ACM_1 = $row2['NRPT_ACM'];

$sql_11 ="SELECT * FROM j3_nrpt_transaction WHERE UNIT_CODE = :ACK_NUM_ID";
$stmt_11=$db->prepare($sql_11);
$stmt_11->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
$stmt_11->execute();
while($row_11=$stmt_11->fetch(PDO::FETCH_ASSOC)){
	$UNIT_CODE = $row_11['UNIT_CODE'];
	$NRPT_NAME = $row_11['NRPT_NAME'];
	$NRPT_ACM = $row_11['NRPT_ACM'];
	$NRPT_NUNIT = $row_11['NRPT_NUNIT'];
	$NRPT_NPAGE = $row_11['NRPT_NPAGE'];
	$NRPT_DMYUPD = $row_11['NRPT_DMYUPD'];
	$NRPT_UNIT_PARENT = $row_11['NRPT_UNIT_PARENT'];
	$NRPT_USER = $row_11['NRPT_USER'];
}

$sql_2 = "SELECT * FROM j3_unit WHERE UNIT_CODE = :ACK_NUM_ID";
$stmt_2=$db->prepare($sql_2);
$stmt_2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
$stmt_2->execute();
$row_2=$stmt_2->fetch(PDO::FETCH_ASSOC);
$UNIT_NAME_2 = $row_2['UNIT_NAME'];
$UNIT_ACM_2 =$row_2['UNIT_ACM'];
$UNIT_PROV_2 =$row_2['UNIT_PROV'];
$UNIT_DMY_2 =$row_2['UNIT_DMY'];
$DMY = substr($UNIT_DMY_2,0,2);
$DMY2 = substr($UNIT_DMY_2,2,2);
$DMY3 = substr($UNIT_DMY_2,4,4);

?>

<!DOCTYPE html>
<html>
<head>
	<?php
	include ('haed.php');
	?>
		<link rel="stylesheet" href="https:////cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<style>
	.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    padding: 3px;
}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php
		include ('sidebar.php');
		?>
		
		<div class="content-wrapper">
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12"><br>
							<div class="card">
								<div class="card-body">
									<section class="content">
										<div class="container-fluid">
												<div class="card card-default">
													<div class="card-header">
														<div style="text-vlign: center; ">
															<div class="row">
																<label style="vertical-align: middle">อจย./อฉก. :</label>
																<div class="col-md-2">
																	<input type="text" class="form-control" name="ACK_ID" value="<?=$ACK_ID?>">
																</div>
																&nbsp;
																<label>หมายเลข :</label>
																<div class="col-md-2">
																	<input type="text" class="form-control" name="ACK_ID">
																</div>
																&nbsp;
																<label>ว/ด/ป อนุมัติ :</label>
																<div class="col-md-2">
																	<input type="text" class="form-control" name="UNIT_DMY" value="<?=$DMY;?>/<?=$DMY2;?>/<?=$DMY3?>">
																</div>
																&nbsp;
																<label>อสอ. :</label>
																<div class="col-md-2">
																	<input type="text" class="form-control" name="ACK_ID" value="<?=$ACK_STS?>">
																</div>	
															</div>
														</div>
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-sm-5">
																<div class="form-group">
																	<label>นามหน่วยเต็ม</label>
																	<input type="text" class="form-control" name="UNIT_NAME" value="<?=$UNIT_NAME?>">
																</div>
															</div>
															<div class="col-12 col-sm-3">
																<div class="form-group">
																	<label>นามหน่วยย่อ</label>
																	<input type="text" class="form-control" name="UNIT_ACM" value="<?=$UNIT_NAME_ACK?>">
																</div>
															</div>
															<div class="col-12 col-sm-2">
																<div class="form-group">
																	<label>จว.ที่ตั้ง</label>
																	<input type="text" class="form-control" name="UNIT_PROV" value="">
																</div>
															</div>
															<div class="col-12 col-sm-2">
																<div class="form-group">
																	<label>ว/ด/ป อนุมัติ</label>
																	<input type="text" class="form-control" name="UNIT_DMY" value="<?=$DMY;?>/<?=$DMY2;?>/<?=$DMY3?>">
																</div>
															</div>
															<div class="col-12 col-sm-2">
																<div class="form-group">
																	<label>รหัสหน่วย</label>
																	<input type="text" class="form-control" name="UNIT_CODE_PARENT"
																		value="<?=$UNIT_CODE_2?>">
																</div>
															</div>
															<div class="col-12 col-sm-5">
																<div class="form-group">
																	<label>รหัสหน่วยกรมบัญชีกลาง</label>
																	<input type="text" class="form-control" name="ACK_ESSENCE">
																</div>
															</div>
															<div class="col-12 col-sm-2">
																<div class="form-group">
																	<label>วัน-เวลา ณ ทำรายการล่าสุด</label>
																	<input type="text" class="form-control" name="ACK_TIMESTAMP"
																		value="<?=date('d/m/Y H:i:s') ?>" readonly>
																</div>
															</div>
															<div class="col-12 col-sm-2">
																<div class="form-group">
																	<label>ผู้ทำรายการ</label>
																	<input type="text" class="form-control" name="ACK_USER" readonly>
																</div>
															</div>
															<div class="col-12 col-sm-1">
																<div class="form-group">
																	<label>เวอร์ชัน</label>
																	<input type="text" class="form-control" name="ACK_VERSION" value="1" readonly>
																</div>
															</div>
														</div>
													</div>
												</div>
										</div>
									</section>
									<?php
										if($ACK_NUM_ID == "6110000000"){
											echo'<table id="example1" class="table table-bordered table-striped">
												<thead class="bg-info">                                                        
													<tr>
														<th style="text-align: center;">ประเภท</th>
														<th style="text-align: center;">สัญญาบัตร</th>
														<th style="text-align: center;">ประทวน</th>
														<th style="text-align: center;">พลอาสาสมัคร</th>
														<th style="text-align: center;">พลทหาร</th>
														<th style="text-align: center;">ลูกจ้างประจำ</th>
														<th style="text-align: center;">พนักงานราชการ</th>
													</tr>
												</thead>
												<tbody>';
													
														include ('connectpdo.php');
															$sql_u = "SELECT * FROM j3_unit WHERE UNIT_CODE = :UNIT_ACM_ID";
															$stmt_u=$db->prepare($sql_u);
															$stmt_u->bindparam(':UNIT_ACM_ID',$UNIT_ACM_ID);
															$stmt_u->execute();
															$row_u=$stmt_u->fetch(PDO::FETCH_ASSOC);
															//while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																$UNIT_COF_FULL = $row_u['UNIT_COF_FULL'];//สัญญา
																$UNIT_COF_FILL = $row_u['UNIT_COF_FILL'];
																$UNIT_COF_REAL = $row_u['UNIT_COF_REAL'];
																$UNIT_NCO_FULL = $row_u['UNIT_NCO_FULL'];//ประทวน
																$UNIT_NCO_FILL = $row_u['UNIT_NCO_FILL'];
																$UNIT_NCO_REAL = $row_u['UNIT_NCO_REAL'];
																$UNIT_PVT_FULL = $row_u['UNIT_PVT_FULL'];//พลอาสา
																$UNIT_PVT_FILL = $row_u['UNIT_PVT_FILL'];
																$UNIT_PVT_REAL = $row_u['UNIT_PVT_REAL'];
																$UNIT_EMPY_FULL = $row_u['UNIT_EMPY_FULL'];//ลูกจ้างประจำ
																$UNIT_EMPY_FILL = $row_u['UNIT_EMPY_FILL'];
																$UNIT_EMPY_REAL = $row_u['UNIT_EMPY_REAL'];
																$UNIT_TEMP_FULL = $row_u['UNIT_TEMP_FULL'];//ลูกจ้างชั่ว
																$UNIT_TEMP_FILL = $row_u['UNIT_TEMP_FILL'];
																$UNIT_TEMP_REAL = $row_u['UNIT_TEMP_REAL'];
																$UNIT_PVTT_FULL = $row_u['UNIT_PVTT_FULL'];//พลทหาร
																$UNIT_PVTT_FILL = $row_u['UNIT_PVTT_FILL'];
																$UNIT_PVTT_REAL = $row_u['UNIT_PVTT_REAL'];
																$UNIT_CODE_KP = $row_u['UNIT_CODE'];
																//echo $UNIT_CODE_KP;
															//}
															
																echo'<tr>
																	<tr>
																		<th class="bg-info" style="width: 100px; text-align: center;">อัตราเต็ม</th>
																		<td style="width: 100px; text-align: center;">'.$UNIT_COF_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_NCO_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVT_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVTT_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_EMPY_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_TEMP_FULL.'</td>
																	</tr>
																	<tr>
																		<th class="bg-info" style="width: 100px; text-align: center;">อัตราอนุมัติ</th>
																		<td style="width: 100px; text-align: center;">'.$UNIT_COF_FILL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_NCO_FILL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVT_FILL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVTT_FILL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_EMPY_FILL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_TEMP_FILL.'</td>
																	</tr>
																	<tr>
																		<th class="bg-info" style="width: 100px; text-align: center;">บรรจุจริง</th>
																		<td style="width: 100px; text-align: center;">'.$UNIT_COF_REAL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_NCO_REAL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVT_REAL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVTT_REAL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_EMPY_REAL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_TEMP_REAL.'</td>
																	</tr>
																</tr>';
															
																									
												echo'</tbody>
											</table>';
										}else{
											echo'<table id="example1" class="table table-bordered table-striped">
												<thead class="bg-info">                                                        
													<tr>
														<th style="text-align: center;">ประเภท</th>
														<th style="text-align: center;">สัญญาบัตร</th>
														<th style="text-align: center;">ประทวน</th>
														<th style="text-align: center;">พลอาสาสมัคร</th>
														<th style="text-align: center;">พลทหาร</th>
													</tr>
												</thead>
												<tbody>';
													
														include ('connectpdo.php');
															$sql_u = "SELECT * FROM j3_unit WHERE UNIT_CODE = :UNIT_ACM_ID";
															$stmt_u=$db->prepare($sql_u);
															$stmt_u->bindparam(':UNIT_ACM_ID',$UNIT_ACM_ID);
															$stmt_u->execute();
															$row_u=$stmt_u->fetch(PDO::FETCH_ASSOC);
															//while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																$UNIT_COF_FULL = $row_u['UNIT_COF_FULL'];//สัญญา
																$UNIT_COF_FILL = $row_u['UNIT_COF_FILL'];
																$UNIT_COF_REAL = $row_u['UNIT_COF_REAL'];
																$UNIT_NCO_FULL = $row_u['UNIT_NCO_FULL'];//ประทวน
																$UNIT_NCO_FILL = $row_u['UNIT_NCO_FILL'];
																$UNIT_NCO_REAL = $row_u['UNIT_NCO_REAL'];
																$UNIT_PVT_FULL = $row_u['UNIT_PVT_FULL'];//พลอาสา
																$UNIT_PVT_FILL = $row_u['UNIT_PVT_FILL'];
																$UNIT_PVT_REAL = $row_u['UNIT_PVT_REAL'];
																$UNIT_EMPY_FULL = $row_u['UNIT_EMPY_FULL'];//ลูกจ้างประจำ
																$UNIT_EMPY_FILL = $row_u['UNIT_EMPY_FILL'];
																$UNIT_EMPY_REAL = $row_u['UNIT_EMPY_REAL'];
																$UNIT_TEMP_FULL = $row_u['UNIT_TEMP_FULL'];//ลูกจ้างชั่ว
																$UNIT_TEMP_FILL = $row_u['UNIT_TEMP_FILL'];
																$UNIT_TEMP_REAL = $row_u['UNIT_TEMP_REAL'];
																$UNIT_PVTT_FULL = $row_u['UNIT_PVTT_FULL'];//พลทหาร
																$UNIT_PVTT_FILL = $row_u['UNIT_PVTT_FILL'];
																$UNIT_PVTT_REAL = $row_u['UNIT_PVTT_REAL'];
																$UNIT_CODE_KP = $row_u['UNIT_CODE'];
																//echo $UNIT_CODE_KP;
															//}
																echo'<tr>
																	<tr>
																		<th class="bg-info" style="width: 100px; text-align: center;">อัตราเต็ม</th>
																		<td style="width: 100px; text-align: center;">'.$UNIT_COF_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_NCO_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVT_FULL.'</td>
																		<td style="width: 100px; text-align: center;">'.$UNIT_PVTT_FULL.'</td>
																	</tr>
																</tr>';
															
																									
												echo'</tbody>
											</table>';
										}
									?>
								</div>
								<div class="card-body">
									<button class="tablink" onmouseover="openPage('Home1', this, 'white')">
										<font style="font-weight: bold; font-size: 18px;">นามหน่วยถือทำเนียบ</font>
									</button>
									<button class="tablink" onmouseover="openPage('Sturc1', this, 'white')">
										<font style="font-weight: bold; font-size: 18px;">นามหน่วยพิมพ์</font>
									</button>
									<button class="tablink" onmouseover="openPage('News1', this, 'white')">
										<font style="font-weight: bold; font-size: 18px;">ทำเนียบกำลังพล</font>
									</button>

									<div id="Home1" class="tabcontent">
										<div class="card-body">
											<table id="example1" class="table table-bordered table-striped" style="width: 1500px;">
												<tbody>
													<?php                                                        
														echo'<tr>
															<th class="bg-info" rowspan="2" style="width: 150px; text-align: center; vertical-align: middle">สัญญาบัตร</th>';



																$sql2 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction
																WHERE ROST_NPARENT = :ACK_NUM_ID OR ROST_NUNIT = :UNIT_CODE_4 OR ROST_UNIT = :UNIT_CODE_5 OR ROST_PARENT = :UNIT_CODE_6 
																GROUP BY ROST_RANK ORDER BY ROST_RANK";
																$stmt2=$db->prepare($sql2);
																$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
																$stmt2->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
																$stmt2->bindparam(':UNIT_CODE_5',$UNIT_CODE_5);
																$stmt2->bindparam(':UNIT_CODE_6',$UNIT_CODE_6);
																$stmt2->execute();
																while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																	$COUNT = $row2['COUNT(ROST_ID)'];
																	$ROST_RANK = $row2['ROST_RANK'];
																	$ROST_RANKNAME = $row2['ROST_RANKNAME'];

																$sql14= "SELECT * FROM j1_rank WHERE ROST_RANK = :ROST_RANK";
																$stmt14=$db->prepare($sql14);
																$stmt14->bindparam(':ROST_RANK',$ROST_RANK);
																$stmt14->execute();		
																$row79=$stmt14->fetch(PDO::FETCH_ASSOC);

																$RANK_NAME = $row79['ROST_RANKNAME'];
																				

																	if($ROST_RANK == "02" || $ROST_RANK == "03" || $ROST_RANK == "04" || $ROST_RANK == "05" || $ROST_RANK == "06"
																	|| $ROST_RANK == "07" || $ROST_RANK == "08" || $ROST_RANK == "09" || $ROST_RANK == "10"){




																		echo '<th class="bg-info" style="width: 100px; text-align: center">'.$RANK_NAME.'</th>';
																		
																		
																	}
																}

				

															echo'<th class="bg-info" style="text-align: center;">รวม</th>
															<tr>';

																	$stmt2->execute();
																	$SUM = "0";
																	while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																		$COUNT = $row2['COUNT(ROST_ID)'];
																		$ROST_RANK = $row2['ROST_RANK'];

																		
																		//echo $ROST_RANK;

																		if($ROST_RANK == "02" || $ROST_RANK == "03" || $ROST_RANK == "04" || $ROST_RANK == "05" || $ROST_RANK == "06"
																		|| $ROST_RANK == "07" || $ROST_RANK == "08" || $ROST_RANK == "09" || $ROST_RANK == "10"){
																			echo '<td style="width: 100px; text-align: center">
																				<input type="text" class="form-control" name="CRAK" value="'.$COUNT.'">
																			</td>';
																			
																			$SUM = $SUM+$COUNT;
																		}
																	}
																echo'<td style="width: 100px; text-align: center"><input type="text" class="form-control" name="CRAK" value="'.$SUM.'"></td>
																
															</tr>
														</tr>';
													?>
												</tbody>
												<tbody>
													<?php
														echo'<tr>
															<th class="bg-info" rowspan="2" style="width: 150px; text-align: center; vertical-align: middle">ประทวน</th>';
															
															include ('connectpdo.php');
																	$sql2 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction
																	WHERE ROST_NPARENT = :ACK_NUM_ID OR ROST_NUNIT = :UNIT_CODE_4 OR ROST_UNIT = :UNIT_CODE_5 OR ROST_PARENT = :UNIT_CODE_6 
																	GROUP BY ROST_RANK ORDER BY ROST_RANK";
																	$stmt2=$db->prepare($sql2);
																	$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
																	$stmt2->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
																	$stmt2->bindparam(':UNIT_CODE_5',$UNIT_CODE_5);
																	$stmt2->bindparam(':UNIT_CODE_6',$UNIT_CODE_6);
																	$stmt2->execute();
																	$SUM = "0";
																	while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																		$COUNT = $row2['COUNT(ROST_ID)'];
																		$ROST_RANK = $row2['ROST_RANK'];
																		$ROST_RANKNAME = $row2['ROST_RANKNAME'];

																		$sql15= "SELECT * FROM j1_rank WHERE ROST_RANK = :ROST_RANK";
																		$stmt15=$db->prepare($sql15);
																		$stmt15->bindparam(':ROST_RANK',$ROST_RANK);
																		$stmt15->execute();		
																		$row80=$stmt15->fetch(PDO::FETCH_ASSOC);

																		$RANK_NAME = $row80['ROST_RANKNAME'];
																		//echo $ROST_RANK;

																		if($ROST_RANK == "21" || $ROST_RANK == "22" || $ROST_RANK == "25"){
																			
																			echo '<th class="bg-info" style="width: 100px; text-align: center">'.$RANK_NAME.'</th>';
																		}
																	}
															
															echo'<th class="bg-info" style="text-align: center;">รวม</th>
															<tr>';
																
																	$stmt2->execute();
																	$SUM = "0";
																	while($row78=$stmt2->fetch(PDO::FETCH_ASSOC)){
																		$COUNT = $row78['COUNT(ROST_ID)'];
																		$ROST_RANK = $row78['ROST_RANK'];
																		//echo $ROST_RANK;

																		if($ROST_RANK == "21" || $ROST_RANK == "22" || $ROST_RANK == "25"){
																			
																			echo '<td style="width: 100px; text-align: center">
																				<input type="text" class="form-control" name="CRAK" value="'.$COUNT.'">
																			</td>';
																			$SUM = $SUM+$COUNT;
																		}
																	}
																
																echo'<td style="width: 100px; text-align: center">
																	<input type="text" class="form-control" name="CRAK" value="'.$SUM.'">
																</td>
															</tr>
														</tr>';
													?>                                                 
												</tbody>
												<tbody>                                                        
													<tr>
														<th class="bg-info" style="text-align: center; vertical-align: middle">พลอาสาสมัคร</th>
														<?php
															include ('connectpdo.php');
															$sql2 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction
															WHERE ROST_NPARENT = :ACK_NUM_ID OR ROST_NUNIT = :UNIT_CODE_4 OR ROST_UNIT = :UNIT_CODE_5 OR ROST_PARENT = :UNIT_CODE_6 
															GROUP BY ROST_RANK ORDER BY ROST_RANK";
															$stmt2=$db->prepare($sql2);
															$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
															$stmt2->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
															$stmt2->bindparam(':UNIT_CODE_5',$UNIT_CODE_5);
															$stmt2->bindparam(':UNIT_CODE_6',$UNIT_CODE_6);
															$stmt2->execute();
															$SUM = "0";
															while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																$COUNT = $row2['COUNT(ROST_ID)'];
																$ROST_RANK = $row2['ROST_RANK'];
																//echo $ROST_RANK;

																if($ROST_RANK == "31"){
																	$SUM = $SUM+$COUNT;
																	
																}
															}
														?>
														<td style="width: 100px; text-align: center">
															<input type="text" class="form-control" name="CRAK" value="<?=$SUM?>">
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<th class="bg-info" style="text-align: center; vertical-align: middle">ลูกจ้างประจำ</th>
														<?php
															include ('connectpdo.php');
															$sql2 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction
															WHERE ROST_NPARENT = :ACK_NUM_ID OR ROST_NUNIT = :UNIT_CODE_4 OR ROST_UNIT = :UNIT_CODE_5 OR ROST_PARENT = :UNIT_CODE_6
															GROUP BY ROST_RANK ORDER BY ROST_RANK";
															$stmt2=$db->prepare($sql2);
															$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
															$stmt2->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
															$stmt2->bindparam(':UNIT_CODE_5',$UNIT_CODE_5);
															$stmt2->bindparam(':UNIT_CODE_6',$UNIT_CODE_6);
															$stmt2->execute();
															$SUM = "0";
															while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																$COUNT = $row2['COUNT(ROST_ID)'];
																$ROST_RANK = $row2['ROST_RANK'];
															

																if($ROST_RANK == "50" || $ROST_RANK =="51"){
																	$SUM = $SUM+$COUNT;
																	
																}
															}
														?>
														<td style="width: 100px; text-align: center">
															<input type="text" class="form-control" name="CRAK" value="<?=$SUM?>">
														</td>
													</tr>                                                   
												</tbody>
												<tbody>
													<tr>
														<th class="bg-info" style="text-align: center; vertical-align: middle">พลทหาร</th>
														<?php
															include ('connectpdo.php');
															$sql2 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction
															WHERE ROST_NPARENT = :ACK_NUM_ID OR ROST_NUNIT = :UNIT_CODE_4 OR ROST_UNIT = :UNIT_CODE_5 OR ROST_PARENT = :UNIT_CODE_6
															GROUP BY ROST_RANK ORDER BY ROST_RANK";
															$stmt2=$db->prepare($sql2);
															$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
															$stmt2->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
															$stmt2->bindparam(':UNIT_CODE_5',$UNIT_CODE_5);
															$stmt2->bindparam(':UNIT_CODE_6',$UNIT_CODE_6);
															$stmt2->execute();
															$SUM = "0";
															while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
																$COUNT = $row2['COUNT(ROST_ID)'];
																$ROST_RANK = $row2['ROST_RANK'];
																

																if($ROST_RANK == "32"){
																	$SUM = $SUM+$COUNT;
																}
															}
														?>
														<td style="width: 100px; text-align: center">
															<input type="text" class="form-control" name="CRAK" value="<?=$SUM?>">
														</td>
													</tr>                                                   
												</tbody>
											</table>
										</div>
									</div>
									<div id="Sturc1" class="tabcontent">
										<?php
											include ('connectpdo.php');
											$sql3 = "SELECT * FROM j3_nrpt_transaction WHERE NRPT_UNIT_PARENT = :UNIT_CODE_4";
											$stmt3=$db->prepare($sql3);
											$stmt3->bindparam(':UNIT_CODE_4',$UNIT_CODE_4);
											$stmt3->execute();
												$i = "0";
												while($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
													$SUB1 = substr($row3['UNIT_CODE'],6);
													
													if($SUB1 != "0001" && $SUB1 != "0002" && $SUB1 != "0003" && $SUB1 != "9999" && $SUB1 != "9998"  && $SUB1 != "0900"){
														if($row3['NRPT_UNIT_PARENT'] == $UNIT_CODE_4){
															$UNIT3 = $row3['UNIT_CODE'];
															$SUB = substr($UNIT_CODE_4,0,2);
															$i++;
															echo '
																<div class="card card-outline card-success">
																	<div class="card-header">
																		<div class="card-body">
																			<div class="row">
																				<label style="text-align: center;">รหัสหน่วย :</label>
																				<div class="col-sm-2" style="text-align: center;">
																					<input type="text" class="form-control" value="'.$UNIT3.'" disabled>   
																				</div> 
																				<label>รหัสส่วนราชการ :</label>
																				<div class="col-sm-1" style="text-align: center;">
																					<input type="text" class="form-control" value="'.$SUB.'" disabled>
																				</div>
																				<label>ลำดับที่ :</label>
																				<div class="col-sm-1">
																					<input type="text" class="form-control" value="" disabled>
																				</div>
																				<label>รหัสหน่วยใหม่ :</label>
																				<div class="col-sm-2">
																					<input type="text" class="form-control" value="'.$UNIT3.'" disabled>
																				</div>
																				<label>รหัสหน่วยขึ้นหน้าใหม่ :</label>
																				<div class="col-sm-1">
																					<input type="text" class="form-control" value="" disabled>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="card-body">
																		<div class="row">
																			<div class="col-12 col-sm-6">
																				<div class="form-group">
																					<label>นามหน่วยเต็ม</label>
																					<input type="text" class="form-control" name="NRPT_NAME" value="'.$row3['NRPT_NAME'].'" readonly>
																				</div>
																			</div>
																			<div class="col-12 col-sm-6">
																				<div class="form-group">
																					<label>นามหน่วยภาษาอังกฤษ</label>
																					<input type="text" class="form-control" name="UNIT_CODE" readonly>
																				</div>
																			</div>
																			<div class="col-12 col-sm-6">
																				<div class="form-group">
																					<label>นามหน่วยย่อ</label>
																					<input type="text" class="form-control" name="NRPT_ACM" value="'.$row3['NRPT_ACM'].'" readonly>
																				</div>
																			</div>
																			<div class="col-12 col-sm-6">
																				<div class="form-group">
																					<label>นามหน่วยภาษาอังกฤษย่อ</label>
																					<input type="text" class="form-control" name="UNIT_NAME" readonly>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>';
																$sql7 = "SELECT * FROM j3_nrpt_transaction WHERE NRPT_UNIT_PARENT = :UNIT3";
																$stmt7=$db->prepare($sql7);
																$stmt7->bindparam(':UNIT3',$UNIT3);
																$stmt7->execute();
																$row7=$stmt7->fetch(PDO::FETCH_ASSOC);
																							
																if($row7['NRPT_UNIT_PARENT'] == $UNIT3){
																	$stmt7->execute();
																	while($row7=$stmt7->fetch(PDO::FETCH_ASSOC)){
																		$parent1 = $row7['NRPT_UNIT_PARENT'];
																			if($row7['NRPT_UNIT_PARENT'] == $UNIT3){
																				$UNIT4 = $row7['UNIT_CODE'];
																										
																				echo '<div class="card card-outline card-danger">
																				<div class="card-body">
																					<div class="card-header">
																						<div class="card-body">
																							<div class="row">
																								<label style="text-align: center;">รหัสหน่วย :</label>
																								<div class="col-sm-2" style="text-align: center;">
																									<input type="text" class="form-control" value="'.$UNIT4.'" disabled>   
																								</div> 
																								<label>รหัสส่วนราชการ :</label>
																								<div class="col-sm-1" style="text-align: center;">
																									<input type="text" class="form-control" value="'.$SUB.'" disabled>
																								</div>
																								<label>ลำดับที่ :</label>
																								<div class="col-sm-1">
																									<input type="text" class="form-control" value="" disabled>
																								</div>
																								<label>รหัสหน่วยใหม่ :</label>
																								<div class="col-sm-2">
																									<input type="text" class="form-control" value="'.$UNIT4.'" disabled>
																								</div>
																								<label>รหัสหน่วยขึ้นหน้าใหม่ :</label>
																								<div class="col-sm-1">
																									<input type="text" class="form-control" value="" disabled>
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="row">
																						<div class="col-12 col-sm-6">
																							<div class="form-group">
																								<label>นามหน่วยเต็ม</label>
																								<input type="text" class="form-control" name="NRPT_NAME" value="'.$row7['NRPT_NAME'].'" readonly>
																							</div>
																						</div>
																						<div class="col-12 col-sm-6">
																							<div class="form-group">
																								<label>นามหน่วยภาษาอังกฤษ</label>
																								<input type="text" class="form-control" name="UNIT_CODE" readonly>
																							</div>
																						</div>
																						<div class="col-12 col-sm-6">
																							<div class="form-group">
																								<label>นามหน่วยย่อ</label>
																								<input type="text" class="form-control" name="NRPT_ACM" value="'.$row7['NRPT_ACM'].'" readonly>
																							</div>
																						</div>
																						<div class="col-12 col-sm-6">
																							<div class="form-group">
																								<label>นามหน่วยภาษาอังกฤษย่อ</label>
																								<input type="text" class="form-control" name="UNIT_NAME" readonly>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>';
																										
																		}
																	}
																}
															}
														}	
													}
												?>
									</div>									
									<div id="News1" class="tabcontent">
										<iframe
											src="iframe_unit_ack.php?id=<?=$UNIT_CODE_2;?>&name=<?=$UNIT_CODE_2;?>&nickname=<?=$UNIT_CODE_2;?>&lastname=<?=$UNIT_CODE_2?>"
											frameborder="0" width="100%" height="800"></iframe>
									</div>
								</div>
							</div>
						</div>	
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<button class="tablink" onmouseover="openPage('Home', this, 'white')" ><font style="font-weight: bold; font-size: 18px;">กล่าวทั่วไป</font></button>
									<button class="tablink" onmouseover="openPage('Sturc', this, 'white')"><font style="font-weight: bold; font-size: 18px;">ผังการจัด</font></button>
									<button class="tablink" onmouseover="openPage('News', this, 'white')"><font style="font-weight: bold; font-size: 18px;">อัตรากำลังพล</font></button>
									<button class="tablink" onmouseover="openPage('Contact', this, 'white')"><font style="font-weight: bold; font-size: 18px;">คำชี้แจง</font></button>
									<button class="tablink" onmouseover="openPage('About', this, 'white')" ><font style="font-weight: bold; font-size: 18px;">อัตรายุทโธปกรณ์</font></button>
									
									<?php
									$sql2 = "SELECT ACK_MISSION,ACK_DISTRIBUTION,ACK_SCOPE,ACK_DIVISION,ACK_EXPLANATION FROM j3_ack WHERE ACK_NUM_ID = :ACK_NUM_ID";
									$stmt2=$db->prepare($sql2);
									$stmt2->bindparam(':ACK_NUM_ID',$ACK_NUM_ID); 
									$stmt2->execute();
									$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
									$ACK_M = $row2['ACK_MISSION'];
									$ACK_D = $row2['ACK_DISTRIBUTION'];
									$ACK_S = $row2['ACK_SCOPE'];
									$ACK_DV = $row2['ACK_DIVISION'];
									$ACK_E = $row2['ACK_EXPLANATION'];
									?>

									<div id="Home" class="tabcontent">
										<a href="export_word.php?id=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-primary"><i class="fas fa-file-word"></i> WORD</button></a>
										<a href="report_ack.php?id=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button></a><br><br>
										<div class="form-group">
											<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">ภารกิจ :</font></label>
											<textarea class="form-control" id="editor" rows="4" name="ACK_MISSION" style="border-width:1px; border-color: gray; font-weight: bold; font-size: 18px;" DISABLED><?=$ACK_M?></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">การแบ่งมอบ :</font></label>
											<textarea class="form-control" id="editor1" rows="4" name="ACK_DISTRIBUTION" style="border-width:1px; border-color: gray; font-weight: bold; font-size: 18px;" DISABLED><?=$ACK_D?></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">ขอบเขตความรับผิดชอบและหน้าที่ :</font></label>
											<textarea class="form-control" id="editor2" rows="4" name="ACK_SCOPE" style="border-width:1px; border-color: gray; font-weight: bold; font-size: 18px;" DISABLED><?=$ACK_S?></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">การแบ่งส่วนราชการและหน้าที่ :</font></label>
											<textarea class="form-control" id="editor3" rows="4" name="ACK_DIVISION" style="border-width:1px; border-color: gray;font-weight: bold; font-size: 18px;" DISABLED><?=$ACK_DV?></textarea>
										</div>
									</div>

									<div id="Sturc" class="tabcontent">
										<a href="iframe_tree.php?id=<?=$UNIT_CODE_2?>&id2=<?=$ACK_NUM_ID?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
										<a href="report_2.php?id=<?=$UNIT_CODE_2?>&id2=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button></a>
										<div style="text-align: center;">
											<?php
											include ('connectpdo.php');
											$sql6 = "SELECT * FROM j3_nrpt_transaction WHERE UNIT_CODE = :UNIT_CODE_2" ;
											$stmt6=$db->prepare($sql6);
											$stmt6->bindparam(':UNIT_CODE_2',$UNIT_CODE_2);
											$stmt6->execute();
											$row6=$stmt6->fetch(PDO::FETCH_ASSOC);
											$data = $row6['UNIT_CODE'];
											echo '<div class="tf-tree tf-gap-sm">
											<ul>
											<li>
											<span class="tf-node-content">
											'. $row6['NRPT_ACM'] .'
											</span>';
											if($data == $UNIT_CODE_2){
												$sql8 = "SELECT * FROM j3_nrpt_transaction WHERE NRPT_UNIT_PARENT = :data" ;
												$stmt8=$db->prepare($sql8);
												$stmt8->bindparam(':data',$data);
												$stmt8->execute();
												$row8=$stmt8->fetch(PDO::FETCH_ASSOC);
												if($row8['NRPT_UNIT_PARENT'] == $data){
													echo '<ul>';
													$stmt8->execute();
													while($row8=$stmt8->fetch(PDO::FETCH_ASSOC)){
														$SUB = substr($row8['UNIT_CODE'],6);
																		//echo $SUB;
														if($SUB != "0001" && $SUB != "0002" && $SUB != "0003" && $SUB != "9999" && $SUB != "9998"  && $SUB != "0900"){
															if($row8['NRPT_UNIT_PARENT'] == $data){
																$send = $row8['UNIT_CODE'];
																				//echo $row8['UNIT_CODE'];
																echo '<li>
																<span class="tf-node-content">
																'. $row8['NRPT_ACM'] .'
																</span>';
																				//$row8['UNIT_CODE'] != "6150000001" && $row8['UNIT_CODE'] != "6150000002" && $row8['UNIT_CODE'] != "6150000003" && 
																				$sql7 = "SELECT * FROM j3_nrpt_transaction WHERE NRPT_UNIT_PARENT = :send";
																				$stmt7=$db->prepare($sql7);
																				$stmt7->bindparam(':send',$send);
																				$stmt7->execute();
																				$row7=$stmt7->fetch(PDO::FETCH_ASSOC);
																				
																				if($row7['NRPT_UNIT_PARENT'] == $send){
																					echo '<ul>';
																					$stmt7->execute();
																					while($row7=$stmt7->fetch(PDO::FETCH_ASSOC)){
																						$parent1 = $row7['NRPT_UNIT_PARENT'];
																						if($row7['NRPT_UNIT_PARENT'] == $send){
																							
																							echo '<li>
																									<span class="tf-nc">
																										'. $row7['NRPT_ACM'] .'
																									</span>
																								</li>';
																							
																						}
																					}
																					echo '</ul>';
																				}
																			}
																			echo '
																			</li>';
																		}
																	}
																}
																echo '</ul>';
															}          
															echo '
															</li>
															</ul>
															</div>';					
															?>
														</div>
													</div>

													<div id="News" class="tabcontent"> 
														<button type="button" id="link_modal" data-toggle="modal" data-target="#modalPersonal" class="btn btn-info editbtn"><i class="fas fa-plus"></i></button></a>
														<a href="report_sum_ack_approve.php?id=<?=$UNIT_CODE1;?>&name=<?=$UNIT_CODE1;?>&nickname=<?=$UNIT_CODE1;?>&lastname=<?=$UNIT_CODE1?>&id5=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-primary"><i class="fas fa-file-word"></i> ปะหน้า</button></a>
													    <a href="report_iframe_ack_approve.php?id=<?=$UNIT_CODE1;?>&name=<?=$UNIT_CODE1;?>&nickname=<?=$UNIT_CODE1;?>&lastname=<?=$UNIT_CODE1?>&id5=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-success"><i class="fas fa-file-word"></i> อัตรากำลังพล</button></a>
													    <a href="report_sum_p_ack_approve.php?id=<?=$UNIT_CODE_2;?>&name=<?=$UNIT_CODE_2;?>&nickname=<?=$UNIT_CODE_2;?>&lastname=<?=$UNIT_CODE_2?>&id5=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-danger"><i class="fas fa-file-word"></i> ปะหลัง</button></a>
													    <br>
														<div class="card-body">
															<table id="example3" class="table table-bordered table-striped">
																<thead class="bg-blue">                                                        
																	<tr>
																		<th style="text-align: center;">ลำดับ</th>
																		<th style="text-align: center;">รหัสประจำตำแหน่ง</th>
																		<th>ชื่อตำแหน่ง</th>
																		<th>ตำแหน่งย่อ</th>
																		<th style="text-align: center;">อัตรา</th>
																		<th style="text-align: center;">รหัสกรมบัญชีกลาง</th>
																		<th style="text-align: center;">Manage</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	include ('connectpdo.php');
											/*		$sql2 = "SELECT * FROM j3_ratepersonal WHERE ACK_ID = :ACK_ID";
													$stmt2=$db->prepare($sql2);
													$stmt2->bindparam(':ACK_ID',$ACK_ID);
													$stmt2->execute();
													while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
														$RATE_P_NUM = $row2['RATE_P_NUM'];
														$ROST_CPOS = $row2['ROST_CPOS'];
														$EXPERT_MIL_ID = $row2['EXPERT_MIL_ID'];
														$RATE_P_REMARK = $row2['RATE_P_REMARK'];
														$RATE_P_NUMBER = $row2['RATE_P_NUMBER'];
														$RATE_P_RANK = $row2['RATE_P_RANK'];
														$SALARY_ID = $row2['SALARY_ID'];
														$ACK_ID = $row2['ACK_ID'];
														$RATE_P_VERSION = $row2['RATE_P_VERSION'];
														$ROSTT_ID = $row2['ROST_ID'];
														$ROST_OLD_ID = $row2['ROST_OLD_ID'];*/

														$i = 0;

					
														$sql5 ="SELECT * FROM j3_ack WHERE ACK_NUM_ID = :ACK_NUM_ID";
														$stmt5=$db->prepare($sql5);
														$stmt5->bindparam(':ACK_NUM_ID',$ACK_NUM_ID);
														$stmt5->execute();
														while($row5=$stmt5->fetch(PDO::FETCH_ASSOC)){
															$ACK_NUM_ID = $row5['ACK_NUM_ID'];
															$ACK_ID = $row5['ACK_ID'];
															$ACK_MISSION = $row5['ACK_MISSION'];
															$ACK_DISTRIBUTION = $row5['ACK_DISTRIBUTION'];
															$ACK_ESSENCE = $row5['ACK_ESSENCE'];
															$ACK_SCOPE = $row5['ACK_SCOPE'];
															$ACK_DIVISION = $row5['ACK_DIVISION'];
															$ACK_EXPLANATION = $row5['ACK_EXPLANATION'];
															$ACK_SUMMARY = $row5['ACK_SUMMARY'];
															$ACK_USER = $row5['ACK_USER'];
															$ACK_NAME = $row5['ACK_NAME'];
															$UNIT_CODE_2 = $row5['UNIT_CODE'];
															$UNIT_NAME = $row5['UNIT_NAME'];
															$UNIT_NAME_ACK = $row5['UNIT_NAME_ACK'];
															$UNIT_CODE_PARENT = $row5['UNIT_CODE_PARENT'];
															$ACK_TIMESTAMP = $row5['ACK_TIMESTAMP'];
															$ACK_STS = $row5['ACK_STS'];
															$ACK_VERSION = $row5['ACK_VERSION'];


															$sql3 = "SELECT *,COUNT(ROST_ID) FROM j3_rost_transaction WHERE ACK_NUM_ID LIKE '".$ACK_NUM_ID."' GROUP BY ROST_POSNAME_ACM  
																ORDER BY `j3_rost_transaction`.`ROST_ID` ASC";
															$stmt3=$db->prepare($sql3);
															$stmt3->bindparam(':UNIT_CODE_2',$UNIT_CODE_2);
															$stmt3->execute();
															while($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
																$COUNT = $row3['COUNT(ROST_ID)'];
																$ROST_UNIT = $row3['ROST_UNIT'];
																$ROST_CPOS = $row3['ROST_CPOS'];
																$ROST_POSNAME = $row3['ROST_POSNAME'];
																$ROST_POSNAME_ACM = $row3['ROST_POSNAME_ACM'];
																$ROST_RANK = $row3['ROST_RANK'];
																$ROST_RANKNAME = $row3['ROST_RANKNAME'];
																$ROST_LAO_MAJ = $row3['ROST_LAO_MAJ'];
																$ROST_NCPOS12 = $row3['ROST_NCPOS12'];
																$ROST_ID = $row3['ROST_ID'];
																$ROST_PARENT = $row3['ROST_PARENT'];	
																$ROST_NUNIT = $row3['ROST_NUNIT'];	
																$ROST_NPARENT = $row3['ROST_NPARENT'];

																$i++;

															

																?>
																<tr>
																	<td style="width: 20px; text-align: center;"><?=$i?></td>
																	<td style="width: 150px; text-align: center;"><?=$ROST_CPOS?></td>
																	<td style="width: 600px;"><?=$ROST_POSNAME?></td>
																	<td style="width: 350px;"><?=$ROST_POSNAME_ACM?></td>
																	<td style="width: 20px; text-align: center;">
																		<?php
																		if($ROST_RANK == "19" || $ROST_RANK == "29"){
																			echo '-';
																		}elseif($ROST_RANK != "19" || $ROST_RANK != "29"){
																			echo $COUNT;
																		}
																		?>
																		
																	</td>
																	<td style="width: 150px; text-align: center;"><?=$ROST_NCPOS12?></td>
																	<td style="text-align: center;">        
																		<div class="table-actions">
																			<button type="button" id="link_modal" data-toggle="modal" data-target="#EditModal" data-id="<?=$ROST_ID;?>" class="btn btn-success btn-sm editbtn"><i class="fas fa-pencil-alt"></i></button></a>
																			<a href='delete_rate_p.php?id3=<?=$ROST_ID?>&id4=<?=$ACK_NUM_ID?>' onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')"><button type="button" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-ban"></i></button></a>
																		</div>
																	</td>
																</tr>
															<?php }} ?>                                                             
														</tbody>
													</table>
												</div>
											</div>

											<div id="Contact" class="tabcontent">
												<a href="export_word_explan.php?id=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-primary"><i class="fas fa-file-word"></i> WORD</button></a>
												<a href="report_4.php?id=<?=$ACK_NUM_ID?>"><button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Print</button></a><br><br>
												<div class="form-group">
													<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">คำชี้แจง :</font></label>
													<textarea class="form-control" id="editor4" rows="4" name="ACK_EXPLANATION" style="border-width:1px; border-color: gray;font-weight: bold; font-size: 18px;" DISABLED><?=$ACK_E?></textarea>
												</div>	
											</div>

											<div id="About" class="tabcontent">
												<a href="report_5.php?id=<?=$ACK_NUM_ID;?>"><button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Print</button></a>
												<div class="card-body">
													<table id="example2" class="table table-bordered table-striped">
														<thead class="bg-primary">                                                        
															<tr>
																<th style="text-align: center;">หมายเลข อฉก.</th>
																<th>หมายเลขสิ่งอุปกรณ์</th>
																<th>ชื่อสิ่งอุปกรณ์</th>
																<th style="text-align: center;">จำนวน</th>
																<th style="text-align: center;">หน่วยงานที่รับผิดชอบ</th>
																<th style="text-align: center;">Manage</th>
															</tr>
														</thead>
														<tbody>
															<?php
															include ('connectpdo.php');
															$sql8 = "SELECT * FROM j3_rateitem WHERE ACK_ID = :ACK_ID";
															$stmt8=$db->prepare($sql8);
															$stmt8->bindparam(':ACK_ID',$ACK_ID);
															$stmt8->execute();
															while($row8=$stmt8->fetch(PDO::FETCH_ASSOC)){
																$RATE_I_NUM = $row8['RATE_I_NUM'];
																$ACK_ID = $row8['ACK_ID'];
																$RATE_I_NUM_POS = $row8['RATE_I_NUM_POS'];
																$NSN_ID = $row8['NSN_ID'];
																$NSN_NAME = $row8['NSN_NAME'];
																$RATE_I_TOTAL = $row8['RATE_I_TOTAL'];
																$RATE_I_REMARK = $row8['RATE_I_REMARK'];
																$P_ID = $row8['P_ID'];
																$RATE_I_UPD_DATE = $row8['RATE_I_UPD_DATE'];
																$RATE_I_DEPARTMENT = $row8['RATE_I_DEPARTMENT'];
																?>
																<tr>
																	<td style="width: 140px; text-align: center;"><?=$ACK_ID?></td>
																	<td style="width: 200px;"><?=$NSN_ID?></td>
																	<td style="width: 350px;"><?=$NSN_NAME?></td>
																	<td style="width: 150px; text-align: center;"><?=$RATE_I_TOTAL?></td>
																	<td style="width: 400px; text-align: center;"><?=$RATE_I_DEPARTMENT?></td>
																	<td style="text-align: center;">        
																		<div class="table-actions">
																			<button type="button" id="link_modal" data-toggle="modal" data-target="#EditModal" data-id="<?=$ROST_ID;?>" class="btn btn-success btn-sm editbtn"><i class="fas fa-pencil-alt"></i></button></a>
																			<a href='unit_structure_01.php?id=<?=$UNIT_CODE;?>'><button type="button" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-ban"></i></button></a>
																		</div>
																	</td>
																</tr>
															<?php } ?>                                                             
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">			
								<div class="col-md-6">
									<div class="card">
										<div class="card-body">
											<div class="dt-responsive">
												<table id="lang-dt" class="table table-striped table-bordered nowrap">
													<tbody>
														<tr>
															<th style="width: 260px;" class="table-primary"><font style="font-size: 18px;">หมายเลขอัตราเฉพาะกิจ :</font></th>
															<td><font style="font-size: 18px; font-weight: bold;"><?=$ACK_ID?></font></td>
														</tr>
														<tr>
															<th class="table-primary"><font style="font-size: 18px;">ชื่อหมายเลขอัตราเฉพาะกิจ :</font></th>
															<td><font style="font-size: 18px; font-weight: bold;"><?=$ACK_NAME?></font></td>
														</tr>
														<tr>
															<th class="table-primary"><font style="font-size: 18px;">หมายเลขหน่วย :</font></th>
															<td><font style="font-size: 18px; font-weight: bold;"><?=$UNIT_CODE_2?></font></td>
														</tr>
														<tr>
															<th class="table-primary"><font style="font-size: 18px;">นามหน่วย: </font></th>
															<td><font style="font-size: 18px; font-weight: bold;"><?=$UNIT_NAME?></font></td>
														</tr>
														<tr>
															<th class="table-primary"><font style="font-size: 18px;">นามหน่วยย่อ :</font></th>
															<td><font style="font-size: 18px; font-weight: bold;"><?=$UNIT_NAME_ACK?></font></td>
														</tr>
														<tr style="vertical-align: middle;">
															<th class="table-primary"><font style="font-size: 18px;"  valign="middle">สถานะข้อมูล :</font></th>
															<td><font style="font-size: 18px; font-weight: bold;"  valign="middle">


																<?php
																if($ACK_STS=="อนุมัติ"){
																	echo "<font color='green'><b>$ACK_STS</b></font>";
																}else if($ACK_STS=="รอการอนุมัติ"){
																	echo "<font color='orange'><b>$ACK_STS</b></font>";
																}else{
																	echo "<font color='red'><b>$ACK_STS</b></font>";
																}            
																?>

															</font>
															<?php
															if($ACK_STS=="อนุมัติ"){
																echo "";
															}else if($ACK_STS=="รอการอนุมัติ"){
																echo "
																<a href='change_sts.php?id1=$ACK_NUM_ID'><button type='button' class='btn btn-icon btn-danger' style='float: right;' onClick=\"javascript:return confirm('ต้องการอนุมัติ '-'$ACK_ID'-');\" ><i class='fas fa-ban' ></i></button></a>
																<a href='change_sts.php?id=$ACK_NUM_ID'><button type='button' class='btn btn-icon btn-success' style='float: right;' onClick=\"javascript:return confirm('ต้องการอนุมัติ '-'$ACK_ID'-');\"><i class='fas fa-check'></i></button></a>
																";
															}else{
																echo "";
															}            
															?>
														</td>
													</tr>

												</tbody>		      
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-body">

										<?php
										$sql5 = "SELECT ACK_SUMMARY as SUMMARY FROM j3_ack WHERE ACK_ID = :ACK_ID";
										$stmt5=$db->prepare($sql5);
										$stmt5->bindparam(':ACK_ID',$ACK_ID); 
										$stmt5->execute();
										$row5=$stmt5->fetch(PDO::FETCH_ASSOC);
										$SUMMARY = $row5['SUMMARY'];
										?>

										<div class="form-group">
											<label for="exampleTextarea1"><font style="font-weight: bold; font-size: 18px;">สรุปปะหน้า :</font></label>
											<textarea class="form-control" id="exampleTextarea1" rows="10" name="ACK_SCOPE" style="border-width:1px; border-color: gray; font-weight: bold; font-size: 18px;" DISABLED><?=$SUMMARY?></textarea>
										</div>	
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<button type="button" class="btn btn-primary" style="height: 40px; width: 150px;" onclick="window.location.href='upd_ack.php?id=<?=$ACK_NUM_ID?>'"><i class="ik ik-edit-2"></i>แก้ไขข้อมูล</button>
								<button type="button" class="btn btn-danger" style="height: 40px; width: 150px;" onclick="window.location.href='read_ack.php'"><i class="ik ik-info"></i>ย้อนกลับ</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="EditModal">
			<div class="modal-dialog modal-xl">
				<form method="post" id="user_form" enctype="multipart/form-data" action="ct_create_p_ack.php">
					<div class="modal-content">
						<div class="modal-header">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewLastInsert">
								ดูข้อมูลที่เพิ่มล่าสุด
							</button>

							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="upd_id" id="upd_id">
							<div class="form-row">
								<div class="form-group col-md-12">
								<label><b>ค้นหาตำแหน่งหน้าที่</b></label>
									<select name="search" class="form-control">
										<option value="">--กรุณาเลือก--</option>
										<?php
										include ('connect.php');
										$sql = "SELECT * FROM j3_cpos";
										$res = mysqli_query($conn, $sql);
										while($row= mysqli_fetch_assoc($res)) {
											echo '<option value="'.$row['ROST_CPOS'].'" data-ROST_CPOS_NAME="'.$row['ROST_CPOS_NAME'].'" data-ROST_CPOS_ACM="'.$row['ROST_CPOS_ACM'].'" >'.$row['ROST_CPOS_NAME'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label><b>หมายเลข อฉก.</b></label>
									<input type="text" class="form-control form-control-inverse" name="ACK_ID" value="<?=$ACK_ID?>">
								</div>
								<div class="form-group col-md-2">
									<label><b>รหัสประจำตำแหน่ง</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_CPOS" id="ROST_CPOS">
								</div>
								<div class="form-group col-md-5 ROST_POSNAME_2">
									<label><b>ตำแหน่งหน้าที่</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_POSNAME" id="ROST_POSNAME_2">
									<div id="list_3"></div>
								</div>
								<div class="form-group col-md-3">
									<label><b>ตำแหน่งหน้าที่(ย่อ)</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_POSNAME_ACM">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-3">
									<label><b>หมายเลขหน่วย</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_PARENT">
								</div>
								<div class="form-group col-md-3">
									<label><b>หมายเลข (ศูนย์/สำนัก)</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_NUNIT">
								</div>
								<div class="form-group col-md-3">
									<label><b>หมายเลขกอง</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_NPARENT">
								</div>
								<div class="form-group col-md-3">
									<label><b>หมายเลขแผนก</b></label>
									<input type="text" class="form-control form-control-inverse" name="ROST_UNIT">
								</div>
								<div class="form-group col-md-2">
									<label for="inputPassword4"><b>ชั้นยศ</b></label>
									<select class="form-control form-control-inverse" name="RATE_P_RANK">
										<option selected>กรุณาเลือก...</option>
										<?php
										include ('connect.php');
										$sql = "SELECT * FROM j1_rank";
										$res = mysqli_query($conn, $sql);
										while($row= mysqli_fetch_assoc($res)) {
											echo '<option value="'.$row['ROST_RANK'].'" data-ROST_LAO_MAJ="'.$row['ROST_RANKNAME'].'" data-ROST_CDEP="'.$row['ROST_CDEP'].'" >'.$row['ROST_RANKNAME'].'</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="inputPassword4"><b>กำเนิดสายวิทยาการ</b></label>
									<select class="form-control form-control-inverse" name="LAO_ID">
										<option value="">กรุณาเลือก...</option>
										<?php
										$sql = "SELECT * FROM j3_lao";
										$res = mysqli_query($conn, $sql);
										while($row= mysqli_fetch_assoc($res)) {
											echo '<option value="'.$row['ID'].'">'.$row['LAO_NAME'].'</option>';
										}
										?>
									</select>
								</div>
									<div class="form-group col-md-2 D_ID_2">
									<label for="inputPassword4"><b>กลุ่มงาน</b></label>
									<input type="text" class="form-control form-control-inverse" id="D_ID_2" require>
									<div id="list_d_2"></div>
								</div>
								<div class="form-group col-md-2">
									<label for="inputPassword4"><b>เหล่า</b></label>
									<select class="form-control form-control-inverse" name="RATE_SEQ">
										<option value="">กรุณาเลือก...</option>
										<option>สธ.</option>
										<option>เสธ/ไม่เสธ</option>
										<option>ไม่เสธ/เสธ</option>
										<option>-</option>
									</select>
								</div>
								<input type="hidden" name="D_ID_2">
					<!--	<div class="form-group col-md-2">
							<label><b>เหล่า</b></label>
							<select class="form-control form-control-inverse" name="ROST_LAO_MAJ">
								<option value="">กรุณาเลือก...</option>
								<option value="0">ทั่วไป</option>
								<option value="1">ทบ.</option>
								<option value="2">ทอ.</option>
								<option value="3">ทร.</option>
							</select>
						</div> -->
						<div class="form-group col-md-2">
							<label><b>เงินเดือนอัตรา</b></label>
							<select class="form-control form-control-inverse" name="SALARY_ID">
								<option value="">กรุณาเลือก...</option>
								<?php
								$sql = "SELECT * FROM j1_salary";
								$res = mysqli_query($conn, $sql);
								while($row= mysqli_fetch_assoc($res)) {
									echo '<option value="'.$row['CSAL_CODE'].'">'.$row['CSAL_RADUB'].' '.$row['CSAL_CHUN'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label><b>เลขกรมบัญชีกลาง</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_NCPOS12">
						</div>
					</div>    
					<div class="form-row">
						<div class="form-group col-md-9">
							<label><b>ชกท.</b></label>
							<input type="text" class="form-control form-control-inverse" name="EXPERT_MIL_ID">
						</div>
						<div class="form-group col-md-3">
							<label><b>ยอด (อัตรา)</b></label>
							<input type="text" class="form-control form-control-inverse" name="RATE_P_NUMBER">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label><b>หมายเหตุ</b></label>
							<textarea class="form-control form-control-inverse" name="RATE_P_REMARK" rows="4"></textarea>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<!--    <input type="hidden" name="AJY_ACK_ID" id="AJY_ACK_ID" /> -->
					<input type="hidden" name="ROST_CDEP" id="ROST_CDEP" />
					<input type="hidden" name="operation" id="operation" />
					<input type="hidden" name="ROST_ID" id="ROST_ID" />
					<input type="submit" name="updatedata" id="action" class="btn btn-success" value="เพิ่มข้อมูล" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่าง</button>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="modal fade" id="modalPersonal">
	<div class="modal-dialog modal-xl">
		<form method="post" id="per_form" enctype="multipart/form-data" action="ct_create_p_ack.php">
			<div class="modal-content">
				<div class="modal-body">
					<input type="hidden" name="upd_id" id="upd_id">
					<div class="form-row">
						<div class="form-group col-md-2">
							<label><b>หมายเลข อฉก.</b></label>
							<input type="text" class="form-control form-control-inverse" name="ACK_ID" value="<?=$ACK_ID?>">
						</div>
						<div class="form-group col-md-2">
							<label><b>รหัสประจำตำแหน่ง</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_CPOS">
						</div>
						<div class="form-group col-md-5 ROST_POSNAME_1">
							<label><b>ตำแหน่งหน้าที่</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_POSNAME" id="ROST_POSNAME_1">
							<div id="list"></div>
						</div>
						<div class="form-group col-md-3">
							<label><b>ตำแหน่งหน้าที่(ย่อ)</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_POSNAME_ACM">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label><b>หมายเลขหน่วย</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_PARENT" value="<?=$ROST_PARENT?>" require>
						</div>
						<div class="form-group col-md-3">
							<label><b>หมายเลข (ศูนย์/สำนัก)</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_NUNIT" value="<?=$ROST_NUNIT?>" require>
						</div>
						<div class="form-group col-md-3">
							<label><b>หมายเลขกอง</b></label>
								<select class="form-control form-control-inverse" name="ROST_NPARENT" require>
								<option selected>กรุณาเลือก</option>
									<?php
									$sql_nrpt_approve = "SELECT ROST_NPARENT FROM j3_rost_transaction WHERE ROST_NUNIT = :UNIT_CODE_2 GROUP BY ROST_NPARENT ";
									$stmt_nrpt_approve=$db->prepare($sql_nrpt_approve);
									$stmt_nrpt_approve->bindparam(':UNIT_CODE_2',$UNIT_CODE_2);
									$stmt_nrpt_approve->execute();
									while($row_nrpt_approve=$stmt_nrpt_approve->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row_nrpt_approve['ROST_NPARENT'].'">'.$row_nrpt_approve['ROST_NPARENT'].'</option>';
									}
									?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label><b>หมายเลขแผนก</b></label>
							<select class="form-control form-control-inverse" name="ROST_RANK" require>
										<option selected>กรุณาเลือก...</option>
										<?php
										$sql_nrpt_approve1 = "SELECT ROST_UNIT FROM j3_rost_transaction WHERE ROST_NUNIT = :UNIT_CODE_2 GROUP BY ROST_UNIT ";
										$stmt_nrpt_approve1=$db->prepare($sql_nrpt_approve1);
										$stmt_nrpt_approve1->bindparam(':UNIT_CODE_2',$UNIT_CODE_2);
										$stmt_nrpt_approve1->execute();
										while($row_nrpt_approve1=$stmt_nrpt_approve1->fetch(PDO::FETCH_ASSOC)){
											echo '<option value="'.$row_nrpt_approve1['ROST_UNIT'].'">'.$row_nrpt_approve1['ROST_UNIT'].'</option>';
										}
										?>
							</select>
						</div>
						<div class="form-group col-md-2">
									<label for="inputPassword4"><b>ชั้นยศ</b></label>
									<select class="form-control form-control-inverse" name="RATE_P_RANK" require>
										<option selected>กรุณาเลือก...</option>
										<?php
										include ('connect.php');
										$sql = "SELECT * FROM j1_rank";
										$res = mysqli_query($conn, $sql);
										while($row= mysqli_fetch_assoc($res)) {
											echo '<option value="'.$row['ROST_RANK'].'" data-ROST_LAO_MAJ="'.$row['ROST_RANKNAME'].'" data-ROST_CDEP="'.$row['ROST_CDEP'].'" >'.$row['ROST_RANKNAME'].'</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="inputPassword4"><b>กำเนิดสายวิทยาการ</b></label>
									<select class="form-control form-control-inverse" name="LAO_ID" require>
										<option value="">กรุณาเลือก...</option>
										<?php
										$sql = "SELECT * FROM j3_lao";
										$res = mysqli_query($conn, $sql);
										while($row= mysqli_fetch_assoc($res)) {
											echo '<option value="'.$row['ID'].'">'.$row['LAO_NAME'].'</option>';
										}
										?>
									</select>
								</div>
									<div class="form-group col-md-2 D_ID_1">
									<label for="inputPassword4"><b>กลุ่มงาน</b></label>
									<input type="text" class="form-control form-control-inverse" id="D_ID_1" require>
									<div id="list_d_1"></div>
								</div>
								<div class="form-group col-md-2">
									<label for="inputPassword4"><b>เหล่า</b></label>
									<select class="form-control form-control-inverse" name="RATE_SEQ" require>
										<option value="">กรุณาเลือก...</option>
										<option>สธ.</option>
										<option>เสธ/ไม่เสธ</option>
										<option>ไม่เสธ/เสธ</option>
										<option>-</option>
									</select>
								</div>
								<input type="hidden" name="D_ID_1">
					<!--	<div class="form-group col-md-2">
							<label><b>เหล่า</b></label>
							<select class="form-control form-control-inverse" name="ROST_LAO_MAJ">
								<option value="">กรุณาเลือก...</option>
								<option value="0">ทั่วไป</option>
								<option value="1">ทบ.</option>
								<option value="2">ทอ.</option>
								<option value="3">ทร.</option>
							</select>
						</div> -->
						<div class="form-group col-md-2">
							<label><b>เงินเดือนอัตรา</b></label>
							<select class="form-control form-control-inverse" name="SALARY_ID" require>
								<option value="">กรุณาเลือก...</option>
								<?php
								$sql = "SELECT * FROM j1_salary";
								$res = mysqli_query($conn, $sql);
								while($row= mysqli_fetch_assoc($res)) {
									echo '<option value="'.$row['CSAL_CODE'].'">'.$row['CSAL_RADUB'].' '.$row['CSAL_CHUN'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label><b>เลขกรมบัญชีกลาง</b></label>
							<input type="text" class="form-control form-control-inverse" name="ROST_NCPOS12" require>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-9">
							<label><b>ชกท.</b></label>
							<input type="text" class="form-control form-control-inverse" name="EXPERT_MIL_ID" require>
						</div>
						<div class="form-group col-md-3">
							<label><b>ยอด (อัตรา)</b></label>
							<input type="text" class="form-control form-control-inverse" name="RATE_P_NUMBER" require>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label><b>หมายเหตุ</b></label>
							<textarea class="form-control form-control-inverse" name="RATE_P_REMARK" rows="4"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<!--    <input type="hidden" name="AJY_ACK_ID" id="AJY_ACK_ID" /> -->
					<input type="hidden" name="ROST_CDEP" id="ROST_CDEP" />
					<input type="hidden" name="operation" id="operation" />
					<input type="hidden" name="ROST_ID" id="ROST_ID" />
					<input type="submit" name="updatedata" id="action" class="btn btn-success" value="เพิ่มข้อมูล" />
					<button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่าง</button>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="viewLastInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลที่เพิ่มล่าสุด</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table id="lastdata" class="table table-bordered table-striped">
					<thead class="bg-primary">                                                        
						<tr>
							<th style="text-align: center;">เลขประจำตำแหน่ง</th>
							<th>ชื่อตำแหน่ง</th>
							<th>ชื่อตำแหน่งเดิม</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<footer class="main-footer">
	<strong>Copyright &copy; 2019 </strong>
	Multi Innovation Engineering Co.,Ltd
</footer>


<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<style>
	* {box-sizing: border-box}
	/* Set height of body and the document to 100% */
	body, html {
		height: 100%;
		margin: 0;
		font-family: Arial;
	}
	/* Style tab links */
	.tablink {
		background-color: #87cefa;
		color: black;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 14px 16px;
		font-size: 17px;
		width: 20%;
	}
	.tablink:hover {
		background-color: #79CDCD;
	}
	/* Style the tab content (and add height:100% for full page content) */
	.tabcontent {
		color: #555;
		display: none;
		padding: 100px 20px;
		height: 100%;
	}
</style>
<script>
	function myFunction() {
		window.print();
	}
</script>

<script src="temp_index/plugins/jquery/jquery.min.js"></script>
<script src="temp_index/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<script src="temp_index/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="temp_index/plugins/chart.js/Chart.min.js"></script>
<script src="temp_index/plugins/sparklines/sparkline.js"></script>
<script src="temp_index/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="temp_index/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="temp_index/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="temp_index/plugins/moment/moment.min.js"></script>
<script src="temp_index/plugins/daterangepicker/daterangepicker.js"></script>
<script src="temp_index/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="temp_index/plugins/summernote/summernote-bs4.min.js"></script>
<script src="temp_index/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="temp_index/dist/js/adminlte.js"></script>
<script src="temp_index/dist/js/pages/dashboard.js"></script>
<script src="temp_index/dist/js/demo.js"></script>
<script src="temp_index/plugins/jquery/jquery.min.js"></script>
<script src="temp_index/plugins/datatables/jquery.dataTables.js"></script>
<script src="temp_index/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>

<script>
	function openPage(pageName,elmnt,color) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].style.backgroundColor = "";
		}
		document.getElementById(pageName).style.display = "block";
		elmnt.style.backgroundColor = color;
	}
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});
	});
</script>

<script>
	$(function () {
		$("#example3").DataTable();
		$('#example4').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});
	});
</script>
<script>  
 $(document).ready(function(){  
      $('#ROST_POSNAME_1').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"data_cpos.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#list').fadeIn();  
                          $('#list').html(data);   
                     }  
                });  
           }  
      });  
      $(document).on('click', '.ROST_POSNAME_1 ul li', function(){ 
           $('#ROST_POSNAME_1').val($(this).text());  
           $('#list').fadeOut();
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('#ROST_POSNAME_2').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"data_cpos.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#list_3').fadeIn();  
                          $('#list_3').html(data);   
                     }  
                });  
           }  
      });  
      $(document).on('click', '.ROST_POSNAME_2 ul li', function(){ 
           $('#ROST_POSNAME_2').val($(this).text());  
           $('#list_3').fadeOut();
      });  
 });  
 </script>
<script>
	$(document).ready(function () {
		$('#EditModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var ROST_ID = button.data('id') // Extract info from data-* attributes
                    var modal = $(this)
                    
                    $.ajax({
                    	type: "POST",
                    	url: "query_p_ack.php",
                    	data: {rost_id:ROST_ID , do:'modal_edit_p_ack'},
                    	dataType: "json",
                    	success: function (response) {
                    		var arr_input_key = ['ACK_ID', 'ROST_CPOS', 'ROST_POSNAME'  , 'ROST_POSNAME_ACM' , 'ROST_NCPOS12', 'ROST_ID', 'ROST_PARENT', 'ROST_NUNIT', 'ROST_NPARENT' , 'ROST_UNIT' ]
                    		var arr_select_key = ['ROST_RANK' , 'CLAO_NAME_SHORT' ]
							var arr_old_key = ['ROST_POSNAME'  , 'ROST_POSNAME_ACM']
                    		$.each(response, function (indexInArray, valueOfElement) { 
                    			if (jQuery.inArray(indexInArray, arr_input_key) !== -1){
                    				if (valueOfElement != ''){
                    					modal.find('input[name="'+indexInArray+'"]').val(valueOfElement)
                    				}
                    			}
                    			if (jQuery.inArray(indexInArray, arr_select_key) !== -1){
                    				if (valueOfElement != ''){
                    					if (indexInArray == 'CLAO_NAME_SHORT'){
                    						modal.find('select[name="RATE_P_RANK"]').val(valueOfElement)
                    					}else{
                    						modal.find('select[name="'+indexInArray+'"]').val(valueOfElement)
                    					}
                    				}
                    			}

								if (jQuery.inArray(indexInArray, arr_old_key) !== -1){
                    				if (valueOfElement != ''){
                    					modal.find('input[name="'+indexInArray+'"]').attr('old-'+indexInArray, valueOfElement)
                    				}
                    			}

                    		});
                    		modal.find('#ROST_ID').val(ROST_ID)
                    	}
                    });
                })
	});
	$('#EditModal form#user_form').on('submit', function (event) {
		var _this = $(this)
		$.ajax({
			type: "POST",
			url: "query_p_ack_edit.php",
			data: _this.serialize()+"&do=updatedata_p_ack",
			// dataType: "json",
			success: function (response) {
				console.log(response)
				// alert('บันทึกข้อมูลเรียบร้อยแล้ว')
			}
		});
		event.preventDefault()
	});
	$('#viewLastInsert').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) 
		var modal = $(this)
		var editmodal = $('#EditModal')
		var ROST_CPOS = editmodal.find('input[name="ROST_CPOS"]').val()
		var ROST_PARENT = editmodal.find('input[name="ROST_PARENT"]').val()
		var ROST_NUNIT = editmodal.find('input[name="ROST_NUNIT"]').val()
		var ROST_NPARENT = editmodal.find('input[name="ROST_NPARENT"]').val()
		var ROST_UNIT = editmodal.find('input[name="ROST_UNIT"]').val()
		$.ajax({
			type: "POST",
			url: "query_p_ack.php",
			data: {ROST_PARENT, ROST_NUNIT, ROST_NPARENT, ROST_UNIT , ROST_CPOS , do:'viewlast'},
			dataType: "json",
			success: function (response) {
				if (response){
					console.log(response)
					if ($.fn.DataTable.isDataTable('#lastdata')) {
						$('#lastdata').dataTable().fnClearTable();
						$('#lastdata').dataTable().fnDestroy();
					}
					LoadCurrentReport(response)
				}
			}
		});
	});
	function LoadCurrentReport(oResults) {
		var oTblReport = $("#lastdata")
		oTblReport.DataTable ({
			"data" : oResults,
			"searching": false,
			"bAutoWidth": false,
			"columns" : [
			{ "data" : "ROST_CPOS" },
			{ "data" : "ROST_POSNAME" },
			{ "data" : "ROST_POSTNAME_OLD"},
			]
		});
	}
	$('#modalPersonal select[name="ROST_NPARENT"]').on('change', function () {
		var _this = $(this)
		var rost_nparent= $(this).val()
		var rost_postname = $('#modalPersonal input[name="ROST_POSNAME"]').attr('old-value')
		var rost_postname_acm = $('#modalPersonal input[name="ROST_POSNAME_ACM"]').attr('old-value')
		$.ajax({
			type: "POST",
			url: "data_cpos.php",
			data: {do:'get_NRPT_NAME' , ROST_NPARENT:rost_nparent},
			dataType: "json",
			success: function (response) {
				console.log(response)
				$('#modalPersonal input[name="ROST_POSNAME"]').val(rost_postname +response.NRPT_NAME)
				$('#modalPersonal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm +response.NRPT_ACM)
				_this.attr('old-value' , response.NRPT_NAME)
				_this.attr('old-value-acm' , response.NRPT_ACM)
			}
		});
	});
	$(document).on("click",'li[class="form-control form-control-inverse form-main"]',function() {
    	$('#modalPersonal input[name="ROST_POSNAME"]').attr('old-value', $(this).text() )
		$('#modalPersonal input[name="ROST_CPOS"]').val( $(this).attr('attr-rost-cpos') )
		$('#modalPersonal input[name="ROST_POSNAME_ACM"]').val( $(this).attr('attr-rost-cpos-acm') )
		$('#modalPersonal input[name="ROST_CPOS"]').attr('old-value' , $(this).attr('attr-rost-cpos'))
		$('#modalPersonal input[name="ROST_POSNAME_ACM"]').attr('old-value' , $(this).attr('attr-rost-cpos-acm'))
	});
	$('#modalPersonal select[name="ROST_RANK"]').on('change', function () {
		var _this = $(this)
		var rost_nparent=  $('#modalPersonal select[name="ROST_NPARENT"]').attr('old-value')
		var rost_postname = $('#modalPersonal input[name="ROST_POSNAME"]').attr('old-value')
		var rost_nparent_acm =  $('#modalPersonal select[name="ROST_NPARENT"]').attr('old-value-acm')
		var rost_postname_acm = $('#modalPersonal input[name="ROST_POSNAME_ACM"]').attr('old-value')
		$.ajax({
			type: "POST",
			url: "data_cpos.php",
			data: {do:'get_NRPT_NAME' , ROST_NPARENT:_this.val()},
			dataType: "json",
			success: function (response) {
				console.log(response)
				if (response.NRPT_ACM != rost_nparent_acm){
				     $('#modalPersonal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm + response.NRPT_ACM.split(".")[1] + rost_nparent_acm)
				    }else{
				     $('#modalPersonal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm + rost_nparent_acm)
				    }	
			}
		});
	});
	$('#EditModal select[name="ROST_NPARENT"]').on('change', function () {
		var _this = $(this)
		var rost_nparent= $(this).val()
		var rost_postname = $('#EditModal input[name="ROST_POSNAME"]').attr('old-value')
		var rost_postname_acm = $('#EditModal input[name="ROST_POSNAME_ACM"]').attr('old-value')
		$.ajax({
			type: "POST",
			url: "data_cpos.php",
			data: {do:'get_NRPT_NAME' , ROST_NPARENT:rost_nparent},
			dataType: "json",
			success: function (response) {
				console.log(response)
				$('#EditModal input[name="ROST_POSNAME"]').val(rost_postname +response.NRPT_NAME)
				$('#EditModal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm +response.NRPT_ACM)
				_this.attr('old-value' , response.NRPT_NAME)
				_this.attr('old-value-acm' , response.NRPT_ACM)
			}
		});
	});
	$(document).on("click",'li[class="form-control form-control-inverse form-main"]',function() {
    	$('#EditModal input[name="ROST_POSNAME"]').attr('old-value', $(this).text() )
		$('#EditModal input[name="ROST_CPOS"]').val( $(this).attr('attr-rost-cpos') )
		$('#EditModal input[name="ROST_POSNAME_ACM"]').val( $(this).attr('attr-rost-cpos-acm') )
		$('#EditModal input[name="ROST_CPOS"]').attr('old-value' , $(this).attr('attr-rost-cpos'))
		$('#EditModal input[name="ROST_POSNAME_ACM"]').attr('old-value' , $(this).attr('attr-rost-cpos-acm'))
	});
	$('#EditModal select[name="ROST_RANK"]').on('change', function () {
		var _this = $(this)
		var rost_nparent=  $('#EditModal select[name="ROST_NPARENT"]').attr('old-value')
		var rost_postname = $('#EditModal input[name="ROST_POSNAME"]').attr('old-value')
		var rost_nparent_acm =  $('#EditModal select[name="ROST_NPARENT"]').attr('old-value-acm')
		var rost_postname_acm = $('#EditModal input[name="ROST_POSNAME_ACM"]').attr('old-value')
		$.ajax({
			type: "POST",
			url: "data_cpos.php",
			data: {do:'get_NRPT_NAME' , ROST_NPARENT:_this.val()},
			dataType: "json",
			success: function (response) {
				console.log(response)
				if (response.NRPT_ACM != rost_nparent_acm){
				     $('#EditModal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm + response.NRPT_ACM.split(".")[1] + rost_nparent_acm)
				    }else{
				     $('#EditModal input[name="ROST_POSNAME_ACM"]').val(rost_postname_acm + rost_nparent_acm)
				    }	
			}
		});
	});
	$(document).ready(function(){
      $('#D_ID_2').keyup(function(){
			var query_d = $(this).val();
			if(query_d != '')
			{
					$.ajax({
						url:"data_cpos.php",
						method:"POST",
						data:{query_d:query_d},
						success:function(data)
						{
							$('#list_d_2').fadeIn();
							$('#list_d_2').html(data);
						}
					});
			}
		});
		$(document).on('click', '.D_ID_2 ul li', function(){
			// alert($(this).attr('attr-d_id'))
			$('#D_ID_2').val($(this).text());
			$('#EditModal input[type="hidden"][name="D_ID_2"]').val( $(this).attr('attr-d_id_2') );
			$('#list_d_2').fadeOut();
		});
	});
	$(document).ready(function(){
      $('#D_ID_1').keyup(function(){
			var query_a = $(this).val();
			if(query_a != '')
			{
					$.ajax({
						url:"data_cpos.php",
						method:"POST",
						data:{query_a:query_a},
						success:function(data)
						{
							$('#list_d_1').fadeIn();
							$('#list_d_1').html(data);
						}
					});
			}
		});
		$(document).on('click', '.D_ID_1 ul li', function(){
			// alert($(this).attr('attr-d_id'))
			$('#D_ID_1').val($(this).text());
			$('#modalPersonal input[type="hidden"][name="D_ID_1"]').val( $(this).attr('attr-d_id_1') );
			$('#list_d_1').fadeOut();
		});
	});
	$('#modalPersonal form#per_form').on('submit', function (event) {
			var _this = $(this)
			$.ajax({
				type: "POST",
				url: "query.php",
				data: _this.serialize()+"&do=updatedata_p_ack",
				dataType: "json",
				success: function (response) {
					console.log(response)
					if(response == 'success'){
						alert('บันทึกข้อมูลเรียบร้อยแล้ว')
						location.reload();
					}
					// alert('บันทึกข้อมูลเรียบร้อยแล้ว')
				}
			});
			// console.log( $(this).serialize() )
		event.preventDefault()
	});
	$('select[name="search"]').select2({
		width: '100%'
	});

	$('select[name="search"]').on('change', function () {
		var _this = $(this)
		var selected_rost_postname  = _this.find("option[value='" + _this.val() + "']").attr('data-rost_cpos_name')
		var selected_rost_postname_acm  = _this.find("option[value='" + _this.val() + "']").attr('data-rost_cpos_acm')
		var old_rost_postname = $('input[name="ROST_POSNAME"]').attr('old-rost_posname')
		var old_rost_postname_acm = $('input[name="ROST_POSNAME_ACM"]').attr('old-rost_posname_acm')
		// var selected_rost_postname = $('select[name="search"]').select2().find(":selected").data("data-ROST_CPOS_NAME'");
		if(_this.val()){
			$('input[name="ROST_POSNAME"]').val(selected_rost_postname + ' ' + old_rost_postname)
			$('input[name="ROST_POSNAME_ACM"]').val(selected_rost_postname_acm + '' + old_rost_postname_acm)
			$('input[name="ROST_CPOS"]').val(_this.val())
		}
	});

	$('#EditModal').on('hidden.bs.modal', function (event) {
		location.reload()
	})
</script>

</body>
</html>
<?
		$fieldNames = array("id","Name","Type","Type(a)","Paid","Paid(a)","Start Date","End Date","Reason","Status","Apply Date");
		$tableName="leave_absence";
//		$required = "0,1,6,7";

//		$fieldShow[5]["type"]="__SELECT";
		$fieldEdit[1]["type"]="__SELECT";
		$fieldShow[1] = $fieldEdit[1]["content"] = into_array("emp");
		$fieldEdit[2]["type"]=$fieldEdit[3]["type"]="__RADIO";
		$fieldEdit[2]["content"]=$fieldEdit[3]["content"]=$fieldShow[2]=$fieldShow[3]=array("","Sick Leave","Casual Leave","Annual Leave");
		
		$fieldEdit[4]["type"]=$fieldEdit[5]["type"]="__RADIO";
		$fieldEdit[4]["content"]=$fieldEdit[5]["content"]=$fieldShow[4]=$fieldShow[5]=array("","Yes","No");
		
		$fieldEdit[9]["type"]="__RADIO";
		$fieldEdit[9]["content"]=$fieldShow[9]=array("","Accepted","Deferred & Accepted","Rejected");
		
		?>
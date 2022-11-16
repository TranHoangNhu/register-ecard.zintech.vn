<!DOCTYPE HTML>
<html>
<head>
<head>
<title>ZinSpa-Phần mềm quản lý Spa, Thẩm mỹ, Nails, Salon</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="Phần mềm quản lý spa ZinSpa" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Custom CSS -->
<link href="../css/style1.css" rel='stylesheet' type='text/css' />
<link href="../css/font-awesome.css" rel="stylesheet"> 
<link href="../css/custom.css" rel="stylesheet">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!--  ChartJS   -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- DataLabels plugin --> 
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>

<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<link href="images/favicon-zintech.png" rel='icon' type='image/x-icon' /> 
<!---//webfonts--->  
<!-- Boostrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<!--Moment JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<!-- Boostrap Datetimepicker CSS + JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css">

<!-- Custom JS -->
<script src="../js/custom.js"></script>
<style>
.table.doanhthu > tbody > tr:last-child > td {
	color: green;
	font-weight: 700;
}

[id^="chart_legends"] ul{
   list-style: none;
   white-space: nowrap;
   margin-top: 10px;
   padding-left: 0;
	font-size: 18px;
}

[id^="chart_legends"] li span{
   width: 62px;
   height: 20px;
   display: inline-block;
   margin: 0 5px 8px 0;
   vertical-align: -9.4px;
}

.seperator {
	border-top: 8px dotted #bbb;
  	border-radius: 1px;
  	margin: 20px 0
}

@media all and (min-width:769px){
	
	[id^="chart_legends"] ul{
	   margin-top: 100px;
	   font-size: 1.3vw;
	}
 }

	
@media all and (max-width:667px){
	
	[id^="chart_legends"] ul {
	   	margin-top: 100px;
		font-size: 1.3vw;
		font-weight: 700;
	}
	
	[id^="chart_legends"] li span {
		width: 7em;
		height: 3em;
	}
	
	.loop_start > div:nth-child(1), .loop_start > div:nth-child(2){
		background: #F0F8FF;
		min-height: 250px;
	}
	
	.seperator{ 
		visibility: hidden;
	}

	
}	

@media all and (max-width:375px) {

	[id^="chart_legends"] ul {
	    margin-top: 18vh;
	    font-size: 1.8vw;
	    font-weight: 700;
		position: relative;
		right: 1em;
	}

	[id^="chart_legends"] li span {
    	width: 5em;
    	height: 2em;
	}

	.dophu_baygio, .dophu_khac{
		height: 235px!important;
	}

}
	
	
.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
	background-color: #fff!important;
	color: #555;
}

.nav-tabs > li > a, .nav-tabs > li > a:focus{
	color: #fff;
}

.form-control .do-phu{
	border: 1px solid #555!important;
	border-radius: 0px!important;
}

/**
 * Striped table for popup
 */
.dataTables_wrapper #ktv_list_filter input{
  width: 21em;
}
.dataTables_wrapper #ktv_list_filter {
  width:50%;
  text-align:center;
  float: left;
}

/**
 * Fake table
 */
 .Table
{
    display: table;
}
.Heading
{
  display: table-header-group;
  font-weight: bold;
  text-align: center;
  background-color: #ddd;
}
.Row
{
  display: table-row;
}
.Cell
{
  display: table-cell;
  width: 27%;
  border: solid;
  border-width: thin;
  padding: 3px 10px;
  border: 1px solid #999999;
  text-align: center;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
</head>
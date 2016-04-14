<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>PIN CODE - MANIPUR</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_popup.php"); ?>
<div class="container">
 <div class="page-content">
 	<div class="inv-main">	
    
  <div class="panel panel-success">  <!----------------------START price list Information-------------->
	 <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    PIN code <span class="panel-subTitle"> ( Manipur )</span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
   </h3>
   </div>
                                      
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="test_name_price_table">
<thead align="left">
	<tr>
      <th> Pin Code </th>
      <th> Area </th>
      <th> District </th>
      <th> State </th>
	</tr>
</thead>
<tbody>
   <tr>
     <td>795001</td>
     <td>D.m College So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Imphal Bazar So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Imphal H.o.</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>K M College Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Khoyathong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Kshetribangoon Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Kshetrigao Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Laikoiching Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Ngarian Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Nungsai Chiru Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Phubala Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795001</td>
     <td>Soibam Leikai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Ahallup Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Awangpotshangbam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Heingang Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Karakhul Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Khonghampat Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Khurukhul Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Konthakhabam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Loitang Leikinthabi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Luwangsangbam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Mantripukhri So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795002</td>
     <td>Tendongyang (p) Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Canchipur (t/c/d) Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Kunja (p) Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Kyamgei Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Langthabal Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Manipur University</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Mongsangei Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795003</td>
     <td>Ningombam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Central Agriculture University</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Iroisemaba Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Lamboi Khongnagkhong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Lamphelpat So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Langol Housing Complex Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Noremthong Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Sagolband Thingom Leikai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Sayang Kuraomakhong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795004</td>
     <td>Tera Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795005</td>
     <td>Awang Konmgpal Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795005</td>
     <td>Khurai Khongnang Makhong Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795005</td>
     <td>Moirang Kampu Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795005</td>
     <td>Porompat So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795005</td>
     <td>Takhel Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795007</td>
     <td>Karong So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Irilbung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Keirao Bitra Salam</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Keirao Makting Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Keirao Wangkhem Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Khongangpheidekpi Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Kitnapanung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Kongba Bazar Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Laiphrak Maring Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Mongkhang Lambi Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Oinam Thingel Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Singjamei So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795008</td>
     <td>Uchekon Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Bitrarakhong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Haoreibi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Hiyangthang Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Irom Meijrao Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Kodompokpi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Paobitek Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Samurou Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Wangoi So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795009</td>
     <td>Yumnam Khunou Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Chingmang Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Heinoumakhong Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Huidrom Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Kameng Kakching Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Lamlai Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Lamlong So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Moirang Purel Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Ningthemchakhul Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Nongdam Tangkhul Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Nongoda Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Phaknung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Sawombung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Tangkhul Hungdung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Taretkhul Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795010</td>
     <td>Yourbung Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795015</td>
     <td>Maram So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Chairen Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Jul Bangching Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>K. Molnam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Khambathel Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Khongnangpheisani Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Longja Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>M Bongmol Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Mahou Tera Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Sangaikot</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Serou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Shahumphai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795101</td>
     <td>Sugnu So</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Aigejang Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Anal Khullen Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Chakpikarong So</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Gobok Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Khengjoi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Khubungh Khullen Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Monbi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Phiran Machet Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Sajik Tampak Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Sehao Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Semol Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Thorchom Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Toupokpi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795102</td>
     <td>Zoupi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Arong Nongmaikhong Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Elangkhangpokpi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Hivanalam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Kakching Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Kakching So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Kalikalok Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Keirak Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Langmeidon Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Leingangching Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Mairembam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Mantak Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Nodoom Bazar Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Pangaltabi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Purum Pantha Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Sora Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Tokpaching Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Wabagai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Waikhong Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795103</td>
     <td>Wangoo Laipham Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Chawanamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Chingai Khullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Kaibi Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
     <td>795104</td>
     <td>Laii Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Liyai Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Liyal Khunou Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Paomata Centre Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Phaibung Khullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Saranamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Siraffi Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Tadubi So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795104</td>
     <td>Tungjoy Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Koide Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Lakhamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Maiba Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Makhan Bazar Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Phuba Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795105</td>
     <td>Purul Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Lairouching Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Oinam Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Oklong Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Rajamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Senapati So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Thingba Khullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Thingba Khunou Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Tumuyan Khullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Willang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795106</td>
     <td>Yangkhullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>J Phaijang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>Motbung So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>N. Khenjang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>Nurathel Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>S.bolkot Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>Saitu Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>Sapermeina Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795107</td>
     <td>Thingsat Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Chalwa (p) Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Cheljang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Ganel Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Irang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Kolhen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>T Waichong</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795112</td>
     <td>Thengjang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Crpf Langjing So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Haorang Kairel Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Khamnam Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Khangakhul Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Khumbong Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Konthoujam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Langjing Achouba Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Longa Koireng Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Maklang Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Natok Kabui Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>New Keithelmanbi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Ngairangbam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Sagoltongba Bazar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Tairenpokpi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Takyel Khongbal Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Tharoijam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795113</td>
     <td>Yurembam Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Dolaithabi Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Haraorou Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Kairang Litan Makhong Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Khongbal Tangkhul Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Khumidok (p) Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Liklikhong Bazar Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Mapao Keithelmanbi Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Pngaei Yangdong So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Pukhao Ahallup Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Sagolmang Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Satang Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Thangal Surung Edbo</td>
     <td>Not Available</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Uyumpok Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Waiton Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Wakhen Phai Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795114</td>
     <td>Yumnam Khunou Edbo</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>Bidyanagar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>Br Colony Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>Gularthol So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>Kashimpur Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>Keimai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795115</td>
     <td>New Keiphundai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Bongmun Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Borobekra Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Champanagar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Chingmun Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Jakurdhar Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Jiribam Bazar So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Kh Jaikhan Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Lalkhai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Latingkhal Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Longpi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Ngaphabung Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Patpuimun Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Phaibok Mullen Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Sonapur Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Suangpuimun Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795116</td>
     <td>Tuitengmun Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Khouwpuibung Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Mual Vaiphei Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Saikot So</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Tuikham Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Tuining Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795117</td>
     <td>Tuitengphai Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Bunglong Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Galam Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Gangpijang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Ichaigojang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Jangnoi Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Makeng Ngarolu Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Makokchung Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Molkon Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Mutukhong Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Pangjang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Phaikon Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Saikul So</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Sangpei Khullen Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>T. Awkhumbung Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Tingpibung Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795118</td>
     <td>Zelengphai Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Chandraman Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Haipi Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Kalapahar So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Keithelmanbi Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Kheijang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Persian Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Thanamba Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795122</td>
     <td>Tokpa Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Charoi Khullel Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Jiban Nager Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Leimatak Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Loktak Project So</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Mayuran Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Sadukhoiroi Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795124</td>
     <td>Tokpalamdan Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Atang Khunou Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Chaiton Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Dullen (t/c/d) Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Illong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Jampii (t/c/d) Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Kadi Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Kasanlong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Khumphung Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Kuilong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Lemta Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Lenglong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Magulong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>New Lambala Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Takou Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Tamei So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795125</td>
     <td>Upper Selsi (t/c/d) Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Bishnupur So</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Dolang</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Dolang Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Dolang Khunou</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Haotak Khullen Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Khoijuman Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Khongbung Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Khunpi Naosem Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Lamdangmei Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Ngaikhong Khullen Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Ningthoukhong Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Potsangbam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Thangal Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Thinungei Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Toubul Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795126</td>
     <td>Zouzangtek Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795127</td>
     <td>Chandel So</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795127</td>
     <td>Duthang Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795127</td>
     <td>Larong Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795127</td>
     <td>Liwasari Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795127</td>
     <td>Mittong Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Aina Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Bungmual Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Chehjang Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Chothemunpi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Churachandpur Mdg</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Geljaing Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Hamkeilon Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Henglep Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Kangvai Bazar Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Khanpi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Kolhen Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Kumbipukhri Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Kwanpui Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Lailong Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Lingshiphai Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Lungsai Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Lungshung Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Mission Compound Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Mualkoi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Munpi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Panglian Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Pearsonmun Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Phaipheng Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Saiden Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Saikhul Village</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Sangphou Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Santing Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Sielmet Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>South Kotlein Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Takvam Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Teiyong Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Thangshi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Thinkew Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Tollen Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Tolphei Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Tuinom Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Tulaphei Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795128</td>
     <td>Ukha Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Hengbung Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Kangpokpi Mission Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Kangpokpi So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Maohiing Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Maohing Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Taphou Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Thonglang Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795129</td>
     <td>Toribari Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Arapyi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Chajing Pt Ii Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Haoreibi Mayai Leikai</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Heinoumakhong Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Lilong So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Nungei Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Phunalmaring Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Thiyamkonjil Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Turelahnabi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795130</td>
     <td>Urup Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Bongajang Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Bongjoi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Chenpal Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Gamphajal Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Khudengthabi Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Maojam Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Molchamedbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Moreh So</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>New Somtal Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>T- Bongmun Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Tengnoupal Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>T-minou Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795131</td>
     <td>Yangoulen Edbo</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Chabung Company Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Loukok Mayai Leikai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Maibam Konjil Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Mayang Impahl Bengoon Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Mayang Imphal So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Mutum Phibou Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Phoubakchao Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Santhel Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Sekmaijin Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Sekmaijin Khunou Konuma Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Sekmaijin Khunou Litan Makhong</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Tera Khoidum Mayai Leikai Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Uchiwa Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795132</td>
     <td>Uchiwa Wangban Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Boroyangbi Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Bunglon Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Dopkon Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Ethai Bazar Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Gelmol Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Haotakphailen Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Kangathei Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Khoirentak Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Khordak Ichin Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Khousabung Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Kumbi (p) Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Kwakta Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Moirang So</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Molphei Tampak Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Nabil (p) Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795133</td>
     <td>Naransena Edbo)</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Awangjiri Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Bungte Chiru Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Heikrujam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Irengbam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Isok Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Kabowakching Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Kamong Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Keinou Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Khabi Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Langpok Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Leimapokpam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Leimram Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Maibam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Manamayang Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Nambol So</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Naorem Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Oinam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Pukhrambam Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Tharoi Bomdiar Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Thinkai Khullen Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795134</td>
     <td>Utlou Edbo</td>
     <td>Bishnupur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Aimol Kodamphai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Angbrashu Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Bongli Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Chaton Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Chelhep Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Kambang Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Khangbaram Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Kharou Khullen Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Khoibu Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Khousat (t/c/d) Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Khudei Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Khunbi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Laiching Khongsang Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Lamkang Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Lamlong Khullen Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Lamlong Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Leibi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Liwachangning Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Machi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Minou Khunjao Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Molhang Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Moltek Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Narum Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Pallel So</td>
     <td>Chandel</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Saibhom Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Sita Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Songjang Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795135</td>
     <td>Thamnapokpi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Awang Leikinthabi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Ch. Khongnangpokpi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Kanglatongbi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Luwangsangol Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Makhan Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Potsangbam Khoirou Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795136</td>
     <td>Sekmai So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Athokpam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Athokpam Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Charangpat Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Haokha Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Irong Thokchom (t/c/d) Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Keibung Mamang Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Khangabok Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Khekmanedbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Kiyam Shiphai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Kshetri Leikai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Lembakhul Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Moijing Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Okram Wangmataba Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Phoudel Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Poirou Khongjil Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Sabaltongba Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Thoubal Block (t/c/d) Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Thoubal Khunou Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Thoubal Leisangthem Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Thoubal Ningombam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Thoubal So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795138</td>
     <td>Wangbal Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Behiang Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Hengtam Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Kangkap Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Lama Camp Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Lungchin Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Lungthul Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Mualmun Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Siabu Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Singhat So</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Songdoh Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Songtal Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795139</td>
     <td>Vokbual Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795140</td>
     <td>Laiphrakom Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795140</td>
     <td>Sangaiprou Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795140</td>
     <td>Tulihal So</td>
     <td>Imphal East</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795140</td>
     <td>Yarrow Meitram Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795141</td>
     <td>Tamenglong So</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Akhui Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Atengba Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Bhalok Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Bongoijang Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Chamu Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Chingai (p) Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Chingjaroiedbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Chither (p) Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Dailong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Huining Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Hundung Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Jessami Edno</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Kagai Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Kahulong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Keikao Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Khamasom Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Kharasom Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Khayang Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Khongjaron Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Khongjaron Khunthak Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Lamlang Gate Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Leisan Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Longpram Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Mapum Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Namtiram Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>New Pallong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Ngairou Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Nungbi Khunou Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Nungshang Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Paorei Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Paoyii Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Phungcham Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Poii Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Pushing Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Rajai Khunou Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Sirarakhong Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Siroi Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Songpram Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Sorang Phung Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>T.c. Ground Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tamenglong Khunjao Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tharon Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Thuilon Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tolloi Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tousem Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tuinem Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tungou Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Tushem Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Ukhrul So</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795142</td>
     <td>Wairengba Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Aibulon Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Bukpi Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Bungpilon Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Hanship Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Khajang Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Leijangphai Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Leison Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Millongmun Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Parbung Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Phaijang Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Pherazol Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Pmzol Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Sawaiphaih (t/c/d) Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Semon Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Singjawl Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Taithu Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Thanlon So</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Tingsong Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Tipaimukh (p) Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795143</td>
     <td>Tuabung Edbo</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Huime Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Kachal Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Khongdei Simphung Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Ngari Khullen Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Phadang Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Somdal So</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795144</td>
     <td>Thiwa Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Ashi Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Chadong Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Chassad Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Grihang Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Kongpat Khunou Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>L Tangkhul Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Lairabokhong Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Lambui Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Leiting Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Litan So</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Lungphu Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Maku Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Maokot Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Phungyar Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Sanakeithel Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Semol Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Shongshak Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Siyamongjam Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Sorde Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Thawai Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795145</td>
     <td>Yangangpokpi Edbo</td>
     <td>Ukhrul</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Christan Centre Haochong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Heibongpokpi Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Ijairong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Irengnaga Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Kangchup Chiru Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Kangchup Hill (p) Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Kangchup Makhong Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Karam Vaiphei Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Khundong Khukhaiba Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Lairen Sajik Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Lamdeng Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Lamsang So</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Mayang Langjing Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Oktan Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Phayeng Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795146</td>
     <td>Ponlian Edbo</td>
     <td>Imphal West</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Chongmun Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Kambiron Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Khoupum Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Mukti Khullen Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Nungba So</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Nungnang Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Rengpang Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795147</td>
     <td>Sibilong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Cherapur Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Heirok Part 2 Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Herok Part 1 Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Karongthel Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Khongjom Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Phundrei Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Puleilokpi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Salungpham Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Samaram Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Sangaiyumpham Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Sapam Salai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Tekcham Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Tentha Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Tollen Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795148</td>
     <td>Wangjing So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Andro Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Angtha Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Bongbal Khullen Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Changamdabi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Haokhongching Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Heinganglok Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Hulkap Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Irong Tangkhul Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Kamu Tampak Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Kamu Tongam Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Kamuching Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Kasom Khullen Edbo</td>
     <td>Not Available</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Khoirom Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Khonglou Vaiphei (t/c/d) Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Louremba Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Lungthar Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Mollen (t/c/d) Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Nambasi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Nongpok Sekmai Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Phouoibi Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Saram Patong Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Soichang Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Top Chingtha Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Yairipok So</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Yairipok Tulihal Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795149</td>
     <td>Yambem Laxmi Bazar Edbo</td>
     <td>Thoubal</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795150</td>
     <td>Mao So</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795150</td>
     <td>Pfukhro Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795150</td>
     <td>Phunanamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795150</td>
     <td>Pudunamei Edbo</td>
     <td>Senapati</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795158</td>
     <td>Chingkonpang So</td>
     <td>Churachandpur</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Awangkhul Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Charoi Tupul Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Haochong Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Khongsang Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Lukhambi Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Nagaching Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>New Kabui Khullen Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>None So</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Nungtek Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
   <tr>
        <td>795159</td>
     <td>Thingra Edbo</td>
     <td>Tamenglong</td>
     <td>Manipur</td>
   </tr>
</tbody>
</table>

<div class="clearfix"></div>
</div>

<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>    

<script type="text/javascript">

$(document).ready(function() {
	
 $('#test_name_price_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bInfo": false,
		"bBootstrap": true,
		"bAutoWidth": false,	
		    			
		"fnPreDrawCallback": function( oSettings ) 
		  {		
			$('.dataTables_filter input').addClass('form-control input-sm');
			$('.dataTables_filter input').attr('placeholder', 'Search');	
			$('.dataTables_filter input').css('height', '33px');
			$('.dataTables_length select').addClass('form-control input-sm');
			$('.dataTables_length select').css('height', '33px');	
			$('.dataTables_length select').css('margin-right', '3px');	
			$('.dataTables_length select').css('margin-bottom', '10px');
			$('.dataTables_length select').css('float', 'left');
		  }
		  			
     })
    })


</script>
</body>
</html>
<?php ob_flush(); ?>
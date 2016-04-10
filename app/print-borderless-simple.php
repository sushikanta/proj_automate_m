 <style media="print">
 @media print {
  *{
    color: #000 !important;
    text-shadow: none !important;
    background: transparent !important;
    box-shadow: none !important;
  }
 tr, img {
    page-break-inside: avoid;
  }
  img {
    max-width: 100% !important;
 }
  @page
{

    /* this affects the margin in the printer settings */
    margin: 0cm !important;
	margin-top: 0.5cm !important;
	padding: 0cm !important;
	font-size:6pt !important;
}

body{
	font-size:8pt !important;
	margin: 0px;
	padding:0px;
	}
.container{ margin-top:0px;}
h2 {
font-size: 24pt;
}

h4 {
font-size: 14pt;
margin-top: 25px;
}
  p,
  h2,
  h3 {
    orphans: 3;
    widows: 3;
  }
  h2,
  h3 {
    page-break-after: avoid;
  }

* {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          /*box-sizing: border-box;*/
		  -webkit-print-color-adjust:exact; /*--chrom fixed background issue*/
		  -webkit-text-stroke: 1px transparent; /*--chrom font issue*/
		 }

.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td { border: 1px solid transparent !important; }

.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td {
 border: 1px solid transparent !important;

vertical-align: top;
}

.table-hover > tbody > tr:nth-child(2n+1) > td, .table-hover > tbody > tr:nth-child(2n+1) > th { background-color: #e2e4ff !important; }
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th { background-color: #e2e4ff !important; }

.table{border:none !important;}
   * {
    color: #000 !important;
    text-shadow: none !important;
    background: transparent !important;
    box-shadow: none !important;
  }
 .no-border{ border:none !important;}
 .no-print{ display: none !important;}
 .blank{display: none !important; visibility:hidden !important; width: 0% !important;}
 .print_67{width: 100% !important;}
</style>

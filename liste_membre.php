<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fonts/font-awesome.css">
	<script type="text/javascript" src="bootstrap/js/jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/js/shieldui.all.min.css" />
	<script type="text/javascript" src="bootstrap/js/shieldui-all.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/jszip.min.js"></script>
</head>
<body style='padding: 5px'>
	<div class="container">
		<div class="row">
			<h1>Liste des membres</h1>
			<table id="exportTable" class="table table-hover"">
				<thead>
					<th>Nom</th>
					<th>Postnom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Promotion</th>
				</thead>
				<tbody>
					<?php
						require_once 'membre.php';

						$mb =  new membre();
						$mb->getAllmembers();
					?>
				</tbody>
				
			</table>
			<button id="exportButton" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-pdf-o"></span> Exporter PDF</button> ou 
			<button id="exportButton2" class="btn btn-lg btn-success clearfix"><span class="fa fa-file-excel-o"></span> Exporter Excel</button>
		</div>
	</div>
	<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Nom: { type: String },
                        Postnom: { type: String },
                        Prenom: { type: String },
                        Email: { type: String },
                        Promotion: { type: String }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "fideleplk",
                    created: new Date()
                });

                pdf.addPage("a4", "portrait");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "Nom", title: "Nom", width: 100 },
                        { field: "Postnom", title: "Postnom", width: 100 },
                        { field: "Prenom", title: "Prenom", width: 100 },
                        { field: "Email", title: "Adresse Email", width: 120 },
                        { field: "Promotion", title: "Promotion", width: 80 }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "listedesmembres"
                });
            });
        });
    });
</script>
<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton2").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Nom: { type: String },
                        Postnom: { type: String },
                        Prenom: { type: String },
                        Email: { type: String },
                        Promotion: { type: String }
                    }
                }
            });

            // when parsing is done, export the data to Excel
            dataSource.read().then(function (data) {
                new shield.exp.OOXMLWorkbook({
                    author: "fideleplk",
                    worksheets: [
                        {
                            name: "Liste des membre",
                            rows: [
                                {
                                    cells: [
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Nom"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Postnom"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Prenom"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Email"
                                        },
                                        {
                                            style: {
                                                bold: true
                                            },
                                            type: String,
                                            value: "Promotion"
                                        }
                                    ]
                                }
                            ].concat($.map(data, function(item) {
                                return {
                                    cells: [
                                        { type: String, value: item.Nom },
                                        { type: String, value: item.Postnom },
                                        { type: String, value: item.Prenom },
                                        { type: String, value: item.Email },
                                        { type: Number, value: item.Promotion }
                                    ]
                                };
                            }))
                        }
                    ]
                }).saveAs({
                    fileName: "listedesmembres"
                });
            });
        });
    });
</script>
</body>
</html>

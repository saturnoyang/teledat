<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<title>Teledat.cl INTRANET</title>
	<link rel="shortcut icon" href="favicon.ico" />	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<link rel="stylesheet" type="text/css" href="images/style.css">
	
	<script type="text/javascript" src="images/jquery.js"></script>
	
	<script type="type/javascript">
		$(document).ready(function(){
			$("#tab").click(function(){
				console.log("clicked");
				$("#extended-forecast").slideDown();
			});
		});
	</script>
</head>

<body id="page-body">

    <div id="demo-top-bar">

  <div id="demo-bar-inside">

    <h2 id="demo-bar-badge">
      <a href="http://www.teledat.cl/">www.teledat.cl</a>
    </h2>

    <div id="demo-bar-buttons">
          </div>

  </div>

</div>	
	<img id="background-img" class="bg" src="images/2260149771_00cb406fd6_o.jpg" alt="">
	
	<div id="weather-info">

	  <div id="extended-forecast">
		
    <p>Hi.</p>
			
	  </div>
		
		<div id="tab">
			IntraNET</div>
	<center>
	  <form name="form1" method="post" action="ingreso.php" autocomplete="off">
	    <table width="40%" border="1" align="center" cellpadding="0" cellspacing="0">
		    <tr>
		      <td colspan="3"><div align="left">Bienvienido</div></td>
	        </tr>
		    <tr>
		      <td width="10%" rowspan="2">&nbsp;</td>
		      <td>usuario:</td>
		      <td><label for="usr"></label>
	          <input type="text" name="usr" id="usr" /></td>
	        </tr>
		    <tr>
		      <td>contraseña:</td>
		      <td><label for="pswd"></label>
	          <input type="password" name="pswd" id="pswd" /></td>
	        </tr>
		    <tr>
		      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Enviar" /></td>
	        </tr>
	      </table>
      </form>
</center>
    
    
    	
</div>



	
	 <style type="text/css" style="display: none !important;">
	* {
		margin: 0;
		padding: 0;
	}
	body {
		overflow-x: hidden;
	}
	#demo-top-bar {
		text-align: left;
		background: #222;
		position: relative;
		zoom: 1;
		width: 100% !important;
		z-index: 6000;
		padding: 5px 0 5px;
	}
	#demo-bar-inside {
		width: 940px;
		margin: 0 auto;
		position: relative;
		overflow: hidden;
	}
	#demo-bar-buttons {
		padding-top: 10px;
		float: right;
	}
	#demo-bar-buttons a {
		font-size: 12px;
		margin-left: 20px;
		color: white;
		margin: 2px 0;
		text-decoration: none;
		font: 14px "Lucida Grande", Sans-Serif !important;
	}
	#demo-bar-buttons a:hover,
	#demo-bar-buttons a:focus {
		text-decoration: underline;
	}
	#demo-bar-badge {
		display: inline-block;
		width: 240px;
		padding: 0 !important;
		margin: 0 !important;
		background-color: transparent !important;
	}
	#demo-bar-badge a {
		display: block;
		width: 100%;
		height: 75px;
		border-radius: 0;
		bottom: auto;
		margin: 0;
		background: url(images/TELEDAT-02.jpg) no-repeat;
		background-size: 100%;
		overflow: hidden;
		text-indent: -9999px;
	}
	#demo-bar-badge:before, #demo-bar-badge:after {
		display: none !important;
	}
</style>	


</body></html>
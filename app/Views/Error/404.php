<style>
	* {
		transition: all 0.6s;
	}

	html {
		height: 100%;
	}

	body {
		font-family: 'Lato', sans-serif;
		color: #888;
		margin: 0;
	}

	#main {
		display: table;
		width: 100%;
		height: 100vh;
		text-align: center;
	}

	.fof {
		display: table-cell;
		vertical-align: middle;
	}

	.fof h1 {
		font-size: 50px;
		display: inline-block;
		padding-right: 12px;
		animation: type .5s alternate infinite;
	}

	a {
		background-color: #199319;
		color: white;
		padding: 15px 25px;
		text-decoration: none;
		border-radius: 10px;
	}

	@keyframes type {
		from {
			box-shadow: inset -3px 0px 0px #888;
		}

		to {
			box-shadow: inset -3px 0px 0px transparent;
		}
	}
</style>
<link rel="icon" href="<?= $this->ASSETS_URL ?>icon/logo.png">
<title>404 | MDL</title>

<div id="main">
	<div class="fof">
		<h1>Error 404</h1>
		<h4><a href="javascript:history.back()">Go Back</a></h4>
	</div>
</div>
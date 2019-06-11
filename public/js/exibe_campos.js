function toggleToFoto()
{
	document.getElementById('form-link').style.display = 'none';
	document.getElementById('form-file').style.display = 'block';
	document.getElementById('form-title').style.display = 'block';
	document.getElementById('form-desc').style.display = 'block';
}
function toggleToVideo()
{
	document.getElementById('form-link').style.display = 'block';
	document.getElementById('form-file').style.display = 'none';
	document.getElementById('form-title').style.display = 'none';
	document.getElementById('form-desc').style.display = 'none';
}

function toggleToDados()
{
	document.getElementById('form-dados_1').style.display = 'block';
	document.getElementById('form-dados_2').style.display = 'none';
}
function toggleToEndereco()
{
	document.getElementById('form-dados_1').style.display = 'none';
	document.getElementById('form-dados_2').style.display = 'block';
}
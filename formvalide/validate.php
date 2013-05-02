<?php

// Tipos de validacao disponiveis, e seus campos
static $types;
$types = array(
	'contato' => array(
		'nome' => array(
				'required' => true,
				'requiredMessage' => 'Este campo e obrigatorio',
				'existMessage' => 'Ja existe uma pessoa cadastrada com esse nome',
			),
		'email' => array(
				'required' => true,
				'requiredMessage' => 'Este campo e obrigatorio',
				'existMessage' => 'Ja existe uma pessoa cadastrada com este email',
			),
		'telefone' => array(
				'required' => false
			)
		),
	);
#echo $types['contato']['nome']['existMessage'];
#cho '<pre>';
#print_r( $types['contato']['nome']);
// Para saber quais campos que devem existir
$type = $_GET['i'];

if (isset($type) && array_key_exists($type, $types)) {
	
	$tempData = $_POST;
	$data = array();
	$erro = array();

	// Pega somente os campos que foram setados no '$types'
	foreach ($tempData as $input => $value) {
		if( array_key_exists($input, $types[$type]) ) {
			// Se for obrigatorio, e estiver vazio
			if ($types[$type][$input]['required']===true && empty($value)) {
				$erro['error'] = true;
				//$data['type'] = 'required';
				$erro[$input] = array('class'=>'empty','message'=>$types[$type][$input]['requiredMessage']);
			}


			// So repassa se nao for vazio, e se houve um erro
			if ( !empty($value) ) {
				$data[$input] = trim($value);
			}
		}
	}

	// Se nao passou no basico
	if (!empty($erro)) {
		echo json_encode($erro);
		return false;
	}

	// Valida de acordo com o '$type'
	switch ($type) {
		case 'contato':
			contatoValide($data,$types[$type]);
			break;
		
		default:
			# code...
			break;
	}

}



/*
	Funcoes de validacao
*/
function contatoValide ($data,$message) {
	// Importante resaltar que a '$data' ja chega aqui
	// somente com os parametros definidos no '$types'
	// e que nao estejam vazios
	// e passada por algumas validacoes basicas.

	// Efetua toda a validacao, como email valido ...
	// Pode ser feita uma busca na db, para comparacao

	// teste de comparacoes
	$nome = 'Guilherme';
	$email = 'guiiski@gmail.com';

	$returned = array();

	if($data['nome']==$nome) {
		$returned['error'] = true;
		$returned['nome'] = array(
			'class' => 'exist', // Classe css, para exibicao de cores diferentes
			'message' => $message['nome']['existMessage']
			);
	}

	echo json_encode($returned);
	#print_r($data);
}

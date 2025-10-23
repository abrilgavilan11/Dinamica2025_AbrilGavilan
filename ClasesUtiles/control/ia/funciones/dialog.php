<?php
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . realpath(__DIR__ . '/../credenciales.json'));

require __DIR__ . '/../vendor/autoload.php';
use Google\Cloud\Dialogflow\V2\Client\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\DetectIntentRequest;

class Dialog
{


    public function empezar($textoUsuario)
    {
        $projectId = 'adivineitor-sbkv';
        $sessionId = session_id();
        $languageCode = 'es';

        //Sesion que vamos a usar para que el chat sea unico
        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($projectId, $sessionId);


        //Texto que le ingresamos nosotros
        $textInput = new TextInput();
        $textInput->setText($textoUsuario);
        $textInput->setLanguageCode($languageCode);


        //preparamos el input para enviarlo al dialog
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        //La respuestita que nos manda dialog de vuelta
        $request = new DetectIntentRequest();
        $request->setSession($session);
        $request->setQueryInput($queryInput);



        $response = $sessionsClient->detectIntent($request);
        $resultado = $response->getQueryResult();


        return $resultado->getIntent()->getDisplayName();


    }
}
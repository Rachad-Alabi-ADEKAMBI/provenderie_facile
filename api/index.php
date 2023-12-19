<?php
//url: http://127.0.0.1/provenderie/api/subjects

include 'api.php';

try {
    if (!empty($_GET['demande'])) {
        $url = explode('/', filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            /* case 'hero':
                getHero();
                break;
            */

            case 'subjects':
                getSubjects();
                break;

            case 'chooseSubject':
                chooseSubject();
                break;
            case 'chooseItem':
                chooseItem();
                break;
            case 'calculate':
                calculate();
                break;

            default:
                throw new Exception("La demande n'est pas valide");
        }
    } else {
        throw new Exception('Problème de récupération de données. ');
    }
} catch (Exception $e) {
    $erreur = [
        'message' => $e->getMessage(),
        'code' => $e->getCode(),
    ];

    print_r($erreur);
}
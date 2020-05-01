<?php

namespace App\Service;

class EntityService{
    const passwordrules = [
        ['1','2','3','4','5','6','7','8','9','0'],
        ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
        ['&','#','-','_','@','|','+','-','/','*'],
    ];


	public static function  EntityToArray($entity){
			$result = [];
            // Boucle sur les attribut de l'entiity
            foreach ((array) $entity as $key => $value)
            {
                // exemple de $key : "App\Entity\Customer firstName"
                // attributName recevra uniquement "firstName"
                $attributName = trim(substr($key, strrpos($key, chr(0))));
                // à partir de attributName on va créer le nom du
                 // getter (exemple : getFirstName)
                $getter = 'get'.ucfirst($attributName); 
                // si la méthode existe et que la valeur n'est pas null
                if(method_exists($entity, $getter) && !is_null($value)) 
                {
                    // on l'ajoute à notre tableau associatif
                    $result[$attributName] = call_user_func([
                        $entity,
                        $getter
                    ]);
                }
            }
            // retourne le tableau associatif créé à partir de l'entity
            return $result;	
	}

    /**
    * $password : password
    * $len : length
    * 4 rules
    */
    public static function checkPassword($password,$len){
        $rules = [
            "len" => 0,
            "number" => 0,
            "letter" => 0,
            "special" => 0
        ];
        $response = 0;
        if(strlen($password) >= $len){
            $rules["len"] = 1;
            for($i = 0; $i<strlen($password);$i++){
                if(in_array($password[$i],self::passwordrules[0]))$rules["number"] = 1;
                if(in_array($password[$i],self::passwordrules[1]))$rules["letter"] = 1;
                if(in_array($password[$i],self::passwordrules[2]))$rules["special"] = 1;
            }
            if($rules["len"] == 1 && $rules["number"] == 1 && $rules["letter"] == 1 && $rules["special"] == 1)$response = 1;
        }
        return $response;
    }

}
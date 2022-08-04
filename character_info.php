<?php


########################################################################################################################################
// TESTING AREA

    $EVE = new EVE();
    $EVE->GET_CHARACTER_INFO();
########################################################################################################################################

    class EVE {



        private $CHARACTER_ID = "994843447";
        private $URL = 'https://login.eveonline.com/oauth/authorize?response_type=code&redirect_uri=http://localhost/oauth-callback&client_id={5fdf6fb4b8de40b694a0cab00252ca6e}&scope=esi-location.read_ship_type.v1%20esi-skills.read_skills.v1%20esi-wallet.read_character_wallet.v1%20esi-universe.read_structures.v1%20esi-contracts.read_character_contracts.v1%20esi-corporations.read_standings.v1';

        public function EVE_API($TYPE)
        {

            switch($TYPE)
            {


                case 'LOGIN':

                    $CURL_ARRAY = array
                    (
                        CURLOPT_URL => 'https://esi.evetech.net/latest/characters/'.$this->CHARACTER_ID.'/?datasource=tranquility',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Cache-Control: no-cache'),
                    );

                case 'CHARACTER_INFO':

                    $CURL_ARRAY = array
                    (
                        CURLOPT_URL => 'https://esi.evetech.net/latest/characters/'.$this->CHARACTER_ID.'/?datasource=tranquility',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Cache-Control: no-cache'),
                    );

                    break;

                case 'WALLET_BALANCE':

                    $CURL_ARRAY = array
                    (
                        CURLOPT_URL => 'https://esi.evetech.net/latest/characters/'.$this->CHARACTER_ID.'/wallet/?datasource=tranquility',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Cache-Control: no-cache'),
                    );

                    break;
            }
            $curl = curl_init();
            curl_setopt_array($curl, $CURL_ARRAY);
            $API_RESPONSE = curl_exec($curl);
            curl_close($curl);
            $API_RESULT = (array)json_decode($API_RESPONSE,true);
            return $API_RESULT;
        }

        public function GET_CHARACTER_INFO()
        {
            $API_RESULT_INFO = $this->EVE_API('CHARACTER_INFO');
            $API_RESULT_WALLET = $this->EVE_API('WALLET_BALANCE');


            print_r($API_RESULT_INFO);
            print_r($API_RESULT_WALLET);
        }


    }

?>
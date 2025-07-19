<?php
/*
 * @copyright Copyright (c) 2024 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\controllers;

use Altum\Response;
use Picqer\Barcode\BarcodeGeneratorSVG;

class BarcodeGenerator extends Controller {

    public function index() {

        if(empty($_POST)) {
            redirect();
        }

        /* :) */
        $available_barcodes = require APP_PATH . 'includes/enabled_barcodes.php';

        if(isset($_POST['json'])) {
            $_POST = json_decode($_POST['json'], true);
        }

        $_POST['type'] = isset($_POST['type']) && array_key_exists($_POST['type'], $available_barcodes) ? $_POST['type'] : 'text';

        /* Check for the API Key if needed */
        if(!isset($_POST['api_key']) || (isset($_POST['api_key']) && empty($_POST['api_key']))) {
            /* Check the guest plan */
            if(!$this->user->plan_settings->enabled_barcodes->{$_POST['type']}) {
                die();
            }
        } else {
            $user = db()->where('api_key', $_POST['api_key'])->where('status', 1)->getOne('users');

            if(!$user) {
                die();
            }
        }

        /* Process variables */
        $_POST['foreground_color'] = isset($_POST['foreground_color']) && preg_match('/#([A-Fa-f0-9]{3,4}){1,2}\b/i', $_POST['foreground_color']) ? $_POST['foreground_color'] : '#000000';
        $_POST['width_scale'] = isset($_POST['width_scale']) && in_array($_POST['width_scale'], range(1, 10)) ? (int) $_POST['width_scale'] : 2;
        $_POST['height'] = isset($_POST['height']) && in_array($_POST['height'], range(30, 1000)) ? (int) $_POST['height'] : 30;

        $_POST['is_bulk'] = (int) (bool) ($_POST['is_bulk'] ?? 0);
        if($_POST['is_bulk']) {
            $_POST['value'] = preg_split('/\r\n|\r|\n/', $_POST['value'])[0];
        }

        $data = trim($_POST['value']);

        /* :) */
        $barcode = new BarcodeGeneratorSVG();

        /* Check if data is empty */
        if(!trim($data)) {
            $data = 1;
        }

        /* Preprocessing */
        $data = $this->filter_barcode_data($data, $_POST['type']);

        if(!$data) {
            Response::json(l('barcodes.invalid_error_message'), 'error');
        }

        /* Generate the first SVG */
        try {
            $svg = $barcode->getBarcode($data, $_POST['type'], $_POST['width_scale'], $_POST['height'], $_POST['foreground_color']);
        } catch (\Exception $exception) {
            Response::json($exception->getMessage(), 'error');
        }

        $image_data = 'data:image/svg+xml;base64,' . base64_encode($svg);

        Response::json('', 'success', ['data' => $image_data, 'embedded_data' => $data]);

    }

    private function filter_barcode_data($data, $type) {
        $patterns = [
            'C32' => '/[^0-9A-Z ]/',
            'C39' => '/[^0-9A-Z\-.* $/+%]/',
            'C39+' => '/[^0-9A-Z\-.* $/+%]/',
            'C39E' => '/[^0-9A-Z\-.* $/+%]/',
            'C39E+' => '/[^0-9A-Z\-.* $/+%]/',
            'C93' => '/[^0-9A-Z\- $%+\/]/',
            'S25' => '/[^0-9]/',
            'S25+' => '/[^0-9]/',
            'I25' => '/[^0-9]/',
            'I25+' => '/[^0-9]/',
            'ITF14' => '/[^0-9]/',
            'C128' => '/[^!-~]/', // ASCII 33-126
            'C128A' => '/[^ !-_\x20-\x5F]/', // ASCII 32-95
            'C128B' => '/[^ !-~]/', // ASCII 32-126
            'C128C' => '/[^0-9]/', // Numeric pairs only (even length)
            'EAN2' => '/[^0-9]/',
            'EAN5' => '/[^0-9]/',
            'EAN8' => '/[^0-9]/',
            'EAN13' => '/[^0-9]/',
            'UPCA' => '/[^0-9]/',
            'UPCE' => '/[^0-9]/',
            'MSI' => '/[^0-9]/',
            'MSI+' => '/[^0-9]/',
            'POSTNET' => '/[^0-9]/',
            'PLANET' => '/[^0-9]/',
            'TELEPENALPHA' => '/[^A-Za-z0-9]/', // Alphanumeric only
            'TELEPENNUMERIC' => '/[^0-9]/',
            'RMS4CC' => '/[^0-9A-Z]/', // Alphanumeric (uppercase)
            'KIX' => '/[^0-9A-Z]/', // Alphanumeric (uppercase)
            'IMB' => '/[^0-9A-Z]/', // Alphanumeric (uppercase)
            'CODABAR' => '/[^0-9A-D\-\$:\/.+]/',
            'CODE11' => '/[^0-9\-]/',
            'PHARMA' => '/[^0-9]/',
            'PHARMA2T' => '/[^0-9]/',
        ];

        // Check if the barcode type is supported
        if (!array_key_exists($type, $patterns)) {
            return false;
        }

        // Apply the specific pattern to filter out invalid characters
        return preg_replace($patterns[$type], '', $data);
    }
}

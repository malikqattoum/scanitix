<?php
/*
 * @copyright Copyright (c) 2024 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\Controllers;

use Altum\Models\Plan;

class AdminUserView extends Controller {

    public function index() {

        $user_id = (isset($this->params[0])) ? (int) $this->params[0] : null;

        /* Check if user exists */
        if(!$user = db()->where('user_id', $user_id)->getOne('users')) {
            redirect('admin/users');
        }

        /* Get widget stats */
        $qr_codes = db()->where('user_id', $user_id)->getValue('qr_codes', 'count(`qr_code_id`)');
        $barcodes = db()->where('user_id', $user_id)->getValue('barcodes', 'count(`barcode_id`)');
        $links = db()->where('user_id', $user_id)->getValue('links', 'count(`link_id`)');
        $pixels = db()->where('user_id', $user_id)->getValue('pixels', 'count(`pixel_id`)');
        $projects = db()->where('user_id', $user_id)->getValue('projects', 'count(`project_id`)');
        $domains = db()->where('user_id', $user_id)->getValue('domains', 'count(`domain_id`)');
        $payments = in_array(settings()->license->type, ['Extended License', 'extended']) ? db()->where('user_id', $user_id)->getValue('payments', 'count(`id`)') : 0;

        /* Get the current plan details */
        $user->plan = (new Plan())->get_plan_by_id($user->plan_id);

        /* Check if its a custom plan */
        if($user->plan_id == 'custom') {
            $user->plan->settings = $user->plan_settings;
        }

        $user->billing = json_decode($user->billing);

        /* Main View */
        $data = [
            'user' => $user,
            'qr_codes' => $qr_codes,
            'barcodes' => $barcodes,
            'links' => $links,
            'pixels' => $pixels,
            'projects' => $projects,
            'domains' => $domains,
            'payments' => $payments,
        ];

        $view = new \Altum\View('admin/user-view/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
